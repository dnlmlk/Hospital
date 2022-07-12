<?php

namespace App\Core\Form;

use App\Core\Model;

abstract class BaseField
{

    public Model $model;
    public string $attribute;
    public string $type;


    public function __construct( Model $model, string $attribute)
    {
        $this->model = $model;
        $this->attribute = $attribute;
    }

    public function __toString()
    {
        return sprintf('
            <div class="form-outline flex-fill mb-0">
                    %s
                <label class="form-label" for="%s">%s</label>
                <div class="invalid-feedback">
                    %s
                </div>
            </div>',
            $this->renderInput(),
            $this->attribute,
            $this->model->getLabel($this->attribute),
            $this->model->getFirstError($this->attribute)
        );
    }

    abstract public function renderInput();

}