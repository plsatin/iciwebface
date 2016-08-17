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
    $url_host = "https://".ICINGA2_HOST.":5665/v1/objects/hosts/".$host."/";

try {
    $ch = curl_init();

    if (FALSE === $ch)
        throw new Exception('failed to initialize');

    curl_setopt($ch, CURLOPT_URL, $url_host);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

    $output_host = curl_exec($ch);

    if (FALSE === $output_host)
        throw new Exception(curl_error($ch), curl_errno($ch));

} catch(Exception $e) {

    trigger_error(sprintf(
        'Curl failed with error #%d: %s',
        $e->getCode(), $e->getMessage()),
        E_USER_ERROR);

}

    $url_services = "https://".ICINGA2_HOST.":5665/v1/objects/services?filter=match(%22".$host."%22,host.name)";

try {
    $ch = curl_init();

    if (FALSE === $ch)
        throw new Exception('failed to initialize');

    curl_setopt($ch, CURLOPT_URL, $url_services);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

    $output_services = curl_exec($ch);


    if (FALSE === $output_services)
        throw new Exception(curl_error($ch), curl_errno($ch));

} catch(Exception $e) {

    trigger_error(sprintf(
        'Curl failed with error #%d: %s',
        $e->getCode(), $e->getMessage()),
        E_USER_ERROR);

}

    $url_puppet = "http://".ICINGA2_HOST."/puppet-node.php?host=".$host;

try {
    $ch = curl_init();

    if (FALSE === $ch)
        throw new Exception('failed to initialize');

    curl_setopt($ch, CURLOPT_URL, $url_puppet);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $output_puppet = curl_exec($ch);


    if (FALSE === $output_puppet)
        throw new Exception(curl_error($ch), curl_errno($ch));

} catch(Exception $e) {
    trigger_error(sprintf(
        'Curl failed with error #%d: %s',
        $e->getCode(), $e->getMessage()),
        E_USER_ERROR);
}



    $obj=json_decode($output_host);
    $obj_services=json_decode($output_services);
    $obj_puppet=json_decode($output_puppet);
    $graphite_name = str_replace('-', '_', str_replace('.', '_', $obj->results[0]->attrs->display_name));
}

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


echo "<h4>Характеристики:</h4>";
echo "<table class='mdl-data-table mdl-js-data-table' style='margin: auto; width: 100%'>";


    echo "<td class='mdl-data-table__cell--non-numeric'>";
    echo "Операционная система: ";
    echo "</td><td class='mdl-data-table__cell--non-numeric' style='word-wrap: break-word'><small>";
    echo $obj_puppet->parameters->osfamily . " " . $obj_puppet->parameters->operatingsystemmajrelease ;
    echo "</small></td></tr>";
    echo "<td class='mdl-data-table__cell--non-numeric'>";
    echo "Процессор: ";
    echo "</td><td class='mdl-data-table__cell--non-numeric' style='word-wrap: break-word'><small>";
    echo $obj_puppet->parameters->processor0;
    echo "</small></td></tr>";


echo "</table>";


echo "<h4>Сервисы:</h4>";
echo "<table class='mdl-data-table mdl-js-data-table' style='margin: auto; width: 100%'>";

foreach ($obj_services->results as $hservice) {

    if ($hservice->attrs->state == "0") {
        //OK
        echo "<tr><td class='mdl-data-table__cell--non-numeric'>";
        echo $hservice->attrs->name;
        echo "</td>";
    } elseif ($hservice->attrs->state == "1") {
        //WARNING
        echo "<tr style='background-color: #FCF38D;'><td class='mdl-data-table__cell--non-numeric'>";
        echo "<span class='mdl-badge mdl-badge--overlap' data-badge='!'></span>";
        echo $hservice->attrs->name;
        echo "</td>";
    } elseif ($hservice->attrs->state == "2") {
        //CRITICAL
        echo "<tr style='background-color: #FC8D8D;'><td class='mdl-data-table__cell--non-numeric'>";
        echo "<span class='mdl-badge mdl-badge--overlap' data-badge='!'></span>";
        echo $hservice->attrs->name;
        echo "</td>";
    } elseif ($hservice->attrs->state == "3") {
        //UNKNOWN
        echo "<tr style='background-color: #D5BADE;'><td class='mdl-data-table__cell--non-numeric'>";
        echo "<span class='mdl-badge mdl-badge--overlap' data-badge='!'></span>";
        echo $hservice->attrs->name;
        echo "</td>";
    } else {
        echo "<tr><td class='mdl-data-table__cell--non-numeric'>";
        echo $hservice->attrs->name;
        echo "</td>";

    }

    echo "<td class='mdl-data-table__cell--non-numeric'>";
    echo $hservice->attrs->state;
    echo "</td><td class='mdl-data-table__cell--non-numeric' style='word-wrap: break-word'><small>";
    echo $hservice->attrs->last_check_result->output;
    echo "</small></td></tr>";

}

echo "</table>";

/*
echo "<div class='mdl-grid'>";

foreach ($obj_services->results as $hservice) {

    echo "<div class='mdl-card mdl-shadow--2dp mdl-cell mdl-cell--8-col-tablet mdl-cell--4-col-phone mdl-cell--6-col-desktop'>";
    echo "  <div class='mdl-card__title'>";

    if ($hservice->attrs->state == "0") {
            echo $hservice->attrs->name;
    } else {
        echo "<span class='mdl-badge mdl-badge--overlap' data-badge='!'></span>";
        echo $hservice->attrs->name;
    }

    echo "  </div>";
    echo "  <div class='mdl-card__media'>";

    echo "  </div>";
    echo "  <div class='mdl-card__supporting-text'>";
        echo $hservice->attrs->last_check_result->output;
    echo "  </div>";
    echo "  <div class='mdl-card__actions'>";

    echo "  </div>";
    echo "</div>";

    //echo "<td class='mdl-data-table__cell--non-numeric'>";
    //echo $hservice->attrs->state;

}

echo "</div>";
*/
?>

          </div>
        </div>



<?php include ( "footer.php" ) ?>
