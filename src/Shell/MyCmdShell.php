<?php
namespace App\Shell;

use Cake\Console\ConsoleOutput;
use Cake\Console\ConsoleOptionParser;
use Cake\Console\Shell;
use Cake\Log\Log;
use Cake\ORM\TableRegistry;

class MyCmdShell extends Shell {
	public $tasks = ['Db'];

	public function main($opt = null){
		$this->out("※以下のテーブルが利用できます。");
		$this->out('[B]oards');
		$this->out('[P]eople');
		$t = $this->in("テーブルを選択：", ['B', 'P'], 'B');
		$t = strtoupper($t);
		$table = null;
		$id = $this->in('ID番号を入力：', null, 1);
		$data = null;
		switch($t){
			case 'B':
				$table = 'Boards';
				break;
			case 'P':
				$table = 'People';
				break;
			default:
				$this->info("can't access Database...");
				exit();
		}
		$this->table($table,$id);
	}

	public function boards($id = null){
		if ($id == null){
			$n = $this->in('ID番号を入力：', null, 1);
		} else {
			$n = $id;
		}
		$this->table('boards',$id);
	}

	public function people($id = null){
		if ($id == null){
			$n = $this->in('ID番号を入力：', null, 1);
		} else {
			$n = $id;
		}
		$this->table('people',$id);
	}

	public function table($table,$id){
		if ($this->params['db']){
			$this->Db->main();
			$this->Db->get($table, $id);
		} else {
			$data = TableRegistry::get($table)->get($id);
			$this->out(print_r($data->toArray()));
		}
	}

	public function getOptionParser() {
		$parser = new ConsoleOptionParser('mycmd');
		$parser->description(
			"これは、サンプルで作成したシェルプログラムです。"
		)->addArgument(
			'boards $n', 
			[
				'help' => 'Boardsテーブルの利用。ID番号をつけて実行。',
				'require' => false
			]
		)->addArgument(
			'people $n', 
			[
				'help' => 'Peopleテーブルの利用。ID番号をつけて実行。',
				'require' => false
			]
		)->addArgument(
			'table $t $n', 
			[
				'help' => 'テーブル名とID番号をつけて実行。',
				'require' => false
			]
		)->addOption(
			'db',
			 [
				'short' => 'd',
				'boolean' => true,
				'help' => 'DbTaskを使います。'
			]
		)->epilog(
			'※便利に使ってね！'
		);
		return $parser;
	}

}
