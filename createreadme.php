<?php
    $path = realpath('.');
    $objects = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path),       RecursiveIteratorIterator::SELF_FIRST);
    foreach($objects as $name => $object){
        if ( is_dir($name) && ! is_empty_folder($name) ){
            echo "$name\n" ;
            exec("touch ".$name."/"."README");
        }
    }

    function is_empty_folder($folder) {
    $files = opendir($folder);
    while ($file = readdir($files)) {
        if ($file != '.' && $file != '..')
            return true; // not empty
        }
    }
?>
