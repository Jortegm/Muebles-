<?php



try{
            $conectar = new PDO ("mysql:dbname=Muebles;host=127.0.0.1","root","");
            $conectar -> setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          

            echo "<h1>Listado de los productos</h1>";
                         listaProductos($conectar);


}catch(PDOException $e){
   //controlar los mensajes de error
        echo "Se ha producido un error por que no existe la base de datos Muebles"; 
        echo "<br>"; 
}


  function listaProductos($conectar){
                //consulta de la base de datos de muebles con las Categorias;
                  $datos = $conectar ->query ("select ProductosID, NombreProductos, DescripcionProductos from Productos");
                $mysqli = new mysqli("localhost", "root", "", "Muebles");

                 if ( $mysqli ->query("select ProductosID from Productos") == false){
                     echo"<h2>No has insertado todavia ningún categoria</h2>";
                 }else{  
                  echo "<table border=2>";
                  echo "<tr>";
                  echo "<td>C&oacute;digo Productos</td>";
                  echo "<td>Nombre Productos </td>";
                  echo "<td>Descripcion Productos</td>";
                  echo "<td>Precio del Producto</td>";
                  echo "</tr>";
                  echo "<tr>";

                           
                        while ($productos = $datos ->fetch()){
                        echo "<td>".$productos["ProductosID"]."</td>";
                        echo "<td>".$productos["NombreProductos"]."</td>";
                        echo "<td>".$productos["DescripcionProductos"]."</td>";
                        echo "<td>".$productos["Precio"]."</td>";
                        echo "<td>hola</td>";
                        }
                 }
                    
                 echo "</tr>";
            }