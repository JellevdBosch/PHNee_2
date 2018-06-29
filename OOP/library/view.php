<?php
/**
 * Created by PhpStorm.
 * User: jlbos
 * Date: 28-6-2018
 * Time: 14:55
 */

class View {
    public $data = array();
    public function __construct() {
        $this->data['site_title'] = '';
        $this->data['errormessage'] = [];
    }

    public function Assign($variable = '', $value) {
        if ($variable == ''){
            $this->data = $value;
        }else{
            $this->data[$variable] = $value;
        }
    }

    public function setSiteTitle($site_title){
        $this->data['site_title'] = $site_title;
    }

    public function getErrors() {
        return implode("", (array)$this->data['errormessage']);
    }

    public function getSiteTitle() {
        return $this->data['site_title'];
    }

}