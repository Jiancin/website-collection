<?php
$DB_HOST = 'localhost';
$DB_USER = '';
$DB_PASS = '';
$selectDB= '';
$conn = mysql_connect($DB_HOST,$DB_USER,$DB_PASS);
mysql_select_db("$selectDB");
$result = mysql_query("SELECT * FROM l301_nr1");
while($r = mysql_fetch_assoc($result)) {
$showtemp=$r['temp'];
}
$table = array();
$table['cols'] = array(
    array('label' => '', 'type' => 'string'),
    array('label' => '', 'type' => 'number')
);

$tep = array();
$tep[] = array('v' => (string) 'Temp'); 
$tep[] = array('v' => (int) $showtemp); 
$roo[] = array('c' => $tep);
$table['rows'] = $roo;
$jsonTable2 = json_encode($table);
echo $jsonTable2;
?>