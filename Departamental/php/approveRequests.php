<?php
    /*session_start();
    if (isset($_SESSION['user_rut'])){
        if ($_SESSION["id_rol"] == '2'){
            require_once "../../assets/php/connection.php";
            $connection=connection();
            date_default_timezone_set("America/Santiago");
            $get_date = getdate();
            $date = ($get_date['year']."-".$get_date['mon']."-".$get_date['mday']);
            $time = ($get_date['hours'].":".$get_date['minutes'].":".$get_date['seconds']);
            $date_time=$date.' '.$time;
        }else{
            echo "no estas autorizad@ para enviar la Solicitud";
        }
    }else{
        echo "No se detecta su sesión, por favor inicie sesión";
        header("Location: ../../inicio_sesion.php");
    }*/
    
    function create_route(){
        $route='../assets/uploads/docs/actas/';
        date_default_timezone_set("America/Santiago");
        $get_date = getdate();
        $date = ($get_date['year']."-".$get_date['mon']."-".$get_date['mday']);
        $time = ($get_date['hours'].":".$get_date['minutes'].":".$get_date['seconds']);
        $date_time=$date.'_'.$time;
           
        $new_url='acta'.$_SESSION['rut_fundacion'].'_'.$date_time.'.pdf';        
        $routeOut=$route.$new_url;
        return $routeOut;
    }

    echo create_route();


?>