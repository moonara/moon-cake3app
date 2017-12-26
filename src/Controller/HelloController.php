<?php
namespace App\Controller;

use Cake\Event\Event;
//use Cake\Network\Exception\InvalidCsrfTokenException;

use Cake\ORM\TableRegistry;

class HelloController extends AppController {

public function initialize() {
	parent::initialize();
	$this->pd = TableRegistry::get('PersonalDatum.PersonalDatum');
	$this->loadComponent('PersonalDatum.PersonalDataInfo');
}

public function index($n = 0){
	//$data = $this->boards->anyData();
	//$data = $this->boards->find('something',['field'=>'title','value'=>'%hello%']);
	//$data = $this->PersonalDataInfo->getByName("tuyano"); 
	$data = $this->pd->getByNumber($n);
	//print_r($this->pd);
	$this->set('data',$data);
}
	
			
	public function beforeFilter(Event $e){
	}

	public function sendForm(){
		$str = $this->request->data('text1');
		$result = "";
		if ($str != ""){
			$result = "you type: " . $str;
		} else {
			$result = "empty.";
		}
		$this->set("result", h($result));
	}


}
