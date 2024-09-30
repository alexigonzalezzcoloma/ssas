function chargeDim(destiny){
    destiny=$('#'+destiny);
    $.ajax({
        url: 'php/chargeDimentions.php',
        type: 'GET',
        success: function(response){		
            let items = JSON.parse(response);
            let template = '';
            items.forEach(items => {
                template += ` 
                <option value="${items.id_dim}">${items.nombre_dim}</option>
                `
                });
            destiny.html(template);
        }
    });   
}
function chargeSubdim(destiny,dimensionId){
    destiny=$('#'+destiny);
    $.ajax({
        url: 'php/chargeSubdimentions.php',
        type: 'POST',
        data: {dimensionId},
        success: function(response){		
            let items = JSON.parse(response);
            let template = '';
            items.forEach(items => {
                template += ` 
                <option value="${items.id_subd}">${items.nombre_subd}</option>
                `
                });
            destiny.html(template);
        }
    });    
}
function chargeActions(destiny,subdimensionId){
    destiny=$('#'+destiny);
    data="subdimensionId="+subdimensionId;
    $.ajax({
        url: 'php/chargeActionsPME.php',
        type: 'POST',
        data: data,
        success: function(response){		
            let items = JSON.parse(response);
            let template = '';
            items.forEach(items => {
                template += ` 
                <option value="${items.id_act}">${items.nombre_act}</option>
                `
                });
            destiny.html(template);
        }
    });   
}

function listSubdimensions(destiny,dimId){
    destiny=$('#'+destiny);
    $.ajax({
        url: 'php/listSubdimensions.php',
        type: 'POST',
        data: {dimId},
        success: function(response){		
            let moves = JSON.parse(response);
            let template = '';
            moves.forEach(moves => {
                template += ` <tr>
                                <td>${moves.nombre_subdim}</td>
                               </tr>                                            
                `
                });
            destiny.html(template);
        }
    });
}

function listPMEActionsbyYear(year){
    thisdata="year="+year;
    $.ajax({
        url: 'php/listPMEActionsbyYear.php',
        type: 'POST',
        data: thisdata,
        success: function(response){		
            let items = JSON.parse(response);
            let template = '';
            items.forEach(items => {
                template += `
                <tr>
                    <td>${items.id_accion}</td>
                    <td>${items.nombre_accion}</td>
                    <td>${items.descripcion_accion}</td>
                    <td>${items.nombre_subdimension}</td>
                    <td>${items.fecha_inicio}</td>
                    <td>${items.fecha_fin}</td>
                    <td>
                        <button class="btn btn-warning btn-circle" style="font-size: 11px;width: 30px;height:30px;margin: -8px;" role="button" onclick="callUpdatePMEAction('${items.id_accion}','${items.nombre_accion}','${items.fecha_inicio}')"><i class="fas fa-edit text-white"></i></button>
                        <button class="btn btn-danger btn-circle" style="font-size: 11px;width: 30px;height:30px;margin: 8px;" role="button" onclick="deletePMEAction('${items.id_accion}')"><i class="fas fa-trash text-white"></i></button>
                    </td>

                </tr> 
                            
                `	
                });
            $('#listPMEActionsbyYear').html(template);
        }
    }); 

}

function addPMEActionByYear(){
    addActionDim=$('#addActionDim').val();
    addActionSubdim=$('#addActionSubdim').val();
    addActionName=$('#addActionName').val();
    addActionDescription=$('#addActionDescription').val();
    addActionStartDate=$('#addActionStartDate').val();

    if(addActionDim!=""){
        if(addActionSubdim!=""){
            if(addActionName!=""){
                if(addActionDescription!=""){
                    if(addActionStartDate!=""){
                        thisdata="subdimId="+addActionSubdim+"&actionName="+addActionName+"&actionDescription="+addActionDescription+"&ActionStartDate="+addActionStartDate;
                        $.ajax({
                            type:"POST",
                            url:"php/addPMEActionByYear.php", 
                            data:thisdata,
                            success:function(r){
                                if(r==1){
                                    alertify.success("Acción Guardada en los registros");
                                    $('#addPMEActionByYear').modal('hide');
                                    listPMEActionsbyYear(getYear());
                                }else{
                                    alertify.error(r);
                                    console.log(r);
                                }
                            }
                        });              
                    }else{
                        alertify.error("Debe Seleccionar una fecha de Inicio");
                    }
                }else{
                    alertify.error("Debe Ingresar una Descripción para la Acción");
                }
            }else{
                alertify.error("Debe Ingresar el nombre de la Acción");
            }
        }else{
            alertify.error("Debe Seleccionar la Subdimensión del PME");
        }
    }else{
        alertify.error("Debe seleccinar la Dimensión del PME");
    }
}

function getYear(){
    year=$('#yearFilter').val();
    return year;
}

function openModalAddPMEAction(){
    chargeDim('addActionDim');
    $('#addPMEActionByYear').modal('show');
}

function callUpdatePMEAction(actionId,actionName,startDate){
    $('#editPMEActionID').val(actionId);
    $('#editPMEActionName').val(actionName);
    /*$('#editPMEActionDesc').val(descriptionName);*/
    $('#editPMEActionStartDate').val(startDate);
    $('#editPMEActionByYear').modal('show');
}

function updatePMEAction(){
    actionId=$('#editPMEActionID').val();
    actionName=$('#editPMEActionName').val();
    description=$('#editPMEActionDesc').val();
    startDate=$('#editPMEActionStartDate').val()
    if(actionId!=""){
        if(actionName!=""){
            if(description!=""){
                if(startDate!=""){
                    thisdata="actionId="+actionId+"&actionName="+actionName+"&actionDescription="+description+"&startDate="+startDate;
                            $.ajax({
                                type:"POST",
                                url:"php/updatePMEAction.php", 
                                data:thisdata,
                                success:function(r){
                                    if(r==1){
                                        alertify.success("Acción Guardada en los registros");
                                        $('#editPMEActionByYear').modal('hide');
                                        listPMEActionsbyYear(getYear());
                                    }else{
                                        alertify.error(r);
                                        //console.log(r);
                                    }
                                }
                            });         
                }else{
                    alertify.error("No se puede actualizar porque no se detecta la fecha de inicio de la acción");
                }
            }else{
                alertify.error("No se puede actualizar porque la descripción ahora está vacia");
            }
        }else{
            alertify.error("No se puede actualizar porque el nombre de la acción ahora está vacio");
        }
    }else{
        alertify.error("No se puede actualizar porque no se encuentra el Id de la accíon");
    }

}

function deletePMEAction(actionId){
    alertify.confirm('Eliminar', '¿Esta segur@ de eliminar la Acción del PME?', 
	    function(){ 
            $.ajax({
                url: 'php/deletePMEAction.php',
                type: 'POST',
                data:{actionId},
                success: function(response){
                    if (response==1){
                        alertify.success("Solicitud eliminada");
                        listPMEActionsbyYear(getYear());
                    }else{
                        alertify.error(response);
                    }
                }
            });       
        }
	, function(){ alertify.error('Se cancelo')});

}

$(document).ready(function(){
   chargeDim('selectDim');
   listPMEActionsbyYear(getYear());


   $('#selectDim').change(function(){
        dimId=$('#selectDim').val();
        listSubdimensions('listSubdimensions',dimId);
        chargeSubdim('selectSubdim',dimId);
    });

    $('#yearFilter').change(function(){
        listPMEActionsbyYear(getYear()); 
    });
    
    $('#addActionDim').change(function(){
        dimId=$('#addActionDim').val();
        chargeSubdim('addActionSubdim',dimId);
    });
    

});