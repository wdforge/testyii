<?php

class OrderRepository extends AbstractRepository {

	public function __construct($config = []) {
		$this->initConnection($config);
		$this->setEntityClass('OrderItem');
	}

}
