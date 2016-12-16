<?php
//ob_start();

?>
<html>
<head>
<title>Borramos los datos en la base de datos</title>
</head>
<body>
<?php
require_once("./nuevoProducto.php");

    $datos=$conectar->prepare("delete from productos where ProductoID=?");
    $datos->execute(array($_GET["ProductosID"]));
    header("location:./nuevoProducto.php");
?>
</body>
</html>
<?php
//ob_end_flush();
?>
