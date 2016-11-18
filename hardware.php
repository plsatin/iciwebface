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
$q_Win32_BIOS = "SELECT tbInventoryClass.Name AS ClassName, tbInventoryProperty.Name AS PropertyName, tbComputerInventory.Value, tbComputerInventory.InstanceId
FROM tbComputerInventory INNER JOIN
tbInventoryClass ON tbComputerInventory.ClassID = tbInventoryClass.ClassID INNER JOIN
tbInventoryProperty ON tbComputerInventory.PropertyID = tbInventoryProperty.PropertyID INNER JOIN
tbComputerTarget ON tbComputerInventory.ComputerTargetId = tbComputerTarget.ComputerTargetId
WHERE  (tbComputerTarget.Name LIKE '%$str_q%' AND tbInventoryClass.ClassID ='1');";

// AND (tbInventoryClass.ClassID !='6' AND tbInventoryClass.ClassID !='7' AND tbInventoryClass.ClassID !='4' AND tbInventoryClass.ClassID !='5')

$r_Win32_BIOS = mysql_query($q_Win32_BIOS)  or die(mysql_error());


########################################
$q_Win32_ComputerSystem = "SELECT tbInventoryClass.Name AS ClassName, tbInventoryProperty.Name AS PropertyName, tbComputerInventory.Value, tbComputerInventory.InstanceId
FROM tbComputerInventory INNER JOIN
tbInventoryClass ON tbComputerInventory.ClassID = tbInventoryClass.ClassID INNER JOIN
tbInventoryProperty ON tbComputerInventory.PropertyID = tbInventoryProperty.PropertyID INNER JOIN
tbComputerTarget ON tbComputerInventory.ComputerTargetId = tbComputerTarget.ComputerTargetId
WHERE  (tbComputerTarget.Name LIKE '%$str_q%' AND tbInventoryClass.ClassID ='2');";

$r_Win32_ComputerSystem = mysql_query($q_Win32_ComputerSystem)  or die(mysql_error());


########################################
$q_Win32_BaseBoard = "SELECT tbInventoryClass.Name AS ClassName, tbInventoryProperty.Name AS PropertyName, tbComputerInventory.Value, tbComputerInventory.InstanceId
FROM tbComputerInventory INNER JOIN
tbInventoryClass ON tbComputerInventory.ClassID = tbInventoryClass.ClassID INNER JOIN
tbInventoryProperty ON tbComputerInventory.PropertyID = tbInventoryProperty.PropertyID INNER JOIN
tbComputerTarget ON tbComputerInventory.ComputerTargetId = tbComputerTarget.ComputerTargetId
WHERE  (tbComputerTarget.Name LIKE '%$str_q%' AND tbInventoryClass.ClassID ='16');";

$r_Win32_BaseBoard = mysql_query($q_Win32_BaseBoard)  or die(mysql_error());


########################################
$q_Win32_OperatingSystem = "SELECT tbInventoryClass.Name AS ClassName, tbInventoryProperty.Name AS PropertyName, tbComputerInventory.Value, tbComputerInventory.InstanceId
FROM tbComputerInventory INNER JOIN
tbInventoryClass ON tbComputerInventory.ClassID = tbInventoryClass.ClassID INNER JOIN
tbInventoryProperty ON tbComputerInventory.PropertyID = tbInventoryProperty.PropertyID INNER JOIN
tbComputerTarget ON tbComputerInventory.ComputerTargetId = tbComputerTarget.ComputerTargetId
WHERE  (tbComputerTarget.Name LIKE '%$str_q%' AND tbInventoryClass.ClassID ='8');";

$r_Win32_OperatingSystem = mysql_query($q_Win32_OperatingSystem)  or die(mysql_error());


########################################
$q_Win32_Processor = "SELECT tbInventoryClass.Name AS ClassName, tbInventoryProperty.Name AS PropertyName, tbComputerInventory.Value, tbComputerInventory.InstanceId
FROM tbComputerInventory INNER JOIN
tbInventoryClass ON tbComputerInventory.ClassID = tbInventoryClass.ClassID INNER JOIN
tbInventoryProperty ON tbComputerInventory.PropertyID = tbInventoryProperty.PropertyID INNER JOIN
tbComputerTarget ON tbComputerInventory.ComputerTargetId = tbComputerTarget.ComputerTargetId
WHERE  (tbComputerTarget.Name LIKE '%$str_q%' AND tbInventoryClass.ClassID ='11');";

$r_Win32_Processor = mysql_query($q_Win32_Processor)  or die(mysql_error());


