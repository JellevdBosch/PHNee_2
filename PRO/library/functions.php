<?php
function createRandomID() {
        $bytes = openssl_random_pseudo_bytes(20);
        return bin2hex($bytes);
    }

    function curPageURL() {
        $pageURL = 'http://';
        if ($_SERVER["SERVER_PORT"] != "80") {
            $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
        } else {
            $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
        }
        return $pageURL;
    }

    function curPage() {
        $urlArray = array();
        $urlArray = explode("/",curPageURL());
        //**************************************************************************************//
        //http://php-1.local/  is root                                                //
        //$urlArray[0] == 'http:'                                                              //
        //$urlArray[1] == ''                                                                    //
        //$urlArray[2] == 'php-2-1.local'                                                //
        //$urlArray[3] == 'post'                                                              //
        //$urlArray[4] == 'new.php'                                                             //
        //**************************************************************************************//
        $start = count(explode('/', SITE_ROOT))-1;
        $dirName = $urlArray[$start];
        if (empty($dirName) || $dirName == "" || $dirName != 'post' && $dirName != 'account') {
            return '';
        } else {
            $fileName = (isset($urlArray[$start+1]) && $urlArray[$start+1] != '') ? $urlArray[$start+1] : '';
            $fileName = str_replace('.php', '', $fileName);
            //die(var_dump($fileName));
            switch ($fileName) {
                case 'new':
                    return 'new';
                    break;
                case 'edit':
                    return 'edit';
                    break;
                case 'login':
                    return 'login';
                    break;
                case 'logout':
                    return 'logout';
                    break;
                default:
                    return '';
                    break;
            }
        }
    }

    function test_input($data) {
        $data = trim($data);
        $data = htmlspecialchars($data);
        return $data;
    }



?>