<?php

namespace App\Model;

use App\Model\User;
use App\Repository\UserRepository;
use App\Router\Router;

class Auth {

    private User $user;

    public function __construct() {
    }

    public function login($email, $password) {
        $userRepo = new UserRepository();
        $userData = $userRepo->findByEmail($email);
        if(!$userData) {
            return false;
        }
        if(!$this->validatePasswords($userData, $password, $userRepo)) {
            return false;
        };
        // session_start();
        // $_SESSION['userId'] = $userData['id'];
        // $_SESSION['name'] = explode(" ", $userData['name'])[0];
        // $_SESSION['isLoggedIn'] = true;
        Session::setUserId($userData['id']);
        Session::setName(explode(" ", $userData['name'])[0]);
        Session::setLoggedIn(true);
        return true;
    }

    public function logout() {
        session_unset();
        session_destroy();
        return true;
    }

    public function register($data) {
        $userRepo = new UserRepository();
        if(!$userRepo->create($data)) {
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