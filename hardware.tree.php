<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Hardware Information</title>
	<style>
	html { margin:0; padding:0; font-size:62.5%; }
	body { max-width:800px; min-width:300px; margin:0 auto; padding:20px 10px; font-size:14px; font-size:1.4em; }
	h1 { font-size:1.8em; }
	/*.demo { overflow:auto; border:1px solid silver; min-height:100px; }*/
	</style>
	<link rel="stylesheet" href="/iciwebface/js/themes/default/style.min.css" />
</head>
<body>

<?php
//include ( "header.doc.php" );

$str_q = $_GET["q"];
if ($str_q == '')
{
	$str_q = '%';
}

$host='192.168.0.209'; // имя хоста 
$database='inventory'; // имя базы данных 
$user='inventory_user'; // имя пользователя
$pswd='Z123456z'; // пароль

$dbh = mysql_connect($host, $user, $pswd) or die("Не могу соединиться с MySQL.");
mysql_select_db($database) or die("Не могу подключиться к базе.");
mysql_query("SET names UTF8");



function GetSQLWin32Class($str_host, $str_class)
{
  $q_Win32_Class = "SELECT tbInventoryClass.Name AS ClassName, tbInventoryProperty.Name AS PropertyName, tbComputerInventory.Value, tbComputerInventory.InstanceId
    FROM tbComputerInventory INNER JOIN
    tbInventoryClass ON tbComputerInventory.ClassID = tbInventoryClass.ClassID INNER JOIN
    tbInventoryProperty ON tbComputerInventory.PropertyID = tbInventoryProperty.PropertyID INNER JOIN
    tbComputerTarget ON tbComputerInventory.ComputerTargetId = tbComputerTarget.ComputerTargetId
    WHERE  (tbComputerTarget.Name LIKE '%$str_host%' AND tbInventoryClass.ClassID ='$str_class');";


  $r_Win32_Class = mysql_query($q_Win32_Class)  or die(mysql_error());
  return $r_Win32_Class;
}


$r_Win32_BIOS = GetSQLWin32Class($str_q, '1');

$r_Win32_ComputerSystem = GetSQLWin32Class($str_q, '2');

$r_Win32_BaseBoard = GetSQLWin32Class($str_q, '16');

$r_Win32_OperatingSystem = GetSQLWin32Class($str_q, '8');

$r_Win32_Processor = GetSQLWin32Class($str_q, '11');

$r_Win32_PhysicalMemory = GetSQLWin32Class($str_q, '15');

$r_Win32_DiskDrive = GetSQLWin32Class($str_q, '4');

$r_Win32_LogicalDisk = GetSQLWin32Class($str_q, '5');

$r_Win32_NetworkAdapter = GetSQLWin32Class($str_q, '6');

$r_Win32_VideoController = GetSQLWin32Class($str_q, '13');

$r_Win32_SoundDevice = GetSQLWin32Class($str_q, '12');

$r_Win32_Printer = GetSQLWin32Class($str_q, '10');

$r_Win32_DesktopMonitor = GetSQLWin32Class($str_q, '3');

$r_Win32_NetworkAdapterConfiguration = GetSQLWin32Class($str_q, '7');



?>
    


<br />


<div style="width: 100%;">

	<h1>Hardware Information</h1>
	<div id="jstreehtml" class="demo">
		<ul>
			<li data-jstree='{ "opened" : "true", "icon" : "/iciwebface/img/icons/hardware.ico" }'>Computer: <?php echo $str_q ?>
        <ul>

<?php

echo "<li data-jstree='{ \"icon\" : \"/iciwebface/img/icons/system.ico\" }'>Win32_OperatingSystem<ul>";
while($row = mysql_fetch_array($r_Win32_OperatingSystem)) {
  echo "<li>".$row['PropertyName'].": ".$row['Value']."</li>";
}
echo "</ul></li>";

echo "<li data-jstree='{ \"icon\" : \"/iciwebface/img/icons/computer.ico\" }'>Win32_ComputerSystem<ul>";
while($row = mysql_fetch_array($r_Win32_ComputerSystem)) {
  echo "<li>".$row['PropertyName'].": ".$row['Value']."</li>";
}
echo "</ul></li>";

echo "<li data-jstree='{ \"icon\" : \"/iciwebface/img/icons/system.ico\" }'>Win32_BaseBoard<ul>";
while($row = mysql_fetch_array($r_Win32_BaseBoard)) {
  echo "<li>".$row['PropertyName'].": ".$row['Value']."</li>";
}
echo "</ul></li>";

echo "<li data-jstree='{ \"icon\" : \"/iciwebface/img/icons/bios.ico\" }'>Win32_BIOS<ul>";
while($row = mysql_fetch_array($r_Win32_BIOS)) {
  echo "<li>".$row['PropertyName'].": ".$row['Value']."</li>";
}
echo "</ul></li>";


