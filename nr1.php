<?php
$selectjpg = 'nr1title';
$selectNR = 'l301_nr1';
$title = 'SensorPoint.1';
$DB_HOST = 'localhost';
$DB_USER = '';
$DB_PASS = '';
$selectDB= '';
$dddd= $_GET[ddd];
$stary= $_GET[stary];
$starm= $_GET[starm];
$stard= $_GET[stard];
$stopy= $_GET[stopy];
$stopm= $_GET[stopm];
$stopd= $_GET[stopd];
$command= $_GET[command];
$stardate= $_GET[stardate];
$enddate= $_GET[enddate];
?>
<style type="text/css">
#list {
    position: fixed;
    left: 80px;
    top: 60px;    
    padding: 10px 15px; 
    z-index:1;
}
body, ul.navigation, ul.navigation li, ul.navigation ul, a{
    margin: 0;
    padding:  0;
    font-size: 18px;
    text-decoration: none;
}
ul.navigation,ul.navigation li {
    list-style: none;
}
ul.navigation li {
    position: relative;
    float: left;
}

ul.navigation li a{
    display: block;
    font-size: 24px;
    padding: 10px 10px;
    background: #888;
    color: #FFF;
}

ul.navigation > li > a{
    border-bottom: 1px solid #CCC;    
    border-left: 1px solid #CCC;
}
ul.navigation > li > a:hover{
    color: #666;
    background: #DDD
}

ul.navigation li ul{
    display: none;
    float: left;
    position: absolute;
    left: 0;    
    margin: 0;
}

ul.navigation li:hover > ul{
    display: block;
}

ul.navigation ul li {
    border-bottom: 1px solid black;
    border-left: 1px solid black;
    border-right: 1px solid black;
    border-top: none;

}

ul.navigation ul li:first-child { 
    border-top: 1px solid black;
}

ul.navigation ul a {
    font-size: 20px;
    width: 120px;
    padding: 10px 10px;
    color: #666;
    background: #EEE;
}
ul.navigation ul :hover  {       
    color: #000000;
    background: #AAAAAA;   
}

#backpage {
    width: 160px;
    position: fixed;
    right: 50px;
    bottom: 90px;    
    padding: 10px 15px;    
    font-size: 24px;
    font-color: white;
    background: #777;
    color: white;
    cursor: pointer;
z-index:1;
}
#homepage {
    width: 130px;
    position: fixed;
    right: 50px;
    bottom: 30px;    
    padding: 10px 15px;    
    font-size: 24px;
    font-color: white;
    background: #777;
    color: white;
    cursor: pointer;
z-index:1;
}

</style>


<?php

if ($command=="select") 
{
$stardate=$stary.$starm.$stard;
$enddate=$stopy.$stopm.$stopd;
$dddd=select;
//echo "$stardate.$enddate.$dddd";
//echo "<meta http-equiv=Refresh content=0;url=nr1.php?ddd=select&stardate=$stardate&enddate=$enddate>";
}



$conn = mysql_connect($DB_HOST,$DB_USER,$DB_PASS);
mysql_select_db("$selectDB");
$result = mysql_query("SELECT * FROM $selectNR");
$transactions = array();
$rows = array();
$table = array();
$table['cols'] = array(
array('label' => 'time', 'type' => 'datetime'),
array('label' => 'temp', 'type' => 'number'),
array('label' => 'humidity', 'type' => 'number'),
array('label' => 'light', 'type' => 'number'),
array('label' => 'soiltemp', 'type' => 'number'),
array('label' => 'ph', 'type' => 'number'),
array('label' => 'soilhumidity', 'type' => 'number')
);

$rows = array();





