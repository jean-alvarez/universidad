<?php
// Include (incluir) archivo config.php
require_once "conexion.php";
 
// Define las variables y las inicia con valores vacíos
$nombre = "";
$descripcion = "";
$categoria = "";
$nombre_err = "";
$descrip_err = "";
$categoria_err = "";


// Procesa los datos del formulario cuando se envía
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Valida nombre
    $input_nombre = trim($_POST["nombre"]);
    if(empty($input_nombre)){
        $nombre_err = "Ingrese un nombre";
    } elseif(!filter_var($input_nombre, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $nombre_err = "Ingrese un nombre válido";
    } else{
        $nombre = $input_nombre;
    }
    
    
    
    // Valida descripcion
    $input_descripcion = trim($_POST["descripcion"]);
    if(empty($input_descripcion)){
        $descrip_err = "Ingrese una descripcion";     
    } else{
        $descripcion = $input_descripcion;
    }
    
     // Valida categoria
    $input_categoria = trim($_POST["categoria"]);
    if(empty($input_categoria)){
        $categoria_err = "Ingrese una categoria";     
    } else{
        $categoria = $input_categoria;
    }
    
    // Revisa errores en las entradas para ingresar a la base de datos
    if(empty($nombre_err) && empty($descrip_err) && empty($categoria_err)){
        $sql = "INSERT INTO recetas (nombre, descripcion, categoria, imagen) VALUES (?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "sss", $param_nombre, $param_descripcion, $param_categoria, $imagen);
            
            $param_nombre = $nombre;
            $param_descripcion = $descripcion;
            $param_categoria = $categoria;
            
            if(mysqli_stmt_execute($stmt)){
                header("location: mis_recetas.php");
                exit();
            } else{
                echo "Algo salió mal. Por favor, inténtelo de nuevo";
            }
        }
         
        mysqli_stmt_close($stmt);
    }
    
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

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
      <li class="nav-item active">
        <a class="nav-link" href="crear_receta.php">Crear receta <span class="sr-only">(current)</span></a>
      </li>
        <li class="nav-item">
        <a class="nav-link" href="homeuser.php">Mi cuenta</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="cerrar_sesion.php">Cerrar sesion</a>
      </li>
      </li>
    </ul>
  </div>
</nav>
<br>
<br>

<div class="page-header">
  <center><h1>Crear tu receta</h1></center>
  <center><small>Aqui podras crear tus recetas</small></center>
  <br>
</div>


  <center><div class="container">
  <div class="row">
  <div class="col-sm-6">
    <div class="card">
      <div class="card-body">
        
        <form enctype="multipart/form-data" method="post">
          <center>
  <div class="form-group <?php echo (!empty($nombre_err)) ? 'has-error' : ''; ?>">
    <label for="exampleFormControlInput1">Nombre de la receta</label>
    <input name="nombre" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Ingresa un nombre">
  </div>
  <div class="form-group <?php echo (!empty($categoria_err)) ? 'has-error' : ''; ?>">
    <label for="exampleFormControlInput1">Categoria</label>
    <input name="categoria" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Ingresa una categoria">
  </div>
  <div class="form-group <?php echo (!empty($descrip_err)) ? 'has-error' : ''; ?>">
    <label for="exampleFormControlTextarea1">Descripcion</label>
    <textarea name="descripcion" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
    <br>
    
  </div>
	
	
    <div class="custom-file">
  <input name="imagen"  type="file" onchange="cargarFoto(event)" class="custom-file-input" id="imagen">
  <label class="custom-file-label" for="customFile">Sube una imagen</label>
  </div>

<br>
<br>
  <div class="card" style="width: 18rem;">
  <img id="imagen" src="img/add_imagen.png" class="card-img-top" alt="...">
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
    <h5 class="card-title">Nombre: <?php $nombre ?> </h5>
    <input class="form-control" value="<?php $nombre?>" type="text" readonly>
    <input class="form-control" value="<?php $descripcion?>" type="text" readonly>
    <input class="form-control" value="<?php $categoria?>" type="text" readonly>
  </div>
</div>

<br>
<br>
<br>
 <input type="submit" class="btn btn-success" value="Agregar">
 <button type="button" class="btn btn-primary">Cancelar</button>
</form>
</center>
      </div>
    </div>
  </div>
</div>


</div>
</center>




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