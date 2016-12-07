<?php

require_once("./html.php");
HTML::abrirhtml("Accede","<link rel='stylesheet' type='text/css' href='./../css/estilo.css'");


?>

<div id ="centrado">
            <div id="centrarLogo">
                <img src="./../img/PortadaMuebleBBB - copia.png" />
            </div>
        <div id ="loginEntrada">
            <form action='' method='POST'>
                    <fieldset>
                       
                    <legend>Muebles BBB</legend>
                    <br/>
                    <br/>
                    <label>Usuario</label>
                    <input type="text" name="usuario" id="usuario" value= " " />
                    <br/>
                    <br/>
                    <label>Contraseña</label>
                    <input type="password" name="contrasena" id="contrasena" value= " " />
                    <br/>
                    <br/>
                    <input type='submit' value='Enviar'>
                     <div id ="salir">
                            <a href="./../index.php"><img src="./../img/salir.png" title="Volver a Página Principal"/></a> 
                        </div>
                    </fieldset>
            </form>
        </div>
</div>