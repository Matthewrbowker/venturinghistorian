<?php
require('cgi-bin/functions.php');
require('cgi-bin/vars.php');

$daycount = 0;

if (!isset($_GET['activity']) || !isset($_GET['year'])) {
	$year = '0000';
	$activity = 'notset';
}
else {
	$year = $_GET['year'];
	$activity = $_GET['activity'];
}
$location = "activities";
$file = $activity . ".ini";

if (file_exists(strtolower("$location/$year/$file"))) {
	$buffer = parse_ini_file(strtolower("$location/$year/$file"), true);
}
else {
	$year = "0000";
	$buffer = parse_ini_file("$location/0000/notfound.ini", true);
}

opening_html(ucfirst($buffer['main']['name']));
if ($buffer['main']['dates'] != "-" && $buffer['main']['location'] != "-") echo "<h2>" . $buffer['main']['location'] . " (" . $buffer['main']['dates'] . ")</h2>";
echo $buffer['main']['introtext'];
while ($daycount < count($buffer) - 1) {
	$daycount++;
	$day = "day " . $daycount;
	echo "<h4>" . ucfirst($day) . " (" . $buffer[$day]['day'] . ", " . $buffer[$day]['date'] . ")</h4>\r";
	echo nl2br($buffer[$day]['description'],true) . "\r\r";
}
echo "<br />
";
if (is_dir("$location/$year/$activity")) {
	$count=0;
	echo "<hr>
<H3>Images</H3>\r";
	if ($dir_handler = opendir("$location/$year/$activity/")) {
		while (($file = readdir($dir_handler)) !== false) {
			if (!is_dir("$location/$year/$activity/". $file)) {
				$fileexp = explode(".",$file);
				$ext = strtolower($fileexp[1]);
				if ($ext == "jpg" || $ext == "gif" || $ext == "png" || $ext == "jpeg") {
					echo "<a href=\"image_view.php?file=" . urlencode("$location/$year/$activity/$file") . "\"><img src=\"$location/$year/$activity/$file\" width=\"300\" style=\"border:0;\" alt=\"$file\"/></a><br /><br />";
					$count++;
				}
			}
		}
		closedir($dir_handler);
	}
	if ($count == 0) echo "No images found, sorry.";
}
$navs = array();

if ($year != "0000" && $year != "" && ISSET($year)) $navs[0] = array("year.php?year=$year","View other trips this year");
else $navs[0] = array("year.php","Search trips by year");

$navs[1] = array("trips.php","View all trips");
$navs[2] = array("index.php","Return home");

navlinks($navs);
closing_html();