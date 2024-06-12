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
			echo "<a href='/reservas.php'>Salas cadastradas</a><br>";
			$rodar = true;
		}
	} catch (PDOException $e) {
		print "Error!: " . $e->getMessage() . "<br/>";
		die();
	}
	
	$nome = $_POST['nome'];
	$foto = $_POST['foto'];
	$local = $_POST['local'];
	$data = $_POST['data'];
	$inicio = $_POST['inicio'];
	$final = $_POST['final'];
	$responsavel = $_POST['responsavel'];
	$motivo = $_POST['motivo'];
	$geral = $_POST['geral'];
	$convidados = $_POST['convidados'];
	
	if (isset($_POST['nome'])){
		try {
			$db = new PDO("mysql:host=localhost;dbname=$dbdatabase", $dbuser, $dbpassword);
			foreach($db->query("INSERT INTO reservas (nome, foto, local, data, inicio, final, responsavel, motivo, geral, convidados) VALUES ('".$nome."', '".$foto."', '".$local."', '".$data."', '".$inicio."', '".$final."', '".$responsavel."', '".$motivo."', '".$geral."', '".$convidados."')") as $row) {
				
			}
		} catch (PDOException $e) {
			print "Error!: " . $e->getMessage() . "<br/>";
			die();
		}
	}
	
	if ($rodar == true){
		echo "<br>CADASTRO DE RESERVAS<hr>";
		echo '<form action="/cadastro.php" method="post">';
		echo '<label for="nome">Nome:</label><br>';
		echo '<input type="text" id="nome" name="nome" value=""><br>';
		echo '<label for="foto">Foto:</label><br>';
		echo '<input type="text" id="foto" name="foto" value=""><br>';
		echo '<label for="local">Local:</label><br>';
		echo '<input type="text" id="local" name="local" value=""><br>';
		echo '<label for="data">Data:</label><br>';
		echo '<input type="text" id="data" name="data" value=""><br>';
		echo '<label for="inicio">Hora inicio:</label><br>';
		echo '<input type="text" id="inicio" name="inicio" value=""><br>';
		echo '<label for="final">Hora final:</label><br>';
		echo '<input type="text" id="final" name="final" value=""><br>';
		echo '<label for="responsavel">Responsavel:</label><br>';
		echo '<input type="text" id="responsavel" name="responsavel" value=""><br>';
		echo '<label for="motivo">Motivo:</label><br>';
		echo '<textarea id="motivo" name="motivo" value=""></textarea><br>';
		echo '<label for="geral">Informações gerais:</label><br>';
		echo '<textarea id="geral" name="geral" value=""></textarea><br>';
		echo '<label for="convidados">Convidados:</label><br>';
		echo '<textarea id="convidados" name="convidados" value=""></textarea><br>';
		echo '<input type="submit" value="Cadastrar">';
		echo '</form>';
	} else {
		echo "Não logado";
	}
?>
	
</body>
</html>