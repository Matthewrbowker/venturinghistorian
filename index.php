<?php
require('cgi-bin/functions.php');
require('cgi-bin/vars.php');

opening_html();

echo "<h3>Welcome to $orginization's history page!</h3>

Feel free to browse using the links below.<br />
<br />
<a href=\"year.php\">Search by year</a><br />
<br />
<a href=\"trips.php\">List all trips</a><br />
<br />
<a href=\"about.php\">About this site</a>";

navlinks(array());

closing_html();

?>