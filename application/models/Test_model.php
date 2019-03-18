<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    class Test_model extends CI_Model {

        public function setData($_data) {
            $this->db->insert('trades', $_data);
        }

        public function getMaxValue($_day) {
            $this->db->select('rate')->like('date', $_day);
            return $this->db->order_by('rate', 'DESC')->get('trades', 1)->row();
        }

        public function getMinValue($_day) {
            $this->db->select('rate')->like('date', $_day);
            return $this->db->order_by('rate', 'ASC')->get('trades', 1)->row();
        }

        public function getLastValue() {
            return $this->db->select('rate')->order_by('id', 'DESC')->get('trades', 1)->row();
        }

        public function getHours($_start, $_end) {
            $where = "date BETWEEN '$_start' and '$_end'";
            return $this->db->select('rate, date')->where($where)->get('trades')->result();
        }
    }
?>