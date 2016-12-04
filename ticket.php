<?php
/*********************************************************************
iciwebface 
Страница создания обращения
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

    <script src="js/open-ticket.js"></script>

            
<div class="mdl-grid">
    <div class="mdl-cell mdl-cell--2-col">
    </div>

    <div class="mdl-cell mdl-cell--8-col mdl-card mdl-shadow--4dp">
            
        <div class="mdl-card__supporting-text">   
                    <?php
                            
                        if (!empty($_GET['host'])) {

                            if ($obj->results[0]->attrs->state == "0") {
                                echo "<table class='mdl-data-table' style='border: 0px; border-top: 0px; border-bottom: 0px'><tr><td style='border: 0px; border-top: 0px; border-bottom: 0px'>";
                                echo "<img src='" . $obj->results[0]->attrs->icon_image ."' />";
                                echo "</td><td style='border: 0px; border-top: 0px; border-bottom: 0px'>";
                                echo "<input readonly class='mdl-textfield__input' type='text' name='checkhost' id='checkhost' value='". $obj->results[0]->attrs->display_name . "' />";
                                echo "<small><div id='show-data-host' /></small></td></tr></table>";                                
                            } else {
                                
                                $img_gray = substr($obj->results[0]->attrs->icon_image,0,-4) . "_gray.png";
                                
                                echo "<table class='mdl-data-table' style='border: 0px; border-top: 0px; border-bottom: 0px'><tr><td style='border: 0px; border-top: 0px; border-bottom: 0px'>";
                                echo "<img src='" . $img_gray ."' />";
                                echo "</td><td style='border: 0px; border-top: 0px; border-bottom: 0px'>";
                                //echo "<span class='mdl-badge mdl-badge--overlap' data-badge='!'></span>";
                                echo "<input readonly class='mdl-textfield__input' type='text' name='checkhost' id='checkhost' value='". $obj->results[0]->attrs->display_name . "' />";
                                echo "<small><div id='show-data-host' /></small></td></tr></table>";                                
                            }

                        }
                    ?>
        </div> 


        <div class="mdl-card__title mdl-card--expand">
            <h1 class="mdl-card__title-text">Создать обращение</h1>
        </div>
        <div class="mdl-card__supporting-text" style="margin: auto; padding-right: 0; padding-left: 0;">

            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="width: 100%">
                <label class="mdl-textfield__label" for="exitstatus">Приоритет</label>
                <select class="mdl-textfield__input" name="exitstatus" id="exitstatus">
                    <option value="0" >OK</option>
                    <option value="1" >Warning</option>
                    <option value="2" selected >Critical</option>
                </select>
            </div>


            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="width: 100%">
      		    <label class="mdl-textfield__label" for="host" required>Имя хоста<span class="required">*</span></label>
      		    <input class="mdl-textfield__input" name="host" type="text" id="host" size="35" value="<?php echo $obj->results[0]->attrs->display_name ?>" />
            </div>
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="width: 100%">
                <label class="mdl-textfield__label"  for="message" required>Сообщение <span class="required">*</span></label>
                <textarea class="mdl-textfield__input" name="message"  id="message" rows="5"></textarea>
            </div>
        </div>
        
        <div class="mdl-card__actions mdl-card--border">
            <button id="open_ticket" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">Отправить</button>
        </div>
    
    </div>


</div>

<!--
<style>
/* Change the layout__content class to Flex (instead of inline-block) to allow spacer to work. */
.mdl-layout__content {
    display: -webkit-flex;
	display: flex;
    -webkit-flex-direction: column;
	        flex-direction: column;
}
</style>

<div class="mdl-layout-spacer"></div>
-->
<?php include ( "footer.php" ) ?>
