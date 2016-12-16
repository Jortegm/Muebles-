<?php
//pagina donde sea creará las opciones de administracion para los administradores del sitio.

require_once("./html.php");
HTML::abrirhtml("MueblesBBB","<link rel='stylesheet' type='text/css' href='./../css/estilo.css'");

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

//abrimos y nos conectamos la base de datos de Muebles:
    
    try {
        //nos conectamos a la base de datos:
        $conectar = new PDO ("mysql:dbname=Muebles;host=127.0.0.1","root","");
        //añadimos los atributos;
        $conectar -> setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>
<div id="contenedor">

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
				<?php
				echo "<h5>Hola ".$_SESSION["usuario"]."</h5>";
				?>
            </div>
       </div>
<div id="Cont">
   <h1>Administracion</h1>

        <div id ="listaConfiguracion">
           <br/>
           <br/>
           <a> Administracion </a>
           <ul style="list-style-type:square">
                <li><a href="./nuevoProducto.php">Nuevo Producto</a></li>
			   <li><a href="./nuevaCategoria.php">Nueva Categoria</a></li>

            </ul>
            <a>Listados</a><br/>
            <ul style ="list-style-type:square">
                <li><a href="./ListadoCategorias.php">Listado de Categorias</a></li>
                <li><a href="./listadoproductos.php">Listado de Producto</a></li>
            </ul>
        </div>
            <div id="mostrarConfiguracion"> 
            
           
            </div>
</div>

<?php
       }catch (PDOException $e) {
        //controlar los mensajes de error
        echo "Se ha producido un error por que no existe la base de datos Muebles"; 
        echo "<br>"; 
    }
    
    HTML::CerrarHtml();
       
?>
