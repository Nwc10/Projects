<?php

include_once 'db.php';

//comprueba si un evento es de un usuario
function comprobarEventoUsuario($idUsuario, $idEvento){
    $link=conexion();
    $sql="select * from usuarios_eventos where id_usuario = $idUsuario and id_evento = $idEvento";
    $result=mysqli_query($link, $sql);
    $numFilas= mysqli_num_rows($result);
    if ($numFilas>0){
    return true;
    }else{
     return false;   
    }
}


function selectEventosActivos($id){
    $link=conexion();
    $sql="select e.nombre , e.id from eventos as e inner join usuarios_eventos ue on ue.id_evento=e.id inner join usuarios u on u.id=ue.id_usuario where u.id=$id and e.fecha_baja is NULL";
    $result=mysqli_query($link, $sql);
    $numFilas= mysqli_num_rows($result);
    $arrayDatos=array();
    for($i=0;$i<$numFilas;$i++){
        $arrayDatos[]=mysqli_fetch_assoc($result);
    }
    desconexion($link);
    return $arrayDatos;
}

function selectEventosInactivos($id){
    $link=conexion();
    $sql="select e.nombre , e.id from eventos as e inner join usuarios_eventos ue on ue.id_evento=e.id inner join usuarios u on u.id=ue.id_usuario where u.id=$id and e.fecha_baja is not NULL";
    $result=mysqli_query($link, $sql);
    $numFilas= mysqli_num_rows($result);
    $arrayDatos=array();
    for($i=0;$i<$numFilas;$i++){
        $arrayDatos[]=mysqli_fetch_assoc($result);
    }
    desconexion($link);
    return $arrayDatos;
}
function selectEvento($id){
    $link=conexion();
    $sql="select nombre from eventos where id=$id";
    $result=mysqli_query($link, $sql);
    desconexion($link);
    return mysqli_fetch_assoc($result);
}


//function selectEventos($id){
//    $activos = selectEventosActivos($id);
//    $inactivos = selectEventosInactivos($id);
//    $response= array(
//        "status"=> 200,
//        "activos"=> $activos,
//        "inactivos"=>$inactivos
//    );
//    echo json_encode($response,true);
//}
//
//if(isset($_POST['id'])&&!empty($_POST['id'])){
//    selectEventos($_POST['id']);
//}
?>