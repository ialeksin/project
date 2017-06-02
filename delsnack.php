<?php 
	$productnames=file('2.productnames.txt', FILE_IGNORE_NEW_LINES);
	$productdescs=file('2.productdescs.txt', FILE_IGNORE_NEW_LINES);
	$productprices=file('2.productprices.txt', FILE_IGNORE_NEW_LINES);
	$productimgs=file('2.productimgs.txt', FILE_IGNORE_NEW_LINES);
	for ($i=0; $i<count($productnames); $i++)
	{
		$snacknumber=$_GET['snack'.$i];
		if ($snacknumber!='')
		{
			$snacknumber=$i;
			break;
		}
	}
	file_put_contents('2.productnames.txt', '');
	file_put_contents('2.productdescs.txt', '');
	file_put_contents('2.productprices.txt', '');
	file_put_contents('2.productimgs.txt', '');
	for ($i=$snacknumber; $i<count($productnames); $i++)
	{
		$productnames[$i]=$productnames[$i+1];
		$productdescs[$i]=$productdescs[$i+1];
		$productprices[$i]=$productprices[$i+1];
		$productimgs[$i]=$productimgs[$i+1];
	}
	for ($i=0; $i<count($productnames)-1; $i++)
	{
		file_put_contents('2.productnames.txt', $productnames[$i]."\n", FILE_APPEND);
		file_put_contents('2.productdescs.txt', $productdescs[$i]."\n", FILE_APPEND);
		file_put_contents('2.productprices.txt', $productprices[$i]."\n", FILE_APPEND);
		file_put_contents('2.productimgs.txt', $productimgs[$i]."\n", FILE_APPEND);
	}
	echo '<script>location.href="snack.php"</script>';
?>