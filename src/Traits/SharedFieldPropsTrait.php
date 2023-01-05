<?php

namespace LXBDR\WpPageBuilderFields\Fields;

trait SharedFieldPropsTrait {

	protected string $id;
	public string $name;
	public string $desc;
	public array $required = [];
	public bool $lockable = false;

	protected function getSharedProps(): array {
		return [
			'id'       => $this->id,
			'name'     => $this->name,
			'desc'     => $this->desc,
			'required' => $this->required,
			'lockable' => $this->lockable
		];
	}

}
