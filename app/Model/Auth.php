<?php

namespace App\Model;

use App\Repository\UserRepository;

class Auth {
    public function login($email, $password) {
        $userRepo = new UserRepository();
        $userData = $userRepo->findByEmail($email);
        if(!$userData) {
            return false;
        }
        if(!$this->validatePasswords($userData, $password, $userRepo)) {
            return false;
        };
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
        if(!$userRepo->save($data)) {
            return false;
        }
        return true;
    }

    public function validatePasswords($userData, $password, UserRepository $userRepo)
    {
        if(!password_verify($password, $userData['password'])) {
            return false;
        }

        if(password_needs_rehash($userData['password'], PASSWORD_DEFAULT)) {
            $newHash = password_hash($userData['password'], PASSWORD_DEFAULT);
            $userData['password'] = $newHash;
            $userRepo->saveRehashedPassword($userData);
        }

        return true;
    }
}