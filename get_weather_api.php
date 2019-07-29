<?php
$string = file_get_contents("https://opendata.cwb.gov.tw/fileapi/v1/opendataapi/O-A0001-001?Authorization=CWB-D07CEF16-F2D0-411F-98CB-262E0F9FEF96&downloadType=WEB&format=JSON");
$json_a = json_decode($string, true);
//print_r ($json_a);
//echo $json_a['cwbopendata']['location'];
//echo $json_a['result']['results']['0']['value']."°C";


foreach ($json_a['cwbopendata']['location'] as $key => $value) {
echo $json_a['cwbopendata']['location'][$key]['locationName']." now temp is  ";
echo $json_a['cwbopendata']['location'][$key]['weatherElement'][3]['elementValue']['value']."°C<br>";
}

?>