########################################
$q_Win32_PhysicalMemory = "SELECT tbInventoryClass.Name AS ClassName, tbInventoryProperty.Name AS PropertyName, tbComputerInventory.Value, tbComputerInventory.InstanceId
FROM tbComputerInventory INNER JOIN
tbInventoryClass ON tbComputerInventory.ClassID = tbInventoryClass.ClassID INNER JOIN
tbInventoryProperty ON tbComputerInventory.PropertyID = tbInventoryProperty.PropertyID INNER JOIN
tbComputerTarget ON tbComputerInventory.ComputerTargetId = tbComputerTarget.ComputerTargetId
WHERE  (tbComputerTarget.Name LIKE '%$str_q%' AND tbInventoryClass.ClassID ='15');";

$r_Win32_PhysicalMemory = mysql_query($q_Win32_PhysicalMemory)  or die(mysql_error());


########################################
$q_Win32_DiskDrive = "SELECT tbInventoryClass.Name AS ClassName, tbInventoryProperty.Name AS PropertyName, tbComputerInventory.Value, tbComputerInventory.InstanceId
FROM tbComputerInventory INNER JOIN
tbInventoryClass ON tbComputerInventory.ClassID = tbInventoryClass.ClassID INNER JOIN
tbInventoryProperty ON tbComputerInventory.PropertyID = tbInventoryProperty.PropertyID INNER JOIN
tbComputerTarget ON tbComputerInventory.ComputerTargetId = tbComputerTarget.ComputerTargetId
WHERE  (tbComputerTarget.Name LIKE '%$str_q%' AND tbInventoryClass.ClassID ='4');";

$r_Win32_DiskDrive = mysql_query($q_Win32_DiskDrive)  or die(mysql_error());


?>
    <link rel="stylesheet" href="css/accordion.css">


       <div class="icinga2app-back">
          <a class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon" href="index.php" title="go back" role="button">
            <i class="material-icons" role="presentation">arrow_back</i>
          </a>
       </div>


          <div class="mdl-cell mdl-cell--1-col mdl-cell--hide-tablet mdl-cell--hide-phone"></div>
          <div class="icinga2app-content mdl-color--white mdl-shadow--4dp content mdl-color-text--grey-800 mdl-cell mdl-cell--10-col">

      <div class="mdl-layout__header-row">
        <h3><?php echo $str_q ?></h3>     
      </div>

<br />

<div style="width: 100%;">

</style>

<?php
/*
#############################################################################
echo "<table class='mdl-data-table mdl-js-data-table' style='width: 100%; white-space: normal;'>";
while($row = mysql_fetch_array($result)) {

if ($row['ClassName'] == $ClassName) {

} else {
    echo "<tr><td class='mdl-data-table__cell--non-numeric' colspan='3'><b>".$row['ClassName']."</b></td></tr>";

}
    echo "<tr><td class='mdl-data-table__cell--non-numeric' style='word-wrap: break-word; word-break: break-all;'><small>".$row['PropertyName']."</small></td>
    <td class='mdl-data-table__cell--non-numeric' style='word-wrap: break-word; word-break: break-all;'><small>".$row['Value']."</small></td>
    <td><small>".$row['InstanceId']."</small></td></tr>";
    $ClassName = $row['ClassName'];

}
echo "</table>";
###########################################################################
*/
?>

<?php


//$row = mysql_fetch_array($r_Win32_OperatingSystem);
echo "<div class='mdl-accordion mdl-accordion--opened'>";
echo        "<a class='mdl-navigation__link mdl-accordion__button'>";
#echo          "<i class='material-icons mdl-accordion__icon mdl-animation--default'>expand_more</i>";
echo          "<h5>Win32_OperatingSystem</h5>";
echo        "</a>";
echo        "<div class='mdl-accordion__content-wrapper'>";
echo          "<div class='mdl-accordion__content mdl-animation--default'>";
echo "<ul>";
while($row = mysql_fetch_array($r_Win32_OperatingSystem)) {
echo "<li><a class='mdl-navigation__link'>".$row['PropertyName'].": ".$row['Value']."</a></li>";
}
echo "</ul><br /></div></div></div>";


