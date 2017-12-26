<?php
namespace PersonalDatum\Controller;

use Cake\Event\Event;
use Cake\Network\Exception\InvalidCsrfTokenException;

use Cake\ORM\TableRegistry;

class PersonalDatumController extends AppController {

	public function index(){
		$data = $this->PersonalDatum->find('all');
		$this->set('data',$data);
	}
}
