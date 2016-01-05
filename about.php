<?php
require('cgi-bin/vars.php');
require('cgi-bin/functions.php');

opening_html("About this site");

?>

This is <? echo($orginization . "'s"); ?> history page, containing a record of all the past trips this unit has taken.  This site is maintained by <? echo($historian . ", " . $orginization); ?> historian. <br /> <br />

This software is currently version <? echo($version); ?>, written by Matthew Bowker.

<? navlinks(array(array("index.php","Return home")));

closing_html();

?>