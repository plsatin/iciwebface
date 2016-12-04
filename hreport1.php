<?php
include ( "header.php" );

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


########################################
$q_report = "SELECT tbComputerTarget.Name AS Host,
MAX(IF(PropertyID=23,Value, NULL)) AS OSVer,
MAX(IF(PropertyID=4,Value, NULL)) AS CPU,
MAX(IF(PropertyID=3,Value, NULL)) AS CPUSpeed,
MAX(IF(PropertyID=106,Value, NULL)) AS RAMCapacity,
MAX(IF(PropertyID=107,Value, NULL)) AS RAMSpeed,
MAX(IF((PropertyID=26 AND Value NOT Like '%USB%'),Value, NULL)) AS HDD,
MAX(IF((PropertyID=31 AND Value > 33000000000),Value, NULL)) AS HDDSize,
MAX(IF((PropertyID=62 AND (Value Like '%Realtek%' OR Value Like '%Atheros%' OR Value Like '%Marvell%' OR Value Like '%NVIDIA%')),Value, NULL)) AS Net,
MAX(IF(PropertyID=74,Value, NULL)) AS Video,
MAX(IF(PropertyID=75,Value, NULL)) AS VideoRAM,
MAX(IF(PropertyID=71,Value, NULL)) AS Sound
FROM tbComputerInventory INNER JOIN
tbComputerTarget ON tbComputerInventory.ComputerTargetId = tbComputerTarget.ComputerTargetId
GROUP BY tbComputerTarget.Name;";

// AND (tbInventoryClass.ClassID !='6' AND tbInventoryClass.ClassID !='7' AND tbInventoryClass.ClassID !='4' AND tbInventoryClass.ClassID !='5')

$r_report = mysql_query($q_report)  or die(mysql_error());


?>
    <link rel="stylesheet" href="css/accordion.css">



<section class="mdl-color--white mdl-grid">
  <div class="mdl-cell mdl-cell--12-col">
            <h3>Отчет об аппаратных характеристиках</h3>     

<?php

#############################################################################
echo "<table class='mdl-data-table mdl-js-data-table' style='white-space: normal;'>";
echo "<thead>
<tr>
<th class='mdl-data-table__cell--non-numeric'>Host</th>
<!--<th class='mdl-data-table__cell--non-numeric'>OS Ver.</th>-->
<th class='mdl-data-table__cell--non-numeric'>CPU</th>
<th>Clock</th>
<th>RAM</th>
<th>Speed</th>
<th class='mdl-data-table__cell--non-numeric'>HDD</th>
<th>Size</th>
<th class='mdl-data-table__cell--non-numeric'>Net</th>
<th class='mdl-data-table__cell--non-numeric'>Video</th>
<th>VRAM</th>
<th class='mdl-data-table__cell--non-numeric'>Sound</th>
</tr>
</thead>";

while($row = mysql_fetch_array($r_report)) {


    echo "<tr style='cursor: pointer;' onclick=\"location='hardware.php?q=".$row['Host']."'\"><td class='mdl-data-table__cell--non-numeric'>
    <small>".$row['Host']."</small></td>
    <!--<td class='mdl-data-table__cell--non-numeric'>
    <small>".$row['OSVer']."</small></td>-->
    <td class='mdl-data-table__cell--non-numeric'>
    <small>".$row['CPU']."</small></td>
    <td>
    <small>".str_replace('.',',', round($row['CPUSpeed']/1000, 2))."</small></td>
    <td>
    <small>".($row['RAMCapacity']/1024/1024/1024)."</small></td>
    <td>
    <small>".$row['RAMSpeed']."</small></td>
    <td class='mdl-data-table__cell--non-numeric'>
    <small>".$row['HDD']."</small></td>
    <td>
    <small>".round($row['HDDSize']/1024/1024/1024, 2)."</small></td>
    <td class='mdl-data-table__cell--non-numeric'>
    <small>".$row['Net']."</small></td>
    <td class='mdl-data-table__cell--non-numeric'>
    <small>".$row['Video']."</small></td>
    <td>
    <small>".str_replace('.',',', round($row['VideoRAM']/1024/1024/1024, 2))."</small></td>
    <td class='mdl-data-table__cell--non-numeric'>
    <small>".$row['Sound']."</small></td>
    </tr>";

}
echo "</table>";
###########################################################################
?>
  </div>
</section>

<?php
include ( "footer.php" );
?>

