<?php
    $host = '192.168.1.10';
    $user = 'DevUser2';
    $pass = 'BV!A2k1$e61ms#yeQpE4j';
    $dbname = 'DevPortalCop';
    $port = 3306;

    try{
	$con = mysqli_connect($host, $user, $pass, $dbname);
        $conn = new PDO("mysql:host=$host;dbname=". $dbname, $user, $pass);


    }   catch(PDOException $err){
            echo "Erro: ConexÃ£o com banco de dados nÃ£o foi realizada com sucesso. Erro gerado". $err->getMessage();
}
?>
	<!-- Início da sessão e confirmação de que o usuário está logado -->
	<?php
		session_start();
		$email = $_SESSION['email'];
		if (!isset($_SESSION['email']) || !isset($_SESSION['senha'])) {
			header("Location: ./login_admin.html");
			exit;
		}
	?>