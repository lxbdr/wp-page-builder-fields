<?php

namespace LXBDR\WpPageBuilderFields\Fields;

class Helpers
{

    public static function filterNotNull(array $arr): array
    {
        return array_filter($arr, fn($arr) => !is_null($arr));
    }

}
