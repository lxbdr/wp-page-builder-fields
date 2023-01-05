<?php

namespace LXBDR\WpPageBuilderFields\Fields;

trait AcfFieldGroupTrait
{

    protected string $key;
    protected string $title;
    protected array $fields;
    protected array $location;

    public function getMinimalFieldGroupArray(): array
    {
        return [
            'key' => $this->key,
            'title' => $this->title,
            'fields' => $this->fields,
            'location' => $this->location
        ];
    }

}
