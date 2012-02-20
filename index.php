<?php

  define('CSS_SOURCE', '../assets');
  define('CSS_DEST', '../');
  
  require 'lessc.inc.php';

  if(is_dir(CSS_SOURCE)) {
  
    $dh  = opendir(CSS_SOURCE);
    
    while (false !== ($filename = readdir($dh))) {
        $files[] = $filename;
    }

    foreach($files as $file) {
  
      if($filename = strstr($file, '.less', true)) {
  
        try {
        
          $cache = lessc::cexecute(CSS_SOURCE . '/' . $file);
          file_put_contents(CSS_DEST . $filename . '.min.css' , $cache['compiled']);
          echo 'Created: ' . CSS_DEST . $filename . '.min.css<br/>';
  
        } catch (Exception $ex) {
        
          echo "lessphp fatal error: " . $ex->getMessage();
        
        }
   
      }
  
    }

  } else {
  
    echo 'Source directory doesn\'t exist';
  
  }