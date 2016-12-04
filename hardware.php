<?php
include ( "header.doc.php" );

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

$r_Win32_DiskDrive = GetSQLWin32Class($str_q, '4');

$r_Win32_NetworkAdapter = GetSQLWin32Class($str_q, '6');

$r_Win32_VideoController = GetSQLWin32Class($str_q, '13');


?>
    <link rel="stylesheet" href="css/accordion.css">


       <div class="icinga2app-back">
          <a class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon" href="hreport1.php" title="go back" role="button">
            <i class="material-icons" role="presentation">arrow_back</i>
          </a>
       </div>


          <div class="mdl-cell mdl-cell--1-col mdl-cell--hide-tablet mdl-cell--hide-phone"></div>
          <div class="icinga2app-content mdl-color--white mdl-shadow--4dp content mdl-color-text--grey-800 mdl-cell mdl-cell--10-col">

    
        <h3><?php echo $str_q ?></h3>     


<br />

<div style="width: 100%;">


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


echo "<div class='mdl-accordion'>";
echo        "<a class='mdl-navigation__link mdl-accordion__button'>";
#echo          "<i class='material-icons mdl-accordion__icon mdl-animation--default'>expand_more</i>";
echo          "<h5>Win32_NetworkAdapter</h5>";
echo        "</a>";
echo        "<div class='mdl-accordion__content-wrapper'>";
echo          "<div class='mdl-accordion__content mdl-animation--default'>";
echo "<ul>";
while($row = mysql_fetch_array($r_Win32_NetworkAdapter)) {
echo "<li><a class='mdl-navigation__link'>".$row['PropertyName'].": ".$row['Value']." (".$row['InstanceId'].")</a></li>";
}
echo "</ul><br /></div></div></div>";


echo "<div class='mdl-accordion'>";
echo        "<a class='mdl-navigation__link mdl-accordion__button'>";
#echo          "<i class='material-icons mdl-accordion__icon mdl-animation--default'>expand_more</i>";
echo          "<h5>Win32_VideoController</h5>";
echo        "</a>";
echo        "<div class='mdl-accordion__content-wrapper'>";
echo          "<div class='mdl-accordion__content mdl-animation--default'>";
echo "<ul>";
while($row = mysql_fetch_array($r_Win32_VideoController)) {
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
include ( "footer.doc.php" );
?>