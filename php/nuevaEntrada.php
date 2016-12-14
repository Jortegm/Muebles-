<?php

require_once("./html.php");
HTML::abrirhtml("Nuevo Entrada","<link rel='stylesheet' type='text/css' href='./../css/estilo.css'");

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
    <fieldset>
        <legend id = nuevaEntrada>Nuevo Producto</legend>
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
        <input type='text' name='img' id='img' value= '' />
        <br/> 
        <input type='submit' value='Enviar'>
    </fieldset>
 </form>











<?php

Html::CerrarHtml();


?>