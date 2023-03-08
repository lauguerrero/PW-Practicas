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
            <form action="Register.php" method="post">
                <label for="usuario">Nombre de usuario</label>
                <input type="text" name="usuario" size=8 maxlength=20 placeholder="Nombre de usuario" checked = "checked">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" size=8 maxlength=20 placeholder="Nombre"checked = "checked">
                <label for="apellido">Apellido</label>
                <input type="text" name="apellido" size=8 maxlength=20 placeholder="Apellido" checked = "checked">
                <label for="telefono">Numero de Telefono</label>
                <input type="number" name="telefono" size=8 maxlength=9 placeholder="Numero de telefono" checked = "checked">
                <label for="email">Correo electronico</label>
                <input type="text" name="email" size=8 maxlength=30 placeholder="Correo electronico" checked = "checked">
                <label for="password">Contraseña</label>
                <input type="password" name="pwd" size="8" placeholder="Contraseña" maxlength="20">
                <label for="cpassword">Repetir contraseña</label>
                <input type="cpassword" name="pwd" size="8" placeholder="Repetir contraseña" maxlength="20">
                <input type="submit" value="Acceder">

                <?php
                    $enlace = mysqli_connect ("db4free.net", "adminpw","adminPW123" ,"thereuseshop");

                    $username = $_POST['usuario'];
                    $nombre = $_POST['nombre'];
                    $apellido = $_POST['apellido'];
                    $telefono = $_POST['telefono'];
                    $email = $_POST['email'];
                    $password = md5($_POST['password']);
                    $cpassword = md5($_POST['cpassword']);

                    if($password == $cpassword){
                        $consulta = "SELECT * FROM Usuario WHERE email='$email'";
                        if(mysqli_num_rows($consulta) == 0){  //no existe ese email en la BD
                            mysqli_query($enlace, "INSERT INTO Usuario(Nombre,Apellidos,Telefono,email,username, contrasena) VALUES ('".$nombre."','".$apellido."','".$telefono."','".$email."','".$username."','".$contrasena."',)");
                            echo "<script>alert('Registrado con exito.')</script>";
                        }
                        else{
                            echo "<script>alert('El correo ya existe.')</script>"; 
                        }
                    }

                    mysqli_free_result($consulta);
                    mysqli_close();

                ?>
            </form>
        </section>
    </header>
</body>

</html>