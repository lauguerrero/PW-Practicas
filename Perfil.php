<?php
    session_start();
    $logged_user = $_SESSION['id'];

    $servername = "db4free.net";
    $username = "adminpw";
    $password = "adminPW123";
    $dbname = "thereuseshop";

    // Crea la conexión
    $conn = mysqli_connect($servername, $username, $password);
    $bd = mysqli_select_db($conn, "thereuseshop");
    if(!$bd){
        echo 'No se conecto a la base de datos' . mysqli_error();
    }

?>

<!DOCTYPE HTML>
<html>
<head>
    <meta charset="UTF-8">
    <title>Perfil</title>
    <link rel="stylesheet" type="text/css" href="Perfil.css"> 
</head>
<body>

<?php
    include("header.php");
    
    $sql = "SELECT * FROM Usuario WHERE Id_Usuario = '$logged_user'";
    $sentencia = mysqli_query($conn, $sql);
    if(!$sentencia){
        echo 'Hay un error en la sentencia SQL: ' . mysqli_error($conn);
    }
    else{
        while($usuario = mysqli_fetch_array($sentencia)){
            echo"<h2>Bienvenido a tu perfil ".$usuario['Nombre']."</h2>";
            echo "<h3>Tu informacion</h3>";
            echo "<br>";
            echo"<form action=Perfil.php method=post>";
                echo"<div class = info>";
                    echo "Username: " .$usuario['username'];
                    echo "<br>";
                    echo "Nombre: " .$usuario['Nombre']. " " .$usuario['Apellidos'];
                    echo "<br>";
                    echo "Telefono: " .$usuario['Telefono'];
                    echo "<br>";
                    echo "Correo: " .$usuario['email'];
                    echo "<br>";
                echo"</div>";
                echo "<div class=pass>";
                    echo "Cambiar contrasena:";
                    echo "<br>";
                    echo "<label for=pwd>Contrasena actual</label>";
                    echo "<input type=password name=pwd size=8 maxlength=20>";
                    echo "<br>";
                    echo "<label for=contra>Nueva contrasena</label>";
                    echo "<input type=password name=contra size=8 maxlength=20>";
                    echo "<br>";
                    echo "<input type=submit value=Cambiar>";
                echo "</div>";
            echo "</form>";
        }
    
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $pwd = md5(mysqli_real_escape_string($conn, $_POST['pwd']));
            $contra = md5(mysqli_real_escape_string($conn, $_POST['contra']));
            $consulta = mysqli_query($conn, "SELECT * FROM Usuario WHERE Id_Usuario = '$logged_user' AND contrasena = '$pwd'");
            if(mysqli_num_rows($consulta) === 1){   //usuario y contrasena validados
                $consulta = mysqli_query($conn,"UPDATE Usuario SET contrasena = '$contra' WHERE Id_Usuario = '$logged_user'");
                if(!$consulta){
                    echo 'Hay un error en la sentencia SQL: ' . mysqli_error($conn);
                }
                else{
                    echo 'La contrasena se ha cambiado exitosamente.';
                }
            }
            else{
                echo 'La contrasena actual no es correcta.';
            }
        }
    }

    echo "<br>";
    echo "<h3>Tus articulos publicados</h3>";
    echo "<div class=table-container> ";
            echo"<table class=anuncios>";
                #Obtenemos la información de los artículos que ha publicado el usuario
                $consulta_articulos = mysqli_query($conn, "SELECT * FROM Articulo WHERE id_Usuario = $logged_user") or die ("Fallo en la consulta de Articulos");
                
                $nfilas = mysqli_num_rows($consulta_articulos);
                for($i=0; $i<$nfilas; $i++){
                    $fila = mysqli_fetch_array($consulta_articulos);

                    #Hacemos que se hagan 4 columnas
                    if($i%4 == 0){
                        echo '</tr><tr>';
                    }

                    #Introducimos la imagen, el texto y los botones
                    echo '<td><div style="text-align: center;">';
                    echo '<form method="post">';
                    echo '</form>';
                    echo '<form action="producto.php" method="get"><input type="hidden" name="Id_Articulo" value="'.$fila['Id_Articulo'].'"><input type="image" alt="Submit" class="imagen-anuncio" height="300" width="250" src="'.$fila['Imagen'].'">'; #Insertamos la imagen con el hipervínculo a la página del anuncio
                    echo '<br>';
                    echo '<button type="submit" class="texto-anuncio"><div class="texto-anuncio" align="center">'.$fila['Nombre'].' - '.$fila['Precio'].'€</div></button></form>'; #Insertamos el nombre y el precio con el hipervínculo a la página del anuncio
                    if($fila['id_UReserva'] != NULL){
                        echo 'Reservado';
                    }else{
                        echo 'No reservado';
                    }
                    echo '</div></td>';
                }
           echo"</table>";
        echo"</div>";

    mysqli_close($conn);

    ?>    
    
</body>
</html>