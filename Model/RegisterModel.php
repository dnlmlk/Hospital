<?php

namespace App\Model;

use App\Core\DbModel;

class RegisterModel extends DbModel
{
    public string $email = '';
    public string $password = '';
    public string $confirmPassword = '';
    public string $role = '';
    public string $status = 'Not accepted';

    public function rules()
    {
        return [
            "email" => [self::RULE_REQUIRED, self::RULE_EMAIL, [self::RULE_UNIQUE, "class" => self::class]],
            "password" => [self::RULE_REQUIRED, [self::RULE_MIN, "min" => 8]],
            "confirmPassword" => [self::RULE_REQUIRED, [self::RULE_MATCH, "match" => "password"]],
            "role" => [[self::RULE_REQUIRED]]
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
            'password' => 'Password',
            'confirmPassword' => 'Password Confirm'
        ];
    }

    public function register()
    {
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        return parent::save();
    }

}