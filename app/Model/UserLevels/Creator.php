<?php

namespace App\Model\UserLevels;

use src\Model\User;

class Creator extends User {

    public function getType()
    {
        return parent::CREATOR;
    }
}