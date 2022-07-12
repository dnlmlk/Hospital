<?php

namespace App\Model;


use App\Core\DbModel;

class SetTimeModel extends DbModel
{

    public string $from_0 = '';
    public string $until_0 = '';
    public string $from_1 = '';
    public string $until_1 = '';
    public string $from_2 = '';
    public string $until_2 = '';
    public string $from_3 = '';
    public string $until_3 = '';
    public string $from_4 = '';
    public string $until_4 = '';
    public string $from_5 = '';
    public string $until_5 = '';
    public string $from_6 = '';
    public string $until_6 = '';

    public static function tableName($role): string
    {
        return $role."s";
    }

    public function rules(): array
    {
        return [
            "until_0" => [[self::RULE_SET_TIME, 'setTime' => $this->until_0]],
            "until_1" => [[self::RULE_SET_TIME, 'setTime' => $this->until_1]],
            "until_2" => [[self::RULE_SET_TIME, 'setTime' => $this->until_2]],
            "until_3" => [[self::RULE_SET_TIME, 'setTime' => $this->until_3]],
            "until_4" => [[self::RULE_SET_TIME, 'setTime' => $this->until_4]],
            "until_5" => [[self::RULE_SET_TIME, 'setTime' => $this->until_5]],
            "until_6" => [[self::RULE_SET_TIME, 'setTime' => $this->until_6]],

        ];
    }

    public function attributes(): array
    {
        return ['form_0', 'until_0', 'form_1', 'until_1', 'form_2', 'until_2', 'form_3', 'until_3', 'form_4', 'until_4', 'form_5', 'until_5', 'form_6', 'until_6'];
    }

    public function setTime($times, $email)
    {
        $doctor = parent::findOne(['email' => $email], "doctors");
        $times = json_encode($times);

        $this->addTimes($times, $doctor);
    }

}