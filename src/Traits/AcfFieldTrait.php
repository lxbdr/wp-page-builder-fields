<?php

namespace LXBDR\WpPageBuilderFields\Fields;

trait AcfFieldTrait
{

    protected string $key;
    protected string $label;
    protected string $name;
    protected string $type;

    public function getMinimalFieldArray(): array
    {
        return [
            'key' => $this->key,
            'label' => $this->label,
            'name' => $this->name,
            'type' => $this->type
        ];
    }

}
