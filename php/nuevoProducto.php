<?php

require_once("./html.php");
HTML::abrirhtml("Nueva Producto","<link rel='stylesheet' type='text/css' href='./../css/estiloAD.css'");
session_start();
		//cookie y control con tiempo
		if(isset($_COOKIE["sesion"])){
			$actual=strtotime(date("j-n-Y H:i:s"));
			$anterior=strtotime($_COOKIE["sesion"]);
			if($actual-$anterior > 7200){
				session_destroy();
				header("location:login.php");
			}else{
				setcookie("sesion",date("j-n-Y H:i:s"));
			}
		}

		//subida de archivos
		$exito =False; // para saber si el archivo se ha subido de verdad, creamos un booleano que true y false

    if(count($_FILES)>0){
         $destino = "./productos/".$_FILES["fichero"]["name"];//variable donde vamos a guardar nuestro archivo subido
         if(move_uploaded_file($_FILES["fichero"]["tmp_name"],$destino)){ // comprobamos que existe algun archivo donde lo guarda temporarmente, si existe lo guarda en el destino declarado anteriormente
           //cuando haya el move_uploader_file el archivo ya no esta en el temporal.
            $exito = True; //si existe la subida exitosa, sera true.
            echo"<script>alert('destino subido con exito')</script>";
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
                <div id="registro">
					<?php
				echo "<h5>Hola ".$_SESSION["usuario"]."</h5>";
				?>
                <a href="./../index.php" title="Volver">Salir de Administracion </a>
                <a href="./administrador.php" title=" Volver a Administracion"> Ir a la Administracion </a>
                </div>
            </div>
       </div>


<h1>Nuevo Producto. . .</h1>
	<form method="POST" name="fvalida" action="" enctype="multipart/form-data">
				<br>
					<label>Categoria</label>
					<?php
						//nos conectamos a la bd
						$conectar = new PDO ("mysql:dbname=Muebles;host=127.0.0.1","root","");
		 				$conectar -> setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
						echo "<select type='number' id='nCategorias' name='nCategorias'>";
						echo "<option>-</option>";
						foreach($conectar->query("select DISTINCT NombreCategorias  from categorias") as $NombreCategorias){
						echo '<option>'.$NombreCategorias["NombreCategorias"].'</option>';
						}
						echo "</select>";
					?>

					<label> ID</label>
					<input class="<?php echo isset($mensajeNombre)?'inputError':''?>" type="text" id="IdProduc" name="IdProduc" />
					<?php echo isset($mensajeNombre)?"<font color='red' font-size:'12px'><span class='spanError'>$mensajeNombre</span>":""?>


					<label> Nombre Del Producto</label>
					<input class="<?php echo isset($mensajeNombre)?'inputError':''?>" type="text" id="nProducto" name="nProducto" />
					<?php echo isset($mensajeNombre)?"<font color='red'><span class='spanError'>$mensajeNombre</span>":""?>

					<label> Precio</label>
					<input class="<?php echo isset($mensajePrecio)?'inputError':''?>" align='right' type="number" id="precio" name="precio" />
					<?php echo isset($mensajePrecio)?"<font color='red'><span class='spanError'>$mensajePrecio</span>":""?>
					<br/><br/>

				   <label> Descripcion del Producto</label>
				   <textarea class="<?php echo isset($mensajeDescripcion)?'inputError':''?>"  id="dProducto" name="dProducto" ></textarea>
					<?php echo isset($mensajeDescripcion)?"<font color='red'><span class='spanError'>$mensajeDescripcion</span>":""?>
					<br/><br/>


				   <label> Imagen</label>
					<input type='file' name='fichero'  value= 'Seleccione un fichero' />
					<input type='hidden' name='MAX_FILE_SIZE' value='50000'/> <!--campo oculto donde pones el tamaño del archivo de subida-->
					<br/><br/>


				   <input class="anade" type="submit" name="ENVIAR" value="Añadir">
				<br>
				<br>
			</form>


<?php
echo "<h2>Listado de Productos</h2>";

	try {

		 $conectar = new PDO ("mysql:dbname=Muebles;host=127.0.0.1","root","");
		 $conectar -> setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		if ( empty($_POST)){
			listaProductos($conectar);
		}else{

		$nCategorias="";
		$idProductos="";
		$nombre="";
		$descripcion="";
		$precio = "";
		$error=false;
				//hemos realizado el envío
            $nCategorias=$_POST["nCategorias"];
            $error=false;
			$idProductos=$_POST["IdProduc"];
			$nombre=$_POST["nProducto"];
			$descripcion=$_POST["dProducto"];
			$precio=$_POST["precio"];

            if ($nCategorias=="")
            {
                $mensajeDescripcion="Rellene el campo descripcion";
                $error=true;
			}

            if ($idProductos=="")
            {
                $mensajeNombre="Rellene el campo nombre";
                $error=true;
            }
            if ($nombre=="")
            {
                $mensajeNombre="Rellene el campo nombre";
                $error=true;
            }
            if ($descripcion=="")
            {
                $mensajeNombre="Rellene el campo nombre";
                $error=true;
            }
            if ($precio=="")
            {
                $mensajeNombre="Rellene el campo nombre";
                $error=true;
            }
	    //Listado de los productos que Tenemos actualmente en la base de datos

   //codigo de subida de archivos

				$conexiones = new PDO("mysql:dbname=Muebles;host=127.0.0.1","root","");
				$conexiones -> setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$ft=file_get_contents($destino);
				$subida = $conectar -> prepare("insert into productos values (?,?,?,?,?)");

				$subida->execute(array($idProductos,$nombre,$descripcion,$precio,$ft));
				//mostramos los productos actualizados

							listaProductos($conectar);
		}

	}catch(PDOException $e){
		   //controlar los mensajes de error
				echo "Se ha producido un error por que no existe la base de datos Muebles";
				echo "<br>";
	}


Html::CerrarHtml();



		function listaProductos($conectar){
                //consulta de la base de datos de muebles con las Categorias;
                  $datos = $conectar ->query ("select *  from Productos");
                  echo "<table border=1px solid black>";
                  echo "<tr>";
                  echo "<td>C&oacute;digo Productos</td>";
                  echo "<td>Nombre Productos </td>";
                  echo "<td>Descripcion Productos</td>";
                  echo "<td>Precio del Producto</td>";
				  echo "<td>Imagen del Producto</td>";
				  echo "<td colspan='2'>Tareas de actualizacion</td>";
				  echo "<td>Identificador de Categorias</td>";
                  echo "</tr>";


                        while ($productos = $datos ->fetch()){
                        echo "<tr>";
							echo "<td>".$productos["ProductosID"]."</td>";
							echo "<td>".$productos["NombreProductos"]."</td>";
							echo "<td>".$productos["DescripcionProductos"]."</td>";
							echo "<td>".$productos["Precio"]."</td>";
							echo "<td><img width='150px' heigth='250px' src='data:./productos/jpg;base64,".base64_encode($productos['imagen'])."'/></td>";
							echo "<td ><a href='modificarProducto.php?ProductosID=".$productos['ProductosID']."'>Modificar</a></td>";
							echo "<td><a href='eliminarProducto.php?ProductosID=".$productos['ProductosID']."'>Borrar</a> </td> ";
	             		echo "</tr>";
							}


	  			 echo "</table>";
            }


?>
