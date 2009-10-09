<?php

/*
  @project textorize-server
  @author Paul Thrasher
  @uses textorize by Thomas Fuchs (http://textorize.org/)
*/

/*
textorize command-line options
==============================

textorize [options] string
  -f, --font=[FONT]                Font name
  -s, --size=[SIZE]                Font size in point
  -l, --lineheight=[HEIGHT]        Line height in point
  -t, --ligatures=[TYPE]           Ligatures usage: all, standard or off
      --list-fonts                 List available fonts
  -k, --kerning=[VALUE]            Kerning adjustment
  -o, --output=[FILENAME]          Specify filename for saving
  -b, --obliqueness=[ANGLE]        Slant angle
  -c, --color=[COLOR]              Render text in specific color (CSS color value)
  -g, --background=[COLOR]         Render background in specific color (CSS color value)
  -a, --smoothing=[VALUE]          Font smoothing: 0=no subpixel AA, 1=light, 2=normal, 3=strong
*/

$input = urldecode_deep($_GET);

$cmd = "/usr/bin/textorize ";

$options_list = array(
    'font' => $input['f'] ? (string) $input['f'] : 'arial',
    'size' => $input['s'] ? (float) $input['s'] : 15,
    'color' => "#".($input['c'] ? (string) $input['c'] : '000000'),
    'background' => "#".($input['g'] ? (string) $input['g'] : 'FFFFFF'),
  );
$options = array2cmd($options_list);

$msg = $input['m'];
$msg = escapeshellarg($msg);

$path = realpath(dirname(__FILE__));
$filename = $path."/cache/cache-".sha1($options.$msg).".png";

if(!file_exists($filename)){
  $options .= "--output={$filename} ";
  //echo $cmd.$options.$msg; // you can debug what's run in the command line here.
  //exit;
  exec($cmd.$options.$msg);
}

header('Content-type: image/png');

// seconds, minutes, hours, days
$expires = 60*60*24*14;
header("Pragma: public");
header("Cache-Control: maxage=".$expires);
header('Expires: ' . gmdate('D, d M Y H:i:s', time()+$expires) . ' GMT');

readfile($filename);

function array2cmd($array){
  $output = '';
  foreach($array as $k=>$v){
    if(is_int($v)){
      $v2 = $v;
    }else  if(is_numeric($v)){
      $v2 = (int) $v;
    }else  if(is_float($v)){
      $v2 = $v;
    }elseif(is_string($v)){
      $v = escapeshellarg($v);
      $v2 = $v;
    }else{
      continue;
    }
    $output .= "--$k=$v2 ";
  }
  return $output;
}

function urldecode_deep($val)
{
   return (is_array($val)) ?
     array_map('urldecode_deep', $val) : urldecode($val);
}