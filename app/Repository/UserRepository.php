<?php

namespace App\Repository;

use App\Model\Session;

class UserRepository extends Repository {

    private $queryBuilder = null;

    public function __construct()
    {
        $this->queryBuilder = $this->getQuery();
    }

    public function findAll()
    {
        return $this->queryBuilder->selectQuery("user");
    }

    public function findById($id)
    {
        return $this->queryBuilder->selectQuery("user", "*", "id = $id")[0];
    }

    public function findByEmail($email)
    {
        $user = $this->queryBuilder->selectQuery("user", "*", "email = '$email'");
        if(array_key_exists(0, $user)) {
            return $user[0];
        }
        return false;
    }

    public function saveRehashedPassword($data)
    {
        $this->queryBuilder->updateQuery("user", ["name", "email", "password"], [$data['name'], $data['email'], $data['password']], "id = {$data['id']}");
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }

    public function save($data)
    {

        if(array_key_exists("id", $data)) {

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
    
            $data["password"] = password_hash($data["password"], PASSWORD_DEFAULT);
    
            $result = $this->queryBuilder->updateQuery("user", ["name", "email", "password"], [$data['name'], $data['email'], $data['password']], "id = {$data['id']}");
            
            return $result;
        }

        if(!$this->dataVerify($data)) {
            return false;
        }

        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        $result = $this->queryBuilder->insertQuery("user", ["name", "email", "password"], [$data['name'], $data['email'], $data['password']]);

        if(!$result) {
            return false;
        }
        $user = $this->findByEmail($data['email']);
        Session::setUserId($user['id']);
        Session::setName(explode(" ", $user['name'])[0]);
        Session::setLoggedIn(true);
        return $result;
    }

    public function dataVerify($data) {
        if($this->findByEmail($data['email'])) {
            Session::setMessage("error", "Email já existe");
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
            Session::setMessage("error", "Senha precisa ter pelo menos 6 caracteres");
            return false;
        }

        if(!preg_match('/[A-Z]/', $password) || !preg_match('/[a-z]/', $password)) {
            Session::setMessage("error", "Senha precisa ter pelo menos uma letra maiúscula e uma letra minúscula");
            return false;
        }

        return true;
    }

    public function checkId($id)
    {
        if($id != Session::getUserId()) {
            Session::setMessage("error", "Id de usuário inválido");
            return false;
        }
        return true;
    }

    function passwordConfirmVerify($password, $passwordConfirm)
    {
        if($password != $passwordConfirm) {
            Session::setMessage("error", "As senhas não conferem");
            return false;
        }
        return true;
    }

    function checkName($name)
    {
        if(strlen($name) < 3) {
            Session::setMessage("error", "Nome precisa ter pelo menos 3 caracteres");
            return false;
        }
        return true;
    }
}