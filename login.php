<?php 
	$login=$_POST['login'];
	$password=$_POST['password'];
	$logins=file('logins.txt', FILE_IGNORE_NEW_LINES);
	$passwords=file('passwords.txt', FILE_IGNORE_NEW_LINES);
	for ($i=0; $i<count($logins); $i++)
	{
		if ($login==$logins[$i] && $password==$passwords[$i])
		{
			session_start();
			$_SESSION['login']=$login;
			if ($login=='ilya.aleksin' && $password=='12345678')
			{
				$_SESSION['adminmode']='activated';
			}
			echo '<script>location.href="', $_SERVER['HTTP_REFERER'], '"</script>';
			exit;
		}
	}
	echo '<script>location.href="', $_SERVER['HTTP_REFERER'], '"</script>';
?>