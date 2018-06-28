<?php
//function CallHook() {
//    $fun = new functions();
//    $view = new View();
//    $url = $fun->curPageURL();
//    $start = 0;
//    if (!isset($url) || $url == SITE_ROOT) {
//        $dirName = DEFAULT_DIR;
//        $fileName = DEFAULT_ACTION;
//        $filter = 'today';
//    } else {
//        $urlArray = array();
//        $urlArray = explode("/",$url);
//        //**************************************************************************************//
//        //http://php-1.local/  is root                                                //
//        //$urlArray[0] == 'http:'                                                              //
//        //$urlArray[1] == ''                                                                    //
//        //$urlArray[2] == 'php-1.local'                                                //
//        //$urlArray[3] == 'public'                                                          //
//        //$urlArray[4] == 'posts'                                                              //
//        //$urlArray[5] == 'new.php'                                                              //
//        //**************************************************************************************//
//        $start = count(explode('/', SITE_ROOT))-1;
//        $dirName = $urlArray[$start+1];
//        //die(var_dump($dirName));
//        $fileName = (isset($urlArray[$start+2]) && $urlArray[$start+2] != '') ? $urlArray[$start+2] : DEFAULT_ACTION;
//    }
//    $dir = ROOT.'public/'.$dirName;
//    $file = $dir.'/'.$fileName;
//
//    //instantiate the appropriate page
//    //die(var_dump($dir.$dirName.$file.$fileName)); //SHOULD BE: D:/xampp/htdocs/*optional*/*project_name*/dirName
//    if(file_exists($dir)) {
//        if(file_exists($file)) {
//            switch ($file) {
//                case '/' || 'today':
//                    $view->Set_Site_Title('today');
//                    break;
//                default:
//                    $view->Set_Site_Title('new');
//                    break;
//
//            }
//        } else {
//            switch ($dirName) {
//                case '/':
//                    $view->Set_Site_Title('today');
//                    break;
//                default:
//                    $view->Set_Site_Title('new');
//                    break;
//
//            }
//        }
//    } else{
//        //Error: page not found
//        $view->Assign('errormessage', "1. File <strong>'$dirName'</strong> containing file <strong>'$file'</strong> might be missing. 2. File <strong>'$file'</strong> is missing in <strong>'$dirName'</strong>");
//        $dirName = DEFAULT_DIR;
//        $file = DEFAULT_ACTION;
//        header("Location: ".SITE_ROOT);
//        exit();
//    }
//}
//
//CallHook();
//?>