//-------------------------------------------------------------------------------------------
while($r = mysql_fetch_assoc($result)) {

$temp = array();
$day = $r['year'].$r['month'].$r['day'];
$showyear=$r['year'];
$showmonth=$r['month'];
$showday=$r['day'];
$showtime=$r['time'];
$showtemp=$r['temp'];
$showhunidity=$r['hunidity'];
$showwater=$r['water'];
$showph=$r['ph'];
$showSoilhumid=$r['soilhumid'];
$showlight=$r['light'];
//---------------------------

if($day == $dddd)
{

$year=$r['year'];
$mo=$r['month']-1;
$da=$r['day'];
$hr=substr($r['time'], 0,2);
$mi=substr($r['time'], 3,2);
$se=substr($r['time'], 6,2);
    $temp[] = array('v' => "Date($year,$mo,$da,$hr,$mi,$se)");
    $temp[] = array('v' => (int) $r['temp']); 
    $temp[] = array('v' => (int) $r['hunidity']);
    $temp[] = array('v' => (int) $r['light']/100); 
    $temp[] = array('v' => (int) $r['water']); 
    $temp[] = array('v' => (int) $r['ph']); 
    $temp[] = array('v' => (int) $r['soilhumid']/10);
    $rows[] = array('c' => $temp);
}
}

//---------------------------
if($stardate !='' &&$enddate !='' && $dddd == 'select')
{
$sa=mysql_query("select * from $selectNR");
$sda=mysql_num_rows($sa);
$starswich = 0;
$endswich=0;
for($i=1; $i<=$sda; $i++)
{
$temp = array();
$set=mysql_fetch_row($sa);
$day = $set[0].$set[1].$set[2];

if($day == $stardate)
{$starswich = 1;}
if($day == $enddate)
{$endswich = 1;}
if($day != $enddate && $endswich == 1)
{$starswich = 0;}
if($starswich == 1)
{
$year=$set[0];
$mo=$set[1]-1;
$da=$set[2];
$hr=substr($set[3], 0,2);
$mi=substr($set[3], 3,2);
$se=substr($set[3], 6,2);
$temp[] = array('v' => "Date($year,$mo,$da,$hr,$mi,$se)");
$temp[] = array('v' => (int) $set[4]); 
$temp[] = array('v' => (int) $set[5]); 
$temp[] = array('v' => (int) $set[6]/100); 
$temp[] = array('v' => (int) $set[7]); 
$temp[] = array('v' => (int) $set[10]); 
$temp[] = array('v' => (int) $set[11]/10);
$rows[] = array('c' => $temp);
}
}
}

//--------------------------------------------------------------------------------------------

$table['rows'] = $rows;
$jsonTable = json_encode($table);
//echo $jsonTable;

//-------------------------------------------
echo"
<div id='list'>
        <ul class='navigation'>
            <li>
                <a href='#'>SansorPoint</a>
                <ul>
                  <li><a href='nr1.php?ddd=$day'>Number 1</a></li>
                  <li><a href='nr2.php?ddd=$day'>Number 2</a></li>
                  <li><a href='nr3.php?ddd=$day'>Number 3</a></li>
                  <li><a href='nr4.php?ddd=$day'>Number 4</a></li>
                </ul>
            </li>
        </ul>
</div>
<a href='l301in.php'><div id='backpage'>Previous page</div></a>
<a href='index.php'><div id='homepage'>Home page</div></a>
";
?>

<html>
<head>
<!--Load the Ajax API-->
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script type="text/javascript">
 $(document).ready(function(){
     setInterval(timeclock, 1000);
 });
    function timeclock() {
      var jsonData = $.ajax({
          url: "nr1time.php",
          dataType: "json",
          async: false
          }).responseText;
document.images['hover'].src="http://counter.nsysu.edu.tw/Count.cgi?dd=A&lit="+jsonData
    }





google.load('visualization', '1', {'packages':['corechart']});
google.setOnLoadCallback(drawChart);


