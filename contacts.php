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
		<title>Интернет-магазин - Контакты</title>
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
					<a href="feedback.php">Гостевая книга</a>
				</td>
			</tr>
			<tr>
				<td colspan="4" ALIGN=CENTER>
					<p><img src="images/contacts.jpg" height="250"width = "800"></p>
					<font size="5">
						<i>	
							<P> Контакты </P>
							<br>
							Адрес офиса: 630005, г. Новосибирск, ул. Крылова 36, офис 141
							<br>
							<br>
							Как нас найти:
							<br>
							<p><iframe src="Frame.html" width="900" height="500"></iframe></p>
						</i>
					</font>
					</br>
				</td>
			</tr>
		</table>
		<table width="1302" align="center">
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
			Имя:
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