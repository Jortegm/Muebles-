<?php

require_once("./html.php");
HTML::abrirhtml("Accede","<link rel='stylesheet' type='text/css' href='./../css/estilo.css'");

    try{
        function login($usuario,$passwd){
                /*asignar valores pertinentes al crear el objeto PDO en mi caso prueba*/
                $conectar = new PDO ("mysql:dbname=Muebles;host=127.0.0.1","root","");
                $conectar -> setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $datos = $conectar ->query ("select NombreUsuario, ContrasenaUsuario from usuarios");
                $datos->bindParam(':usuario',$usuario);
                $datos->execute();
                $row = $datos->fetch(PDO::FETCH_ASSOC);
                if ($row["ContrasenaUsuario"]=="" || $row["ContrasenaUsuario"]!=$passwd){
                    return 0; // usuario/contraseña incorrecta
                }
                    else return 1; // usuario/contraseña correcta
            }
        if(!empty($_POST)){
            $user = $_POST["usuario"];
            $psswd = $_POST["contrasena"];

            if (login($user,$psswd)){
            //Si coninciden usuario y congtraseña
                session_start(); //iniciamos la sesion
                $_SESSION["logeado"]=1; //creamos una variable logeado=1 (1)
                $_SESSION["usuario"]=$_POST["usuario"];
			   //Creo la cookie
			   setcookie("sesion",date("j-n-Y H:i:s"));
			  /*almaceno el usuario como variable de sesion para utilizarlo luego en mi aplicacion*/
                header ("Location: administrador.php"); //todo es correcto estoy validado abro pagina de Administracion
             }
            else {
                //si no existe se va a login.php
                echo "Usuario y Constraseña no Validos";  
                }
        }
            /*esta funcion devuelve 1 si el par usuario/contraseña
            coinciden con los almacenados en la base de datos. Utilizo PDO para conectar con la base de datos.
             Además uso una consulta paramétrica para evitar SQLInjection
            */
            




?>
<!--Para acceder como administrador a la zona Administrativa de la pagina
 usuario = admin;
 psswd   = 1234 ;-->

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
                    
                    <br/>                
                    <div id ="salir">
                       <a href="./../index.php"><img src="./../img/salir.png" title="Volver a Página Principal"/></a> 
                    </div>
                    </fieldset>
            </form>
        </div>
</div>


<?php

}catch (PDOException $e) {
    echo "Lo Sentimos, El usuario no es Valido.";
    echo "<br/>";
    echo "Por Favor, introduzca una contraseña Valida o Registresé.";
    echo "<br/>";
}

Html::CerrarHtml();

?>
