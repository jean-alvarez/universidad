<?php session_start();
if (isset($_SESSION['usuario'])) {
	header('Location: login.php');
}
$errores = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$usuario = filter_var(strtolower($_POST['usuario']), FILTER_SANITIZE_STRING);
	$password = $_POST['password'];
	try {
		$conexion = new PDO('mysql:host=localhost;dbname= database_project', 'root', '');
	} catch (PDOException $e) {
		echo "Error:" . $e->getMessage();;
	}
	$statement = $conexion->prepare('
		SELECT * FROM usuarios WHERE usuario = :usuario AND password = :password'
	);
	$statement->execute(array(
		':usuario' => $usuario, 
		':password' => $password
	));
	$resultado = $statement->fetch();
	if ($resultado !== false) {
		$_SESSION['usuario'] = $usuario;
		header('Location: index.php');
	} else {
		$errores .= '<li>Datos Incorrectos</li>';
	}
}
require 'views/login.php';
?>