echo "<div class='mdl-accordion'>";
echo        "<a class='mdl-navigation__link mdl-accordion__button'>";
#echo          "<i class='material-icons mdl-accordion__icon mdl-animation--default'>expand_more</i>";
echo          "<h5>Win32_ComputerSystem</h5>";
echo        "</a>";
echo        "<div class='mdl-accordion__content-wrapper'>";
echo          "<div class='mdl-accordion__content mdl-animation--default'>";
echo "<ul>";
while($row = mysql_fetch_array($r_Win32_ComputerSystem)) {
echo "<li><a class='mdl-navigation__link'>".$row['PropertyName'].": ".$row['Value']."</a></li>";
}
echo "</ul><br /></div></div></div>";


echo "<div class='mdl-accordion'>";
echo        "<a class='mdl-navigation__link mdl-accordion__button'>";
#echo          "<i class='material-icons mdl-accordion__icon mdl-animation--default'>expand_more</i>";
echo          "<h5>Win32_BaseBoard</h5>";
echo        "</a>";
echo        "<div class='mdl-accordion__content-wrapper'>";
echo          "<div class='mdl-accordion__content mdl-animation--default'>";
echo "<ul>";
while($row = mysql_fetch_array($r_Win32_BaseBoard)) {
echo "<li><a class='mdl-navigation__link'>".$row['PropertyName'].": ".$row['Value']."</a></li>";
}
echo "</ul><br /></div></div></div>";


echo "<div class='mdl-accordion'>";
echo        "<a class='mdl-navigation__link mdl-accordion__button'>";
#echo          "<i class='material-icons mdl-accordion__icon mdl-animation--default'>expand_more</i>";
echo          "<h5>Win32_BIOS</h5>";
echo        "</a>";
echo        "<div class='mdl-accordion__content-wrapper'>";
echo          "<div class='mdl-accordion__content mdl-animation--default'>";
echo "<ul>";
while($row = mysql_fetch_array($r_Win32_BIOS)) {
echo "<li><a class='mdl-navigation__link'>".$row['PropertyName'].": ".$row['Value']."</a></li>";
}
echo "</ul><br /></div></div></div>";


echo "<div class='mdl-accordion'>";
echo        "<a class='mdl-navigation__link mdl-accordion__button'>";
#echo          "<i class='material-icons mdl-accordion__icon mdl-animation--default'>expand_more</i>";
echo          "<h5>Win32_PhysicalMemory</h5>";
echo        "</a>";
echo        "<div class='mdl-accordion__content-wrapper'>";
echo          "<div class='mdl-accordion__content mdl-animation--default'>";
echo "<ul>";
while($row = mysql_fetch_array($r_Win32_PhysicalMemory)) {
echo "<li><a class='mdl-navigation__link'>".$row['PropertyName'].": ".$row['Value']." (".$row['InstanceId'].")</a></li>";
}
echo "</ul><br /></div></div></div>";


echo "<div class='mdl-accordion'>";
echo        "<a class='mdl-navigation__link mdl-accordion__button'>";
#echo          "<i class='material-icons mdl-accordion__icon mdl-animation--default'>expand_more</i>";
echo          "<h5>Win32_Processor</h5>";
echo        "</a>";
echo        "<div class='mdl-accordion__content-wrapper'>";
echo          "<div class='mdl-accordion__content mdl-animation--default'>";
echo "<ul>";
while($row = mysql_fetch_array($r_Win32_Processor)) {
echo "<li><a class='mdl-navigation__link'>".$row['PropertyName'].": ".$row['Value']." (".$row['InstanceId'].")</a></li>";
}
echo "</ul><br /></div></div></div>";


echo "<div class='mdl-accordion'>";
echo        "<a class='mdl-navigation__link mdl-accordion__button'>";
#echo          "<i class='material-icons mdl-accordion__icon mdl-animation--default'>expand_more</i>";
echo          "<h5>Win32_DiskDrive</h5>";
echo        "</a>";
echo        "<div class='mdl-accordion__content-wrapper'>";
echo          "<div class='mdl-accordion__content mdl-animation--default'>";
echo "<ul>";
while($row = mysql_fetch_array($r_Win32_DiskDrive)) {
echo "<li><a class='mdl-navigation__link'>".$row['PropertyName'].": ".$row['Value']." (".$row['InstanceId'].")</a></li>";
}
echo "</ul><br /></div></div></div>";

?>
</div>


          </div>
        </div>



<script>
  $(function(){
    $('.mdl-accordion__content').each(function(){
      var content = $(this);
      content.css('margin-top', -content.height());
    });

    $(document.body).on('click', '.mdl-accordion__button', function(){
      $(this).parent('.mdl-accordion').toggleClass('mdl-accordion--opened');
    });
  });
</script>


<?php
include ( "footer.php" );
?>