<?php

require_once('blocks.php');
require_once('config.php');


$file1 = 'pbx01.rmd-confg';
$file2 = 'pbx01.all.ios';
$file = $file1;

$dir = '/Users/erick/src/IOSParser/';
$uri = $dir.$file;


$config = new config();

$config->addBlock('/^ certificate/', '/^\s+quit/', 'Certificates');
$config->addBlock('/^banner [a-z]+ (.+)$/', '/^\s*$1/', 'Banners');

$config->load(file_get_contents ($uri));

print_r($config);
