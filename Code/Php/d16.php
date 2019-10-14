<?php
$url = 'https://www.runoob.com/php/php-preg_match.html?a=1&b=2';
$pattern = '/^https?\:\/\/(.*?)\/.*\?(.*)$/';

preg_match($pattern, $url, $cc);

print_r($cc);