<?php

namespace LXBDR\WpPageBuilderFields\Fields;

class TabContainer implements WrappingInterface, AviaFieldInterface
{

    protected array $contents;

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
            'type' => 'tab_container',
            'nodescription' => true
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
            'type' => 'tab_container_close',
            'nodescription' => true
        ];
    }

}
