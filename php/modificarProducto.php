<?php
require_once("./html.php");
HTML::abrirhtml("Modificar Producto","<link rel='stylesheet' type='text/css' href='./../css/estiloAD.css'");
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
		 $datos = $conectar -> prepare ("update productos SET ProductosID=?, NombreProductos=?, DescripcionProductos=? Precio=? imagen=? WHERE ProductosID = ?");
		//cogemos el codigo de la categoria
		 $idProduc = $_GET["ProductosID"];
		 $datos = $conectar -> query ("select * from productos where ProductosID=".$idProduc);
		 //mostramos todos los datos de la categoria con el codigo que hemos pasado
			$mostrar = $datos ->fetch();
		}catch (PDOException $e){

			echo $e->getMessage();

		}
?>
<?php

	$idCateg=$mostrar["ProductosID"];
    $nombre="";
    $descripcion="";
    $precio="";
    $imagen="";


	   if(!empty($_POST)) {
        //Realizamos el envío
  		  $nombre=$_POST["nProductos"];
  		  $descripcion=$_POST["dProductos"];
            $precio=$_POST["precio"];

              if ($nombre=="") {
                    $mensajePrecio="Rellene el campo precio";
                    $error=true;

               }
              if ($descripcion==""){
                   $mensajeNombre="Rellene el campo nombre";
                   $error=true;
			   }
               if ($precio==""){
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
	 <legend>Modificar Datos Producto</legend>
    <label for='Id'>ID de Producto: </label>
	<input type="number" name='idProduc' readonly value=<?php echo $mostrar["ProductosID"] ?>>

	<label for='Producto'>Nombre Producto: </label>
    <input type='text' name='nProductos' value=<?php echo $nombre?>>

    <label for='Producto'>Precio: </label>
    <input type='text' name='precio' value=<?php echo $precio ?>>
    <br/><br/>

	<label for='Producto'>Descripcion Producto: </label>
    <textarea  id="dProducto" name="dProductos" value <?php $descripcion?>></textarea>
	<br/><br/>
    <label>Imagen </label><br/>
    <?php echo "<img width='150px' height='150px' src='data:./productos/jpg;base64,".base64_encode($mostrar['imagen'])."'/>"?>;
	<label>Cambiar imagen:</label>
    <input type='file' name='fichero'  value= 'Seleccione un fichero' />
	<input type='hidden' name='MAX_FILE_SIZE' value='50000'/>
    <br/><br/>

    <input type="submit" value ="Guardar"/>
    </fieldset>
</form>

<a href="./nuevoProducto.php">Volver</a>
<?php

	$exito =False; // para saber si el archivo se ha subido de verdad, creamos un booleano que true y false

    if(count($_FILES)>0){
         $destino = "./productos/".$_FILES["fichero"]["name"];//variable donde vamos a guardar nuestro archivo subido
         if(move_uploaded_file($_FILES["fichero"]["tmp_name"],$destino)){ // comprobamos que existe algun archivo donde lo guarda temporarmente, si existe lo guarda en el destino declarado anteriormente
           //cuando haya el move_uploader_file el archivo ya no esta en el temporal.
            $exito = True; //si existe la subida exitosa, sera true.
            echo"<script>alert('destino subido con exito')</script>";
        }
	}

		if (count($_POST)!=0){
			$exito=FALSE;
			//preparamos el envio con los datos actualizados
			$datos = $conectar->prepare("pdate productos SET ProductosID=?, NombreProductos=?, DescripcionProductos=? Precio=? imagen=? WHERE ProductosID=".$idProduc);
			//ejecutamos la actualizacion de la fila
            $ft=file_get_contents($destino);
			$datos->execute(array($_POST["idProduc"], $nombre, $descripcion,$precio, $ft));
			//volvemos a la pagina de Categoria
			header("location:./nuevoProducto.php");

		}


 ?>
