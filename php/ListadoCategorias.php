<?php
try {
        //nos conectamos a la base de datos:
        $conectar = new PDO ("mysql:dbname=Muebles;host=127.0.0.1","root","");
        //añadimos los atributos;
        $conectar -> setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        echo" <h1>Listado de Categorias </h1>";
                            listaCategorias($conectar);
}catch (PDOException $e) {
        //controlar los mensajes de error
        echo "Se ha producido un error por que no existe la base de datos Muebles"; 
        echo "<br>"; 
    }

            function listaCategorias ($conectar){
                //consulta de la base de datos de muebles con las Categorias;
                  $datos = $conectar ->query ("select CategoriasID, NombreCategorias, DescripcionCategorias from Categorias");
                $mysqli = new mysqli("localhost", "root", "", "Muebles");

                 if ( $mysqli ->query("select CategoriaID from Categorias") == false){
                     echo"<h2>No has insertado todavia ningún categoria</h2>";
                 }else{  
                  echo "<table border=2>";
                  echo "<tr>";
                  echo "<td>C&oacute;digo Categoria</td>";
                  echo "<td>Nombre Categoria </td>";
                  echo "<td>Descripcion Categoria</td>";
                  echo "<td>Productos por Categorias</td>";
                  echo "</tr>";
                  echo "<tr>";

                           
                        while ($categoria = $datos ->fetch()){
                        echo "<td>".$categoria["CategoriasID"]."</td>";
                        echo "<td>".$categoria["NombreCategias"]."</td>";
                        echo "<td>".$categoria["DescripcionCategorias"]."</td>";
                        echo "<td><a href=./listadoproductos.php?produc=".$categoria["CategoriasID"].">Productos</a></td>";
                        echo "<td>hola</td>";
                        }
                 }
                    
                 echo "</tr>";
            }
            ?>