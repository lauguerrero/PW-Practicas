<html>
    <head>
        <title>Anuncios</title>
        <link rel="stylesheet" href="pagAnuncios.css">
    </head>

    <body>
        <div class="upperbar-container">
            <div class="searchbar" style="float:left;">
                <form id="form"> 
                    <input class="buscar" type="search" id="query" name="q" size="50" placeholder="Buscar artículos...">
                    <button class="buscar">Filtros</button>
                    <button class="buscar" type="submit">Buscar</button>
                </form>
            </div>

            <div class="dropdown" style="float:right;">
                <button class="userbtn">Usuario</button>
                <div class="dropdown-content" style="float:left;">
                    <a href="#">Mi Perfil</a> <!-- Habría que añadir el enlace a la página del perfil -->
                    <a href="#">Lista Deseos</a> <!-- Habría que añadir el enlace a la página de la lista de deseos -->
                    <a href="#" style="color: red">Cerrar Sesión</a> <!-- Habría que añadir el enlace para cerrar sesión -->
                </div>
            </div>

            <div>
                <button class="publicar" style="float:right;">Publicar</button>
            </div>
        </div>

        <div class="table-container">
            <table class='anuncios'>
                <?php
                    $servername = "db4free.net";
                    $username = "adminpw";
                    $password = "adminPW123";
                    $dbname = "thereuseshop";
    
                    $conexion = mysqli_connect($servername, $username, $password, $dbname) or die ("No se puede conectar con el servidor");
    
                    $consulta_articulos = mysqli_query($conexion, "select * from Articulo") or die ("Fallo en la consulta de Articulos");
                    
                    $logged_user = "1"; #Supuesto ID del usuario loggeado

                    if($_SERVER["REQUEST_METHOD"] == "POST"){
                        $id_articulo_deseos=$_POST["Id_Articulo"];
                        $id_usuario_deseos=$_POST["Id_Usuario"];
                        if($_POST["add-listadeseados"] == 'En tu lista de deseos'){ #En este caso significa que queremos eliminar el archivo de la lista de deseos
                            $prueba = mysqli_query($conexion, "delete from Deseos where id_Articulo=$id_articulo_deseos and id_Usuario=$id_usuario_deseos");
                            echo $prueba;
                        }else{ #En este caso significa que queremos añadir el archivo a la lista de deseos
                            echo "Queremos add";
                        }
                    }

                    #Obtenemos la lista de deseos del usuario loggeado
                    $consulta_deseos = mysqli_query($conexion, "select id_Articulo from Deseos where id_Usuario=$logged_user") or die("Fallo en la consulta de Deseos");

                    #Pasamos los articulos de la lista de deseos del usuario a un array
                    $lista_deseos = array();
                    while($fila = mysqli_fetch_array($consulta_deseos)){
                        $lista_deseos[] = $fila['id_Articulo'];
                    }
                    
                    echo '<form method="post">';
                    $nfilas = mysqli_num_rows($consulta_articulos);
                    for($i=0; $i<$nfilas; $i++){
                        $fila = mysqli_fetch_array($consulta_articulos);

                        #Hacemos que se hagan 4 columnas
                        if($i%4 == 0){
                            echo '</tr><tr>';
                        }

                        #Introducimos la imagen, el texto y los botones
                        echo '<td><div>';
                        echo '<div class="add-listadeseados-container">';
                        echo '<input type="hidden" name="Id_Articulo" value="'.$fila['Id_Articulo'].'">';
                        echo '<input type="hidden" name="Id_Usuario" value="'.$logged_user.'">';
                        echo '<input type="submit" class="add-listadeseados" name="add-listadeseados" ';
                        if(in_array($fila['Id_Articulo'], $lista_deseos)){
                            echo 'value="En tu lista de deseos"';
                        }else{
                            echo 'value="Añadir a tu lista de deseos"';
                        }
                        echo '></div>';
                        echo '<a href="#"><img class="anuncio" height="300" width="250" src="../ImagenesArticulos/'.$fila['Imagen'].'.jpg"/></a>'; #Insertamos la imagen con el hipervínculo a la página del anuncio
                        echo '<br>';
                        echo '<a class="texto-anuncio" href="#"><div align="center">'.$fila['Nombre'].' - '.$fila['Precio'].'€</div></a>'; #Insetamos el nombre y el precio con el hipervínculo a la página del anuncio
                        echo '</div></td>';
                    }
                    echo '</form>';
                ?>
            </table>
        </div>
    </body>
</html>

<!-- Estructura del código html dentro de cada celda
<td>
    <div>
        <div class="add-listadeseados-container">
            <button class="add-listadeseados">
                MG
            </button>
        </div>
        <a href="#"><img class="anuncio" height="250" width="200" src="../ImagenesArticulos/'.$fila['Imagen'].'.jpg"/></a>
        <br>
        <a class="texto-anuncio" href="#"><div align="center">'.$fila['Nombre'].' - '.$fila['Precio'].'€</div></a>
    </div>
</td>
-->