function drawChart() {
  var data = new google.visualization.DataTable(<?=$jsonTable?>);
  var options = {
      lineWidth: 2.5,
      backgroundColor:'#2D2D2D',
      hAxis: {
      textStyle:{color: '#FFF'}
    },
      vAxis: {
      textStyle:{color: '#FFF'}
    },
      legendTextStyle: {color:'#FFF'},
      titleTextStyle: {color: '#FFF'},
          series: {

            4: { color: '#30AACC' },
            5: { color: '#9999FF' },
          },
chartArea:{left:300,top:10,width:"70%",height:"80%"},
  selectionMode: 'multiple',
  tooltip: {trigger: 'selection'},
  aggregationTarget: 'auto',
        animation: {
          duration: 3500,
          easing: 'out',
          startup: true
        }

    };
  var chart = new google.visualization.LineChart(document.getElementById('chart1_div'));
  chart.draw(data, options);
}

google.load('visualization', '1', {'packages':['gauge']});
google.setOnLoadCallback(drawChart2);
 $(document).ready(function(){
     setInterval(drawChart2, 10000);
 });
function drawChart2() {
      var jsonData2 = $.ajax({
          url: "nr1temp.php",
          dataType: "json",
          async: false
          }).responseText;
      var dat = new google.visualization.DataTable(jsonData2);
      var option = {animation: {duration: 10000,easing: 'out',startup: true},max:50,width: 400,height: 300,redFrom: 28, redTo:45,yellowFrom:0, yellowTo: 18,yellowColor:'#0066FF',greenFrom:18,greenTo:28,majorTicks: ['0c',' ', '10c',' ',  '20c',' ', '30c',' ', '40c',' ', '50c'],minorTicks:5};
      var chart = new google.visualization.Gauge(document.getElementById('chart2_div'));
      chart.draw(dat, option);
}
google.load('visualization', '1', {'packages':['gauge']});
google.setOnLoadCallback(drawChart3);
 $(document).ready(function(){
     setInterval(drawChart3, 10000);
 });
function drawChart3() {
      var jsonData3 = $.ajax({
          url: "nr1humid.php",
          dataType: "json",
          async: false
          }).responseText;
      var dat = new google.visualization.DataTable(jsonData3);
      var option = {max:100,width: 400,height: 300,redFrom: 70, redTo:100,redColor:'#0066FF',yellowFrom:0, yellowTo: 30,greenFrom:30,greenTo:70,majorTicks: ['0%','', '20%','',  '40%','', '60%','', '80%','', '100%'],minorTicks:10};
      var chart = new google.visualization.Gauge(document.getElementById('chart3_div'));
      chart.draw(dat, option);
}
google.load('visualization', '1', {'packages':['gauge']});
google.setOnLoadCallback(drawChart4);
 $(document).ready(function(){
     setInterval(drawChart4, 10000);
 });
function drawChart4() {
      var jsonData4 = $.ajax({
          url: "nr1light.php",
          dataType: "json",
          async: false
          }).responseText;
      var dat = new google.visualization.DataTable(jsonData4);
      var option = {max:65535,width: 400,height: 300,redFrom:35000, redTo:65535,yellowFrom:10000, yellowTo: 35000,greenFrom:0,greenTo:10000,greenColor:'#888888',majorTicks: ['0','1w', '2w','',  '4w','5w', '6w','6w5'],minorTicks:10};
      var chart = new google.visualization.Gauge(document.getElementById('chart4_div'));
      chart.draw(dat, option);
}
google.load('visualization', '1', {'packages':['gauge']});
google.setOnLoadCallback(drawChart5);
 $(document).ready(function(){
     setInterval(drawChart5, 10000);
 });
function drawChart5() {
      var jsonData5 = $.ajax({
          url: "nr1sot.php",
          dataType: "json",
          async: false
          }).responseText;
      var dat = new google.visualization.DataTable(jsonData5);
      var option = {max:50,width: 400,height: 300,redFrom: 28, redTo:45,yellowFrom:0, yellowTo: 18,yellowColor:'#0066FF',greenFrom:18,greenTo:28,majorTicks: ['0c','', '10c','',  '20c','', '30c','', '40c','', '50c'],minorTicks:5};
      var chart = new google.visualization.Gauge(document.getElementById('chart5_div'));
      chart.draw(dat, option);
}
google.load('visualization', '1', {'packages':['gauge']});
google.setOnLoadCallback(drawChart6);
 $(document).ready(function(){
     setInterval(drawChart6, 10000);
 });
