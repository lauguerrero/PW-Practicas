<?php
    session_start();
    $logged_user = $_SESSION['id'];

    // Conexion con el servidor
    $servername = "db4free.net";
    $username = "adminpw";
    $password = "adminPW123";
    $dbname = "thereuseshop";
    // Crea la conexion
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    //Definicion de las variables
    $nombre = $tematica = $precio = $descripcion = $estado = $imagen = $sql = "";

    function extensionFoto($file){
        $pattern = "/.jpg$|.png$|.bmp$|.gif$/i";
        preg_match($pattern, $file, $matches);
        return count($matches);
    }

    //chdir("ImagenesArticulos");

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $nombre = $_POST["nombre"];
        $tematica = $_POST["tematica"];
        $precio = $_POST["precio"];
        $descripcion = $_POST["descripcion"];
        $estado = $_POST["estado"];
        
        if(isset($_FILES['imagen'])){
            $target_dir = "./ImagenesArticulos/";
            $file = $_FILES['imagen']['name'];
            $path = pathinfo($file);
            $filename = $path['filename'];
            $ext = $path['extension'];
            $temp_name = $_FILES['imagen']['tmp_name'];
            $path_filename_ext = $target_dir.$filename.".".$ext;

            if(extensionFoto($path_filename_ext)){
                move_uploaded_file($temp_name,$path_filename_ext);
                $sql = "INSERT INTO Articulo (id_Usuario, Nombre, Tematica, Precio, Descripcion, Estado, Imagen) VALUES ('$logged_user', '$nombre', '$tematica', '$precio', '$descripcion', '$estado', '$path_filename_ext')";
                //Instrucciones de insercion en la base de datos
                if(mysqli_query ($conn, $sql)){
                    header("location: Anuncios.php");
                } else {
                    echo "Error al insertar el registro: " . mysqli_error($conn);
                }
            }
        }
    }

    mysqli_close($conn);
?> 