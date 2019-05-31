<?php
$a = [];
$b = null;
exec('git remote -v', $a, $b);

if ($b) {
	echo 'error !';
	return flase;
}

if (empty($a)) {
	echo 'empty !';
	return false;
}


foreach ($a as $v) {
	echo $v;
}