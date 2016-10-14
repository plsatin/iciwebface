<?php
/*********************************************************************
iciwebface 
Прокси к icinga2
Павел Сатин <pslater.ru@gmail.com>
11.08.2016
ver. 0.3.1
**********************************************************************/

require_once( "config.php" );

$username = ICINGA2_USR;
$password = ICINGA2_PSW;

$data_string = false;
$puppet_node = false;

if (!empty($_GET['host'])) {
    $host = trim($_GET['host']); 
    $json_url = "https://".ICINGA2_HOST.":5665/v1/objects/hosts/".$host."/";
} elseif (!empty($_GET['domain'])) {
    $domain = trim($_GET['domain']);
    $json_url = "https://".ICINGA2_HOST.":5665/v1/objects/hosts?filter=match%28%22*" . $domain . "*%22%2Chost%2Ename%29";
} elseif (!empty($_GET['checkhost'])) {
    $checkhost = trim($_GET['checkhost']);
    $data = array("type" => "Host", "filter" => "host.name==\"".$checkhost."\"", "next_check" => true);                                                                    
    $data_string = json_encode($data);
    //echo $data_string;                                                                                 
    $json_url = "https://".ICINGA2_HOST.":5665/v1/actions/reschedule-check";
} elseif (!empty($_GET['node'])) {
    $puppet_node = trim($_GET['node']);
    $json_url = "http://".ICINGA2_HOST."/puppet-node.php?host=".$puppet_node; 

} elseif (!empty($_GET['supporthost'])) {
    $support_host = trim($_GET['supporthost']);
    $message =  trim($_GET['message']);
    $exitstatus =  (int) $_GET['exitstatus'];
    $json_url = "https://".ICINGA2_HOST.":5665/v1/actions/process-check-result?service=". $support_host ."!support-ticket"; 
    $data = array("exit_status" => $exitstatus, "plugin_output" => "". $message."");                                                                    
    $data_string = json_encode($data);

    //echo $data_string;
    //echo $json_url;

} else {
    $json_url = "https://".ICINGA2_HOST.":5665/v1/objects/hosts";
}

    try {
        $ch = curl_init();

        if (FALSE === $ch)
            throw new Exception('failed to initialize');
            if ($data_string) {
                $headers = array( 
                    "Accept: application/json"
                    ); 

                curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            }

            curl_setopt($ch, CURLOPT_URL, $json_url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            if ($puppet_node) {

            } else {
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
                curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
                curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            }
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

?>