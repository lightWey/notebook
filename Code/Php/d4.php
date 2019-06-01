<?php
$p = getcwd();

$config = [
	'github.com'  => 'https://raw.githubusercontent.com/{{name}}/{{notebook}}/{{branch}}/{{path}}',
    'git.dev.tencent.com' => 'https://dev.tencent.com/u/{{name}}/p/{{notebook}}/git/raw/{{branch}}/{{path}}'
];

$a = $b = null;
exec('type git', $a, $b);

if ($b || empty($a)) {
	exit('not found git command !');
}

$a=[];
$b=0;
exec('git remote -v', $a, $b);

if ($b || empty($a)) {
	exit('do not found any file!');
}


$pattern = '/^origin\s(https?:\/\/(.+\.com).*\.git).*\(push\)/';

$cc = [];

foreach ($a as $v) {
	$c1 = [];
	if (preg_match($pattern, $v, $c1) && isset($c1[2])) {
		$cc[] = $c1[2];
	}
}


$lists = scandir($p);

if (empty($lists)) {
	exit('do not found any file!');
}

$list = array_filter($lists, function ($v) {
	if (preg_match('/.+\.(jpg|jpeg|bmp|gif)/i', $v)) {
		return true;
	}
});


print_r($list);