<?php

require_once("./html.php");
HTML::abrirhtml("Nuevo Entrada","<link rel='stylesheet' type='text/css' href='./../css/estilo.css'");

$conectar = new PDO ("mysql:dbname=Muebles;host=127.0.0.1","root","");
                $conectar -> setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $datos = $conectar ->query ("select NombreUsuario, ContrasenaUsuario from usuarios");

?>

<!-- creamos la cabecera con 3 div donde va el logo, buscador y redes sociales y acceso de los usuarios.-->
        <div id="cabecera1">
            <!--div para letrero de la empresa -->
            <div id="letrero">
                <img src="../img/PortadaMuebleBBB - copia.png" />
            </div>
            <!-- div para buscador de la empresa -->
            
            <!-- div para iconos administracion -->
            <div id ="administracion">
                <div id="registro">
                <a href="./../index.php" title="Volver">Salir de Administracion </a>
                </div>
            </div>
       </div>


<h1>Nueva Entrada . . .<h1>

<label>Elige un opcion para agregar un producto o una categoria</label>
   <select name="programa">    
       <option value="producto" selected="selected">PRODUCTO</option>
       <option value="categoria">CATEGORIA</option>
   </select>

 <form action='' method='POST'>


        <br>
        <label> ID</label>
        <input type='text' name='id' id='id' value= '' />
        <br/> 
        <label> Nombre Del Producto</label>
        <input type='text' name='nProducto' id='nProducto' value= '' />
        <br/> 
        <label> Descripcion del Producto</label>
        <input type='text' name='dProducto' id='dProducto' value= '' />
        <br/> 
        <label> Precio</label>
        <input type='text' name='Precio' id='Precio' value= '' />
        <br/> 
        <label> Imagen</label>
        <input type='file' name='fichero'  value= 'Seleccione un fichero' />
        <input type='hidden' name='MAX_FILE_SIZE'value='50000'/> <!--campo oculto donde pones el tamaño del archivo de subida-->
        <input type='submit' value='Enviar'>

 </form>


<?php
/*$IDCategoria="";
$IDCategoria=$_GET["IDCategoria"];*/
//require_once("./../categorias/altaCategorias.php");
 if (isset($_GET["categoria_idcategoria"])) {
    $IDCategoria = $_GET["categoria_idcategoria"];
}else {
    $IDCategoria = "";
}

try
{
    $conexion=new PDO("mysql:dbname=muebles;host=127.0.0.1","root","");
    //Configurar conexion para lanzar excepciones PDO
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $datos=$conexion->query("select * from productos where ProductosID");
    RecorrerConFetch($datos);
    //$mostrar=$datos->fetch();
}
catch (PDOException $e)
{
//controlar error
    echo $e ->getMessage();
}


