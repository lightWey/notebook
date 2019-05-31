<?php
$p = getcwd();
var_dump($p);exit();

print_r($p);
$config = [
	'github.com'  => 'https://raw.githubusercontent.com/{{name}}/{{notebook}}/{{branch}}/{{path}}',
    'git.dev.tencent.com' => 'https://dev.tencent.com/u/{{name}}/p/{{notebook}}/git/raw/{{branch}}/{{path}}'
];

$a = $b = null;
exec('type git', $a, $b);

if ($b || empty($a)) {
	echo 'not found git command !';
	return flase;
}

$a=[];
$b=0;
exec('git remote -v', $a, $b);

$pattern = '/^origin\s(https?:\/\/(.+\.com).*\.git).*\(push\)/';

$cc = [];

foreach ($a as $v) {
	$c1 = [];
	if (preg_match($pattern, $v, $c1) && isset($c1[2])) {
		$cc[] = $c1[2];
	}
}

echo PHP_EOL;
echo DIRECTORY_SEPARATOR;

print_r(scandir($p));