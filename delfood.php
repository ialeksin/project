<?php 
	$productnames=file('1.productnames.txt', FILE_IGNORE_NEW_LINES);
	$productdescs=file('1.productdescs.txt', FILE_IGNORE_NEW_LINES);
	$productprices=file('1.productprices.txt', FILE_IGNORE_NEW_LINES);
	$productimgs=file('1.productimgs.txt', FILE_IGNORE_NEW_LINES);
	for ($i=0; $i<count($productnames); $i++)
	{
		$foodnumber=$_GET['food'.$i];
		if ($foodnumber!='')
		{
			$foodnumber=$i;
			break;
		}
	}
	file_put_contents('1.productnames.txt', '');
	file_put_contents('1.productdescs.txt', '');
	file_put_contents('1.productprices.txt', '');
	file_put_contents('1.productimgs.txt', '');
	for ($i=$foodnumber; $i<count($productnames); $i++)
	{
		$productnames[$i]=$productnames[$i+1];
		$productdescs[$i]=$productdescs[$i+1];
		$productprices[$i]=$productprices[$i+1];
		$productimgs[$i]=$productimgs[$i+1];
	}
	for ($i=0; $i<count($productnames)-1; $i++)
	{
		file_put_contents('1.productnames.txt', $productnames[$i]."\n", FILE_APPEND);
		file_put_contents('1.productdescs.txt', $productdescs[$i]."\n", FILE_APPEND);
		file_put_contents('1.productprices.txt', $productprices[$i]."\n", FILE_APPEND);
		file_put_contents('1.productimgs.txt', $productimgs[$i]."\n", FILE_APPEND);
	}
	echo '<script>location.href="index.php"</script>';
?>