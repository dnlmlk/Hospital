<?php

namespace App\Core;

abstract class Model
{
    public const RULE_REQUIRED = "required";
    public const RULE_EMAIL = "email";
    public const RULE_MIN = "min";
    public const RULE_MATCH = "match";
    public const RULE_UNIQUE = "unique";
    public const RULE_SET_TIME = "setTime";

    public array $errors = [];

    public function checkAttributes($data)
    {
        foreach ($data as $attribute => $value){
            if (property_exists($this, $attribute)){
                $this->{$attribute} = $value;
            }
        }
    }
    abstract public function rules();


    public function validate()
    {
        foreach ($this->rules() as $attribute => $rules) {
            $value = $this->{$attribute};
            foreach ($rules as $rule) {
                $ruleName = $rule;
                if (!is_string($rule)) {
                    $ruleName = $rule[0];
                }
                if ($ruleName === self::RULE_REQUIRED && !$value) {
                    $this->addErrorByRule($attribute, self::RULE_REQUIRED);
                }
                if ($ruleName === self::RULE_EMAIL && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $this->addErrorByRule($attribute, self::RULE_EMAIL);
                }
                if ($ruleName === self::RULE_MIN && strlen($value) < $rule['min']) {
                    $this->addErrorByRule($attribute, self::RULE_MIN, ['min' => $rule['min']]);
                }
                if ($ruleName === self::RULE_MATCH && $value !== $this->{$rule['match']}) {
                    $this->addErrorByRule($attribute, self::RULE_MATCH, ['match' => $rule['match']]);
                }
                if ($ruleName === self::RULE_SET_TIME) {
                    $id = explode("_", $attribute)[1];
                    $until = 'until_'.$id;
                    $from = 'from_'.$id;

                    if ($value <= $this->{$from} && !empty($value)) {
                        $this->addErrorByRule($attribute, self::RULE_SET_TIME, ['setTime' => $rule['setTime']]);
                    }
                    elseif ((empty($this->{$attribute}) && !empty($this->{$from})) || (empty($this->{$from}) && !empty($this->{$attribute}))) {
                        $this->addErrorByRule($attribute,'notMatch');
                    }
                }
                if ($ruleName === self::RULE_UNIQUE) {
                    $className = $rule['class'];
                    $uniqueAttr = $rule['attribute'] ?? $attribute;
                    $tableName = $className::tableName($this->role);
                    $db = Application::$app->DB;
                    $statement = $db->prepare("SELECT * FROM $tableName WHERE $uniqueAttr = :$uniqueAttr");
                    $statement->bindValue(":$uniqueAttr", $value);
                    $statement->execute();
                    $record = $statement->fetchObject();
                    if ($record) {
                        $this->addErrorByRule($attribute, self::RULE_UNIQUE, ["field" => $this->getLabel($attribute)]);
                    }
                }
            }
        }
        return empty($this->errors);
    }

    public function errorMessages()
    {
        return [
            self::RULE_REQUIRED => 'This field is required',
            self::RULE_EMAIL => 'This field must be valid email address',
            self::RULE_MIN => 'Min length of this field must be {min}',
            self::RULE_MATCH => 'This field must be the same as {match}',
            self::RULE_UNIQUE => 'Record with with this {field} already exists',
            self::RULE_SET_TIME => 'This field must be the bigger than {setTime}',
            'notMatch' => 'Two fields must be full or empty'
        ];
    }

    public function errorMessage($rule)
    {
        return $this->errorMessages()[$rule];
    }

    private function addErrorByRule(string $attribute, string $rule, $params = [])
    {
        $params['field'] ??= $attribute;
        $errorMessage = $this->errorMessage($rule);
        foreach ($params as $key => $value) {
            $errorMessage = str_replace("{{$key}}", $value, $errorMessage);
        }
        $this->errors[$attribute][] = $errorMessage;
    }

    public function addError(string $attribute, string $message)
    {
        $this->errors[$attribute][] = $message;
    }

    public function hasError($attribute)
    {
        return $this->errors[$attribute] ?? false;
    }

    public function getFirstError($attribute)
    {
        $errors = $this->errors[$attribute] ?? [];
        return $errors[0] ?? '';
    }

    public function labels()
    {
        return [];
    }

    public function getLabel($attribute)
    {
        return $this->labels()[$attribute] ?? $attribute;
    }
}