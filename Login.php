<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Compra articulos de segunda mano">
    <title>TheReUseShop</title>

    <link href="styles/home.css" .css” rel="stylesheet" type="text/css">
</head>

<body>
    <header>
        <h1>The TheReUseShop</h1>
        <h2>Segundas oportunidades para objetos únicos</h2>

        <section>
            <form action="Login.php" method="post">
                <label for="usuario">Nombre de usuario</label>
                <input type="text" name="usuario" size=8 maxlength=20 checked = "checked">
                <br>
                <br>
                <label for="password">Contraseña</label>
                <input type="password" name="pwd" size="8" maxlength="20">
                <br>
                <br>
                <input type="submit" value="Acceder">

                <?php
                    // Conexion con el servidor
                    $servername = "db4free.net";
                    $username = "adminpw";
                    $password = "adminPW123";
                    $dbname = "thereuseshop";
                    // Crea la conexion
                    $enlace = mysqli_connect($servername, $username, $password, $dbname);
                    
                    if($_SERVER["REQUEST_METHOD"] == "POST") {
                        if(empty($_POST['usuario'])||empty($_POST['pwd'])){
                            echo '<script language="javascript">alert("Uno de los campos esta vacío, por favor rellenalos todos.");</script>';
                        }
                        else{
                            $usuario = $_POST['usuario'];
                            $pwd = md5($_POST['pwd']);
                            $consulta = mysqli_query($enlace, "SELECT * FROM Usuario WHERE username = '$usuario' and contrasena = '$pwd'");
                            if(mysqli_num_rows($consulta) === 1){ //usuario y contraseña validos
                                $reg = mysqli_fetch_array($consulta);
                                session_start();
                                $_SESSION['id'] = $reg['Id_user'];

                                header("location: Anuncios.php");
                            }
                            else{
                                echo '<script language="javascript">alert("El usuario o contraseña son incorrectos. Intentelo de nuevo.");</script>';
                            }
                        }
                    }
                ?>
            </form>
        </section>
    </header>
</body>

</html>