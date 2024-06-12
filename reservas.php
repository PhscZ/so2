<?php
	session_start();
?>
<html>
<body>
<?php
	$login = "";
	$password = "";
	$login = $_SESSION['login'];
	$password = $_SESSION['password'];
	
	$dbuser = "user";
	$dbpassword = "password";
	$dbdatabase = "db";
	
	$rodar = false;
	try {
		$db = new PDO("mysql:host=localhost;dbname=$dbdatabase", $dbuser, $dbpassword);
		foreach($db->query("SELECT login, senha FROM usuarios WHERE login='".$login."' AND senha='".$password."'") as $row) {
			echo "Logado como " . $row['login']."<br>";
			echo "<a href='/cadastro.php'>Cadastrar salas</a><br>";
			$rodar = true;
		}
	} catch (PDOException $e) {
		print "Error!: " . $e->getMessage() . "<br/>";
		die();
	}
	
	if ($rodar == true){
		echo "<br>RESERVAS<hr>";
		try {
			$db = new PDO("mysql:host=localhost;dbname=$dbdatabase", $dbuser, $dbpassword);
			foreach($db->query("SELECT * FROM reservas") as $row) {
				echo "SALA ".$row['id'].": ".$row['nome']."<br>";
				echo "<img src='".$row['foto']."' width='500' height='250'>"."<br>";
				echo "LOCAL: ".$row['local']."<br>";
				echo "DATA/HORA: ".$row['data']."   ".$row['inicio']." - ".$row['final']."<br>";
				echo "RESPONSAVEL: ".$row['responsavel']."<br>";
				echo "MOTIVO: ".$row['motivo']."<br>";
				echo "OBSERVAÇÃO GERAL: ".$row['geral']."<br>";
				echo "CONVIDADOS: ".$row['convidados']."<br>";
				echo "<hr>";
			}
		} catch (PDOException $e) {
			print "Error!: " . $e->getMessage() . "<br/>";
			die();
		}
	} else {
		echo "Não logado";
	}
?>
	
</body>
</html>

