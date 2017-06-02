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
		<title>Интернет-магазин - Оформление заказа</title>
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
					<a href="contacts.php">Гостевая книга</a>
				</td>
			</tr>
<?php 
	echo '
			<tr>
				<td colspan="4">
					<p><b>Оформление заказа:</b></p>
					';
	for ($i=0; $i<$_SESSION['cartcounter']; $i++)
	{
		$sum=$sum+$_SESSION['price'.$i]*$_SESSION['quantity'.$i];
		echo '
		<b>', $_SESSION['item'.$i], ' - ', $_SESSION['quantity'.$i], ' шт. - ', $_SESSION['price'.$i]*$_SESSION['quantity'.$i], ' р.</b>
		<br>
		';
	}
	echo '
		<br>
		<b>Итого к оплате: ', $sum, ' р.</b>
					<form action="confirmordering.php">
						<p>Ф.И.О.:</p>
						<input type="text" size="30" name="fullname" required>
						<p>Тел. номер:</p>
						<input type="text" size="30" name="phonenumber" required>
						<p>E-mail:</p>
						<input type="text" size="30" name="email" required>
						<p>Адрес доставки (оставьте поле пустым, если желаете забрать товар самостоятельно):</p>
						<input type="text" size="70" name="address">
						<p>Желаемая дата доставки (самовывоза) товара:</p>
						<input type="text" size="20" name="date" required>
				</td>
			</tr>
			<tr>
				<td align="right" colspan="4">
					<br>
					<input type="submit" value="Подтвердить заказ">
					<br>
					<br>
					</form>
				</td>
			</tr>
			';
?>
		<table width="1308" align="center">
			<tr>
				<td colspan="4" ALIGN=CENTER>
					<font size="3">
					Сайт по продаже функционального питания © 2014-2017.
					<br>
					Не является публичной офертой
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
	echo 'Число посещений сайта: ', file_get_contents('counter.txt');
?>
					</font>
				</td>
			</tr>
		</table>
	</body>
</html>