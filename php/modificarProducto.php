<?php

require_once("./html.php");
HTML::abrirhtml("Modificar Categoria","<link rel='stylesheet' type='text/css' href='./../css/estiloAD.css'");
session_start();

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
                <a href="./../index.php" title="Volver">Salir de Administracion </a>
                <a href="./administrador.php" title=" Volver a Administracion"> Ir a la Administracion </a>
                </div>
				<?php
				echo "<h5>Hola ".$_SESSION["usuario"]."</h5>";
				?>
            </div>
       </div>


<h1>Modificar Producto. . .</h1>

<?php
	try{
     $conexion=new PDO("mysql:dbname=northwind; host=127.0.0.1","root","");//---,usuario, contraseña
     $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     $datos=$conectar->prepare("update ProductoID, NombreProductos, DescripcionProductos, Precio, imagen FROM productos WHERE ProductoID = ?");//ya tengo los datos en $datos

     $datos->execute(array($_GET["ProductoID"]));
     var_dump($_GET);
     //var_dump($datos->fetch());
     //leo datos->fetch()
     while($categoria=$datos->fetch()){//fila a fila
          $auxId=$categoria["CategoriasID"];
          $auxNombre=$categoria["NombreCategorias"];
		  $auxDescripcion=$categoria["DescripcionCategorias"];
      }

 }catch(PDOException $e){
     //controlar error
     echo $e->getMessage();
 }
$auxId="";
$auxNombre="";
$auxDescripcion="";
$auxPrecio="";

 ?>

 <form action='' method='Post'>
    <fieldset>
	 <legend>Modificar Datos Categoria</legend>
    <label for='Id'>ID del Producto: </label>
    <input type='text' name='id' value='<?php echo $auxId ?>'/>
    <br>
    <label for='Nom'>Nombre del Producto: </label>
    <input type='text' name='nProduc' value='<?php echo $auxNombre ?>'/>
    <br>
	<label for='Descpr'>Descripcion del Producto: </label>
    <input type='text' name='nProduc' value='<?php echo $auxDescripcion ?>'/>
    <br>
	<label for='Precio'>Precio: </label>
    <input type='text' name='Precio' value='<?php echo $auxPrecio?>'/>
    <br>
	<label for='imagen'> Imagen</label>
                <input type='file' name='fichero'  value= 'Seleccione un fichero' /><div id="subida"></div>
                <input type='hidden' name='MAX_FILE_SIZE' value='50000'/> <!--campo oculto donde pones el tamaño del archivo de subida-->
                <br><br><br>
    <input type="submit" value ="Guardar"/>
    </fieldset>
</form>

<a href="/administracion.php">Salir</a>
<?php
    //si pulsas guardr se guarda
    if(count($_POST)!=0){

        echo 'Guardar.';


    }else{
        //nada que guardar
		echo 'Error en la Subida.';

    }
 ?>
