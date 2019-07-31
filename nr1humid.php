<?php
$DB_HOST = 'localhost';
$DB_USER = '';
$DB_PASS = '';
$selectDB= '';
$conn = mysql_connect($DB_HOST,$DB_USER,$DB_PASS);
mysql_select_db("$selectDB");
$result = mysql_query("SELECT * FROM l301_nr1");
while($r = mysql_fetch_assoc($result)) {
$showhunid=$r['hunidity'];
}
$table = array();
$table['cols'] = array(
    array('label' => '', 'type' => 'string'),
    array('label' => '', 'type' => 'number')
);

$tep = array();
$tep[] = array('v' => (string) 'Humidity'); 
$tep[] = array('v' => (int) $showhunid); 
$roo[] = array('c' => $tep);
$table['rows'] = $roo;
$jsonTable3 = json_encode($table);
echo $jsonTable3;
?>