function drawChart6() {
      var jsonData6 = $.ajax({
          url: "nr1ph.php",
          dataType: "json",
          async: false
          }).responseText;
      var dat = new google.visualization.DataTable(jsonData6);
      var option = {max:14,width: 400,height: 300,redFrom: 0, redTo:5,yellowFrom:7, yellowTo: 14,yellowColor:'#0066FF',greenFrom:5,greenTo:7,majorTicks: ['0','1', '2','3','4','5', '6','7', '8','9','10','11','12','13','14'],minorTicks:0};
      var chart = new google.visualization.Gauge(document.getElementById('chart6_div'));
      chart.draw(dat, option);
}
google.load('visualization', '1', {'packages':['gauge']});
google.setOnLoadCallback(drawChart7);
 $(document).ready(function(){
     setInterval(drawChart7, 10000);
 });
function drawChart7() {
      var jsonData6 = $.ajax({
          url: "nr1soh.php",
          dataType: "json",
          async: false
          }).responseText;
      var dat = new google.visualization.DataTable(jsonData6);
      var option = {max:100,width: 400,height: 300,redFrom: 70, redTo:100,redColor:'#0066FF',yellowFrom:0, yellowTo: 30,greenFrom:30,greenTo:70,majorTicks: ['0%','', '20%','',  '40%','', '60%','', '80%','', '100%'],minorTicks:10};
      var chart = new google.visualization.Gauge(document.getElementById('chart7_div'));
      chart.draw(dat, option);
}
</script>
</head>
<body bgcolor='#2D2D2D'>
<center>
<?php
//selectcheck
$sty=$showyear;
$stm = $showmonth;
$std=$showday;


echo"
<title>$title</title>
<form  name='lee'>
<a href='index.php'><img src='$selectjpg.jpg'></a>
<table border='0' width='40%' bordercolor='#2D2D2D'  style='color:white;' bgcolor='#2D2D2D'>
<tr><td align='center' colspan='6'><img src='http://counter.nsysu.edu.tw/Count.cgi?dd=A&lit=$showyear-$showmonth$showday'></td></tr>
<tr><td align='center' colspan='3'>
<img name='hover'></td></tr>
<td><div id='chart2_div'></div></td>
<td><div id='chart3_div'></div></td>
<td><div id='chart4_div'></div></td><tr>
<td><div id='chart5_div'></div></td>
<td><div id='chart6_div'></div></td>
<td><div id='chart7_div'></div></td></tr>


</table>

<br><br>

<table border='0' width='45%' bordercolor='#2D2D2D'  style='font-size:26px;color:white;' bgcolor='#2D2D2D' >
<td>Select date:</td>
<td>   <select style='font-size:24px;' name='stary'>
     　<option value='2015'>2015</option>
     　<option value='2016'>2016</option>
     　<option value='2017'>2017</option>
       </select>

<select style='font-size:24px;' name='starm'>
     　<option value='01'>1</option>
     　<option value='02'>2</option>
     　<option value='03'>3</option>
     　<option value='04'>4</option>
     　<option value='05'>5</option>
     　<option value='06'>6</option>
     　<option value='07'>7</option>
     　<option value='08'>8</option>
     　<option value='09'>9</option>
     　<option value='10'>10</option>
     　<option value='11'>11</option>
     　<option value='12'>12</option>
       </select>

