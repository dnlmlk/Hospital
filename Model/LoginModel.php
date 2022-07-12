<?php

namespace App\Model;

use App\Core\DbModel;

class LoginModel extends DbModel
{

    public string $email = '';
    public string $password = '';
    public string $role = '';
    public string $status = '';

    public function rules()
    {
        return [
            "email" => [self::RULE_REQUIRED],
            "password" => [self::RULE_REQUIRED],
            "role" => [self::RULE_REQUIRED]
        ];
    }

    public static function tableName($role): string
    {
        return $role."s";
    }

    public function attributes($role): array
    {
        return $role == "Patient" ? ['email', 'password'] : ['email', 'password', 'status'];
    }

    public function labels(): array
    {
        return [
            'email' => 'Email',
            'password' => 'Password'
        ];
    }

    public function login()
    {
        $user = parent::findOne(['email' => $this->email],static::tableName($this->role));
        if (!$user){
            $this->addError("email", "this user doesn't exist");
            return false;
        }
        if (!password_verify($this->password, $user->password)){
            $this->addError("password", "password doesn't match with email");
            return false;
        }
        if ($user->status == "Not accepted"){
            $this->addError("email", "this account not accepted yet");
            return false;
        }

        return true;
    }

}