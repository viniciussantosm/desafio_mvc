<?php

namespace App\Model;

use App\Model\User;
use App\Repository\UserRepository;
use App\Router\Router;

class Auth {

    private User $user;

    public function __construct() {
    }

    public function login($email) {
        $userRepo = new UserRepository();
        $userData = $userRepo->findByEmail($email);
        if(!$this->validatePasswords($userData, $_POST['password'], $userRepo)) {
            return false;
        };
        session_start();
        Session::setUserId($userData['id']);
        Session::setName(explode(" ", $userData['name'])[0]);
        Session::setLoggedIn(true);
        return true;
    }

    public function logout() {
        session_unset();
        session_destroy();
        Router::redirect("/posts/index");
    }

    public function register() {
        $userRepo = new UserRepository();
        if(!$userRepo->create($_POST)) {
            return false;
        }
        return true;
    }

    public function validatePasswords($userData, $password, UserRepository $userRepo)
    {
        if(password_verify($password, $userData['password'])) {
            if(password_needs_rehash($userData['password'], PASSWORD_ARGON2ID)) {
                $newHash = password_hash($userData['password'], PASSWORD_ARGON2ID);
                $userData['password'] = $newHash;
                $userRepo->update($userData);
            }
            return true;
        }
        return false;
    }
}