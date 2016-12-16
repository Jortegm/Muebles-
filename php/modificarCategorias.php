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

		try{
		 $conectar=new PDO("mysql:dbname=Muebles;host=127.0.0.1","root","");//---,usuario, contraseña
		 $conectar->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		 $datos = $conectar -> prepare ("update categorias SET CategoriaID=?, NombreCategoria=?, DescripcionCategorias=? WHERE CategoriasID = ?");
		 $idCateg = $_GET["CategoriasID"];
		 $datos = $conectar -> query ("select * from categorias where CategoriasID=".$idCateg);
		 $mostrar = $datos ->fetch();
		}catch (PDOException $e){

			echo $e->getMessage();

		}
?>
<h1>Modificar Producto. . .</h1>
<?php

    $idCateg="";
    $nombre="";
    $descripcion="";

	   if(!empty($_POST)) {
        //Realizamos el envío
          $idCateg=$_POST["IdCateg"];
  		  $nombre=$_POST["nombre"];
  		  $descripcion=$_POST["descripcion"];


              if ($idCateg==""){
                 $mensajeDescripcion="Rellene el campo descripcion";
                 $error=true;
              }
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

                <div id="registro">
                <a href="./../index.php" title="Volver">Salir de Administracion </a>
                <a href="./administrador.php" title=" Volver a Administracion"> Ir a la Administracion </a>
                </div>
				<?php
				echo "<h5>Hola ".$_SESSION["usuario"]."</h5>";
				?>
            </div>
       </div>


 <form action='' method='POST'>
    <fieldset>
	 <legend>Modificar Datos Categoria</legend>
    <label for='Id'>ID de la Categoria: </label>
	<input type="number" name="idcategoria" readonly value="<?php echo $mostrar['idCateg']?>">    <br>
   <label for='Categoria'>Nombre Categoria: </label>
    <input type='text' name='nCateg' value='<?php echo $auxNombre ?>'/>
    <br>
	<label for='Categoria'>Descripcion Categoria: </label>
    <input type='text' name='dCateg' value='<?php echo $auxDescripcion ?>'/>
    <br>
    <input type="submit" value ="Guardar"/>
    </fieldset>
</form>

<a href="/administracion.php">Salir</a>
<?php

	if((count($_POST)!=0) && (!$error)){
		if (count($_POST)!=0){
			$exito=FALSE;
			//echo "<script>alert('Archivo subido con exito')</script>";
			$datos = $conexion->prepare('UPDATE productos set IdCateg=?, nCateg=?, dCateg=?  where IdCateg=?');
			$datos->execute(array( $_POST["IdCateg" ],$_POST["nCateg"],$_POST["dCateg"]));
		}
	}

 ?>
