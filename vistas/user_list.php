<div class="container is-fluid mb-6">
    <h1 class="title">Usuarios</h1>
    <h2 class="subtitle">Lista de usuarios</h2>
</div>

<div class="container pb-6 pt-6">

<?php
 
 require_once "./php/main.php";

 // Eliminar usuario
 if(isset($_GET["user_id_del"])){
    require_once "./php/usuario_eliminar.php";
 }

 if(!isset($_GET["page"])){
    $pagina=1;
 }else{
    $pagina=(int) $_GET["page"];
    if($pagina<=1){
        $pagina=1;
    } 
 };

 $pagina=limpiar_cadena($pagina);
 $url="index.php?vista=user_list&page=";
 $registros=15;
 $busqueda="";

 require_once "./php/usuario_lista.php";

 ?>

    

    <nav class="pagination is-centered is-rounded" role="navigation" aria-label="pagination">
        <a class="pagination-previous" href="#">Anterior</a>

        <ul class="pagination-list">
            <li><a class="pagination-link" href="#">1</a></li>
            <li><span class="pagination-ellipsis">&hellip;</span></li>
            <li><a class="pagination-link is-current" href="#">2</a></li>
            <li><a class="pagination-link" href="#">3</a></li>
            <li><span class="pagination-ellipsis">&hellip;</span></li>
            <li><a class="pagination-link" href="#">3</a></li>
        </ul>

        <a class="pagination-next" href="#">Siguiente</a>
    </nav>

</div>