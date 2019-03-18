<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

use Restserver\Libraries\REST_Controller;

class Test extends REST_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Test_model');
    }

    public function _remap($_method, $_params = array()) {
        switch($_method){
            case 'data': $this->setData_post();
                break;
            case 'indicators': $this->getIndicators_get($_params);
                break;
            case 'one_hour': $this->getOneHour_get($_params);
                break;
            case 'six_hours': $this->getSixHour_get($_params);
                break;
            case 'twelve_hours': $this->getTwelveHour_get($_params);
                break;
            case 'twenty_four_hours': $this->getTwentyFourHours_get($_params);
                break;
            default: $this->error_get();
                break;
        }
    }

    public function setData_post() {
        $type = 200;
        if($this->input->post()) $this->Test_model->setData($_POST);
        else {
            $response = res(false, null,'Parametros no resividos');
            $type = 404;
        }
    }

    public function getIndicators_get($_data) {
        $type = 200;
        if($_data) {
            $day = $_data[0];
            $max = $this->Test_model->getMaxValue($day);
            $min = $this->Test_model->getMinValue($day);
            $value = $this->Test_model->getLastValue();
            $max = $max? $max->rate : null;
            $min = $min? $min->rate : null;
            $response = array('max' => $max, 'min' => $min, 'value' => $value->rate);
            $response = res(true, $response);
        } else {
            $response = res(false, null,'Parametros no resividos');
            $type = 404;
        }
        $this->response($response, $type);
    }

    public function getOneHour_get($_data) {
        $type = 200;
        if($_data) {
            $dateTimeEnd = "$_data[0] $_data[1]:00:00";
            $dateTimeStart = date('Y-m-d H:i:s', strtotime($dateTimeEnd."- 1 hours"));
            $response = $this->Test_model->getHours($dateTimeStart, $dateTimeEnd);
            if($response) $response = res(true, $response);
            else {
                $response = res(false, null,'No se encontraron coincidencias');
                $type = 404;
            }
        } else {
            $response = res(false, null,'Parametros no resividos');
            $type = 404;
        }
        $this->response($response, $type);
    }

    public function getSixHour_get($_data) {
        $type = 200;
        if($_data) {
            $dateTimeEnd = "$_data[0] $_data[1]:00:00";
            $dateTimeStart = date('Y-m-d H:i:s', strtotime($dateTimeEnd."- 6 hours"));
            $response = $this->Test_model->getHours($dateTimeStart, $dateTimeEnd);
            if($response) $response = res(true, $response);
            else {
                $response = res(false, null,'No se encontraron coincidencias');
                $type = 404;
            }
        } else {
            $response = res(false, null,'Parametros no resividos');
            $type = 404;
        }
        $this->response($response, $type);
    }

    public function getTwelveHour_get($_data) {
        $type = 200;
        if($_data) {
            $dateTimeEnd = "$_data[0] $_data[1]:00:00";
            $dateTimeStart = date('Y-m-d H:i:s', strtotime($dateTimeEnd."- 12 hours"));
            $response = $this->Test_model->getHours($dateTimeStart, $dateTimeEnd);
            if($response) $response = res(true, $response);
            else {
                $response = res(false, null,'No se encontraron coincidencias');
                $type = 404;
            }
        } else {
            $response = res(false, null,'Parametros no resividos');
            $type = 404;
        }
        $this->response($response, $type);
    }

    public function getTwentyFourHours_get($_data) {
        $type = 200;
        if($_data) {
            $dateTimeEnd = "$_data[0] $_data[1]:00:00";
            $dateTimeStart = date('Y-m-d H:i:s', strtotime($dateTimeEnd."- 24 hours"));
            $response = $this->Test_model->getHours($dateTimeStart, $dateTimeEnd);
            if($response) $response = res(true, $response);
            else {
                $response = res(false, null,'No se encontraron coincidencias');
                $type = 404;
            }
        } else {
            $response = res(false, null,'Parametros no resividos');
            $type = 404;
        }
        $this->response($response, $type);
    }

    public function error_get() {
        $response = error();
        $this->response($response, 404);
    }
	
}
