#!/usr/bin/php -q
<?php

  // append a slash to the supplied path if it doesn't already have one
  function slashIt($dir) {
    if($dir{strlen($dir) - 1} != '/') {
      $dir .= "/";
    }
    return $dir;
  }

  // recursively scan a bunch of directories
  function scan($dir) {
    global $test_mode,$dest_dir;
    
    // if the directory can be scanned
    if ($dh = opendir($dir)) {
      
        // go through every file
        while (($file = readdir($dh)) !== false) {
          
          // if the file isn't a hidden file
          if($file != "." && $file != ".." && $file{0} != '.'){
            
            // if it's a directory
            if(filetype($dir . $file) == "dir") {
              
              // recurse into sub-directory
              scan($dir.$file."/");
              
            } else {
              
              // create new date based path
              $timestamp = filemtime($dir.$file);
              $newpath = date("Y/m",$timestamp);
              
              // if this is for real
              if(!$test_mode) {
                
                // make new directory
                mkdir($dest_dir.$newpath,0775,true);
                
                // copy the file into the destination
                copy($dir.$file , $dest_dir.$newpath."/".$file);
              }
            }
            echo "$dir$file  ---> $newpath\n";               
          }
            
        }
        closedir($dh);
    }
  }

  // command line parameters
  $argv = $_SERVER["argv"];
  $argc = $_SERVER["argc"];
  if($argc < 3) {
    die("Incorrect number of parameters\n".
        "Usage:\n".
        "  ./foldinizer.php  <source path> <destination path> (<test mode>)\n");
  }
  $source_dir = slashIt($argv[1]);
  $dest_dir = slashIt($argv[2]);
  if($source_dir == $dest_dir) {
    die("Source and destination directories are the same\n");
  }
  if($argc==4  && $argv[3]) {
    $test_mode = true;
  }
  
  // test to see if source and destinations are there
  if(!file_exists($source_dir) || !is_dir($source_dir)) {
    die("The source directory $source_dir does not exist or is not a directory");
  }
  if(!file_exists($dest_dir)|| !is_dir($source_dir)) {
    die("The destination directory $dest_dir does not exist or is not a directory");
  }
  
  // begin the scan
  scan($source_dir);
  
?>