function RecorrerConFetch($datos)
{


    echo "<center>";
    echo "<table border 5px>";
    echo "</center>";
    echo "<font color='green'><h1>LISTADO PRODUCTOS</h2>";
    echo "<tr>";
    echo "<td>";
    echo "<h4>IdProducto";
    echo "</td>";
    echo "<td>";
    echo "<h4>Nombre Producto";
    echo "</td>";
    echo "<td>";
    echo "<h4>IdCategoria";
    echo "</td>";
    echo "<td>";
    echo "<h4>Imagen";
    echo "</td>";
    echo "<td>";
    echo "<h4>Descricpion";
    echo "</td>";
    echo "<td>";
    echo "<h4>Precio";
    echo "</td>";
    echo "<br>";


    while($productos=$datos->fetch())
    {

        echo "<tr>";
        echo "<td>";
        echo "".$productos["idproducto"];
        echo "</td>";
        echo "<td>";
        echo "".$productos["descripcion_producto"];
        echo "</td>";
        echo "<td>";
        echo "".$productos["categoria_idcategoria"];
        echo "</td>";

        echo "<td>";
        echo "<img src='data:imagenessubidas/png;base64,".base64_encode($productos['pictureproductos'])."    '/>";
        echo "</td>";


        echo "<td>";
        echo "".$productos["nombreproducto"];
        echo "</td>";
        echo "<td>";
        echo "".$productos["precioproducto"];
        echo "</td>";


        echo '<td><a href="editarProductoSin.php?idproducto='.$productos["idproducto"].'"><img src="imagenes/modificar.jpg" border="0"> </a>';
        echo '<a href="borrarProductosSin.php?idproducto='.$productos["idproducto"].'"><img src="imagenes/eliminar.jpg" border="0"></a></td>';
        echo "</tr>";
        echo "<br>";

    }
}
?>
<?php


    $descripcion="";
    $error=false;

    $nombre="";
        if(!empty($_POST))
        {
            //hemos realizado el envío


            $descripcion=$_POST["descripcion_producto"];
            $error=false;
            $precio=$_POST["precioproducto"];

            $nombre=$_POST["nombreproducto"];




            if ($descripcion=="")
            {
                $mensajeDescripcion="Rellene el campo descripcion";
                $error=true;
            }
            if ($precio=="")
            {
                $mensajePrecio="Rellene el campo precio";
                $error=true;
            }

            if ($nombre=="")
            {
                $mensajeNombre="Rellene el campo nombre";
                $error=true;
            }
        }
    ?>



        <form method="POST" name="fvalida" action="" enctype="multipart/form-data">
            <table border 2px>
            <br>
                <tr>
                <td style="text-align:right;"><h4>ID CATEGORIA:
                <?php
                    echo "<select type='number' id='idcategoria' name='idcategoria'>";
                    foreach($conexion->query("select DISTINCT CategoriasID from categorias") as $IDCategoria) {
                    echo '<option>'.$IDCategoria["idcategoria"].'</option>';
                    }
                    echo "</select>";
                ?>


                <td style="text-align:right;"><h4>DESCRIPCION: <br><textarea class="<?php echo isset($mensajeDescripcion)?'inputError':''?>" rows="4" cols="25" id="descripcion_producto" name="descripcion_producto" require></textarea>
                <?php echo isset($mensajeDescripcion)?"<font color='red'><span class='spanError'>$mensajeDescripcion</span>":""?></td>
                <td><h4>SUBIR FOTO <br><input type="file"  name="archivo" require/></td>
                </tr>
                <tr>
                <td style="text-align:right;"><h4>PRECIO: <br><input class="<?php echo isset($mensajePrecio)?'inputError':''?>" align='right' type="number" id="precioproducto" name="precioproducto" require/>
                <?php echo isset($mensajePrecio)?"<font color='red'><span class='spanError'>$mensajePrecio</span>":""?></td>

                <td style="text-align:right;"><h4>NOMBRE:<br><input class="<?php echo isset($mensajeNombre)?'inputError':''?>" type="text" id="nombreproducto" name="nombreproducto" require/>
                <?php echo isset($mensajeNombre)?"<font color='red'><span class='spanError'>$mensajeNombre</span>":""?></td>
                </tr>
            </table>
            <table border 2px>
                <tr>
                <td style="text-align:center;"><input type="submit" name="ENVIAR" value="Añadir"><td>
                </tr>
            </table>

            <br>
            <br>
            <table border 2px>
                <tr>
                    <td><a href="../administracion.html">Volver a Modo Administrador</a></td>
                </tr>
                <tr>
                    <td><a href="../index.html">Volver a Home</a></td>
                </tr>
            </table>
        </form>
        <?php
            if((count($_POST)!=0) && (!$error))
            {
                $exito=FALSE;
                //var_dump($_FILES)
                if(count($_FILES)>0)
                {
                    $destino="imagenessubidas/".$_FILES["archivo"]["name"];
                    if(move_uploaded_file($_FILES["archivo"]["tmp_name"],$destino))
                    {
                        $exito=TRUE;
                        //echo "<script>alert('Archivo subido con exito')</script>";
                    }

                            $ft=file_get_contents($destino);
                            $sql = $conexion->prepare('INSERT INTO productos VALUES (?,?,?,?,?,?)');
                            $sql->execute(array(0,$_POST["descripcion_producto"], $_POST["idcategoria"],$ft,$_POST["nombreproducto"], $_POST["precioproducto"] ));
                           // header("location:./altaProductosSin.php");


                }
            }

            ?>










<?php

Html::CerrarHtml();


?>
