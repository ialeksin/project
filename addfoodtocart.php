<?php 
	session_start();
	$productnames=file('1.productnames.txt', FILE_IGNORE_NEW_LINES);
	$productprices=file('1.productprices.txt', FILE_IGNORE_NEW_LINES);
	for ($i=0; $i<count($productnames); $i++)
	{
		$foodnumber=$_GET['food'.$i];
		if ($foodnumber!='')
		{
			$foodnumber=$i;
			break;
		}
	}
	$_SESSION['item'.$_SESSION['cartcounter']]=$productnames[$foodnumber];
	$_SESSION['price'.$_SESSION['cartcounter']]=$productprices[$foodnumber];
	$_SESSION['quantity'.$_SESSION['cartcounter']]=1;
	$_SESSION['cartcounter']++;
	echo '<script>location.href="', $_SERVER['HTTP_REFERER'], '"</script>';
?>