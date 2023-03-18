<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Compra articulos de segunda mano">
    <title>Añadir Usuario</title>
    <link href="Register.css" .css” rel="stylesheet" type="text/css">
</head>

<body>
    <header>
        <h1>The TheReUseShop</h1>
        <h2>Segundas oportunidades para objetos únicos</h2>

        <section>
            <form action="AdminReg.php" method="post">
                <label for="usuario">Nombre de usuario</label>
                <input type="text" name="usuario" size=14 maxlength=20 placeholder="Nombre de usuario" checked = "checked">
                <br>
                <br>
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" size=8 maxlength=20 placeholder="Nombre"checked = "checked">
                <br>
                <br>
                <label for="apellido">Apellido</label>
                <input type="text" name="apellido" size=8 maxlength=20 placeholder="Apellido" checked = "checked">
                <br>
                <br>
                <label for="telefono">Numero de Telefono</label>
                <input type="number" name="telefono" size=5 maxlength=9 placeholder="Numero de telefono" checked = "checked">
                <br>
                <br>
                <label for="email">Correo electronico</label>
                <input type="text" name="email" size=12 maxlength=30 placeholder="Correo electronico" checked = "checked">
                <br>
                <br>
                Administrador?
                <input type="radio" name="admin" value="1"/>Si
                <input type="radio" name="admin" value="0"/>No
                <br>
                <br>
                <label for="password">Contraseña</label>
                <input type="password" name="pwd" size="13" placeholder="Contraseña" maxlength="20">
                <br>
                <br>
                <label for="cpassword">Repetir contraseña</label>
                <input type="password" name="cpwd" size="13" placeholder="Repetir contraseña" maxlength="20">
                <br>
                <br>
                <input type="submit" value="Añadir">

                <?php
                    // Conexion con el servidor
                    $servername = "db4free.net";
                    $username = "adminpw";
                    $password = "adminPW123";
                    $dbname = "thereuseshop";
                    // Crea la conexion
                    $enlace = mysqli_connect($servername, $username, $password, $dbname);
                    
                    if($_SERVER["REQUEST_METHOD"] == "POST") {
                        if(empty($_POST['usuario'])||empty($_POST['nombre'])||empty($_POST['apellido'])||empty($_POST['telefono'])
                        ||empty($_POST['email'])||empty($_POST['pwd'])||empty($_POST['cpwd'])||empty($_POST['admin'])){
                            echo '<script language="javascript">alert("Uno de los campos esta vacío, por favor rellenalos todos.";</script>';
                        }
                        else{
                            $username = $_POST['usuario'];
                            $nombre = $_POST['nombre'];
                            $apellido = $_POST['apellido'];
                            $telefono = $_POST['telefono'];
                            $email = $_POST['email'];
                            $admin = $_POST['admin'];
                            $password = md5($_POST['pwd']);
                            $cpassword = md5($_POST['cpwd']);

                            if($password == $cpassword){
                                $consulta = mysqli_query($enlace,"SELECT * FROM Usuario WHERE username='$username'");
                                if(mysqli_num_rows($consulta) == 0){  //no existe ese usuario en la BD
                                    mysqli_query($enlace, "INSERT INTO Usuario(Nombre,Apellidos,Telefono,email,username, contrasena, esAdmin) VALUES ('$nombre','$apellido','$telefono','$email','$username','$password', '$admin')");
                                    header("location: ListaUsu.php");
                                }
                                else{
                                    echo '<script language="javascript">alert("El usuario ya existe.");</script>'; 
                                }
                            }
                            else{
                                echo '<script language="javascript">alert("Introduzca la misma contraseña.");</script>';
                            }
                        }
                    }
                ?>
            </form>
        </section>
    </header>
</body>

</html>