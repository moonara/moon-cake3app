<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * NextBoards Controller
 *
 * @property \App\Model\Table\NextBoardsTable $NextBoards
 */
class NextBoardsController extends AppController
{


public function show($id = null){
	if (empty($id)){
		$this->getTreeBoard(0);
	} else {
		$this->getTreeBoard($id);
	}
}

public function getTreeBoard($id) {
	if ($id != 0) {
		$data = $this->NextBoards
			->find()
			->where(['NextBoards.id' => $id])
			->contain(['People']);
		$this->set('data', $data);
		if (!empty($data)) {
			$child = $this->NextBoards
				->find('children',['for' => $id],false)
				->find('threaded')
				->contain(['People']);
				//->find()
				//->where(['parent_id' => $id])
				//->contain(['People']);
			$this->set('child', $child);
		}
	} else {
		$query = $this->NextBoards->find('treeList', [
			'keyPath' => 'id',
			'valuePath' => 'title',
			'spacer' => '　　'
		]);
		$this->set('query', $query);
		//echo '<pre>';
		//print_r($query->toArray());
		//echo '</pre>';
		$child = $this->NextBoards
			->find()
			->where(['parent_id' => 0])
			->contain(['People']);
		$this->set('child', $child);
	}
}



	/**
	 * Index method
	 *
	 * @return \Cake\Network\Response|null
	 */
	public function index()
	{
		$this->paginate = [
			'contain' => ['People']
		];
		$nextBoards = $this->paginate($this->NextBoards);

		$this->set(compact('nextBoards'));
		$this->set('_serialize', ['nextBoards']);
	}

	/**
	 * View method
	 *
	 * @param string|null $id Next Board id.
	 * @return \Cake\Network\Response|null
	 * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
	 */
	public function view($id = null)
	{
		$nextBoard = $this->NextBoards->get($id, [
			'contain' => ['People']
		]);

		$this->set('nextBoard', $nextBoard);
		$this->set('_serialize', ['nextBoard']);
	}

	/**
	 * Add method
	 *
	 * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
	 */
	public function add() {
		$nextBoard = $this->NextBoards->newEntity();
		if ($this->request->is('post')) {
			$nextBoard = $this->NextBoards->patchEntity($nextBoard, $this->request->data);
			if ($this->NextBoards->save($nextBoard)) {
				$this->Flash->success(__('The next board has been saved.'));

				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error(__('The next board could not be saved. Please, try again.'));
			}
		}
		$people = $this->NextBoards->People->find('list', ['limit' => 200]);
		$this->set('people',$people);
		$this->set('nextBoard',$nextBoard);
		//$this->set('_serialize', ['nextBoard']);
	}

	/**
	 * Edit method
	 *
	 * @param string|null $id Next Board id.
	 * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
	 * @throws \Cake\Network\Exception\NotFoundException When record not found.
	 */
	public function edit($id = null)
	{
		$nextBoard = $this->NextBoards->get($id, [
			'contain' => []
		]);
		if ($this->request->is(['patch', 'post', 'put'])) {
			$nextBoard = $this->NextBoards->patchEntity($nextBoard, $this->request->data);
			if ($this->NextBoards->save($nextBoard)) {
				$this->Flash->success(__('The next board has been saved.'));

				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error(__('The next board could not be saved. Please, try again.'));
			}
		}
		$people = $this->NextBoards->People->find('list', ['limit' => 200]);
		$this->set(compact('nextBoard', 'people'));
		$this->set('_serialize', ['nextBoard']);
	}

	/**
	 * Delete method
	 *
	 * @param string|null $id Next Board id.
	 * @return \Cake\Network\Response|null Redirects to index.
	 * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
	 */
	public function delete($id = null)
	{
		$this->request->allowMethod(['post', 'delete']);
		$nextBoard = $this->NextBoards->get($id);
		if ($this->NextBoards->delete($nextBoard)) {
			$this->Flash->success(__('The next board has been deleted.'));
		} else {
			$this->Flash->error(__('The next board could not be deleted. Please, try again.'));
		}

		return $this->redirect(['action' => 'index']);
	}
}