echo "<li data-jstree='{ \"icon\" : \"/iciwebface/img/icons/cpu.ico\" }'>Win32_Processor<ul>";
$adapters = array();
while($row = mysql_fetch_array($r_Win32_Processor)) {
  $InstId = $row['InstanceId'];
  $PropName = $row['PropertyName'];
  $PropValue = $row['Value'];
  $adapters[$InstId][$PropName]["Value"] = $PropValue;
}
$i = 1;
foreach ( $adapters as $adapter ) {
  echo "<li data-jstree='{ \"icon\" : \"/iciwebface/img/icons/cpu.ico\" }'>".$adapters[$i]["Name"]["Value"]."<ul>";
  foreach ( $adapter as $key => $value ) {
    echo "<li>".$key.": ".$value["Value"]."</li>";
  }
  echo '</ul></li>';
  $i ++;
}
echo "</ul></li>";


echo "<li data-jstree='{ \"icon\" : \"/iciwebface/img/icons/ram.ico\" }'>Win32_PhysicalMemory<ul>";
$adapters = array();
while($row = mysql_fetch_array($r_Win32_PhysicalMemory)) {
  $InstId = $row['InstanceId'];
  $PropName = $row['PropertyName'];
  $PropValue = $row['Value'];
  $adapters[$InstId][$PropName]["Value"] = $PropValue;
}
$i = 1;
foreach ( $adapters as $adapter ) {
  echo "<li data-jstree='{ \"icon\" : \"/iciwebface/img/icons/ram.ico\" }'>".$adapters[$i]["Name"]["Value"]."<ul>";
  foreach ( $adapter as $key => $value ) {
    echo "<li>".$key.": ".$value["Value"]."</li>";
  }
  echo '</ul></li>';
  $i ++;
}
echo "</ul></li>";


echo "<li data-jstree='{ \"icon\" : \"/iciwebface/img/icons/disk.ico\" }'>Win32_DiskDrive<ul>";
$adapters = array();
while($row = mysql_fetch_array($r_Win32_DiskDrive)) {
  $InstId = $row['InstanceId'];
  $PropName = $row['PropertyName'];
  $PropValue = $row['Value'];
  $adapters[$InstId][$PropName]["Value"] = $PropValue;
}
$i = 1;
foreach ( $adapters as $adapter ) {
  echo "<li data-jstree='{ \"icon\" : \"/iciwebface/img/icons/disk.ico\" }'>".$adapters[$i]["Name"]["Value"]."<ul>";
  foreach ( $adapter as $key => $value ) {
    echo "<li>".$key.": ".$value["Value"]."</li>";
  }
  echo '</ul></li>';
  $i ++;
}
echo "</ul></li>";


echo "<li data-jstree='{ \"icon\" : \"/iciwebface/img/icons/disk.ico\" }'>Win32_LogicalDisk<ul>";
$adapters = array();
while($row = mysql_fetch_array($r_Win32_LogicalDisk)) {
  $InstId = $row['InstanceId'];
  $PropName = $row['PropertyName'];
  $PropValue = $row['Value'];
  $adapters[$InstId][$PropName]["Value"] = $PropValue;
}
$i = 1;
foreach ( $adapters as $adapter ) {
  if ($adapters[$i]["DriveType"]["Value"] == 5) {
      echo "<li data-jstree='{ \"icon\" : \"/iciwebface/img/icons/cdrom.ico\" }'>".$adapters[$i]["Name"]["Value"]."<ul>";
  } else {
      echo "<li data-jstree='{ \"icon\" : \"/iciwebface/img/icons/disk.ico\" }'>".$adapters[$i]["Name"]["Value"]."<ul>";
  }
  foreach ( $adapter as $key => $value ) {
    echo "<li>".$key.": ".$value["Value"]."</li>";
  }
  echo '</ul></li>';
  $i ++;
}
echo "</ul></li>";


echo "<li data-jstree='{ \"icon\" : \"/iciwebface/img/icons/network.ico\" }'>Win32_NetworkAdapter<ul>";
$adapters = array();
while($row = mysql_fetch_array($r_Win32_NetworkAdapter)) {
  $InstId = $row['InstanceId'];
  $PropName = $row['PropertyName'];
  $PropValue = $row['Value'];
  $adapters[$InstId][$PropName]["Value"] = $PropValue;
}
$i = 1;
foreach ( $adapters as $adapter ) {
  echo "<li data-jstree='{ \"icon\" : \"/iciwebface/img/icons/network.ico\" }'>".$adapters[$i]["Name"]["Value"]."<ul>";
  foreach ( $adapter as $key => $value ) {
    echo "<li>".$key.": ".$value["Value"]."</li>";
  }
  echo '</ul></li>';
  $i ++;
}
echo "</ul></li>";


