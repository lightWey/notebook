<?php
$rp = $argv[1] ?? '';
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


$pattern = '/^origin\s(https?:\/\/(.+\.com)\/(\w+).*\/(\w+)\.git).*\(push\)/';


$lists = scandir($p);

if (empty($lists)) {
	exit('do not found any file!');
}

$list = array_filter($lists, function ($v) {
	if (preg_match('/.+\.(jpg|jpeg|bmp|gif|png)/i', $v)) {
		return true;
	}
});



foreach ($a as $v) {
	$c1 = [];
	if (preg_match($pattern, $v, $c1) && isset($c1[2])) {
		$str = preg_replace('/{{\w+}}/','%s',$config[$c1[2]]);
		$rp = $rp ?: $c1[4];
		$s = stripos($p, $rp);
		$rpc = substr($p, $s+strlen($rp)+1);
		foreach ($list as $v) {
			echo sprintf($str, $c1[3], $rp, 'master', $rpc.DIRECTORY_SEPARATOR.$v),PHP_EOL;	
		}
		echo PHP_EOL;
	}
}





//print_r($list);