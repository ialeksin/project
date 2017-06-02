<?php
	session_start();
	$productnames=file('2.productnames.txt', FILE_IGNORE_NEW_LINES);
	$productprices=file('2.productprices.txt', FILE_IGNORE_NEW_LINES);
	for ($i=0; $i<count($productnames); $i++)
	{
		$snacknumber=$_GET['snack'.$i];
		if ($snacknumber!='')
		{
			$snacknumber=$i;
			break;
		}
	}
	$_SESSION['item'.$_SESSION['cartcounter']]=$productnames[$snacknumber];
	$_SESSION['price'.$_SESSION['cartcounter']]=$productprices[$snacknumber];
	$_SESSION['quantity'.$_SESSION['cartcounter']]=1;
	$_SESSION['cartcounter']++;
	echo '<script>location.href="', $_SERVER['HTTP_REFERER'], '"</script>';
?>