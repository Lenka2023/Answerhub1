<?php if(isset($_POST['enter'])){
	session_start();
	$e_login=htmlspecialchars($_POST['e_login']);
	$e_password=md5($_POST['e_password']);
						
	
	if(!isset($_SESSION['text']))
{
$_SESSION['text'] = "";
}

	unset($_SESSION['reg_succes']);
	
	$mysqli=new mysqli ('localhost', 'Mysitefour', '00000', "mysite-local");
	$query="SELECT* FROM `users` WHERE `login` = '$e_login'";
	$result = mysqli_query($mysqli, $query);
	$flag = false;
	$user_data=mysqli_fetch_array($result);
	  
  if ($user_data[password] == $e_password) {
		header("Location:editor.php");
		exit;
		echo "<p><span style='color:red;'>Succes registration</span></p>";
											} 
  elseif ($user_data[password] == !$e_password) {
		echo "<p><span style='color:red;'>Incorrect password</span></p>";
												} 
											
													
	$mysqli->close();
							}
	<?php
    // включаем отображение всех ошибок, кроме E_NOTICE
    error_reporting(E_ALL & ~E_NOTICE);
    ini_set('display_errors', 1);
     
    // наш обработчик ошибок
    function myHandler($level, $message, $file, $line, $context) {
        // в зависимости от типа ошибки формируем заголовок сообщения
        switch ($level) {
            case E_WARNING:
                $type = 'Warning';
                break;
            case E_NOTICE:
                $type = 'Notice';
                break;
            default;
                // это не E_WARNING и не E_NOTICE
                // значит мы прекращаем обработку ошибки
                // далее обработка ложится на сам PHP
                return false;
        }
        // выводим текст ошибки
        echo "<h2>$type: $message</h2>";
        echo "<p><strong>File</strong>: $file:$line</p>";
        echo "<p><strong>Context</strong>: $". join(', $', array_keys($context))."</p>";
        // сообщаем, что мы обработали ошибку, и дальнейшая обработка не требуется
        return true;
    }
     
    // регистрируем наш обработчик, он будет срабатывать на для всех типов ошибок
    set_error_handler('myHandler', E_ALL);
	function shutdown() {
    $error = error_get_last();
    if (
        // если в коде была допущена ошибка
        is_array($error) &&
        // и это одна из фатальных ошибок
        in_array($error['type'], [E_ERROR, E_PARSE, E_CORE_ERROR, E_COMPILE_ERROR])
    ) {
        // очищаем буфер вывода (о нём мы ещё поговорим в последующих статьях)
        while (ob_get_level()) {
            ob_end_clean();
        }
        // выводим описание проблемы
        echo "Сервер находится на техническом обслуживании, зайдите позже";
    }
}
register_shutdown_function('shutdown');
	?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
	<link rel="stylesheet" href="css/style1.css"type="text/css"/>
    <title>Registration</title>											
		
	</head>
	<body>
	<table  width='100%;' cellpadding='0' cellspacing='0'>
			<tr>
				<td colspan='2'>
					<img src="img/logo.jpg" width='100%;' alt="Шапка сайта"/>
				</td>
				</tr>
				<tr>
					<td style= 'width:20%;' valign='top'>
					<td>
					<td style= 'width:80%;' >
						<div style = "text-align:center; ">
							<h1>Entering</h1>
							
							<form id="form1" action="" method="post">
								<div class="fieldmain">	
								<div class="mainfield">
									<div class="regfield">
										<label for="login">Login</label>
										<input type='text' name='e_login' id="login" placeholder="Login" required/>
									</div>
									<div class="regfield">
										<label for="password">Password</label>
										<input type='password' name='e_password' id="password" placeholder="Password" required/>
									</div>
									
									<div class="regfield">
										<input type='submit' name='enter' value='Log in'/><br><a href="register.php">Registration</a>
							
									</div>
								</div>
							</div>	
							</form>
						</div>
					</td>
				</tr>
				<tr>
				
				