<?php
	session_start();
	for ($i=0; $i<$_SESSION['cartcounter']; $i++)
	{
		if ($_GET['changequantity'.$i]=='-' && $_SESSION['quantity'.$i]>1)
		{
			$_SESSION['quantity'.$i]--;
			break;
		}
		if ($_GET['changequantity'.$i]=='+')
		{
			$_SESSION['quantity'.$i]++;
			break;
		}
	}
	echo '<script>location.href="', $_SERVER['HTTP_REFERER'], '"</script>';
?>
