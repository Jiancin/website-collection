<?php
$DB_HOST = 'localhost';
$DB_USER = '';
$DB_PASS = '';
$selectDB= '';
$conn = mysql_connect($DB_HOST,$DB_USER,$DB_PASS);
mysql_select_db("$selectDB");
$result = mysql_query("SELECT * FROM l301_nr1");
while($r = mysql_fetch_assoc($result)) {
$showtime=$r['time'];
}
echo $showtime;
?>