<select style='font-size:24px;' name='stard'>
     　<option value='01'>1</option>
     　<option value='02'>2</option>
     　<option value='03'>3</option>
     　<option value='04'>4</option>
     　<option value='05'>5</option>
     　<option value='06'>6</option>
     　<option value='07'>7</option>
     　<option value='08'>8</option>
     　<option value='09'>9</option>
     　<option value='10'>10</option>
     　<option value='11'>11</option>
     　<option value='12'>12</option>
     　<option value='13'>13</option>
     　<option value='14'>14</option>
     　<option value='15'>15</option>
     　<option value='16'>16</option>
     　<option value='17'>17</option>
     　<option value='18'>18</option>
     　<option value='19'>19</option>
     　<option value='20'>20</option>
     　<option value='21'>21</option>
     　<option value='22'>22</option>
     　<option value='23'>23</option>
     　<option value='24'>24</option>
     　<option value='25'>25</option>
     　<option value='26'>26</option>
     　<option value='27'>27</option>
     　<option value='28'>28</option>
     　<option value='29'>29</option>
     　<option value='30'>30</option>
     　<option value='31'>31</option>
       </select>
</td>
<td>
to
</td>
<td>
<select style='font-size:24px;' name='stopy'>
     　<option value='2015'>2015</option>
     　<option value='2016'>2016</option>
     　<option value='2017'>2017</option>
     　<option value='2018'>2018</option>
     　<option value='2019'>2019</option>
     　<option value='2020'>2020</option>
       </select>
<select style='font-size:24px;' name='stopm'>
     　<option value='01'>1</option>
     　<option value='02'>2</option>
     　<option value='03'>3</option>
     　<option value='04'>4</option>
     　<option value='05'>5</option>
     　<option value='06'>6</option>
     　<option value='07'>7</option>
     　<option value='08'>8</option>
     　<option value='09'>9</option>
     　<option value='10'>10</option>
     　<option value='11'>11</option>
     　<option value='12'>12</option>
       </select>
<select style='font-size:24px;' name='stopd'>
     　<option value='01'>1</option>
     　<option value='02'>2</option>
     　<option value='03'>3</option>
     　<option value='04'>4</option>
     　<option value='05'>5</option>
     　<option value='06'>6</option>
     　<option value='07'>7</option>
     　<option value='08'>8</option>
     　<option value='09'>9</option>
     　<option value='10'>10</option>
     　<option value='11'>11</option>
     　<option value='12'>12</option>
     　<option value='13'>13</option>
     　<option value='14'>14</option>
     　<option value='15'>15</option>
     　<option value='16'>16</option>
     　<option value='17'>17</option>
     　<option value='18'>18</option>
     　<option value='19'>19</option>
     　<option value='20'>20</option>
     　<option value='21'>21</option>
     　<option value='22'>22</option>
     　<option value='23'>23</option>
     　<option value='24'>24</option>
     　<option value='25'>25</option>
     　<option value='26'>26</option>
     　<option value='27'>27</option>
     　<option value='28'>28</option>
     　<option value='29'>29</option>
     　<option value='30'>30</option>
     　<option value='31'>31</option>
       </select>
</td>

<td>
<input type='submit' name='command' value='select'style='width:80px;height:40px;font-size:24px;'>
</td>
</table>
</form>
";

?>

<script>document.lee.stopy.value = '<?=$sty?>';</script>
<script>document.lee.stopm.value = '<?=$stm?>';</script>
<script>document.lee.stopd.value = '<?=$std?>';</script>


<script>document.lee.stary.value = '<?=$sty?>';</script>
<script>document.lee.starm.value = '<?php if($std-1==0){if($stm < 10){echo 0;}echo $stm-1;}else{echo $stm;}?>';</script>
<script>document.lee.stard.value = '<?php
if($std-1==0)
{
if($stm-1==1 or$stm-1==3 or$stm-1==5 or$stm-1==7 or$stm-1==8 or$stm-1==10 or$stm-1==12)
{echo 31;}
if($stm-1==4 or$stm-1==6 or$stm-1==9 or$stm-1==11)
{echo 30;}
if($stm-1==2)
{echo 28;}
}
else
{

if($std <= 10){$std=$std-1;echo "0$std";}else {echo $std-1;}
}

?>';</script>



<div id="chart1_div" style="width: 100%; height: 100%"></div>
</center>
</body>
</html>