echo "<li data-jstree='{ \"icon\" : \"/iciwebface/img/icons/network.ico\" }'>Win32_NetworkAdapterConfiguration<ul>";
$adapters = array();
while($row = mysql_fetch_array($r_Win32_NetworkAdapterConfiguration)) {
  $InstId = $row['InstanceId'];
  $PropName = $row['PropertyName'];
  $PropValue = $row['Value'];
  $adapters[$InstId][$PropName]["Value"] = $PropValue;
}
$i = 1;
foreach ( $adapters as $adapter ) {
  echo "<li data-jstree='{ \"icon\" : \"/iciwebface/img/icons/network.ico\" }'>".$adapters[$i]["Caption"]["Value"]."<ul>";
  foreach ( $adapter as $key => $value ) {
    echo "<li>".$key.": ".$value["Value"]."</li>";
  }
  echo '</ul></li>';
  $i ++;
}
echo "</ul></li>";


echo "<li data-jstree='{ \"icon\" : \"/iciwebface/img/icons/video.ico\" }'>Win32_VideoController<ul>";
$adapters = array();
while($row = mysql_fetch_array($r_Win32_VideoController)) {
  $InstId = $row['InstanceId'];
  $PropName = $row['PropertyName'];
  $PropValue = $row['Value'];
  $adapters[$InstId][$PropName]["Value"] = $PropValue;
}
$i = 1;
foreach ( $adapters as $adapter ) {
  echo "<li data-jstree='{ \"icon\" : \"/iciwebface/img/icons/video.ico\" }'>".$adapters[$i]["Description"]["Value"]."<ul>";
  foreach ( $adapter as $key => $value ) {
    echo "<li>".$key.": ".$value["Value"]."</li>";
  }
  echo '</ul></li>';
  $i ++;
}
echo "</ul></li>";


echo "<li data-jstree='{ \"icon\" : \"/iciwebface/img/icons/monitor.ico\" }'>Win32_DesktopMonitor<ul>";
$adapters = array();
while($row = mysql_fetch_array($r_Win32_DesktopMonitor)) {
  $InstId = $row['InstanceId'];
  $PropName = $row['PropertyName'];
  $PropValue = $row['Value'];
  $adapters[$InstId][$PropName]["Value"] = $PropValue;
}
$i = 1;
foreach ( $adapters as $adapter ) {
  echo "<li data-jstree='{ \"icon\" : \"/iciwebface/img/icons/monitor.ico\" }'>".$adapters[$i]["Name"]["Value"]."<ul>";
  foreach ( $adapter as $key => $value ) {
    echo "<li>".$key.": ".$value["Value"]."</li>";
  }
  echo '</ul></li>';
  $i ++;
}
echo "</ul></li>";


echo "<li data-jstree='{ \"icon\" : \"/iciwebface/img/icons/audio.ico\" }'>Win32_SoundDevice<ul>";
$adapters = array();
while($row = mysql_fetch_array($r_Win32_SoundDevice)) {
  $InstId = $row['InstanceId'];
  $PropName = $row['PropertyName'];
  $PropValue = $row['Value'];
  $adapters[$InstId][$PropName]["Value"] = $PropValue;
}
$i = 1;
foreach ( $adapters as $adapter ) {
  echo "<li data-jstree='{ \"icon\" : \"/iciwebface/img/icons/audio.ico\" }'>".$adapters[$i]["Name"]["Value"]."<ul>";
  foreach ( $adapter as $key => $value ) {
    echo "<li>".$key.": ".$value["Value"]."</li>";
  }
  echo '</ul></li>';
  $i ++;
}
echo "</ul></li>";


echo "<li data-jstree='{ \"icon\" : \"/iciwebface/img/icons/printer.ico\" }'>Win32_Printer<ul>";
$adapters = array();
while($row = mysql_fetch_array($r_Win32_Printer)) {
  $InstId = $row['InstanceId'];
  $PropName = $row['PropertyName'];
  $PropValue = $row['Value'];
  $adapters[$InstId][$PropName]["Value"] = $PropValue;
}
$i = 1;
foreach ( $adapters as $adapter ) {
  echo "<li data-jstree='{ \"icon\" : \"/iciwebface/img/icons/printer.ico\" }'>".$adapters[$i]["Name"]["Value"]."<ul>";
  foreach ( $adapter as $key => $value ) {
    echo "<li>".$key.": ".$value["Value"]."</li>";
  }
  echo '</ul></li>';
  $i ++;
}
echo "</ul></li>";


?>



				</ul>
			</li>
		</ul>
	</div>



</div>

	<script src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
	<script src="/iciwebface/js/jstree.min.js"></script>
	
	<script>
	// html demo
	$('#jstreehtml').jstree();


	</script>
</body>
</html>

<?php



//include ( "footer.doc.php" );
?>