<?php
session_start();


class Page {
	function render1() {
		$request_link = 'getKeys?';
		echo "<input id='w' value='". date("YmdHis")."' type='text' />";
		echo "<div id='link' ></div>";
		echo '
<script>
document.body.onload = function() {
	console.log(document.cookie);
	var pp = "";
	setTimeout(function() {
		var t = "wine="; 
		var p = "page_id=";
		var tt = "";


		
		var cookies = document.cookie.split("; ");
		for(var i=0; i < cookies.length; i++) {
			if(cookies[i].indexOf(t) != -1) {
				tt = cookies[i].replace(t, "");
			}
			if(cookies[i].indexOf(p) != -1) {
				pp = cookies[i].replace(p, "");
			}
		}
			console.log(tt,pp, p, t);
		document.getElementById("w").value = tt;
	}, 2000);


	setTimeout(function(){
		var link_elements = ["/u.php?p=2"];
		link_elements.push("ww="+ document.getElementById("w").value);
		link_elements.push("pp="+ pp);
		var final_link = link_elements.join("&");
		document.getElementById("link").innerHTML = "<a target=\"testing\" href=\""+ final_link+ "\">link</a>";
	}, 4000);
}
</script>
		';
	}
}


class ValidateRequest {
	private $salt = "xa.287&*";
	
	function init() {
		
		$microtime = microtime(1);
		$time = floor($microtime * 10)*7;
		$drink = hash('sha256', $time. $this->salt);

		$_SESSION['drink'] = $drink.''. $time;
		
		$cursor = -1;
		$seperator = substr($time, $cursor);

		$result_array = explode($seperator, $drink);
		while(count($result_array) <= 2) {
			$cursor--;
			$seperator = substr(substr($time, $cursor), 0, 1);
			$result_array = explode($seperator, $drink);
		}
		$timeout = time()+300;
		setcookie("page_id", $seperator. ($microtime* 40000), $timeout);
		setcookie("wine", array_shift($result_array), $timeout);

		$_SESSION['spirit'] = $result_array;
	}

	function validate($wine = 0, $time = 0) {

		array_unshift($_SESSION['spirit'], $wine);

		$seperator = substr($time, 0, 1);
		$time = substr($time, 1);

		$key = implode($seperator, $_SESSION['spirit']). ''. floor(($time/40000)*10)*7;

		return ($key == $_SESSION['drink']);
	}
}



$page = !empty($_GET['p'])? $_GET['p']: 0;

$crf = new ValidateRequest();
switch ($page) {
	case 2:
		$params = $_GET;
		if(!array_key_exists('ww', $params) || !array_key_exists('pp', $params)) {
			die("The road you can go is not the right way.");
		}
		$w = $_GET['ww'];
		$s = $_GET['pp'];
		$r = $crf->validate($w, $s);
		var_dump($r);
		echo "----------------------<br />";
		break;
	
	default:
		$s = $crf->init();

		$p = new Page();
		$p -> render1();
		echo "<pre>";
		print_r($_SESSION);
		break;
}