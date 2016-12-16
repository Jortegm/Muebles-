<?php
//ob_start();

?>
<html>
<head>
<title>Borramos los datos en la base de datos</title>
</head>
<body>
<?php
require_once("./nuevaCategoria.php");

    $datos=$conectar->prepare("delete from categorias where CategoriasID=?");
    $datos->execute(array($_GET["CategoriasID"]));
    header("location:./nuevaCategoria.php");
?>
</body>
</html>
<?php
//ob_end_flush();
?>
