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
                    $enlace = mysqli_connect ("db4free.net", "adminpw","adminPW123" ,"thereuseshop");
                    
                    $usuario = $_POST('usuario');
                    $pwd = $_POST('pwd');
                    $consulta = mysqli_query ($enlace, "SELECT * FROM Usuario WHERE username = '$usuario' and contrasena = '$pwd'");

                    if(mysqli_num_rows($consulta) != 0){ //usuario y contraseña validos
                        session_start();
                        session_register("autentificado");
                        $autentificado = "SI";
                        
                    }
                    else{
                        echo "El usuario o contraseña son incorrectos. Intentelo de nuevo.";
                    }
                    mysqli_free_result($consulta);
                    mysqli_close();

                ?>
            </form>
        </section>
    </header>
</body>

</html>