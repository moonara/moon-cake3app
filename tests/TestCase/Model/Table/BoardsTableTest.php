<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\BoardsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

class BoardsTableTest extends TestCase {

	public $BoardsTable;

	public $fixtures = [
		'app.boards',
		'app.people'
	];

	public function setUp() {
		parent::setUp();
		$config = TableRegistry::exists('Boards') ? [] : 
			['className' => 'App\Model\Table\BoardsTable'];
		$this->BoardsTable = TableRegistry::get('Boards', $config);
	}

	public function tearDown() {
		unset($this->BoardsTable);
		parent::tearDown();
	}

	public function testInitialize() {
	}

	public function testValidationDefault() {
	}

	/** find Board test */
	public function testBoardsTableFind() {
		$result = $this->BoardsTable->find('all')->first();
		$this->assertFalse(empty($result));
		$this->assertEquals($result->id, 1001);
		$this->assertStringStartsWith('test title 1', $result->title);
		$this->assertTrue(is_a($result,'App\Model\Entity\Board'));
	}

}
