<!DOCTYPE html>
<html>
    <head>
        <title>Form tạo widget</title>
        <meta charset="UTF-8">
    </head>
    <body>
        <?php 
            if(isset($_GET['error']) && $_GET['error']) {
                echo '<h1>FAILED: '.$_GET['error'].'</h1>';
            }
        ?>
        <h4>Đăng nhập</h4>
        <form action="login.php" method="post" >
            Tên đăng nhập: <input type="text" name="username" required/><br>
            Mật khẩu: <input type="password" name="password" required/><br>
            <input type="submit" name="login_submit" value="Đăng nhập" />
        </form>
        
        <h4>Đăng ký</h4>
        <form action="login.php" method="post" >
            Tên đăng nhập: <input type="text" name="username" required/><br>
            Mật khẩu: <input type="password" name="password" required/><br>
            Xác nhận mật khẩu: <input type="password" name="re-password" required/><br>
            <input type="submit" name="register_submit" value="Đăng ký" />
        </form>
        <?php echo isset($_GET['']) ? $_GET[''] : '';?>
        <h1>Tạo Widget</h1>
        <form action="createwidget.php" method="post" enctype="multipart/form-data">
            Logo: <br>
            &nbsp;&nbsp;Url: <input type="text" name="logo1" id="logo1" onchange="resetInput('logo2')" value="<?php echo (isset($_GET['logo'])&&substr($_GET['logo'], 0, 4)=='http') ? $_GET['logo'] : '';?>" /><br> 
            &nbsp;&nbsp;Tải lên: <input type="file" name="logo2" accept="image/*" id="logo2" onchange="resetInput('logo1')" value="<?php echo (isset($_GET['logo'])&&substr($_GET['logo'], 0, 4)!='http') ? $_GET['logo'] : '';?>" /><br>
            Tên: <input type="text" name="name" value="<?php echo isset($_GET['name']) ? $_GET['name'] : '';?>" /><br>
            Màu: <input type="color" name="color" value="<?php echo isset($_GET['color']) ? $_GET['color'] : '';?>"/><br>
            Trang Facebook: https://www.facebook.com/<input type="text" name="facebookPage" value="<?php echo isset($_GET['facebookPage']) ? $_GET['facebookPage'] : '';?>" /><br>
            Tin nhắn 1: <input type="text" name="message1" value="<?php echo isset($_GET['message1']) ? $_GET['message1'] : '';?>" /><br>
            Tin nhắn 2: <input type="text" name="message2" value="<?php echo isset($_GET['message2']) ? $_GET['message2'] : '';?>" /><br>
            <input type="submit" name="submit" />
        </form>

        <?php 
            if(isset($_GET['link']) && $_GET['link']) {
                echo '<br><br>CODE:<br><code>
                    &lt;script type="text/javascript"
                        src="'. $_GET['link'] .'"&gt;&lt;/script&gt;
                </code>
                <script type="text/javascript" src="'. $_GET['link'] .'"></script>';
            }
        ?>
    <script>
        function resetInput(elementId) 
        {
            document.getElementById(elementId).value= '';
        }
    </script>
    </body>
</html>