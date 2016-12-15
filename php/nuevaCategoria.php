<?php

require_once("./html.php");
HTML::abrirhtml("Nuevo Entrada","<link rel='stylesheet' type='text/css' href='./../css/estiloAD.css'");


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
            </div>
       </div>


<h1>Nueva Categoria. . .</h1>


<?php

		 if (isset($POST["idCategorias"])) {
			$idCategoria = $POST["idCategorias"];
		}else {
			$idCategoria = "";
		}

			try {
				 $conectar = new PDO ("mysql:dbname=Muebles;host=127.0.0.1","root","");
				 $conectar -> setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


			}catch(PDOException $e){
		   //controlar los mensajes de error
				echo "Se ha producido un error por que no existe la base de datos Muebles";
				echo "<br>";
			}
  function listaCategorias($conectar){
                //consulta de la base de datos de muebles con las Categorias;
                  $datos = $conectar ->query ("select CategoriasID, NombreCategorias, DescripcionCategorias,ProductosID from Categorias");
                $mysqli = new mysqli("localhost", "root", "", "Muebles");

                 if ( $mysqli ->query("select CategoriasID from categorias") == false){
                     echo"<h2>No has insertado todavia ningún categoria</h2>";
                 }else{
                  echo "<table border=1px solid black>";
                  echo "<tr>";
                  echo "<td>C&oacute;digo Categorias</td>";
                  echo "<td>Nombre Categoria </td>";
                  echo "<td>Descripcion Categorias</td>";
				  echo "<td colspan='2'>Tareas de actualizacion</td>";
                  echo "</tr>";
                  echo "<tr>";


                        while ($categorias = $datos ->fetch()){
                        echo "<td>".$categorias["CategoriasID"]."</td>";
                        echo "<td>".$categorias["NombreCategorias"]."</td>";
                        echo "<td>".$categorias["DescripcionCategorias"]."</td>";
                        echo "<td>".$categorias["ProductosID"]."</td>";
						echo "<td><a href='modificar.php?ProductosID=".$categorias['CategoriasID']."'>Modificar</a></td>";
						echo "<td><a href='borrar.php?ProductosID=".$categorias['CategoriasID']."'>Borrar</a> </td> ";

                        }
                 }

                 echo "</tr>";
	  			 echo "</table>";
            }
?>
<?php

       if(!empty($_POST)){
            //hemos realizado el envío
		   $idCategorias = $_POST["idCategorias"];
			$nombre=$_POST["nCategorias"];
            $descripcion=$_POST["dCategorias"];
            $error=false;

			if ($nombre==""){
                $mensajeNombre="Rellene el campo nombre";
                $error=true;
            }


            if ($descripcion==""){
                $mensajeDescripcion="Rellene el campo descripcion";
                $error=true;
            }

         }
    ?>



        <form method="POST" name="fvalida" action="" enctype="multipart/form-data">
            <br>
              <label> ID</label>
                <input class="<?php echo isset($mensajeNombre)?'inputError':''?>" type="text" id="idCategorias" name="idCategorias" />
                <?php echo isset($mensajeNombre)?"<font color='red' font-size:'12px'><span class='spanError'>$mensajeNombre</span>":""?><br><br><br>

                <label> Nombre de la Categoria</label>
                <input class="<?php echo isset($mensajeNombre)?'inputError':''?>" type="text" id="nCategorias" name="nCategorias" />
                <?php echo isset($mensajeNombre)?"<font color='red'><span class='spanError'>$mensajeNombre</span>":""?><br><br>


               <label> Descripcion de la Categoria</label>
               <textarea class="<?php echo isset($mensajeDescripcion)?'inputError':''?>"  id="dCategorias" name="dCategorias" ></textarea>
                <?php echo isset($mensajeDescripcion)?"<font color='red'><span class='spanError'>$mensajeDescripcion</span>":""?><br><br>

               <input class="anade" type="submit" name="ENVIAR" value="Añadir">
            <br>
            <br>
        </form>
        <?php
	//Listado de los productos que Tenemos actualmente en la base de datos
		echo "<h2>Listado de Nuestras Categorias</h2>";
                         listaCategorias($conectar);

			$conexiones = new PDO("mysql:dbname=northwind;host=127.0.0.1","root","");
            $conexiones -> setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $subida =$conexiones -> prepare("insert into productos values (?,?,?)");
            $subida->execute( $idCategorias,$nombre,$descripcion);


?>










<?php

Html::CerrarHtml();


?>
