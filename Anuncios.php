<html>
    <head>
        <title>Anuncios</title>
        <link rel="stylesheet" href="Anuncios.css">
    </head>

    <body>
        <div class="upperbar-container">
            <div class="searchbar" style="float:left;">
                <form method="post"> 
                    <input class="buscar" type="search" id="query" name="q" size="50" placeholder="Buscar artículos...">
                    <select name = "Filtro">
                        <option selected>Categoria</option>
                        <option>Deporte y ocio</option>
                        <option>Electronica</option>
                        <option>Moda y accesorios</option>
                        <option>Inmobiliaria</option>
                        <option>Libros</option>
                        <option>Coleccionismo</option>
                        <option>Otros</option>
                    </select>
                    <button class="buscar" type="submit" name="boton-buscar">Buscar</button>
                </form>
            </div>

            <div class="dropdown" style="float:right;">
                <button class="userbtn">Usuario</button>
                <div class="dropdown-content" style="float:left;">
                    <a href="./Perfil.php">Mi Perfil</a>
                    <a href="./ListaDeseos.php">Lista Deseos</a>
                    <a href="./Home.html" style="color: red">Cerrar Sesión</a>
                </div>
            </div>

            <div>
                <button class="publicar" style="float:right;"><a class="publicar" href="./publicar.html">Publicar</a></button>
            </div>
        </div>

        <div class="table-container">
            <table class='anuncios'>
                <?php
                    session_start();

                    $servername = "db4free.net";
                    $username = "adminpw";
                    $password = "adminPW123";
                    $dbname = "thereuseshop";

                    $logged_user = $_SESSION['id'];
    
                    $conexion = mysqli_connect($servername, $username, $password, $dbname) or die ("No se puede conectar con el servidor");
    
                    $consulta_articulos = mysqli_query($conexion, "select * from Articulo") or die ("Fallo en la consulta de Articulos");

                    if($_SERVER["REQUEST_METHOD"] == "POST"){
                        if(isset($_POST["Id_Articulo"])){ #Cuando queremos añadir o eliminar un articulo de la lista de deseos
                            $id_articulo_deseos=$_POST["Id_Articulo"];
                            if($_POST["add-listadeseados"] == 'delete'){ #En este caso significa que queremos eliminar el archivo de la lista de deseos
                                mysqli_query($conexion, "delete from Deseos where id_Articulo=$id_articulo_deseos and id_Usuario=$logged_user");
                            }else{ #En este caso significa que queremos añadir el archivo a la lista de deseos
                                mysqli_query($conexion, "insert into Deseos values($logged_user, $id_articulo_deseos)");
                            }
                        }elseif(isset($_POST['boton-buscar'])){ #Cuando queremos buscar un artículo
                            $consulta_articulos = mysqli_query($conexion, 'select * from Articulo where Nombre like "%'.$_POST["q"].'%"') or die ("Fallo en la consulta de Articulos");
                            if($_POST["Filtro"] != 'Categoria'){
                                $consulta_articulos = mysqli_query($conexion, 'select * from Articulo where Tematica like "%'.$_POST["Filtro"].'%"') or die ("Fallo en la consulta de Articulos");
                            }
                        }
                    }

                    #Obtenemos la lista de deseos del usuario loggeado
                    $consulta_deseos = mysqli_query($conexion, "select id_Articulo from Deseos where id_Usuario=$logged_user") or die("Fallo en la consulta de Deseos");

                    #Pasamos los articulos de la lista de deseos del usuario a un array
                    $lista_deseos = array();
                    while($fila = mysqli_fetch_array($consulta_deseos)){
                        $lista_deseos[] = $fila['id_Articulo'];
                    }
                    
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
                        echo '<div class="add-listadeseados-container">';
                        echo '<input type="hidden" name="Id_Articulo" value="'.$fila['Id_Articulo'].'">';
                        echo '<button type="submit" class="add-listadeseados" name="add-listadeseados"';
                        if(in_array($fila['Id_Articulo'], $lista_deseos)){
                            echo 'value="delete">En tu lista de deseos';
                        }else{
                            echo 'value="add">Añadir a tu lista de deseos';
                        }
                        echo '</button></div>';
                        echo '</form>';
                        echo '<form action="producto.php" method="get"><input type="hidden" name="Id_Articulo" value="'.$fila['Id_Articulo'].'"><input type="image" alt="Submit" class="imagen-anuncio" height="300" width="250" src="'.$fila['Imagen'].'">'; #Insertamos la imagen con el hipervínculo a la página del anuncio
                        echo '<br>';
                        echo '<button type="submit" class="texto-anuncio"><div class="texto-anuncio" align="center">'.$fila['Nombre'].' - '.$fila['Precio'].'€</div></button></form>'; #Insertamos el nombre y el precio con el hipervínculo a la página del anuncio
                        echo '</div></td>';
                    }
                ?>
            </table>
        </div>
    </body>
</html>

<!-- Estructura del código html dentro de cada celda
<form>
    <td>
        <div>
            <div class="add-listadeseados-container">
                <input type="submit" class="add-listadeseados" name="add-listadeseados" value="Añadir a tu lista de deseos">
                <input type="hidden" name="Id_Articulo" value="'.$fila['Id_Articulo'].'">
                <input type="hidden" name="Id_Usuario" value="'.$logged_user.'">
            </div>
            <a href="#"><img class="anuncio" height="250" width="200" src="../ImagenesArticulos/'.$fila['Imagen'].'.jpg"/></a>
            <br>
            <a class="texto-anuncio" href="#"><div align="center">'.$fila['Nombre'].' - '.$fila['Precio'].'€</div></a>
        </div>
    </td>
</form>
-->