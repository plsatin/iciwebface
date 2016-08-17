<?php
/*********************************************************************
iciwebface 
Прокси к puppet/yaml/node
Павел Сатин <pslater.ru@gmail.com>
17.08.2016
ver. 0.1.1
**********************************************************************/

if (!empty($_GET['host'])) {

    $hostnode = mb_strtolower(trim($_GET['host']));
    $nodeyaml = "puppet/node/" .$hostnode. ".yaml";
    $parsed = yaml_parse_file($nodeyaml);
    echo json_encode($parsed);

}

?>
