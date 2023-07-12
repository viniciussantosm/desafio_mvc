<?php

namespace src\Repository;

use config\Database;
use src\Model\User;

class UserRepository extends Repository {

    private $conn;

    public function __construct()
    {
        $instance = Database::getInstance();
        $this->conn = $instance->getConn();
    }

    public function findAll()
    {
        $query = $this->conn->query("SELECT * FROM users");
        if($query->num_rows > 0) {
            $rows = $query->fetch_all(MYSQLI_ASSOC);
            $query->free_result();
            return $rows;
        }
        return [];
    }

    public function findById($id)
    {
        $query =  $this->conn->query("SELECT * FROM users WHERE id = $id");
        if($query->num_rows > 0) {
            $row = $query->fetch_assoc();
            $query->free_result();
            return $row;
        }
        return [];
    }

    public function findByEmail($email)
    {
        $query = $this->conn->query("SELECT * FROM users WHERE email = '$email'");
        if($query->num_rows > 0) {
            $row = $query->fetch_assoc();
            $query->free_result();
            return $row;
        }
        return [];
    }

    public function create($data)
    {
        if(!$this->dataVerify($data)) {
            return false;
        }
        $query = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $data['password'] = password_hash($data['password'], PASSWORD_ARGON2ID);
        $stmt->bind_param("sss", $data['name'], $data['email'], $data['password']);
        $result = $stmt->execute();

        if(!$result) return false;
        
        $result = $stmt->insert_id;
        session_start();
        $_SESSION["userId"] = $result;
        $_SESSION["name"] = explode(" ", $data['name'])[0];
        $_SESSION["isLoggedIn"] = true;
        return $result;
    }

    public function update($data)
    {
        $query = "UPDATE users SET name = ?, password = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);

        if(!$this->checkId($data['id'])) {
            return false;
        }

        if(!$this->checkName($data["name"])) return false;

        if(!$this->passwordConfirmVerify($data['password'], $data['passwordConfirm'])) {
            return false;
        }
        
        if(!$this->passwordVerify($data['password'])) {
            return false;
        }
        
        $data["password"] = password_hash($data["password"], PASSWORD_ARGON2ID);
        $stmt->bind_param("ssi", $data['name'], $data['password'], $data['id']);
        $result = $stmt->execute();
        return $result;
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }

    public function save()
    {
        // TODO: Implement save() method.
    }

    public function dataVerify($data) {
        if($this->findByEmail($data['email'])) {
            $_SESSION["message"]["type"] = "error";
            $_SESSION["message"]["value"] = "Email já existe";
            return false;
        }

        if(!$this->checkName($data["name"])) return false;

        if(!$this->passwordConfirmVerify($data['password'], $data['passwordConfirm'])) return false;

        if(!$this->passwordVerify($data['password'])) return false;

        return true;
    }

    public function passwordVerify($password)
    {
        if(strlen($password) < 6) {
            $_SESSION["message"]["type"] = "error";
            $_SESSION["message"]["value"] = "Senha precisa ter pelo menos 6 caracteres";
            return false;
        }

        if(!preg_match('/[A-Z]/', $password) || !preg_match('/[a-z]/', $password)) {
            $_SESSION["message"]["type"] = "error";
            $_SESSION["message"]["value"] = "Senha precisa ter pelo menos uma letra maiúscula e uma letra minúscula";
            return false;
        }

        return true;
    }

    public function checkId($id)
    {
        if($id != $_SESSION["userId"]) {
            $_SESSION["message"]["type"] = "error";
            $_SESSION["message"]["value"] = "Id de usuário inválido";
            return false;
        }
        return true;
    }

    function passwordConfirmVerify($password, $passwordConfirm)
    {
        if($password != $passwordConfirm) {
            $_SESSION["message"]["type"] = "error";
            $_SESSION["message"]["value"] = "As senhas não conferem";
            return false;
        }
        return true;
    }

    function checkName($name)
    {
        if(strlen($name) < 3) {
            $_SESSION["message"]["type"] = "error";
            $_SESSION["message"]["value"] = "Nome precisa ter pelo menos 3 caracteres";
            return false;
        }
        return true;
    }
}