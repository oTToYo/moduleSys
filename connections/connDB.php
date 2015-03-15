<?php
# database connection setting

 $HOST="localhost";
 $USER="root";
 $PASS="";
 $DB="netcompservice";
 $link_ID=mysql_connect($HOST,$USER,$PASS);
 
 if(!$link_ID) die("Database connection error!");
 
 mysql_select_db($DB,$link_ID);
 mysql_query("SET NAMES 'utf8'");
 mysql_query("SET CHARACTER_SET_CLIENT='utf8'");
 mysql_query("SET CHARACTER_SET_RESULTS='utf8'");

?>
