<h3><?php if($text){echo $text;}?></h3>
<br>
<form method="post">
	<input type="text" name="name" placeholder="Введите имя" required>
	<input type="password" name="password" placeholder="Введите пароль" required>
	<input type="submit" name="button" value="Войти">
</form>