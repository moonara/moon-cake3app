<?php
namespace PersonalDatum\Model\Behavior;

use Cake\ORM\Behavior;
use Cake\ORM\Table;
use Cake\ORM\Query;

class ByNumberBehavior extends Behavior {
	
	public function initialize(array $config) {
	}

	public function getByNumber($n) {
		$data = $this->_table->find()
			->offset($n)->first();
		return $data;
	}
	
}