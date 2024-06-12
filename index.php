<?php
	session_start();
?>
<html>
<head>
	<link rel="stylesheet" href="index.css">
	<title>Login</title>
</head>
<body>
	<form action="/index.php" method="post">
		<label for="login">Login:</label><br>
		<input type="text" id="login" name="login" value=""><br>
		<label for="senha">Senha:</label><br>
		<input type="password" id="senha" name="senha" value=""><br>
		<input type="submit" value="Enviar">
	</form>
	<br>
<?php
	$login = "";
	$password = "";
	
	if (isset($_POST['login']) && isset($_POST['senha'])) {
		$_SESSION['login'] = $_POST['login'];
		$_SESSION['password'] = $_POST['senha'];
	}
	$login = $_SESSION['login'];
	$password = $_SESSION['password'];
	
	$dbuser = "user";
	$dbpassword = "password";
	$dbdatabase = "db";
	
	try {
		$db = new PDO("mysql:host=localhost;dbname=$dbdatabase", $dbuser, $dbpassword);
		foreach($db->query("SELECT login, senha FROM usuarios WHERE login='".$login."' AND senha='".$password."'") as $row) {
			echo "Logado como " . $row['login']."<br>";
			echo "<a href='/reservas.php'>Ir para a tela de reservas</a><br>";
		}
	} catch (PDOException $e) {
		print "Error!: " . $e->getMessage() . "<br/>";
		die();
	}
?>
</body>
</html>