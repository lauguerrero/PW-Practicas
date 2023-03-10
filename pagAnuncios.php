<html>
    <head>
        <title>Anuncios</title>
        <style>
            /* Estilo de la tabla que tendrá todos los anuncios */
            table.anuncios {
                border-spacing: 50px;
                margin-left: 0 auto;
                margin-right: 0 auto;
            }

            /* Estilo de cada imagen dentro de la tabla con los anuncios */
            img.anuncio {
                display: block;
                margin-left: auto;
                margin-right: auto;
                border: 1px solid black;
            }

            /* Estilo del texto debajo de cada imagen de la tabla con los anuncios */
            div.anuncio {
                font-family: Courier;
                font-size: 20px;
            }

            /* Estilo de la barra de búsqueda superior */
            input.search {
                width: 300px;
                padding: 10px;
                border: none;
                border-radius: 5px 0 0 5px;
            }

            /* Estilo de los botones para la búsqueda */
            button.search {
                padding: 10px;
                border: none;
                border-radius: 0 5px 5px 0;
                background-color: #007bff;
                color: #fff;
                cursor: pointer;
            }

            /* Botón usuario */
            .userbtn {
                background-color: #4ea93b;
                color: white;
                padding: 16px;
                font-size: 16px;
                border: none;
            }

            /* The container <div> - needed to position the dropdown content */
            .dropdown {
                position: relative;
                display: inline-block;
            }

            /* Dropdown Content (Hidden by Default) */
            .dropdown-content {
                display: none;
                position: absolute;
                right: 0;
                background-color: 92e27a;
                min-width: 160px;
                box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
                z-index: 1;
            }

            /* Links inside the dropdown */
            .dropdown-content a {
                color: black;
                padding: 12px 16px;
                text-decoration: none;
                display: block;
            }

            /* Change color of dropdown links on hover */
            .dropdown-content a:hover {background-color: #92e27a;}

            /* Show the dropdown menu on hover */
            .dropdown:hover .dropdown-content {display: block;}

            /* Change the background color of the dropdown button when the dropdown content is shown */
            .dropdown:hover .dropbtn {background-color: #71c55b;}

        </style>
    </head>

    <body>
        <!--Prueba de comentario-->

        <div>
            <div class="searchbar" style="float:left;">
                <form id="form"> 
                    <input class="search" type="search" id="query" name="q" size="50" placeholder="Buscar artículos...">
                    <button class="search">Filtros</button>
                    <button class="search" type="submit">Buscar</button>
                </form>
            </div>

            </div>

            <div class="dropdown" style="float:right;">
                <button class="userbtn">Usuario</button>
                <div class="dropdown-content" style="float:left;">
                    <a href="#">Mi Perfil</a>
                    <a href="#">Lista Deseos</a>
                    <a href="#" style="color: red">Cerrar Sesión</a>
                </div>
            </div>
        </div>

        <div>
            <table class='anuncios'>
                <?php
                #Prueba de comentario
                    $servername = "db4free.net";
                    $username = "adminpw";
                    $password = "adminPW123";
                    $dbname = "thereuseshop";
    
                    $conexion = mysqli_connect($servername, $username, $password, $dbname) or die ("No se puede conectar con el servidor");
    
                    $consulta = mysqli_query($conexion, "select * from Articulo") or die ("Fallo en la consulta");
                    
                    $nfilas = mysqli_num_rows($consulta);
                    for($i=0; $i<$nfilas; $i++){
                        $fila = mysqli_fetch_array($consulta);
                        if($i%4 == 0){
                            echo '</tr><tr>';
                        }
                        echo '<td><div>';
                        echo '<a href="#"><img class="anuncio" height="250" width="200" src="../ImagenesArticulos/'.$fila['Imagen'].'.jpg"/></a>'; #Insertamos la imagen con el hipervínculo a la página del anuncio
                        echo '<br>';
                        echo '<a href="#"><div class="anuncio" align="center">'.$fila['Nombre'].' - '.$fila['Precio'].'€</div></a>'; #Insetamos el nombre y el precio con el hipervínculo a la página del anuncio
                        echo '</div></td>';
                    }
                ?>
            </table>
        </div>
    </body>
</html>