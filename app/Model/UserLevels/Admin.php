<?php

namespace App\Model\UserLevels;

use src\Model\User;

class Admin extends User {
    public function getType()
    {
        return parent::ADMIN;
    }
}