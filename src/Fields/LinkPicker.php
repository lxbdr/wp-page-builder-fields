<?php

namespace LXBDR\WpPageBuilderFields\Fields;

class LinkPicker implements AviaFieldInterface
{

    use SharedFieldPropsTrait;
    use SetOptionalsTrait;

    public string $std = '';
    public string $target_id = 'linktarget';
    public string $target_std = '';
    protected array $subtypes = [];

    const SUBTYPE_NO_LINK = 'no';
    const SUBTYPE_DEFAULT = 'default';
    const SUBTYPE_MANUALLY = 'manually';
    const SUBTYPE_SINGLE = 'single'; // Single entry
    const SUBTYPE_TAXONOMY = 'taxonomy';
    const SUBTYPE_LIGHTBOX = 'lightbox'; // open in lightbox

    public function __construct($id, $options = [])
    {
        $this->id = $id;
        $this->name = 'Link';
        $this->desc = 'Link einfügen';

        $allowed_subtypes = [
            self::SUBTYPE_DEFAULT,
            self::SUBTYPE_NO_LINK,
            self::SUBTYPE_MANUALLY,
            self::SUBTYPE_SINGLE,
            self::SUBTYPE_TAXONOMY,
            self::SUBTYPE_LIGHTBOX
        ];
        // all the required fields
        if ($subtypes = $options['subtypes'] ?? null) {
            if (!is_array($subtypes) || !empty(array_diff($subtypes, $allowed_subtypes))) {
                throw new \InvalidArgumentException("Invalid subtypes array.");
            }
            $this->subtypes = $subtypes;
        }

        $this->setOptionals($options);
    }

    public function toAviaField(): array
    {
        return Helpers::filterNotNull([
            ...$this->getSharedProps(),
            'type' => 'template',
            'template_id' => 'linkpicker_toggle',
            'std' => $this->std,
            'subtypes' => $this->subtypes,
            'target_id' => $this->target_id,
            'target_std' => $this->target_std
        ]);
    }

    public static function get_avia_url($link_attribute)
    {
        if (!class_exists('\AviaHelper')) {
            throw new \Exception('Enfold not loaded.');
        }
        return \AviaHelper::get_url($link_attribute);
    }

    public static function get_avia_link_target($linktarget_attribute)
    {
        if (!class_exists('\AviaHelper')) {
            throw new \Exception('Enfold not loaded.');
        }
        return \AviaHelper::get_link_target($linktarget_attribute);
    }
}
