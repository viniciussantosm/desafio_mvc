<?php

namespace App\Model\UserLevels;

use App\Model\User;

class Admin extends User {
    public function getType()
    {
        return parent::ADMIN;
    }
}