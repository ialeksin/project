<?php 
	session_start();
	if (isset($_SESSION['cartcounter'])==false)
	{
		$_SESSION['cartcounter']=0;
	}
	if (isset($_COOKIE['visit'])==false)
	{
		$a=file_get_contents('counter.txt');
		$a++;
		file_put_contents('counter.txt', $a);
		setcookie('visit');
	}
?>
<html>
	<head>
		<meta charset="utf-8">
		<title>Интернет-магазин - функциональное питание</title>
		<style>
			a { 
			text-decoration: none;
			}
			table {
			border-collapse: collapse;
			border: 2px solid #FFDEAD;
			}
		</style>
		<link rel="stylesheet" href="style.css" type="text/css">
	</head>
	<body bgcolor="#FFDEAD">
<?php 
	if (isset($_SESSION['login']))
	{
	echo '
		<table width="100%">
			<tr valign="top">
				<td>
					<font size="2">
						Здравствуйте, ', $_SESSION['login'], '.
					</font>
					<form action=exit.php>
						<input type="submit" name="exit" value="Выйти">
					</form>
				</td>
				<td align="right">
				';
	if (isset($_SESSION['adminmode'])==false)
	{
	echo '
					<font size="2">
						<a href="cart.php">Корзина: ', $_SESSION['cartcounter'], '</a>
					</font>
					';
	}
	else
	{
	$orderscount=file('ordersitems.txt', FILE_IGNORE_NEW_LINES);
	echo '
					<font size="2">
						<a href="orders.php">Новые заказы: ', count($orderscount), '</a>
					</font>
					';
	}
	echo '
				</td>
			</tr>
		</table>
		';
	}
	else echo '
		<table width="100%">
			<tr>
				<td>
					<font size="2">
						<a href="registration.php">Регистрация</a>
					</font>
				</td>
				<td align="right">
					<font size="2">
						<a href="cart.php">Корзина: ', $_SESSION['cartcounter'], '</a>
					</font>
				</td>
			</tr>
			<tr>
				<td>
					<font size="2">
						<a href="#auth">Вход</a>
					</font>
				</td>
			</tr>
		</table>
		';
?>
		<table width="1308" align="center">
			<tr>
				<td colspan="4">
					<a href="index.php">
					<img src="images/top.jpg" alt="Функциональное питание" width="1308" height="370"> 
					</a>
				</td>
			</tr>
			<tr height="70">
				<td bgcolor="#FFF8DC" ALIGN=CENTER width = "327">
					<a href="index.php">Функциональное питание</a>
				</td>
				<td bgcolor="#FFF8DC" ALIGN=CENTER width = "327">
					<a href="snack.php">Фруктовый батончик</a>
				</td>
				<td bgcolor="#FFF8DC" ALIGN=CENTER width = "327">
					<a href="contacts.php">Контакты</a>
				</td>
				<td bgcolor="#FFF8DC" ALIGN=CENTER width = "327">
					<a href="feedback.php">Гостевая книга</a>
				</td>
			</tr>
			<tr>
			<td colspan="4" ALIGN=CENTER> 
				<font size="5" color="brown" face="Arial">Мы всегда рады видеть вас в нашем магазине! </font>
			</td>
		</tr>
<?php 
	$productnames=file('1.productnames.txt', FILE_IGNORE_NEW_LINES);
	$productdescs=file('1.productdescs.txt', FILE_IGNORE_NEW_LINES);
	$productimgs=file('1.productimgs.txt', FILE_IGNORE_NEW_LINES);
	$productprices=file('1.productprices.txt', FILE_IGNORE_NEW_LINES);
	for ($i=0; $i<count($productnames); $i++)
	{
	echo '
			<tr>
				<td colspan="4">
					<img src="images/', $productimgs[$i], '" align="left">
					<b>', $productnames[$i], '</b>
					<br>
					<br>
					', $productdescs[$i], '
					<br>
					<br>
					Цена: ', $productprices[$i], ' р.
				</td>
			</tr>
			';
	if (isset($_SESSION['login']) && isset($_SESSION['adminmode']))
	{
	echo '
			<tr>
				<td align="right" colspan="4">
					<br>
					<form action="delfood.php">
					<input type="submit" value="Удалить этот товар" name="food', $i, '">
					</form>
				</td>
			</tr>
			';
	}
	else
	{
	echo '
			<tr>
				<td align="center" colspan="4">
				<br>
					<form action="addfoodtocart.php">
					';
		for ($j=0; $j<$_SESSION['cartcounter']; $j++)
		{
			if ($_SESSION['item'.$j]==$productnames[$i])
			{
				echo '
				<input type="submit" value="Добавлено в корзину" name="food', $i, '" disabled>
				';
				$is_item_added[$i]=1;
			}
		}
		if ($is_item_added[$i]!=1)
		{
			echo '
			<input type="submit" value="Добавить в корзину" name="food', $i, '">
			';
		}
		echo '
					</form>
				</td>
			</tr>
			';
	}
} 
if (isset($_SESSION['login']) && isset($_SESSION['adminmode']))
{
	echo '
			<tr>
				<td colspan="4">
					<form method="post" enctype="multipart/form-data" action=addfood.php>
						<p>Добавить товар:</p>
						<p>Название:<br>
						<input type="text" size="40" name="productname" required></p>
						<p>Описание:<br>
						<textarea rows="15" cols="110" name="productdesc" required></textarea></p>
						<p>Цена:<br>
						<input type="text" name="productprice" required></p>
						<p>Картинка (рекоменд. ширина - 380 пикс.):<br>
						<input type="file" name="productimg" required></p>
						<input type="submit">
					</form>
				</td>
			</tr>
			';
}
?>
		</table>
		<table width="1308" align="center">
			<tr>
				<td colspan="4">
					<p ALIGN=CENTER>
<?php
	$f_contents = file("banner.txt");  
	$banner = $f_contents[array_rand($f_contents)];  
	echo $banner;
?>
					</p>
				</td>
			</tr>
			<tr>
				<td colspan="4" ALIGN=CENTER>
					<font size="3">
						Сайт по продаже функционального питания © 2014-2017.
						<br>
						Не является публичной офертой
						<br>
						<a href="doc.php">Документы потребителю</a>
						<br>
						<br>
<?php 
	if (isset($_SESSION['login'])==false)
	{
	echo '
		<a name="auth">Вход:</a>
		<form method="post" action=login.php>
			Логин:
			<input type="text" name="login" required>
			Пароль:
			<input type="password" name="password" required>
			<input type="submit" value="Войти">
		</form>
		';
}
	echo 'Число уникальных посещений сайта: ', file_get_contents('counter.txt');
?>
					</font>
				</td>
			</tr>
		</table>
	</body>
</html>