<?php
session_start();

// LOG IN
if(isset($_POST['login_submit'])) {
    $inputusername= $_POST['username'];
    $inputpassword= $_POST['password'];

    // SERVER INFO
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "chatwidget";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = 'SELECT id, widgetId
                  FROM customers
                 WHERE username = "'.$inputusername.'"
                   AND password = "' . sha1($inputpassword). '"';
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        // use exec() because no results are returned
        // $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

    }
    catch(PDOException $e)
    {
        echo $sql . "<br>" . $e->getMessage();
        die;
    }


    if(isset($result) && $result!='') {
        setSessionLoggedIn($result['id']);
        $js_data= '';
        if(isset($result['widgetId']) && $result['widgetId']!=null) {
            $_SESSION['logged_in']['widgetId']= $result['widgetId'];
            // $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            // set the PDO error mode to exception
            // $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = 'SELECT logo, name, color, facebook, message1, message2
                    FROM properties
                    WHERE id = '.$result['widgetId'];
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            // use exec() because no results are returned
            // $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $properties = $stmt->fetch(PDO::FETCH_ASSOC);
            // print_r($properties);die;
            $js_data= '?logo='.$properties['logo'].'&name='.$properties['name'].'&color='. str_replace('#', '', $properties['color']) .'&facebookPage='.$properties['facebook'].'&message1='.$properties['message1'].'&message2='.$properties['message2'];
            // print_r($properties);die;
        }
        header('Location: test.php' . $js_data);
        // header("Location:0");
    } else {
        echo 'nhập sai cmnr';
    }
    
}

// REGISTER
if(isset($_POST['register_submit'])) {
    $inputusername= $_POST['username'];
    $inputpassword= $_POST['password'];
    $inputrepassword= $_POST['re-password'];
    if(1==1) {
        // do something
    }

}

function setSessionLoggedIn($userId) 
{
    session_unset();
    $_SESSION['logged_in']['status']= true;
    $_SESSION['logged_in']['userid']= $userId;
    // print_r($_SESSION);die;
}
