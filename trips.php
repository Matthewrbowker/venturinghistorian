<?php
require('cgi-bin/functions.php');
require('cgi-bin/vars.php');

opening_html('All Trips');

if ($dir_handler = opendir($activitiesdir)) {
	while (($dir = readdir($dir_handler)) !== false) {
		if (is_dir($activitiesdir . $dir) && $dir != "." && $dir != ".." && $dir != "0000") {
			if ($file_handler = opendir($activitiesdir . $dir)) {
				echo "<H3>$dir</H3>
				<ul>";
				while (($file = readdir($file_handler)) !== false) {
					if (!is_dir($activitiesdir . $dir . "/" . $file) && $file != "." && $file != ".." && $file != ".DS_Store") {
						$mainfile = explode(".",$file);
						echo "<li><a href=\"activity.php?activity=" . $mainfile[0] . "&amp;year={$dir}\">" . $mainfile[0] . "</a></li>\r";
					}
				}
				echo "</ul>";
			}
		}
	}
}

navlinks(array(array("index.php","Return home")));

closing_html();

?>