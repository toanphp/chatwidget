<?php
    
    class widgetHelper
    {
        private $post_logo='';
        public $post_name='';
        public $post_color='';
        public $post_facebook_page='';
        public $post_message1='';
        public $post_message2='';

        function __construct($logo, $name, $color, $facebook_page, $message1, $message2) 
        {
            $this->post_logo = $logo;
            $this->post_name = $name;
            $this->post_color = $color;
            $this->post_facebook_page = $facebook_page;
            $this->post_message1 = $message1;
            $this->post_message2 = $message2;
            session_start();
        }
        

        public function createJsFile() 
        {
            $return = ['status' => false, 'path' => '', 'error' => ''];

            if(isset($this->post_logo) && $this->post_logo!='' && $this->logoDataFunc($this->post_logo)!==false) $logo= 'var inputLogo = "' . $this->logoDataFunc($this->post_logo) . '";';
            if(isset($this->post_name) && $this->post_name!='') $name= 'var inputName = "' . $this->post_name . '";';
            if(isset($this->post_color) && $this->post_color!='') $color= 'var inputColor = "' . $this->post_color . '";';
            if(isset($this->post_facebook_page) && $this->post_facebook_page!='') $fb= 'var inputFb = "' . $this->post_facebook_page . '";';
            if(isset($this->post_message1) && $this->post_message1!='') $message1= 'var inputMessage1 = "' . $this->post_message1 . '";';
            if(isset($this->post_message2) && $this->post_message2!='') $message2= 'var inputMessage2 = "' . $this->post_message2 . '";';
            

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
                    $sth= $conn->prepare('SELECT path from properties WHERE id='. $_SESSION['logged_in']['widget_id']);
                    $stmt= $sth->execute();
                    $result= $stmt->fetch(PDO::FETCH_ASSOC);
                    $newjspath= $result['path'];
                }
                

                // save data to js file
                $inputValue = $fb . $logo . $name . $color . $message1 . $message2;
                $newjscontent = $inputValue . $samplejscontent;
                if(!isset($newjspath)) {
                    $widget_name = time();
                    $newjspath= 'widgets/newjs'. $widget_name .'.js';
                }
                // $newjsurl = dirname("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]") . '/' . $newjspath;
                
                if(file_put_contents($newjspath, $newjscontent)) {
                    $return['status']= true;
                    $return['path']= $newjspath;
                    return $return;
                } else {
                    $return['error']= 'Lỗi ghi file';
                    return $return;
                }
                
            } else {
                $return['error']= 'Không đọc đc file js mẫu';
                return $return;
            }
        }

        protected function logoDataFunc($logo_data) 
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

            } else {
                return false;
            }
        }


    }


    if(isset($_POST['submit'])) {
        // DB INFO
        $username= 'root';
        $password= '';
        $database= 'chatwidget';
        $host= 'localhost';

        $logo= $_POST['logo1']!=''?$_POST['logo1']:$_FILES['logo2'];
        $name= $_POST['name'];
        $color= $_POST['color'];
        $facebook_page= $_POST['facebookPage'];
        $message1= $_POST['message1'];
        $message2= $_POST['message2'];

        $widget= new widgetHelper($logo, $name, $color, $facebook_page, $message1, $message2);

        $widget_result= $widget->createJsFile();

        if($widget_result['status']==true) {
            try {
                $dsn = "mysql:host=$host;dbname=$database";
                $conn= new PDO($dsn, $username, $password);
            } catch(PDOException $e) {
                echo $e->getMessage();
                exit();
            }


            $path= $widget_result['path'];
            $abs_path= dirname("$_SERVER[REQUEST_URI]") . '/' . $path;;
            $url= 'http://'. $_SERVER['HTTP_HOST'] . $abs_path;

            if(isset($_SESSION['logged_in']['widget_id']) && $_SESSION['logged_in']['widget_id']) {
                // update vao bang 'properties'
                $sth= $conn->prepare('UPDATE properties SET path=":path" abs_path=":abs_path" url=":url" logo=":logo" name=":name" color=":color" facebook=":facebook" message1=":message1" message2=":message2" WHERE id=:id');
                $sth->bindValue(':path', $path);
                $sth->bindValue(':abs_path', $abs_path);
                $sth->bindValue(':url', $url);
                $sth->bindValue(':logo', $logo);
                $sth->bindValue(':name', $name);
                $sth->bindValue(':color', $color);
                $sth->bindValue(':facebook', $facebook_page);
                $sth->bindValue(':message1', $message1);
                $sth->bindValue(':message2', $message2);
                $sth->bindValue(':id', $_SESSION['logged_in']['widget_id']);
                $sth->execute();
                $affected_rows= $sth->rowCount();
                if($affected_rows==1) {
                    $color_string= str_replace('#', '', $color);
                    $return_data= "?logo=$logo&name=$name&color=$color_string&facebookPage=$facebook_page&message1=$message1&message2=$message2&link=$url";
                    header('Location: test.php'. $return_data);
                    // echo 'update thành công cho user'. $_SESSION['logged_in']['userid'];
                } else {
                    $error= 'update loi: '. $_SESSION['logged_in']['userid'];
                    file_put_contents('logs/errors.txt', date("Y/m/d h:i:s") .' '. $error ."\r\n", FILE_APPEND);
                    header('Location: test.php?error='. $error);
                }
            } else {
                // insert vao bang 'properties'
                $sth= $conn->prepare('INSERT INTO properties(path, abs_path, url, logo, name, color, facebook, message1, message2) VALUES(:path, :abs_path, :url, :logo, :name, :color, :facebook, :message1, :message2)');

                $sth->bindValue(':path', $path);
                $sth->bindValue(':abs_path', $abs_path);
                $sth->bindValue(':url', $url);
                $sth->bindValue(':logo', $logo);
                $sth->bindValue(':name', $name);
                $sth->bindValue(':color', $color);
                $sth->bindValue(':facebook', $facebook_page);
                $sth->bindValue(':message1', $message1);
                $sth->bindValue(':message2', $message2);
                $sth->execute();
                $lastInsertId= $conn->lastInsertId();

                if($lastInsertId!=0) {
                    // update bang 'customer'
                    $sth= $conn->prepare('UPDATE customers SET widgetId=:widgetId WHERE id=:id');
                    $sth->bindValue(':widgetId', $lastInsertId);
                    $sth->bindValue(':id', $_SESSION['logged_in']['userid']);
                    $sth->execute();
                    $affected_rows= $sth->rowCount();
                    if($affected_rows==1) {
                        $color_string= str_replace('#', '', $color);
                        $return_data= "?logo=$logo&name=$name&color=$color_string&facebookPage=$facebook_page&message1=$message1&message2=$message2&link=$url";
                        header('Location: test.php'. $return_data);
                        // echo 'update thanh cong widgetId cho user'. $_SESSION['logged_in']['userid'];
                    } else {
                        $error= 'update loi widgetId cho user'. $_SESSION['logged_in']['userid'];
                        file_put_contents('logs/errors.txt', date("Y/m/d h:i:s") .' '. $error ."\r\n", FILE_APPEND);
                        header('Location: test.php?error='. $error);
                    }

                } else {
                    $error= 'insert loi properties';
                    file_put_contents('logs/errors.txt', date("Y/m/d h:i:s") .' '. $error ."\r\n", FILE_APPEND);
                    header('Location: test.php?error='. $error);
                }
                
            }
        } else {
            $error= 'LỖI:'. $widget_result['error'];
            file_put_contents('logs/errors.txt', date("Y/m/d h:i:s") .' '. $error ."\r\n", FILE_APPEND);
            header('Location: test.php?error='. $error);
        }

    }

    // if(isset($_POST['submit'])) {
    //     if(isset($_POST['logo1']) && $_POST['logo1']!='') $logo= 'var inputLogo = "' . $_POST['logo1'] . '";';
    //     if(isset($_FILES['logo2']) && $_FILES['logo2']!='' && substr($_FILES['logo2']['type'], 0, 6)=='image/') {
    //         $imgbinary = fread(fopen($_FILES['logo2']['tmp_name'], "r"), $_FILES['logo2']['size']);
    //         $logo_base64= 'data:' . $_FILES['logo2']['type'] . ';base64,' . base64_encode($imgbinary);
    //         $logo= 'var inputLogo = "' . $logo_base64 . '";';
    //     }
    //     if(isset($_POST['name']) && $_POST['name']!='') $name= 'var inputName = "' . $_POST['name'] . '";';
    //     if(isset($_POST['color']) && $_POST['color']!='') $color= 'var inputColor = "' . $_POST['color'] . '";';
    //     if(isset($_POST['fb']) && $_POST['fb']!='') $fb= 'var inputFb = "' . $_POST['fb'] . '";';
    //     if(isset($_POST['message1']) && $_POST['message1']!='') $message1= 'var inputMessage1 = "' . $_POST['message1'] . '";';
    //     if(isset($_POST['message2']) && $_POST['message2']!='') $message2= 'var inputMessage2 = "' . $_POST['message2'] . '";';
        

    //     // DB INFO
    //     $username= 'root';
    //     $password= '';
    //     $database= 'chatwidget';
    //     $host= 'localhost';




    //     // read js file
    //     $samplejs = fopen("script.js", "r") or die("Unable to open file!");
    //     $samplejscontent= fread($samplejs,filesize("script.js"));
    //     fclose($samplejs);

    //     if(isset($samplejscontent) && $samplejscontent!='') {
    //         if(1==1) {
    //             $inputValue = $fb . $logo . $name . $color . $message1 . $message2;
    //             $newjscontent = $inputValue . $samplejscontent;
    //             $t = time();
    //             $newjspath= "widgets/newjs". $t .".js";
    //             $newjsurl = dirname("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]") . '/' . $newjspath;
    //             $newjs = fopen($newjspath, "w") or die("Unable to open file!");
    //             fwrite($newjs, $newjscontent);
    //             fclose($newjs);
    //             header('Location: test.php?link=' . $newjsurl);
    //         } else {
                

    //         }
            
    //     }        
    // }