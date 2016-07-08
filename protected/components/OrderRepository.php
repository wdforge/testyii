<?php
use Zend\Db\Sql\Sql;

class OrderRepository extends AbstractRepository {

	public function __construct($config = []) {
		$this->initConnection($config);
		$this->setEntityClass('OrderItem');
	}

	public function statusOrder($orderStatusParams) {

		$return = new \ArrayObject;

        $return['status'] = 'OK';
		return $return;	
	}

	public function newOrder($orderAddParams) {

		$return = new \ArrayObject;
        $return['order'] = 10;

		return $return;		
	}

	public function getAll() {

	}
}
