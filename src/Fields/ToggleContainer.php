<?php

namespace LXBDR\WpPageBuilderFields\Fields;

class ToggleContainer implements WrappingInterface, AviaFieldInterface
{

    protected array $contents;
    public $all_closed; // boolean


    public function __construct(array $contents)
    {
        $this->contents = $contents;
        // content must be tabs

    }

    public function toAviaField(): array
    {
        return [
            $this->open(),
            ...$this->contents(),
            $this->close()
        ];
    }

    public function open(): array
    {
        return [
            'type' => 'toggle_container',
            'nodescription' => true,
            'all_closed' => $this->all_closed ?? false
        ];
    }

    public function contents(): array
    {
        $output = [];
        foreach ($this->contents as $content) {
            if (is_a($content, WrappingInterface::class)) {
                $output[] = $content->open();
                array_push($output, ...$content->contents());
                $output[] = $content->close();
                continue;
            }
            if (is_a($content, AviaFieldInterface::class)) {
                $output[] = $content->toAviaField();
                continue;
            }
            $output[] = $content;
        }

        return $output;
    }

    public function close(): array
    {
        return [
            'type' => 'toggle_container_close',
            'nodescription' => true
        ];
    }
}
