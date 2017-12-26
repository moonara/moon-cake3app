<?php
namespace App\Controller;

use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use Cake\I18n\I18n;

class BoardsController extends AppController {
	private $people;
	
	public $paginate = [
		'limit' => 5,
		'order' => [
			'id' => 'ASC'
		],
		'contain' => ['People']
	];

	public function initialize(){
		parent::initialize();
		$this->people = TableRegistry::get('People');
		$this->loadComponent('Paginator');
		$this->loadComponent('RequestHandler');
		$this->loadComponent('DataArray');
	}
	
	public function beforeFilter(Event $event){
		parent::beforeFilter($event);
		//I18n::locale('ja');
	}
	
	public function index(){
		$data = $this->Boards->find()->offset(3)->limit(7);
		$this->set(compact('data'));
	}
	
	// translate test
	public function tr(){
		$boards = $this->Boards->find('translations')->first();

		$boards->translation('ja')->title = '日本語タイトル';
		$boards->translation('en')->title = 'english title.';

		echo $boards;

		//$this->Boards->save($boards);

		echo $boards->translation('ja')->title; 
		echo $boards->translation('en')->title;
	}

	public function add(){
		if ($this->request->isPost()){
			if (!$this->people->checkNameAndPass($this->request->data)){
					$this->Flash->error('名前かパスワードを確認ください。');
			} else {
				$res = $this->people->find()
					->where(['name'=>$this->request->data['name']])
					->andWhere(['password'=>$this->request->data['password']])
					->first();
				$board = $this->Boards->newEntity();
				$board->name = $this->request->data['name'];
				$board->title = $this->request->data['title'];
				$board->content = $this->request->data['content'];
				$board->person_id = $res['id'];
				if($this->Boards->save($board)){
					$this->redirect(['action' => 'index']);
				}
			}
		}
		$this->set('entity', $this->Boards->newEntity());
	}

	public function edit($param=0){
		if ($this->request->isPut()){
			$board = $this->Boards
				->find()
				->where(['Boards.id'=>$param])
				->contain(['People'])
				->first();
			$board->title = $this->request->data['title'];
			$board->content = $this->request->data['content'];
			$board->person_id = $this->request->data['person_id'];
			if (!$this->people->checkNameAndPass($this->request->data)){
				$this->Flash->error('名前かパスワードを確認ください。');
			} else {
				if($this->Boards->save($board)){
					$this->redirect(['action' => 'index']);
				}
			}
		} else {
			$board = $this->Boards
				->find()
				->where(['Boards.id'=>$param])
				->contain(['People'])
				->first();
		}
		$this->set('entity',$board);
	}

	public function show($param = 0){
		$data = $this->Boards
			->find()
			->where(['Boards.id'=>$param])
			->contain(['People'])
			->first();
		$this->set('data',$data);
	}

	public function show2($param = 0){
		$data = $this->people->get($param);
		$this->set('data',$data);
	}

	// ==========掲示板／ここまで============

	public function addRecord(){
		if ($this->request->is('post')) {
			$board = $this->Boards->newEntity($this->request->data);
			if ($this->Boards->save($board)){
				$this->redirect(['action' => 'index']);
			}

			$this->set('entity',$board);
		}
	}

	public function editRecord(){
		if ($this->request->is('post')) {
			$arr1 = ['name'=>$this->request->data['name']];
			$arr2 = ['title'=>$this->request->data['title']];
			$this->Boards->updateAll($arr2, $arr1);
		}
		return $this->redirect(['action' => 'index']);
	}

	public function delRecord(){
		if ($this->request->is('post')) {
			$this->Boards->deleteAll(
				['name'=>$this->request->data['name']]
			);
		}
		$this->redirect(['action' => 'index']);
	}

}
