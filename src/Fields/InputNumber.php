<?php

namespace LXBDR\WpPageBuilderFields\Fields;

class InputNumber extends Input
{

    public $min;
    public $max;
    public $placeholder;
    public $readonly = false;
    public $step;


    public function toAviaField(): array
    {
        $arr = parent::toAviaField();
        $overrides = [
            'type' => 'input_number',
            'min' => $this->min ?? null,
            'max' => $this->max ?? null,
            'readonly' => $this->readonly ?? null,
            'step' => $this->step ?? null
        ];

        return Helpers::filterNotNull([
            ...$arr,
            ...$overrides
        ]);
    }
}
