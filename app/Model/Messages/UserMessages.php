<?php

namespace App\Model\Messages;

class UserMessages extends Messages {

    private $userMessages = [
        "success" => [
            "dataUpdate" => "Dados atualizados com sucesso"
        ],
        "error" => [
            "dataUpdate" => "Erro ao atualizar dados"
        ]
    ];

    public function __construct()
    {
    }

    public static function getMessage(string $name, $type = null): string
    {
        if($type) {
            return self::$userMessages[$type][$name];
        }

        return self::$userMessages[$name];
    }
}