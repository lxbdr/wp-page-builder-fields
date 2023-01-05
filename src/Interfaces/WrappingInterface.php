<?php

namespace LXBDR\WpPageBuilderFields\Interfaces;

interface WrappingInterface
{

    public function open(): array;

    public function contents(): array;

    public function close(): array;
}

