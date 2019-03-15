<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

use Restserver\Libraries\REST_Controller;

class Test extends REST_Controller {
    public function __construct() {
        parent::__construct();
        //$this->load->model('Bussines_model');
    }

    public function _remap($_method, $_params = array()) {
        switch($_method){
            case 'saludo': $this->getSaludo_get();
                break;
            default: $this->error_get();
                break;
        }
    }

    public function getSaludo_get() {
        $type = 200;
        $response = array('saludo' => 'todo bien para empezar');
        $response = res(true, $response);
        $this->response($response, $type);
    }

    public function error_get() {
        $response = error();
        $this->response($response, 404);
    }
	
}
