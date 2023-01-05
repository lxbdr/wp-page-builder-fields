<?php

namespace LXBDR\WpPageBuilderFields\Fields;

class Toggle implements WrappingInterface, AviaFieldInterface
{

    protected string $name;
    protected array $contents = [];
    public string $desc;
    public string $container_class;

    public function __construct(string $name, string $desc, array $contents, array $options = [])
    {
        $this->name = $name;
        $this->desc = $desc;
        $this->contents = $contents;
        $this->container_class = $options['container_class'] ?? '';
    }

    public function open(): array
    {
        return [
            'type' => 'toggle',
            'name' => $this->name,
            'container_class' => $this->container_class,
            'desc' => $this->desc,
        ];
    }

    public function close(): array
    {
        return [
            'type' => 'toggle_close',
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
