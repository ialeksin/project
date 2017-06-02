<?php
	file_put_contents('orderslogins.txt', '');
	file_put_contents('ordersfullnames.txt', '');
	file_put_contents('ordersphonenumbers.txt', '');
	file_put_contents('ordersemails.txt', '');
	file_put_contents('ordersaddresses.txt', '');
	file_put_contents('ordersdates.txt', '');
	file_put_contents('ordersitems.txt', '');
	echo '<script>location.href="orders.php"</script>';
?>