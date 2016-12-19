<?php

require_once("./html.php");
HTML::abrirhtml("Nueva Categoria","<link rel='stylesheet' type='text/css' href='./../css/estiloAD.css'");
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
					<?php
				echo "<h5>Hola ".$_SESSION["usuario"]."</h5>";
				?>
                </div>
            </div>
       </div>


<h1>Nueva Categoria. . .</h1>
<form method="POST" name="fvalida" action="" enctype="multipart/form-data">
            <br>


                <label> ID Categorias</label>
                <input class="<?php echo isset($mensajeNombre)?'inputError':''?>" type="text" id="IdCateg" name="IdCateg" />
                <?php echo isset($mensajeNombre)?"<font color='red' font-size:'12px'><span class='spanError'>$mensajeNombre</span>":""?>

                <label> Nombre Categoria</label>
                <input class="<?php echo isset($mensajeNombre)?'inputError':''?>" type="text" id="nCateg" name="nCateg" />
                <?php echo isset($mensajeNombre)?"<font color='red'><span class='spanError'>$mensajeNombre</span>":""?><br><br>


               <label> Descripcion Categoria</label>
               <textarea class="<?php echo isset($mensajeDescripcion)?'inputError':''?>"  id="dCateg" name="dCateg" ></textarea>
                <?php echo isset($mensajeDescripcion)?"<font color='red'><span class='spanError'>$mensajeDescripcion</span>":""?><br><br>


               <input class="anade" type="submit" name="ENVIAR" value="Añadir">
            <br>
            <br>
        </form>


<?php
	echo "<h2>Listado de Categorias</h2>";

	try{
		 $conectar = new PDO ("mysql:dbname=Muebles;host=127.0.0.1","root","");
		 $conectar -> setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		if ( empty($_POST)){
			listaCategorias($conectar);
		}else{

		$descripcion="";
		$error=false;
		$idCateg="";
		$nombre="";
				//hemos realizado el envío
            $idCateg=$_POST["IdCateg"];
            $error=false;
            $descripcion=$_POST["dCateg"];
            $nombre=$_POST["nCateg"];

            if ($descripcion=="")
            {
                $mensajeDescripcion="Rellene el campo descripcion";
                $error=true;
			}

            if ($nombre=="")
            {
                $mensajeNombre="Rellene el campo nombre";
                $error=true;
            }
	    //Listado de los productos que Tenemos actualmente en la base de datos

   //codigo de subida de archivos

    $exito =False; // para saber si el archivo se ha subido de verdad, creamos un booleano que true y false



			$conexiones = new PDO("mysql:dbname=Muebles;host=127.0.0.1","root","");
            $conexiones -> setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $subida = $conectar -> prepare("insert into categorias values (?,?,?)");
            $subida->execute(array($idCateg,$nombre,$descripcion));



                         listaCategorias($conectar);
		}

			}catch(PDOException $e){
		   //controlar los mensajes de error
				echo "Se ha producido un error por que no existe la base de datos Muebles";
				echo "<br>";
			}
Html::CerrarHtml();



					   function listaCategorias($conectar){
                //consulta de la base de datos de muebles con las Categorias;
                  $datos = $conectar ->query ("select CategoriasID, NombreCategorias, DescripcionCategorias from categorias");

                  echo "<table border=1px solid black>";
                  echo "<tr>";
					  echo "<td>C&oacute;digo Categorias</td>";
					  echo "<td>Nombre Categorias </td>";
					  echo "<td>Descripcion Categorias</td>";
					  echo "<td colspan='2'>Tareas de actualizacion</td>";
                  echo "</tr>";

 				while ($categorias = $datos ->fetch()){
				 echo "<tr>";

                        echo "<td>".$categorias["CategoriasID"]."</td>";
                        echo "<td>".$categorias["NombreCategorias"]."</td>";
                        echo "<td>".$categorias["DescripcionCategorias"]."</td>";

						echo "<td ><a href='modificarCategorias.php?CategoriasID=".$categorias["CategoriasID"]."'>Modificar</a></td>";
						echo "<td><a href='eliminarCategorias.php?CategoriasID=".$categorias['CategoriasID']."'>Borrar</a></td> ";

                        }
                 echo "</tr>";
                 echo "</table>";

				 }



?>
