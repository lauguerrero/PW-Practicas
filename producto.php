<?php

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
    <title>Producto</title>
    <link rel = "stylesheet" type = "text/css" href = "producto.css"> 
</head>
<body>

<h1>Mostrar Producto</h1>

    <?php

        $id = 1;

        // Comprobar si se han recibido datos
        /*if(isset($_GET['Id_Articulo'])){
            // Asignar los valores recibidos a variables
            $id = $_GET['Id_Articulo'];
            
            // Mostrar los datos recibidos
            echo 'Id_Articulo: ' . $id . '<br>';
        }*/

        $sql = "SELECT * FROM Articulo WHERE Id_Articulo = $id";
        $sentencia = mysqli_query($conn, $sql);
        if(!$sentencia){
            echo 'Hay un error en la sentencia SQL: ' .$sql;
        }
        else{
            $articulo = mysqli_fetch_array($sentencia);
        }

    ?>

    <table>

        <?php
            echo "<tr class = uno>";
                for($i = 0; $i < $articulo; $i++) {
                        $foto = $articulo['Imagen'];
                        echo "<td>";
                            echo '<img src = "$foto">';
                        echo "</td>";

                        echo "<td rowspan = 2>";
                            echo $articulo['Nombre'];
                            echo "<br>";
                            echo "<br>";
                            echo 'Categoria: ' . $articulo['Tematica'];
                            echo "<br>";
                            echo "<br>";
                            echo 'Precio: '. $articulo['Precio'] . '€';
                        echo "</td>";

                    $articulo = mysqli_fetch_array($sentencia);
                }
            echo "</tr>";

            echo "<tr>";
                $id = 1;

                // Comprobar si se han recibido datos
                /*if(isset($_GET['Id_Articulo'])){
                    // Asignar los valores recibidos a variables
                    $id = $_GET['Id_Articulo'];
                    
                    // Mostrar los datos recibidos
                    echo 'Id_Articulo: ' . $id . '<br>';
                }*/
        
                $sql = "SELECT * FROM Articulo WHERE Id_Articulo = $id";
                $sentencia = mysqli_query($conn, $sql);
                if(!$sentencia){
                    echo 'Hay un error en la sentencia SQL: ' .$sql;
                }
                else{
                    $articulo = mysqli_fetch_array($sentencia);
                }
                for($i = 0; $i < $articulo; $i++) {
                        echo "<td>";
                            echo $articulo['Descripcion'];
                        echo "</td>";

                    $articulo = mysqli_fetch_array($sentencia);
                }
            echo"</tr>";

        ?>

    </table>

</body>
</html>