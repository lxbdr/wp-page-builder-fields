<?php

namespace LXBDR\WpPageBuilderFields\Fields;


trait SetOptionalsTrait {

	protected function setOptionals( array $options, array $allowedFields = [] ) {
		if ( empty( $allowedFields ) ) {
			$reflect       = new \ReflectionObject( $this );
			$allowedFields = array_map( function ( $prop ) {
				return $prop->getName();
			}, $reflect->getProperties( \ReflectionProperty::IS_PUBLIC ) );
		}

		foreach ( $options as $k => $v ) {
			if ( in_array( $k, $allowedFields ) ) {
				$this->{$k} = $v;
			}
		}
	}

}
