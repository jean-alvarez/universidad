<?php
// Verifica la existencia del parámetro id antes de seguir procesando
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    // Incluye (include) config.php
    require_once "conexion.php";
    
    // Prepara la declaración de selección de la tabla
    $sql = "SELECT * FROM users WHERE id = ?";
    
    if($stmt = mysqli_prepare($link, $sql)){
        // Vincula las variables a la declaración preparada como parámetros
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        // Setea los parámetros
        $param_id = trim($_GET["id"]);
        
        // Intentar ejecutar la declaración preparada
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
    
            if(mysqli_num_rows($result) == 1){
                /* Obtiene la fila de resultados como una matriz asociativa. 
                Como el conjunto de resultados contiene solo una fila, no es 
                necesario usar un ciclo while */
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                
                // Recupera el valor del campo individual
                $fecha_creacion = $row["created_at"];
            } else{
                /* La URL no contiene un parámetro de identificación válido. 
                Redireccionar a la página de error */
                header("location: error.php");
                exit();
            }
            
        } else{
            echo "Algo salió mal. Por favor, inténtelo de nuevo más tarde.";
        }
    }
     
    // Cierra declaración
    mysqli_stmt_close($stmt);
    
    // Cierra conexión
    mysqli_close($link);
} else{
    // La URL no contiene el parámetro id. Redireccionar a la página de error
    header("location: error.php");
    exit();
}
?>




<?php

session_start();
 

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>


<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="index.php">Inicio</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="mis_recetas.php">Mis recetas</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="crear_receta.php">Crear receta</a>
      </li>
        <li class="nav-item active">
        <a class="nav-link" href="homeuser.php">Mi cuenta <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="cerrar_sesion.php">Cerrar sesion</a>
      </li>
    </ul>
  </div>
</nav>
<div class="page-header">
  <center><h1>Tu cuenta</h1></center>
  <center><small>Aqui podras configurar y ver tu cuenta</small></center>
</div>
<br>
<center>
<div class="card" style="width: 18rem;">
  <img id="imagen" class="card-img-top" src="img/sin_foto.jpg" alt="Card image cap">
  <script>
  var cargarFoto = function(event) {
    var reader = new FileReader();
    reader.onload = function(){
      var output = document.getElementById('imagen');
      output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
  };
</script>

  <div class="card-body">
    <h5 class="card-title">Usuario</h5>
    <form>
  <div class="form-group">
    <input onchange="cargarFoto(event)" type="file" class="form-control-file" id="exampleFormControlFile1" >
  </div>
</form>
  </div>
  <ul class="list-group list-group-flush">
    <li class="list-group-item">Nombre de usuario: <h3><?php echo htmlspecialchars($_SESSION["username"]); ?> </h3> </li>
    <li class="list-group-item">Fecha de creacion:<?php echo $fecha_creacion; ?></li>
  </ul>
<br>
<button type="button" class="btn btn-primary">Cambiar mis datos</button>
<br>
</center>
</div>



<br>
        <br>
            <footer>
                <center>
                    <img alt="" src="img/logoFooter.png">
                        <p>
                            Desarrollado por @jean_alvarez y @bryan_saavedra :)
                        </p>
                    </img>
                </center>
            </footer>
        </br>
    </br>
</br>

</body>
</html>