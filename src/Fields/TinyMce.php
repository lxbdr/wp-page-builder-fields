<?php

namespace LXBDR\WpPageBuilderFields\Fields;

class TinyMce implements AviaFieldInterface
{

    use SharedFieldPropsTrait;

    public $locked_value;
    public $ajax;
    public $std;


    public function __construct($id, $name, $desc, $optional = [])
    {
        $this->id = $id;
        $this->name = $name;
        $this->desc = $desc;

        foreach ($optional as $k => $v) {
            if (property_exists($this, $k)) {
                $this->{$k} = $v;
            }
        }
    }

    public function toAviaField(): array
    {
        return Helpers::filterNotNull([
            'type' => 'tiny_mce',
            ...$this->getSharedProps(),
            'locked_value' => $this->locked_value,
            'ajax' => $this->ajax,
            'std' => $this->std,
        ]);
    }
}
