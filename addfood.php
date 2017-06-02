<?php
	$productname=$_POST['productname'];
	$productdesc=$_POST['productdesc'];
	$productdesc = str_replace("\n", '<br>', $productdesc);
	$productprice=(float)$_POST['productprice'];
	$productimg=$_FILES['productimg']['name'];
	copy($_FILES['productimg']['tmp_name'], 'images/'.$_FILES['productimg']['name']);
	file_put_contents('1.productnames.txt', $productname."\n", FILE_APPEND);
	file_put_contents('1.productdescs.txt', $productdesc."\n", FILE_APPEND);
	file_put_contents('1.productprices.txt', $productprice."\n", FILE_APPEND);
	file_put_contents('1.productimgs.txt', $productimg."\n", FILE_APPEND);
	echo '<script>location.href="index.php"</script>';
?>