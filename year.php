<?php
require('cgi-bin/functions.php');
require('cgi-bin/vars.php');

if (isset($_GET['year'])) { $year = $_GET['year']; }

opening_html("Listing trips by year");

if (isset($year)) {
	echo "List all trips for year $year:
	<ul>";
	if (is_dir($activitiesdir . $year)) {
    	if ($dir_handler = opendir($activitiesdir . $year . "/")) {
        	while (($file = readdir($dir_handler)) !== false) {
				if (!is_dir($activitiesdir . $year . "/" . $file)) { // && preg_match($file, "/\.(ini)/")) { 
					$filename_exp = explode(".",$file);
					if ($filename_exp[0] != "") {
						echo "<li><a href=\"activity.php?activity=" . $filename_exp[0] . "&year=$year\">" . ucfirst($filename_exp[0]) . "</a></li>\r";
					}
				}
        	}
        	closedir($dir_handler);
    	}
	}
	echo "</ul>
	<hr>";
}

echo "Please choose a year:
<form action=\"year.php\" method=\"get\">
<select name=\"year\">";
if (is_dir($activitiesdir)) {
	if ($dir_handler = opendir($activitiesdir)) {
		while (($file = readdir($dir_handler)) !== false) {
			if (is_dir($activitiesdir . $file)) {
				if ($file != "." && $file !=".." && $file !="0000") {
					echo "<option value=\"$file\">" . $file . "</option>\r";
				}
			}
		}
		closedir($dir_handler);
	}
}
echo "</select>
<input type=\"submit\" value=\"Search\">
</form>";

navlinks(array(array("index.php","Return Home")));

closing_html();

?>