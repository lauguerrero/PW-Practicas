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

                    $consulta_deseos = mysqli_query($conexion, "select id_Articulo from Deseos where id_Usuario=$logged_user") or die("Fallo en la consulta de Deseos");

                    $lista_deseos = array();
                    while($fila = mysqli_fetch_array($consulta_deseos)){
                        $lista_deseos[] = $fila['id_Articulo'];
                    }
                    
                    $nfilas = mysqli_num_rows($consulta_articulos);
                    for($i=0; $i<$nfilas; $i++){
                        $fila = mysqli_fetch_array($consulta_articulos);
                        if($i%4 == 0){
                            echo '</tr><tr>';
                        }
                        echo '<td><div>';
                        echo '<div class="add-listadeseados-container"><button class="add-listadeseados">';
                        if(in_array($fila['Id_Articulo'], $lista_deseos)){
                            echo 'En tu lista de deseos';
                        }else{
                            echo 'Añadir a tu lista de deseos';
                        }
                        echo '</button></div>';
                        echo '<a href="#"><img class="anuncio" height="300" width="250" src="../ImagenesArticulos/'.$fila['Imagen'].'.jpg"/></a>'; #Insertamos la imagen con el hipervínculo a la página del anuncio
                        echo '<br>';
                        echo '<a class="texto-anuncio" href="#"><div align="center">'.$fila['Nombre'].' - '.$fila['Precio'].'€</div></a>'; #Insetamos el nombre y el precio con el hipervínculo a la página del anuncio
                        echo '</div></td>';
                    }
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