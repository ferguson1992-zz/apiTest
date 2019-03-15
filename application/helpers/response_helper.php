<?php
defined('BASEPATH') OR exit('No direct script access allowed');
function error() {
    $response = array('error'=> TRUE, 'message' => 'Favor de revisar URL y sus parametros');
    return $response;
}

function res($_status = true, $_data = null, $_message = null) {
    $response = array('status' => $_status, 'data' => $_data);
    if(!$_status) $response['menssage'] = $_message;
    return $response;
}
?>