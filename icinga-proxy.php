<?php
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

    echo $content;

    if (FALSE === $content)
        throw new Exception(curl_error($ch), curl_errno($ch));

    } catch(Exception $e) {

        trigger_error(sprintf(
            'Curl failed with error #%d: %s',
            $e->getCode(), $e->getMessage()),
            E_USER_ERROR);

    }

} else {
    
    
    if (!empty($_GET['domain'])) {
       
    $domain = trim($_GET['domain']);
    $json_url = "https://".ICINGA2_HOST.":5665/v1/objects/hosts?filter=match%28%22*" . $domain . "*%22%2Chost%2Ename%29";

    } else {
        
        $json_url = "https://".ICINGA2_HOST.":5665/v1/objects/hosts";
                
    }


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

    echo $content;

    if (FALSE === $content)
        throw new Exception(curl_error($ch), curl_errno($ch));

    } catch(Exception $e) {

    trigger_error(sprintf(
        'Curl failed with error #%d: %s',
        $e->getCode(), $e->getMessage()),
        E_USER_ERROR);

    }
   
}

?>