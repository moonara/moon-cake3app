<?php
namespace PersonalDatum\View\Helper;

use Cake\View\Helper;

class PersonalDataInfoHelper extends Helper {
	public $helpers = ['Html'];

	public function initialize(array $config) {
		parent::initialize($config);
	}

	public function showPersonalDataInfo($data){
		$result = '<table style="width:300px;font-size:9pt;">';
		$result .= "<tr><th>OWNER:</th><td>" . $data->username . "</td></tr>";
		$result .= "<tr><th>EMAIL:</th><td>" . $data->email . "</td></tr>";
		$result .= "<tr><th>TEL:</th><td>" . $data->tel . "</td></tr>";
		$result .= "<tr><th>ADDRESS:</th><td>" . $data->address . "</td></tr>";
		$result .= "</table>";
		return $result;
	}
	
}