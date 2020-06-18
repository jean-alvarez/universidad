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
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html style="background: rgb(238,174,202);
background: radial-gradient(circle, rgba(238,174,202,1) 0%, rgba(148,187,233,1) 100%);">

    <head>
        <title>Recetas</title>
        <link href="https://fonts.googleapis.com/css?family=Anton|Cairo|Exo+2|Martel|Righteous|Teko&display=swap" rel="stylesheet"> 
        <link href="https://fonts.googleapis.com/css?family=Cairo|Martel|Righteous|Teko&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Martel|Righteous|Signika|Teko&display=swap" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet" type="text/css"/>
        <meta charset="UTF-8">
        <link href="css/all.css" rel="stylesheet" type="text/css"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>

    <body>
        <header id="menu">
            <center>
                <h1 id="titulo">Bienvenido al recetario <?php echo htmlspecialchars($_SESSION["username"]); ?></h1>
                <em>Tu repositorio ideal</em>
            </center>
        </header>
            
        <hr>
        <nav>
            
            <ul>
                <li> <a href="index.php">Inicio</a></li>
                <li> <a href="#Inicio">Recetas</a>
                    <ul>
                    <li><a href="vegetarianos.php">Veganas</a></li>  
                    <li><a href="#Inicio">Ensaladas</a></li>
                    <li><a href="almuerzo.php">Almuerzos</a></li>  
                    <li><a href="#Inicio">Desayunos</a></li>  
                    <li><a href="#Inicio">Cenas</a></li>   
                </ul>
                </li>
                <li> <a href="index.php">Top recetas</a></li>
                <li> <a href="mis_recetas.php">Mis recetas</a></li>
                <li> <a href="cerrar_sesion.php">Cerrar sesion</a></li>
            </ul>    
        </nav>
        <hr>
        <div class="slider">
            <ul>
                <li><center><img src="img/empanda.png.jpg" alt=""/></center></li>
                <li><center><img src="img/bbq.png" alt=""/></center></li>
                <li><center><img src="img/paella_1.png" alt=""/></center></li>
                <li><center><img src="img/camaron.png" alt=""/></center></li>
            </ul>
        </div>
        <aside>
            
            <img src="img/aside.png" alt=""/>
        </aside>
        
        <div id="static">
            <p id="titulo1"><strong><u>Preguntas frecuentes</u></strong></p>
            <ol id="olindex">
                <li type="disc"><p>¿Porque decidimos crear esta página?</p></li>
                <p id="parrafoindex">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur convallis pretium nibh. Praesent convallis efficitur metus, eget tincidunt orci luctus sed. Nullam erat felis, volutpat nec tincidunt sit amet, vulputate ut magna. Integer vehicula, ipsum nec fermentum scelerisque, ante tellus ullamcorper ex, ut consectetur diam urna id felis. Aenean et placerat nisi.
                    Vestibulum suscipit augue leo, ac consequat lectus scelerisque non. Proin velit mauris, eleifend non quam vitae</p>
                <li type="disc"><p>¿Como puedo subir mi propia receta?</p></li>
                <p id="parrafoindex">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur convallis pretium nibh. Praesent convallis efficitur metus, eget tincidunt orci luctus sed. Nullam erat felis, volutpat nec tincidunt sit amet, vulputate ut magna. Integer vehicula, ipsum nec fermentum scelerisque, ante tellus ullamcorper ex, ut consectetur diam urna id felis. Aenean et placerat nisi.
                    Vestibulum suscipit augue leo, ac consequat lectus scelerisque non. Proin velit mauris, eleifend non quam vitae</p>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
            </ol>
        </div>
        <footer>
             <center><strong>&COPY;Bryan Saavedra - Jean Alvarez</strong></center>
        </footer>
    
</body>
 
</html>