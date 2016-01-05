<?php
require('cgi-bin/functions.php');
require('cgi-bin/vars.php');

$filename = urldecode($_GET['file']) or die("Filename not set");

$file_ext = explode(DIRECTORY_SEPARATOR, $filename);

opening_html($file_ext[count($file_ext) - 1]);
echo "<br>
<img src=\"$filename\" width=\"970\" alt=\"" . $file_ext[count($file_ext) - 1] . "\" /><br />

<ul>
<li><i>Filename</i>: " . $file_ext[count($file_ext) - 1 ] . "</li>
<li><i>File Size</i>: " . round((filesize($filename)/1024),3) . " KB</li>
<li><i>Last Modified</i>: " . date("F d, Y", filemtime($filename)) . "</li>
</ul>";
echo "<div id=\"footernavlinks\">";

if (isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] != '') {
	navlinks(array(array($_SERVER['HTTP_REFERER'],"Go back"),array("index.php","Return home")));
}
else navlinks(array(array("index.php","Return home")));
closing_html();
?>