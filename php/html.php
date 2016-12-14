<?php
/**
*clase creada para añadir las cabeceras de html con un titulo y link de Css y cerrar el html
*@param $titulo se añade un titulo a la pagina
*#param $link se utilizara para añadir el link de CSS
*/
class Html {
    public static function AbrirHtml($titulo, $link)
    {
        echo "<!DOCTYPE html>";
        echo "<html><head><title>$titulo</title>";
        echo "<meta charset='UTF-8'>".$link.">";
        echo "</head><body>";
    }

    public static function CerrarHtml()
    {
        echo "</body></html>";
    }


    public static function errorDiv(){
        alert("USUARIOS O CONTRASEÑA NO VALIDOS");
    }
}
