<?php
    if(isset($_POST['submit'])) {
        if(isset($_POST['logo1']) && $_POST['logo1']!='') $logo= 'var inputLogo = "' . $_POST['logo1'] . '";';
        if(isset($_FILES['logo2']) && $_FILES['logo2']!='' && substr($_FILES['logo2']['type'], 0, 6)=='image/') {
            $imgbinary = fread(fopen($_FILES['logo2']['tmp_name'], "r"), $_FILES['logo2']['size']);
            $logo_base64= 'data:' . $_FILES['logo2']['type'] . ';base64,' . base64_encode($imgbinary);
            $logo= 'var inputLogo = "' . $logo_base64 . '";';
        }
        if(isset($_POST['name']) && $_POST['name']!='') $name= 'var inputName = "' . $_POST['name'] . '";';
        if(isset($_POST['color']) && $_POST['color']!='') $color= 'var inputColor = "' . $_POST['color'] . '";';
        if(isset($_POST['fb']) && $_POST['fb']!='') $fb= 'var inputFb = "' . $_POST['fb'] . '";';
        if(isset($_POST['message1']) && $_POST['message1']!='') $message1= 'var inputMessage1 = "' . $_POST['message1'] . '";';
        if(isset($_POST['message2']) && $_POST['message2']!='') $message2= 'var inputMessage2 = "' . $_POST['message2'] . '";';
        

        // DB INFO
        $username= 'root';
        $password= '';
        $database= 'chatwidget';
        $host= 'localhost';




        // read js file
        $samplejs = fopen("script.js", "r") or die("Unable to open file!");
        $samplejscontent= fread($samplejs,filesize("script.js"));
        fclose($samplejs);

        if(isset($samplejscontent) && $samplejscontent!='') {
            if(1==1) {
                $inputValue = $fb . $logo . $name . $color . $message1 . $message2;
                $newjscontent = $inputValue . $samplejscontent;
                $t = time();
                $newjspath= "widgets/newjs". $t .".js";
                $newjsurl = dirname("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]") . '/' . $newjspath;
                $newjs = fopen($newjspath, "w") or die("Unable to open file!");
                fwrite($newjs, $newjscontent);
                fclose($newjs);
                header('Location: test.php?link=' . $newjsurl);
            } else {
                

            }
            
        }        
    }






    class widgetHelper{

        public function __constructor($logo, $name, $color, $facebook_page, $message1, $message2) {
            public $post_logo = $logo;
            public $post_name = $name;
            public $post_color = $color;
            public $post_facebook_page = $facebook_page;
            public $post_message1 = $message1;
            public $post_message2 = $message2;
            session_start();
        }

        public function logoData($logo_data) 
        {
            if(strlen($logo_data)>6) {
                if(substr($logo_data, 0, 4)=='http') {
                    return $logo_data;
                } else if(substr($logo_data['type'], 0, 6)=='image/') {
                    $imgbinary = fread(fopen($logo_data['tmp_name'], "r"), $logo_data['size']);
                    $logo_base64= 'data:' . $logo_data['type'] . ';base64,' . base64_encode($imgbinary);
                    return $logo_base64;
                } else {
                    return false;
                }

            }
        }

        public function createJsFile() {
            $return = ['status' => false, 'path' => '', 'error' => ''];


            if(isset($post_logo) && $post_logo!='' && logoData($logo_data)!==false) $logo= 'var inputLogo = "' . logoData($logo_data) . '";';
            if(isset($post_name) && $post_name!='') $name= 'var inputName = "' . $post_name . '";';
            if(isset($post_color) && $post_color!='') $color= 'var inputColor = "' . $post_color . '";';
            if(isset($post_facebook_page) && $post_facebook_page!='') $fb= 'var inputFb = "' . $post_facebook_page . '";';
            if(isset($post_message1) && $post_message1!='') $message1= 'var inputMessage1 = "' . $post_message1 . '";';
            if(isset($post_message2) && $post_message2!='') $message2= 'var inputMessage2 = "' . $post_message2 . '";';
            

            // DB INFO
            $username= 'root';
            $password= '';
            $database= 'chatwidget';
            $host= 'localhost';


            // read js file
            $samplejs = fopen("script.js", "r") or die("Unable to open file!");
            $samplejscontent= fread($samplejs,filesize("script.js"));
            fclose($samplejs);

            if(isset($samplejscontent) && $samplejscontent!='') {
                

                try {
                    $dsn = "mysql:host=$host;dbname=$database";
                    $conn= new PDO($dsn, $username, $password);
                } catch(PDOException $e) {
                    echo $e->getMessage();
                    exit();
                }

                if(isset($_SESSION['logged_in']['widget_id']) && $_SESSION['logged_in']['widget_id']) {
                    $conn->prepare('SELECT path from properties WHERE id='. $_SESSION['logged_in']['widget_id']);
                    $stmt= $conn->execute();
                    $result= $stmt->fetch(PDO::FETCH_ASSOC);
                    $newjspath= $result['path'];
                }
                

                // save data to js file
                $inputValue = $fb . $logo . $name . $color . $message1 . $message2;
                $newjscontent = $inputValue . $samplejscontent;
                if(!isset($newjspath)) {
                    $widget_name = time();
                    $newjspath= 'widgets/newjs'. $t .'.js';
                }
                // $newjsurl = dirname("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]") . '/' . $newjspath;
                
                file_put_contents($newjspath, $newjscontent);
                // $http_response_header;
                if(1==1) {
                    $return['status']= true;
                    $return['path']= $newjspath;
                    return $return;
                } else {
                    $return['error']= '';
                    return $return;
                }
                
            } else {
                $return['error']= '';
                return $return;
            }
        }
    }


    // DB INFO
    $username= 'root';
    $password= '';
    $database= 'chatwidget';
    $host= 'localhost';

    $logo= $_POST['logo1']!=''?$_POST['logo1']:$_FILES['logo2'];
    $name= $_POST['name'];
    $color= $_POST['color'];
    $facebook_page= $_POST['facebook_page'];
    $message1= $_POST['message1'];
    $message2= $_POST['message2'];

    $widget= new widgetHelper($logo, $name, $color, $facebook_page, $message1, $message2);

    $widget_result= $widget->createJsFile();

    if($widget_result['status']==true) {
        if(isset($_SESSION['logged_in']['widget_id']) && $_SESSION['logged_in']['widget_id']) {
            try {
                $dsn = "mysql:host=$host;dbname=$database";
                $conn= new PDO($dsn, $username, $password);
            } catch(PDOException $e) {
                echo $e->getMessage();
                exit();
            }

            $path= $widget_result['path'];
            $abs_path= dirname("$_SERVER[REQUEST_URI]") . '/' . $path;;
            $url= 'http://'. $_SERVER[HTTP_HOST] . $abs_path;

            $conn->prepare('UPDATE properties SET path="'. $path .'" abs_path="'. $abs_path .'" url="'. $url .'" logo="'. $logo .'" name="'. $name .'" color="'. $color .'" facebook="'. $facebook .'" message1="'. $message1 .'" message2="'. $message2 .'" WHERE id='. $_SESSION['logged_in']['widget_id']);
            $conn->execute();
            if($conn->lastInsertId()) {
                //so something
            } else {
                //so something
            }
        } else {
            //do something
        }
    } else {
        echo $widget_result['error'];
        // do something
    }