<?php
session_start();
if (isset($_SESSION['user_rut'])){
    if ($_SESSION["id_rol"] == '4'){
            require_once "../../assets/php/connection.php";
            $connection=connection();
            $requestId=$_POST['requestId'];
            $requestType=$_POST['requestType'];
            $requestTitle=$_POST['requestTitle'];
            $requestJustify=$_POST['requestJustify'];
            $voteDate=$_POST['voteDate'];
            $InternalVote=$_POST['InternalVote'];
            $sqlCurrentState="SELECT solicitudes.id_estado_actual FROM `solicitudes` WHERE solicitudes.id='$requestId' ";
            $resultCurrentState=mysqli_query($connection,$sqlCurrentState);

            $states=mysqli_fetch_row($resultCurrentState);
            $currentState=$states[0];

            if($currentState=="1" || $currentState=="14"){
                $sqltype="SELECT solicitudes.tipo as tipo_anterior FROM solicitudes WHERE solicitudes.id='$requestId'";
                $resultType=mysqli_query($connection,$sqltype);
    
                $oldType="";
                while($var=mysqli_fetch_row($resultType)){
                    $oldType=$oldType.$var[0];
                }
    
                $sqlNumReq="SELECT COUNT(requerimientos.id) FROM requerimientos WHERE id_solicitud='$requestId'";
                $resultNumReq=mysqli_query($connection,$sqlNumReq);
                
                $numReq="";
                while($req=mysqli_fetch_row($resultNumReq)){
                    $numReq=$numReq.$req[0];
                }
    
                $sql="UPDATE solicitudes SET tipo = '$requestType', titulo = '$requestTitle', 
                justificacion = '$requestJustify', voto_interno='$InternalVote', fecha_voto_interno='$voteDate' WHERE solicitudes.id = '$requestId'";
    
                if ($numReq=="0"){
                    echo $result=mysqli_query($connection,$sql);      
                    if(!$result){
                        echo $sql;
                        //die('fallo el servidor :('.mysqli_fetch_array($connection));
                    }
                }else{
                    if($oldType==$requestType){
                        echo $result=mysqli_query($connection,$sql);      
                        if(!$result){
                            echo $sql;
                            //die('fallo el servidor :('.mysqli_fetch_array($connection));
                        }
                    }else{
                        echo "Ya no puedes cambiar el tipo de solicitud porque ya agregaste requerimientos en la solicitud";
                    }
                }
            }else{
                echo "En el estado en que se encuentra la solicitud no es posible la acción indicada";
            }
    }else{
        echo "No estás autorizad@ para listar Presupuestos";
    }
}else{
    echo "No se detecta su sesión, por favor inicie sesión";
    header("Location: ../../inicio_sesion.php"); 
}
?>