<?php
$ee  = mysql_connect("mysql", "test", "test");

$sql = "select * from mysql.user";

$hd = mysql_query($sql);
while($row = mysql_fetch_array($hd)) {
	print_r($row);
}
