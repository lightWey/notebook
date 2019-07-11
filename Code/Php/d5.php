<?php

function varReplace(string $string, array $replaces)
{
    if (empty($string) || empty($replaces)) {
        return $string;
    }

    $search = $fill = [];
    foreach ($replaces as $key => $replace) {
        $search[] = '{{' . $key . '}}';
        $fill[] = $replace;
    }

    return str_replace($search, $fill, $string);
}

$a = [
	'couponPrice' => 1,
	'totalAssistPrice' => 2,
	'rebatePrice' => 3,
	'assistPrice' => 4,
	'bb' => 0
];

$b = [
	"detail_assist_text"=>"助力再返{{assistPrice}}元",
    "detail_rebate_text"=>"返{{rebatePrice}}元",
    "detail_ticket_assist_text"=>"助力就得赚{{assistPrice}}元",
    "detail_ticket_rebate_text"=>"买就得返{{rebatePrice}}元",
    "detail_bottom_bar_right_text"=>"返{{rebatePrice}}元赚{{assistPrice}}元",
    "bb"=>"{{}}返元赚"
];

$result = [];
foreach ($b as $key => $value) {
	$flag = preg_match('/{{(\w+)}}/', $value, $dd);
	if ($flag) {
		var_dump($dd);
		$result[$key] = varReplace($value, $a);
	} else {
		$result[$key] = $value;
	}
}

//print_r($result);