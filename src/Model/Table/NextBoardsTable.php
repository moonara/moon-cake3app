<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class NextBoardsTable extends Table {

	public function initialize(array $config)
	{
		parent::initialize($config);

		$this->addBehavior('Tree'); // ★

	   $this->belongsTo('People');
	}

	public function validationDefault(Validator $validator) {
		$validator
			->integer('id')
			->requirePresence('parent_id')
			->requirePresence('person_id')
			->requirePresence('title')
			->notEmpty('title')
			->requirePresence('content')
			->notEmpty('content');

		return $validator;
	}

	public function buildRules(RulesChecker $rules) {
		 $rules->add($rules->existsIn(['person_id'], 'People'));
		return $rules;
	}
}
