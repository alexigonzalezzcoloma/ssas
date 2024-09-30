<?php
        $concept=array();
        $completeList=$_POST["reqid"];
        $num_req=count($completeList); 

        if(isset($_POST["preComission"])){
            for ($i = 0; $i < $num_req; $i++) {
                array_push($concept,"Aprobar");
            }
        }

        if(isset($_POST["postComission"])){
            if (isset($_POST["checkrequest"])){
                $approvedList=$_POST["checkrequest"];
                $lenAList=count($approvedList);

                if($approvedList==$completeList){
                    for ($j = 0; $j < $num_req; $j++) {
                        array_push($concept,"Aprobada");
                    }
                }else{
                    for ($k = 0; $k < $num_req; $k++) {
                            if (in_array($completeList[$k], $approvedList)) {
                                array_push($concept,"Aprobada");
                            }else{
                                array_push($concept,"Rechazada");
                            }
                    }
                }

            }else{
                $approvedList=array();
                for ($l = 0; $l < $num_req; $l++) {
                    array_push($concept,"Rechazada");
                }
                
            }
        }

?>