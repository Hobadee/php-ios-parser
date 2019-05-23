<?php

if(!function_exists('array_key_first')){
    function array_key_first(array $array){
        if($array === []){
            return NULL;
        }
        foreach($array as $key => $_) return $key;
    }
}

if(!function_exists('array_key_last')){
    function array_key_last(array $array){
        if($array === []){
            return NULL;
        }
        return array_key_first(array_slice($array, -1));
    }
}

