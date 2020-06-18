<?php
// Include config file
require_once "conexion.php";
 
// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Por favor ingrese un usuario.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "Este usuario ya fue tomado.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Al parecer algo salió mal.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Por favor ingresa una contraseña.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "La contraseña al menos debe tener 6 caracteres.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Confirma tu contraseña.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "No coincide la contraseña.";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        $sql = "UPDATE users SET username=?, password=? WHERE id=?";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
            
            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: login.php");
            } else{
                echo "Algo salió mal, por favor inténtalo de nuevo.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
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
        <a class="nav-link" href="index.php">Inicio </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="mis_recetas.php">Mis recetas</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="crear_receta.php">Crear receta</a>
      </li>
        <li class="nav-item active">
        <a class="nav-link" href="homeuser.php">Mi cuenta</a>
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
  <img class="card-img-top" src="img/sin_foto.jpg" alt="Card image cap">
  <div class="card-body">
    <form>
</form>
  </div>

<br>
</center>
</div>
<center>
<div class="card" style="width: 18rem;">
  <div class="card-body">
    <h5 class="card-title">Cambio de datos</h5>
    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>">
  <div class="form-group <?php echo (!empty($nombre_err)) ? 'has-error' : ''; ?>">
    <label>Nuevo nombre de usuario</label>
    <input type="text" name="username" class="form-control">
  </div>
  <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
    <label for="exampleInputPassword1">Nueva Contraseña</label>
    <input type="password" class="form-control" id="exampleInputPassword1" name="password">
  </div>
  <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
    <label for="exampleInputPassword1">Confirma Contraseña</label>
    <input type="password" class="form-control" id="exampleInputPassword1" name="confirm_password">
  </div>
  </div>
  <button type="button" class="btn btn-success">Confirmar cambios</button>
  <br>
  <br>
  <button type="submit" class="btn btn-primary">Cancelar</button>
</form>
  </div>
  </center>

</div>
</center>
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