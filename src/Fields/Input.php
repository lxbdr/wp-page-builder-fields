<?php

namespace LXBDR\WpPageBuilderFields\Fields;

class Input implements AviaFieldInterface
{

    use DefaultConstructorTrait;

    public $locked_value;
    public $attr;
    public $class;
    public $std;

    public function toAviaField(): array
    {
        return Helpers::filterNotNull([
            'type' => 'input',
            ...$this->getSharedProps()
        ]);
    }
}
