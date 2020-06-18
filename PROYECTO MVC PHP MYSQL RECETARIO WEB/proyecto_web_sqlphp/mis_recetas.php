<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
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
<link href="css/estilos.css" rel="stylesheet" type="text/css"></link>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
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
      <li class="nav-item active">
        <a class="nav-link" href="mis_recetas.php">Mis recetas <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="crear_receta.php">Crear receta</a>
      </li>
      
        <li class="nav-item">
        <a class="nav-link" href="homeuser.php">Mi cuenta</a>
         <li class="nav-item">
        <a class="nav-link" href="cerrar_sesion.php">Cerrar sesion</a>
      </li>
      </li>
    </ul>
  </div>
</nav>



<div class="page-header">
  <center><h1>Bienvenido <?php echo htmlspecialchars($_SESSION["username"]); ?>  </h1></center>
  <center><small>Aqui encontraras tus recetas</small></center>
</div>
<p class="font-weight-bold">Tabla de mis recetas: </p>

<?php
                    // Incluir (include) archivo config.php
                    require_once "conexion.php";
                    // Initialize the session

                    
                    // Ejecutando la conexión a la BD
                    $sql = "SELECT * FROM recetas";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>#</th>";
                                        echo "<th>Nombre</th>";
                                        echo "<th>Descripcion</th>";
                                        echo "<th>Categoria</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                   echo "<tr>";
                                        echo "<td>" . $row['id'] . "</td>";
                                        echo "<td>" . $row['nombre'] . "</td>";
                                        echo "<td>" . $row['descripcion'] . "</td>";
                                        echo "<td>" . $row['categoria'] . "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            mysqli_free_result($result);
                        } else{
                            echo "<p class='lead'><em>No existen registros.</em></p>";
                        }
                    } else{
                        echo "ERROR: No se puede ejecutar la conexión $sql. " . mysqli_error($link);
                    }
 
                    // Cerrar conexión
                    mysqli_close($link);
                    ?>





<div class="card-deck">
  <div class="card">
    <img class="card-img-top" src="img/comida.png" alt="Card image cap">
    <div class="card-body">
      <h5 class="card-title"></h5>
      <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content.</p>
      <center> 
      </center>
    </div>
  </div>
  <div class="card">
    <img class="card-img-top" src="img/comida.png" alt="Card image cap">
    <div class="card-body">
      <h5 class="card-title">Card title</h5>
      <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
      <center> 
      </center>
    </div>
  </div>
  <div class="card">
    <img class="card-img-top" src="img/comida.png" alt="Card image cap">
    <div class="card-body">
      <h5 class="card-title">Card title</h5>
      <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. </p>
      <center> 
      </center>
    </div>
  </div>
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