<?php 
	session_start();
	for ($i=0; $i<$_SESSION['cartcounter']; $i++)
	{
		$itemnumber=$_GET['item'.$i];
		if ($itemnumber!='')
		{
			$itemnumber=$i;
			break;
		}
	}
	for ($i=$itemnumber; $i<$_SESSION['cartcounter']; $i++)
	{
		$next=$i+1;
		$_SESSION['item'.$i]=$_SESSION['item'.$next];
		$_SESSION['price'.$i]=$_SESSION['price'.$next];
		$_SESSION['quantity'.$i]=$_SESSION['quantity'.$next];
	}
	$_SESSION['cartcounter']--;
	echo '<script>location.href="', $_SERVER['HTTP_REFERER'], '"</script>';
?>
