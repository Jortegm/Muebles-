<?php

require_once("./html.php");
HTML::abrirhtml("Modificar Categoria","<link rel='stylesheet' type='text/css' href='./../css/estiloAD.css'");
	//iniciamos sesion
	session_start();
		//cookie y control con tiempo
		if(isset($_COOKIE["sesion"]))
		{
			$actual=strtotime(date("j-n-Y H:i:s"));
			$anterior=strtotime($_COOKIE["sesion"]);
			if($actual-$anterior > 7200)
			{
				session_destroy();
				header("location:login.php");
			}
			else
			{
				setcookie("sesion",date("j-n-Y H:i:s"));
			}
		}
		//conectamos a la bd
		try{
		 $conectar=new PDO("mysql:dbname=Muebles;host=127.0.0.1","root","");//---,usuario, contraseña
		 $conectar->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		 $datos = $conectar -> prepare ("update categorias SET CategoriaID=?, NombreCategoria=?, DescripcionCategorias=? WHERE CategoriasID = ?");
		//cogemos el codigo de la categoria
		 $idCateg = $_GET["CategoriasID"];
		 $datos = $conectar -> query ("select * from categorias where CategoriasID=".$idCateg);
		 //mostramos todos los datos de la categoria con el codigo que hemos pasado
			$mostrar = $datos ->fetch();
		}catch (PDOException $e){

			echo $e->getMessage();

		}
?>
<?php

	$idCateg=$mostrar["CategoriasID"];
    $nombre="";
    $descripcion="";

	   if(!empty($_POST)) {
        //Realizamos el envío
  		  $nombre=$_POST["nCateg"];
  		  $descripcion=$_POST["dCateg"];


              if ($nombre=="") {
                    $mensajePrecio="Rellene el campo precio";
                    $error=true;

               }
              if ($descripcion==""){
                   $mensajeNombre="Rellene el campo nombre";
                   $error=true;
			   }

	 }

 ?>

<!-- creamos la cabecera con 3 div donde va el logo, buscador y redes sociales y acceso de los usuarios.-->
        <div id="cabecera1">
            <!--div para letrero de la empresa -->
            <div id="letrero">
                <img src="../img/PortadaMuebleBBB - copia.png" />
            </div>

            <!-- div para salir o navegar por la administracion -->
            <div id ="administracion">
				<?php
				echo "<h5>Hola ".$_SESSION["usuario"]."</h5>";
				?>
                <div id="registro">
                <a href="./../index.php" title="Volver">Salir de Administracion </a>
                <a href="./administrador.php" title=" Volver a Administracion"> Ir a la Administracion </a>
                </div>

            </div>
       </div>


 <form action='' method='POST'>
    <fieldset>
	 <legend>Modificar Datos Categoria</legend>
    <label for='Id'>ID de la Categoria: </label>
	<input type="number" name='idCateg' readonly value=<?php echo $mostrar["CategoriasID"] ?> >

	<label for='Categoria'>Nombre Categoria: </label>
    <input type='text' name='nCateg' value=<?php echo $nombre?>>
    <br/><br/>

	<label for='Producto'>Descripcion Categorias: </label>
    <textarea  id="dCateg" name="dCatego" value <?php $descripcion?>></textarea>
	<br/><br/>
    <input type="submit" value ="Guardar"/>
    </fieldset>
</form>

<a href="./nuevaCategoria.php">Volver</a>
<?php


		if (count($_POST)!=0){
			$exito=FALSE;
			//preparamos el envio con los datos actualizados
			$datos = $conectar->prepare("update categorias SET CategoriasID=?, NombreCategorias=?, DescripcionCategorias=? WHERE CategoriasID=".$idCateg);
			//ejecutamos la actualizacion de la fila
			$datos->execute(array($_POST["idCateg"], $_POST["nCateg"], $_POST["dCateg"]));
			//volvemos a la pagina de Categoria
			header("location:./nuevaCategoria.php");

		}


 ?>
