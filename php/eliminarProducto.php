<?php	//nos conectamos a la bs
		 $conectar=new PDO("mysql:dbname=Muebles;host=127.0.0.1","root","");//---,usuario, contraseña
		 $conectar->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		 $datos = $conectar -> prepare ("update productos SET ProductosID=?, NombreProductos=?, DescripcionProductos=?,  precio=? imagen=? WHERE ProductosID = ?");
		 $idProdu = $_GET["ProductosID"];
		//eliminamos la fila pasandole codigo
		 $datos=$conectar->exec("delete from productos where ProductosID=".$idProdu);
		 header("location: ./nuevoProducto.php");
?>
