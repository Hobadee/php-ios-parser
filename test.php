<?php

require_once('blocks.php');
require_once('config.php');
require_once('parser.php');
require_once('parsers/ephone.php');
require_once('parsers/ephone_dn.php');


$file1 = 'pbx01.rmd-confg';
$file2 = 'pbx01.all.ios';
$file = $file1;

$dir = '/Users/erick/src/IOSParser/configs';
$uri = $dir.$file;


$config = new config();

$config->addBlock('/^ certificate/', '/^\s+quit/', 'Certificates');
$config->addBlock('/^banner [a-z]+ (.+)$/', '/^\s*$1/', 'Banners');
$config->addBlock('/^boot-start-marker/', '/boot-end-marker/', 'Boot File');


$config->addParser(parsers\ephone::class);
$config->addParser(parsers\ephone_dn::class);

$config->load(file_get_contents ($uri));

print_r(json_encode($config));
//print_r($config);
