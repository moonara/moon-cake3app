<?php
namespace App\Test\TestCase\Model\Entity;

use App\Model\Entity\Board;
use Cake\TestSuite\TestCase;

class BoardTest extends TestCase {
	public $Board;

	public function setUp() {
		parent::setUp();
		$this->Board = new Board();
	}

	public function tearDown() {
		unset($this->Board);
		parent::tearDown();
	}

	public function testInitialization() {
	}

	/** $this->Board test */
	public function testBoardInstance() {
		$this->assertTrue(is_a($this->Board,'App\Model\Entity\Board'));
	}

}
