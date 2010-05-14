<?php

/**
 * Wrapper for textorize command-line tool
 * Only supports font, color, size and background so far
 * @author Paul Thrasher [http://vastermonster.com]
 * @uses textorize by Thomas Fuchs [http://textorize.org/]
 */

 /*
 textorize command-line options cheatsheet
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

class textorize {
  
  public $path, $cmd;
  
  public function __construct($path, $cmd = '/usr/bin/textorize')
  {
    $this->path = $path;
    $this->cmd = $cmd;
  }
  
  /**
   * Give this guy an array of options and it returns the rendered filename.
   **/
  public function render($input)
  {
    $options_list = array(
        'font' => $input['f'] ? (string) $input['f'] : 'arial',
        'size' => $input['s'] ? (float) $input['s'] : 15,
        'color' => "#".($input['c'] ? (string) $input['c'] : '000000'),
        'background' => "#".($input['g'] ? (string) $input['g'] : 'FFFFFF'),
      );
    $options = $this->array2cmd($options_list);

    $msg = $input['m'];
    $msg = escapeshellarg($msg);

    $filename = $this->path."/cache/cache-".sha1($options.$msg).".png";

    if(!file_exists($filename)){
      $options .= "--output={$filename} ";
      //echo $cmd.$options.$msg; // you can debug what's run in the command line here.
      //exit;
      exec($this->cmd.' '.$options.$msg);
    }
    
    return $filename;
  }
  
  protected function array2cmd($array){
    // this turns an array into command-line arguments

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

}

function urldecode_deep($val)
{
   // url decode an associative array
   return is_array($val) ? array_map('urldecode_deep', $val) : urldecode($val);
}
