<?php

/**
 * textorize-server [http://github.com/thrashr888/textorize-server]
 * @author Paul Thrasher [http://vastermonster.com]
 * @uses textorize by Thomas Fuchs [http://textorize.org/]
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

include 'textorize.class.php';

$input = $textorize::urldecode_deep($_GET);

$path = realpath(dirname(__FILE__));

$cmd = "/usr/bin/textorize";

$textorize = new textorize($path, $cmd);

$filename = $textorize->render($input);

header('Content-type: image/png');

// seconds, minutes, hours, days
$expires = 60*60*24*14;
header("Pragma: public");
header("Cache-Control: maxage=".$expires);
header('Expires: ' . gmdate('D, d M Y H:i:s', time()+$expires) . ' GMT');

readfile($filename);
