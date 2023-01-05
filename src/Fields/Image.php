<?php

namespace LXBDR\WpPageBuilderFields\Fields;

class Image implements AviaFieldInterface
{

    use SharedFieldPropsTrait;
    use SetOptionalsTrait;

    protected string $type = 'image';
    protected string $fetch = 'url';
    public string $title;
    public string $button;
    public string $std;

    const FETCH_URL = 'url';
    const FETCH_ID = 'id';

    public function __construct($id, $name, $optional = [])
    {
        $this->id = $id;
        $this->name = $name;
        $this->desc = 'Bild auswählen oder hochladen.';
        $this->title = 'Bild auswählen'; // button title
        $this->button = 'Bild auswählen';

        $allowed_fetch_types = [self::FETCH_URL, self::FETCH_ID];

        if (isset($optional['fetch'])) {
            if (!in_array($optional['fetch'], $allowed_fetch_types)) {
                throw new \InvalidArgumentException("Invalid fetch type.");
            }
            $this->fetch = $optional['fetch'];
        }

        $this->setOptionals($optional);
    }

    public function toAviaField(): array
    {

        return Helpers::filterNotNull([
            ...$this->getSharedProps(),
            [
                'type' => $this->type,
                'std' => $this->std ?? null,
                'title' => $this->title,
                'button' => $this->button,
                'fetch' => $this->fetch,
            ]
        ]);
    }
}
