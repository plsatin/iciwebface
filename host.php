<?php
/*********************************************************************
iciwebface 
Страница детальной информации о хосте
Павел Сатин <pslater.ru@gmail.com>
19.01.2016
  
**********************************************************************/

require_once( "config.php" );

if (!empty($_GET['host'])) {
    $host = trim($_GET['host']); 
    $json_url = "https://".ICINGA2_HOST.":5665/v1/objects/hosts/".$host."/";

try {
    $ch = curl_init();

    if (FALSE === $ch)
        throw new Exception('failed to initialize');

    curl_setopt($ch, CURLOPT_URL, $json_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

    $content = curl_exec($ch);

    if (FALSE === $content)
        throw new Exception(curl_error($ch), curl_errno($ch));

} catch(Exception $e) {

    trigger_error(sprintf(
        'Curl failed with error #%d: %s',
        $e->getCode(), $e->getMessage()),
        E_USER_ERROR);

}

    $json_url2 = "https://".ICINGA2_HOST.":5665/v1/objects/services?filter=match(%22".$host."%22,host.name)";

try {
    $ch = curl_init();

    if (FALSE === $ch)
        throw new Exception('failed to initialize');

    curl_setopt($ch, CURLOPT_URL, $json_url2);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

    $content2 = curl_exec($ch);


    if (FALSE === $content2)
        throw new Exception(curl_error($ch), curl_errno($ch));

} catch(Exception $e) {

    trigger_error(sprintf(
        'Curl failed with error #%d: %s',
        $e->getCode(), $e->getMessage()),
        E_USER_ERROR);

}

}

    $obj=json_decode($content);
    $obj2=json_decode($content2);
    $graphite_name = str_replace('-', '_', str_replace('.', '_', $obj->results[0]->attrs->display_name));

?>

<?php include ( "header.php" ) ?>

            
       <div class="icinga2app-back">
          <a class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon" href="index.php" title="go back" role="button">
            <i class="material-icons" role="presentation">arrow_back</i>
          </a>
       </div>

            
          <div class="mdl-cell mdl-cell--1-col mdl-cell--hide-tablet mdl-cell--hide-phone"></div>
          <div class="icinga2app-content mdl-color--white mdl-shadow--4dp content mdl-color-text--grey-800 mdl-cell mdl-cell--10-col">
              
                <button id="fab_checkhost" class="fab-check-host mdl-button mdl-shadow--4dp mdl-js-ripple-effect mdl-js-button mdl-button--fab mdl-color--accent" data-upgraded=",MaterialButton,MaterialRipple" role="presentation">
                    <i class="material-icons mdl-color-text--white" role="presentation">refresh</i>
                </button>
             
            <div class="icinga2app-crumbs mdl-color-text--grey-500 mdl-cell--1-col">
                <span>
                    
                </span>
            </div>
            
            <div class="mdl-layout__header-row" style="padding: 0 0 0 0; border-bottom: 1px solid; border-color: rgba(0,0,0,0.1);">
                
                          <?php
                            
                            if ($obj->results[0]->attrs->state == "0") {
                                echo "<table class='mdl-data-table' style='border: 0px; border-top: 0px; border-bottom: 0px'><tr><td style='border: 0px; border-top: 0px; border-bottom: 0px'>";
                                echo "<img src='" . $obj->results[0]->attrs->icon_image ."' />";
                                echo "</td><td style='border: 0px; border-top: 0px; border-bottom: 0px'>";
                                echo "<input readonly class='mdl-textfield__input' type='text' name='checkhost' id='checkhost' value='". $obj->results[0]->attrs->display_name . "' />";
                                echo "<small><div id='show-data' /></small></td></tr></table>";                                
                            } else {
                                
                                $img_gray = substr($obj->results[0]->attrs->icon_image,0,-4) . "_gray.png";
                                
                                echo "<table class='mdl-data-table' style='border: 0px; border-top: 0px; border-bottom: 0px'><tr><td style='border: 0px; border-top: 0px; border-bottom: 0px'>";
                                echo "<img src='" . $img_gray ."' />";
                                echo "</td><td style='border: 0px; border-top: 0px; border-bottom: 0px'>";
                                //echo "<span class='mdl-badge mdl-badge--overlap' data-badge='!'></span>";
                                echo "<input readonly class='mdl-textfield__input' type='text' name='checkhost' id='checkhost' value='". $obj->results[0]->attrs->display_name . "' />";
                                echo "<small><div id='show-data' /></small></td></tr></table>";                                
                            }
                          ?>
                
            </div>            

<br />

<?php

echo "<h4>Сервисы:</h4>";
echo "<table class='mdl-data-table mdl-js-data-table' style='margin: auto; width: 100%'>";

foreach ($obj2->results as $hservice) {

    if ($hservice->attrs->state == "0") {
        echo "<tr><td class='mdl-data-table__cell--non-numeric'>";
        echo $hservice->attrs->name;
        echo "</td>";
    } else {
        echo "<tr><td class='mdl-data-table__cell--non-numeric'>";
        echo "<span class='mdl-badge mdl-badge--overlap' data-badge='!'></span>";
        echo $hservice->attrs->name;
        echo "</td>";
    }

    echo "<td class='mdl-data-table__cell--non-numeric'>";
    echo $hservice->attrs->state;
    echo "<td class='mdl-data-table__cell--non-numeric'>";
    echo $hservice->attrs->last_check_result->output;
    echo "</td></tr>";

}

echo "</table>"; 
?>

          </div>
        </div>



<?php include ( "footer.php" ) ?>
