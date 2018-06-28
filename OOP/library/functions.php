<?php

class functions {
    public function curPageURL() {
        $pageURL = 'http://';
        if ($_SERVER["SERVER_PORT"] != "80") {
            $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
        } else {
            $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
        }
        return $pageURL;
    }

    public function curPage() {
        $urlArray = array();
        $urlArray = explode("/",$this->curPageURL());
        //**************************************************************************************//
        //http://php-1.local/  is root                                                //
        //$urlArray[0] == 'http:'                                                              //
        //$urlArray[1] == ''                                                                    //
        //$urlArray[2] == 'php-1.local'                                                //
        //$urlArray[3] == 'posts'                                                              //
        //$urlArray[4] == 'new.php'                                                              //
        //**************************************************************************************//
        $start = count(explode('/', SITE_ROOT))-1;
        $dirName = $urlArray[$start];
        if (empty($dirName) || $dirName == "" || $dirName != 'post') {
            return 'posts';
        } else {
            $fileName = (isset($urlArray[$start+1]) && $urlArray[$start+1] != '') ? $urlArray[$start+1] : '';
            $fileName = str_replace('.php', '', $fileName);
            switch ($fileName) {
                case 'new':
                    return 'new';
                    break;
                case 'edit':
                    return 'edit';
                    break;
                default:
                    return 'new';
                    break;
            }
        }
    }

    public function test_input($data) {
        $data = trim($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}

class View {
    public $data = array();
    public function __construct() {
        $this->_fun = new functions();
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

?>