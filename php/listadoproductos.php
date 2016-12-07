<?php


require_once("./administrador.php");
try{
            $conectar = new PDO ("mysql:dbname:muebles;host=127.0.0.1","root","");
            $conectar -> setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $datos= $conectar ->prepare ("select  idProductos, NombreProductos, DescripcionProductos, Precio from productos  where idcategorias=?");
            $datos -> execute(array($_GET["produc"]));

            echo "<h1>Listado de los productos</h1>";
                         listaproductos($datos);


}catch(PDOException $e){
   //controlar los mensajes de error
        echo "Se ha producido un error por que no existe la base de datos Muebles"; 
        echo "<br>"; 
}




function listaproductos($datos){
    
     //Realizar consulta a la BD

    echo "<table border='2'>";
        echo "<tr>";
        echo"<td>C&oacute;digo Producto</td>";
        echo"<td>-Nombre del Producto</td>";
        echo"<td>Descripcion del Producto</td>";
        echo"<td>Precio</td>";
        echo "</tr>";
     echo "<tr>";

        while($producto =  $datos ->fetch()){
        echo "<td>".$producto["idProductos"]."</td>";
        echo "<td>".$producto["NombreProductos"]."</td>";
        echo "<td>".$producto["DescripcionProductos"]."</td>";
        echo "<td>".$producto["Precio"]."</td>";
        echo "</tr>";
        }
        
  echo"</table>";

}