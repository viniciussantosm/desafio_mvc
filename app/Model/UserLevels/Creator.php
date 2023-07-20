<?php

namespace App\Model\UserLevels;

use App\Model\User;

class Creator extends User {

    public function getType()
    {
        return parent::CREATOR;
    }
}