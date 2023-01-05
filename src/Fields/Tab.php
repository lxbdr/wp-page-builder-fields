<?php

namespace LXBDR\WpPageBuilderFields\Fields;

class Tab implements WrappingInterface, AviaFieldInterface
{

    public string $name;
    public array $contents = [];

    public function __construct(string $name, array $contents)
    {
        $this->name = $name;
        $this->contents = $contents;
    }

    public function open(): array
    {
        return [
            'type' => 'tab',
            'name' => $this->name,
            'nodescription' => true
        ];
    }

    public function close(): array
    {
        return [
            'type' => 'tab_close',
            'nodescription' => true
        ];
    }

    public function contents(): array
    {
        $output = [];
        foreach ($this->contents as $content) {
            if (is_a($content, WrappingInterface::class)) {
                $output[] = $content->open();
                $output[] = $content->contents();
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

    public function toAviaField(): array
    {
        return [$this->open(), $this->contents, $this->close()];
    }
}
