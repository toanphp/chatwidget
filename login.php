<?php
if(isset($_POST['login_submit'])) {
    $inputusername= $_POST['username'];
    $inputpassword= $_POST['password'];

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
    }

    $conn = null;
    if(isset($result) && $result!='') {
        $_SESSION['userid'] = $result['id'];
        $js_data= '';
        if(isset($result['widgetId']) && $result['widgetId']!=null) {
            $_SESSION['hasWidget']= true;
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = 'SELECT logo, name, color, facebook, message1, message2
                    FROM properties
                    WHERE id = "'.$result['widgetId'].'"';
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            // use exec() because no results are returned
            // $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $properties = $stmt->fetch(PDO::FETCH_ASSOC);
            $js_data= '?logo='.$properties['logo'].'&name='.$properties['name'].'&color='.$properties['color'].'&fb='.$properties['facebook'].'&message1='.$properties['message1'].'&message2='.$properties['message2'];
            // print_r($properties);die;
        }
        header('Location: test.php' . $js_data);
        // print_r($result['id']);
        // header("Location:0");
    } else {
        echo 'nhập sai cmnr';
    }
    
}

if(isset($_POST['register_submit'])) {
    
}
