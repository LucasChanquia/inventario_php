<?php

require_once "main.php";

$product_id = limpiar_cadena($_POST['img_del_id']);

// Verificar si existe producto

$check_producto = conexion();
$check_producto = $check_producto->query("SELECT * FROM producto WHERE producto_id='$product_id'");

if ($check_producto->rowCount() == 1) {
    $datos = $check_producto->fetch();
} else {
    echo '
    <div class="notification is-danger is-light">
        <strong>¡Ocurrio un error inesperado!</strong><br>
        La IMAGEN del producto no existe en el sistema
    </div>
';
    exit();
}
$check_producto = null;

# Directorio de imagenes

$img_dir = "../img/producto/";

chmod($img_dir, 0777);

if (is_file($img_dir . $datos['producto_foto'])) {

    chmod($img_dir . $datos['producto_foto'], 0777);

    if (!unlink($img_dir . $datos['producto_foto'])) {
            echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                Eroor al intentar eliminar la imagen del producto, por favor intente nuevamente
            </div>
        ';
        exit();
    }
}   

// Actualizar producto

$actualizar_producto=conexion();
$actualizar_producto=$actualizar_producto->prepare("UPDATE producto SET producto_foto=:foto WHERE producto_id=:id");

$marcadores = [
    ":foto" => "",
    ":id" => $product_id,
];

if($actualizar_producto->execute($marcadores)){
    echo '
        <div class="notification is-info is-light">
            <strong>¡IMAGEN ELIMINADA!</strong><br>
            La imagen del producto se eliminó con éxito,  Pulse Aceptar para recargar los cambios

            <p class="has-text-centered pt-5 pb-5">
            <a href="index.php?vista=product_img&product_id_up='.$product_id.'" class="button is-link is-rounded">Aceptar</a>
            </p>
        </div>
';
exit();
}else{
    echo '
    <div class="notification is-warning is-light">
        <strong>¡IMAGEN ELIMINADA!</strong><br>
        Ocurrieron algunos inconvenientes, sin embargo, la imagen del producto ha sido eliminada. Pulse Aceptar para recargar los cambios

        <p class="has-text-centered pt-5 pb-5">
        <a href="index.php?vista=product_img&product_id_up='.$product_id.'" class="button is-link is-rounded">Aceptar</a>
        </p>
    </div>
';
exit();
}
$actualizar_producto=null;