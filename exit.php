<?php 
	session_start();
	unset($_SESSION['adminmode']);
	unset($_SESSION['login']);
	echo '<script>location.href="', $_SERVER['HTTP_REFERER'], '"</script>';
?>
