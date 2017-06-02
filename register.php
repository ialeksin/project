<?php 
	session_start();
	$login=$_POST['login'];
	$email=$_POST['email'];
	$password1=$_POST['password1'];
	$password2=$_POST['password2'];
	$logins=file('logins.txt', FILE_IGNORE_NEW_LINES);
	if (strlen($login)<6)
	{
		$_SESSION['login_too_short']=true;
		echo '<script>location.href="registration.php"</script>';
		exit;
	}
	for ($i=0; $i<count($logins); $i++)
	{
		if ($login==$logins[$i])
		{
			$_SESSION['login_already_exist']=true;
			echo '<script>location.href="registration.php"</script>';
			exit;
		}
	}
	if ($password1!=$password2)
	{
		$_SESSION['passwords_not_the_same']=true;
		echo '<script>location.href="registration.php"</script>';
		exit;
	}
	if (strlen($password1)<8)
	{
		$_SESSION['password_too_short']=true;
		echo '<script>location.href="registration.php"</script>';
		exit;
	}
	file_put_contents('logins.txt', $login."\n", FILE_APPEND);
	file_put_contents('emails.txt', $email."\n", FILE_APPEND);
	file_put_contents('passwords.txt', $password1."\n", FILE_APPEND);
	$_SESSION['login']=$login;
	echo '<script>location.href="index.php"</script>';
?>