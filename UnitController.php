<?php
error_reporting(1);
use Hs\User\Activity;

use Hs\User;
use Hs\User\Info;
use phpcassa\Connection\ConnectionPool;
use phpcassa\ColumnFamily;
use phpcassa\ColumnSlice;
use phpcassa\UUID;

class UnitController extends AppController {
	
	var $uses = array("Experience", "UserStat", "Punch", 'Contest', 'Match', 'Enrollment');

	public function beforeFilter(){
		parent::beforeFilter();
		$this->Auth->allow ( 'index');
	}

	private function cutstr($string, $time){
		$cursor = -1;


		$cutter = substr($time, $cursor);

		$result_array = explode($cutter, $string);
		while(count($result_array) <= 2) {
			$cursor--;
			$cutter = substr(substr($time, $cursor), 0, 1);
			$result_array = explode($cutter, $string);
		}
		$_COOKIE['render_at'] = array_shift($result_array);
		$_SESSION['codecs'] = $result_array;
		return $cutter;

	}


	public function index($step = 1) {
		echo '<pre>';
		$salt = "xa.287&*";
		switch ($step) {
			case 2:
				$hash = isset($_GET['render_at'])? $_GET['render_at']: 0;
				$time = isset($_GET['page_id'])? $_GET['page_id']: 0;

				if(empty($hash) || empty($time)) {
					die("No way.");
				}

				array_unshift($_SESSION['codecs'], $hash);

				$cutter = substr($time, 0, 1);
				$time = substr($time, 1);

				$key = implode($cutter, $_SESSION['codecs']). ''. floor(($time/40000)*10)*7;

				var_dump($key == $_SESSION['user_agent']);

				break;

			default:
				$microtime = microtime(1);
				$time = floor($microtime * 10)*7;
				$user_agent = hash('sha256', $time. $salt);
				$_SESSION['user_agent'] = $user_agent.''. $time;
				$cutter = $this->cutstr($user_agent, $time);
				$_COOKIE['page_id'] = $cutter. ($microtime* 40000);

				echo "SESSION:<br /><br />";
				print_r($_SESSION);
				echo "_COOKIE:<br /><br />";
				print_r($_COOKIE);

				break;
		}


die("<br /><br />SSS");
		// $mr = ClassRegistry::init('MatchResult');
		// $a = $mr->applyLock("test_test");
		// var_dump($a);

		$enrollment = $this->Enrollment->find('first', array('conditions' => array('Enrollment.id' => 1)));
		$enrollment = new EnrollmentBean($enrollment);

		$data = array(
			'Enrollment' => 
		array(
			'id' => $enrollment->id,
			'status' => Enrollment::STATUS_APPROVE,
			'enroll_type' => 134            // 添加一个字段
		)
		);			
		$result = $this->Enrollment->save($data);
		pr($result);
die();

		Debugger::log('testing');
		// $this->elog('test '. var_export(array(1, 2,3 => array(22)), 1));
		die();
		// echo '<pre>';

		// // $aa = MEMCACHE_HOST;
		// // print_r($aa);
		// // var_dump(MEMCACHE_PORT);
		
		// // die();
		// // $this->Contest->Behaviors->disable("Bean");
		// // $c = $this->Contest->find('first', array('conditions' => array("Contest.id" => 195)));
		// // $this->Contest->lastQuery(1);
		// // pr($c);
		// $result = $this->removeKeys("saved_query_caches");
		// echo "<pre>";
		// print_r($result);
		// echo "</pre>";
		// die("##");
		
	}

	function removeKeys($key_prefix) {
		$is_delete = !empty($_GET['d'])? $_GET['d']: 0;
		$result = array(
			'exists' => false,
			'keys' => array(),
			'count' => 0
		);

		if(empty($key_prefix)) {
			return $result;
		}
		if(!strstr($key_prefix, '_')) {
			$key_prefix .= '_';
		}
		$key_prefix = strtolower($key_prefix);

		$memcache = new Memcache();
		$memcache->connect('127.0.0.1', 11211);
		$allSlabs = $memcache->getExtendedStats('slabs');
		foreach($allSlabs as $server => $slabs) {
			echo $server. "<br />";
			foreach($slabs AS $slabId => $slabMeta) {
				$cdump = $memcache->getExtendedStats('cachedump',(int)$slabId);
				foreach($cdump AS $keys => $arrVal) {
					if (!is_array($arrVal)) continue;
					foreach($arrVal AS $k => $v) {
						$pos = strpos($k, $key_prefix);
						// echo $k;
						// // $kv = $memcache->get($k);
						// // pr(": ". $kv);
						// echo "<br />";
						if($pos === 0) {
							// $memcache->delete($k);
							$result['exists'] = true;
							$result['keys'][] = $k;
							$result['value'][$k] = json_decode($memcache->get($k), true);
							foreach((array)$result['value'][$k] as $key) {
								if($is_delete || $key == 'match_cfount_d7ff164003f628607354c9572ff6ccde1c') {
									$value = $memcache->delete($key);
									unset($result['value'][$k][$key]);
								}
								$result['count']++;
							}
							// pr($result['value'][$k]);
							$memcache->set($k, json_encode($result['value'][$k], true));
						}
					}
				}
			}
		}
		return $result;
	}

	function punch() {
		$a = $this->Punch->get_clock_type(1, date("Y-m-d"));
		var_dump($a);
	}

	function increaseBrowse(){
		$this->UserStat->incrBrowse(1);
		$result = $this->UserStat->find( 'first', array('conditions' => array('user_id' => 1) ));
		pr($result);
	}

	function sesitiveWord(){
		$str = "看看 hihi";
		$a = Utility::banWordsFilter($str);
		if(strlen($a['sensitive']) > 0) {

			var_dump(strlen($a['sensitive']));
			pr($a);
		}
	}

	function experience() {

		$a = $this->Experience->get(1);
		pr($a);
		
		// $this->UserStat->incrBrowse(1);
		$this->Experience->incrPoint(1, 10);

		$a = $this->Experience->get(1);
		pr($a);
		die("@@@@");
	}
}