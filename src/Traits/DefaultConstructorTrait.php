<?php

namespace LXBDR\WpPageBuilderFields\Fields;

trait DefaultConstructorTrait {

	use SharedFieldPropsTrait;
	use SetOptionalsTrait;

	public function __construct( $id, $name, $desc, $optional = [] ) {
		$this->id   = $id;
		$this->name = $name;
		$this->desc = $desc;

		$this->setOptionals( $optional );
	}

}
