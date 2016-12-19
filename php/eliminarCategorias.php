<?php	//nos conectamos a la bs
		 $conectar=new PDO("mysql:dbname=Muebles;host=127.0.0.1","root","");//---,usuario, contraseña
		 $conectar->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		 $datos = $conectar -> prepare ("update categorias SET CategoriaID=?, NombreCategoria=?, DescripcionCategorias=? WHERE CategoriasID = ?");
		 $idCateg = $_GET["CategoriasID"];
		//eliminamos la fila pasandole codigo
		 $datos=$conectar->exec("delete from categorias where CategoriasID=".$idCateg);
		 header("location: ./nuevaCategoria.php");
?>
