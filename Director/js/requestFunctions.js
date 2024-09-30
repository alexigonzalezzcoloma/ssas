function listRequest(requestId){
    $.ajax({
        url: 'php/listRequest.php',
        type: 'POST',
        data: {requestId},
        success: function(response){		
            let items = JSON.parse(response);
            let template = '';
            items.forEach(items => {
            template += `   
                        <label for="username" style="font-size: 14px;"><strong>Tipo de Solicitud</strong></label>
                        <input id="requestT" hidden value="${items.tipo}">
                        <select class="form-control" name="requestType" id="requestType">
                            <option value="">Seleccione Tipo de Solicitud</option>
                            <option value="Bienes">Bienes</option>
                            <option value="Servicios">Servicios</option>
                            <option value="Contratos">Contratos</option>
                        </select>
                        <label for="username" style="font-size: 14px;"><strong>Título</strong></label>
                        <input class="form-control" type="text" name="requestTitle" id="requestTitle" style="font-size: 14px;" placeholder="Ingrese Titulo" value="${items.titulo}">
                        <label for="first_name" style="font-size: 14px;"><strong>Justificación</strong></label>
                        <textarea class="form-control" name="requestJustify" id="requestJustify" rows="8" placeholder="Ingrese Justificación">${items.justificacion}</textarea>
                        <label for="" style="font-size: 14px;"><strong>Voto Comisión Interna Colegio</strong></label>
                        <input class="form-control" type="text" name="InternalVote" id="InternalVote" style="font-size: 14px;" value="${items.voto_interno}">
                        <label for="" style="font-size: 14px;"><strong>Fecha de Voto</strong></label>
                        <input class="form-control" type="date" name="voteDate" id="voteDate" style="font-size: 14px;" value="${items.fecha_voto_interno}">
                        <label for="first_name" style="font-size: 14px;"><strong>Estado Actual de la Solicitud&nbsp;</strong></label>
                        <input class="form-control" type="text" placeholder="Se carga Automáticamente" name="RequestState" id="RequestState" style="font-size: 14px;" value="${items.estado_actual}">
                        <label for="username" style="font-size: 14px;"><strong>Total Monetario</strong></label>
                        <input class="form-control" type="text" name="requestTotal" id="requestTotal" style="font-size: 14px;" placeholder="Se carga Automáticamente" value="${items.precio_total}">
                        
                        <!--<label for="username" style="font-size: 14px;"><strong>Subvención(es)</strong></label>
                        <input class="form-control" type="text" name="requestSubs" id="requestSubs" style="font-size: 14px;" placeholder="Se carga Automáticamente">-->    
                    `	
            });            
            $('#listRequest').html(template);
            requestT=$('#requestT').val();
            $('#requestType').val(requestT);
            chargeFormRequirements(requestT);
        }
    });
}

function listMoves(requestId){
    destiny=$('#listMoves');

    $.ajax({
        url: 'php/listMoves.php',
        type: 'POST',
        data: {requestId},
        success: function(response){		
            let moves = JSON.parse(response);
            let template = '';
            moves.forEach(moves => {
                template += ` <tr>
                                <td>${moves.id}</td>
                                <td>${moves.nombre_estado}</td>
                                <td>${moves.nombre_cargo}</td>
                                <td>${moves.nombre_usuario}</td>
                                <td>${moves.recomienda}</td>
                                <td>${moves.comentario}</td>
                                <td>${moves.fecha_hora}</td>
                               </tr>                                            
                `
                });
            destiny.html(template);
        }
    });
}

function listAttachments(requestId){
    $.ajax({
        url: 'php/listAttachments.php',
        type: 'POST',
        data:{requestId},
        success: function(response){		
            let items = JSON.parse(response);
            let template = '';
            items.forEach(items => {
                template += `
                <tr>
                    <td>${items.id}</td>
                    <td>${items.nombre}</td>
                    <td>${items.fecha_hora}</td>
                    <td>
                        <a href="../assets/uploads/docs/${items.ruta}" class="btn btn-success btn-circle ml-1" role="button" style="font-size: 12px;width: 35px;height: 35px;margin: -10px;">
                            <i class="far fa-eye text-white"></i>
                        </a>
                    </td>
                </tr> 
                `	
                });
            $('#listAttach').html(template);
        }
    });   
}
function listRequirements(requestId,type){
    if(type=="Bienes"){
        $.ajax({
            url: 'php/listRequirements.php',
            type: 'POST',
            data:{requestId},
            success: function(response){		
                let items = JSON.parse(response);
                let template = '';
                items.forEach(items => {
                    template += `
                    <tr>
                        <td>${items.id}</td>
                        <td>${items.nombre}</td>
                        <td>${items.cantidad}</td>
                        <td>${items.precio}</td>                    
                        <td>${items.nombre_subvencion}</td>               
                    </tr> 
                    `	
                    });
                $('#listGoods').html(template);
            }
        });   
    }
    if(type=="Servicios"){
        $.ajax({
            url: 'php/listRequirements.php',
            type: 'POST',
            data:{requestId},
            success: function(response){		
                let items = JSON.parse(response);
                let template = '';
                items.forEach(items => {
                    template += `
                    <tr>
                        <td>${items.id}</td>
                        <td>${items.nombre}</td>
                        <td>${items.cantidad}</td>
                        <td>${items.precio}</td>                    
                        <td>${items.nombre_subvencion}</td>               
                    </tr> 
                    `	
                    });
                $('#listServices').html(template);
            }
        });   
        
    }
    if(type=="Contratos"){
        $.ajax({
            url: 'php/listRequirements.php',
            type: 'POST',
            data:{requestId},
            success: function(response){		
                let items = JSON.parse(response);
                let template = '';
                items.forEach(items => {
                    template += `
                    <tr>
                        <td>${items.id}</td>
                        <td>${items.nombre}</td>
                        <td>${items.cantidad}</td>
                        <td>${items.profesional_contratado}</td>
                        <td>${items.nombre_profesional}</td>
                        <td>${items.nombre_subvencion}</td>               
                    </tr> 
                    `	
                    });
                $('#listContracts').html(template);
            }
        });   
        
    }
}
function chargeFormRequirements(type){
    if (type==""){
        template=`No se ha seleccionado tipo de Solicitud aun`;
        $('#FormRequirements').html(template);

    }

    if(type=="Bienes"){
        template=`
                <div id="formGoods">
                    <div class="table-responsive table-bordered table mt-2" id="dataTable-3" role="grid" aria-describedby="dataTable_info" style="font-size: 11px;height: auto;width: auto;">
                        <table class="table table-striped table-bordered dataTable my-0" id="dataTable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Cantidad</th>
                                    <th>Precio</th>
                                    <th>Subvencion</th>
                                </tr>
                            </thead>
                            <tbody id="listGoods">

                            </tbody>
                            <tfoot>
                                <tr>
                                    <td><strong>ID</strong></td>
                                    <td><strong>Nombre</strong></td>
                                    <td><strong>Cantidad</strong></td>
                                    <td><strong>Precio</strong></td>
                                    <td><strong>Subvencion</strong></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
        `;	  
        $('#FormRequirements').html(template);
        requestId=$('#numero').val();
        listRequirements(requestId,type);
    }
    if(type=="Servicios"){
        template=`
                        <div id="formServices">
                            <div class="table-responsive table-bordered table mt-2" id="dataTable-3" role="grid" aria-describedby="dataTable_info" style="font-size: 11px;height: auto;width: auto;">
                                <table class="table table-striped table-bordered dataTable my-0" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nombre</th>
                                            <th>Cantidad</th>
                                            <th>Precio individual</th>
                                            <th>Subvencion</th>
                                        </tr>
                                    </thead>
                                    <tbody id="listServices">
                                        
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td><strong>ID</strong></td>
                                            <td><strong>Nombre</strong></td>
                                            <td><strong>Cantidad</strong></td>
                                            <td><strong>Precio</strong></td>
                                            <td><strong>Subvencion</strong></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
        `;
        $('#FormRequirements').html(template);
        requestId=$('#numero').val();
        listRequirements(requestId,type);
    }
    if(type=="Contratos"){
        template=`
                        <div id="formContracts">
                            <div class="table-responsive table-bordered table mt-2" id="dataTable-3"
                                role="grid" aria-describedby="dataTable_info" style="font-size: 11px;height: auto;width: auto;">
                                <table class="table table-striped table-bordered dataTable my-0" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Asignatura</th>
                                            <th>Cantidad Horas</th>
                                            <th>Profesional</th>
                                            <th>Nombre Profesional</th>
                                            <th>Subvencion</th>
                                        </tr>
                                    </thead>
                                    <tbody id="listContracts">
                                        
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td><strong>ID</strong></td>
                                            <td><strong>Nombre</strong></td>
                                            <td><strong>Cantidad de Horas</strong></td>
                                            <td><strong>Profesional</strong></td>
                                            <td><strong>Nombre Profesional</strong></td>
                                            <td><strong>Subvencion</strong></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
        `;
        $('#FormRequirements').html(template);
        requestId=$('#numero').val();
        listRequirements(requestId,type);
    }

} 

function listSchoolBugdet(requestId){
    $.ajax({
        url: 'php/listSchoolBugdet.php',
        type: 'GET',
        data: {requestId},
        success: function(response){		
            let items = JSON.parse(response);
            let template = '';
            items.forEach(items => {
                template += `
                <p>Presupuesto ${items.titulo}</p> 
                <div class="btn-group" role="group"><button class="btn btn-light" type="button">Total</button><button class="btn btn-secondary btn-lg" type="button"><span style="font-size: 15px;">${items.presupuesto_total}</span></button></div>
                <div class="btn-group" role="group"><button class="btn btn-light" type="button">Usado</button><button class="btn btn-secondary btn-lg" type="button"><span style="font-size: 15px;">${items.presupuesto_utilizado}</span></button></div>
                <div class="btn-group" role="group"><button class="btn btn-light" type="button">Disponible</button><button class="btn btn-secondary btn-lg" type="button"><span style="font-size: 15px;">${items.presupuesto_disponible}</span></button></div>
                <div class="btn-group" role="group"><button class="btn btn-light" type="button">En proceso</button><button class="btn btn-secondary btn-lg" type="button"><span style="font-size: 15px;">${items.presupuesto_gestion}</span></button></div>
                <br>
                <br>
                `	
                });
            $('#schoolBudget').html(template);
        }
    }); 
}

function listSubsBugdets(requestId){
$.ajax({
    url: 'php/listSubsBugdets.php',
    type: 'GET',
    data: {requestId},
    success: function(response){		
        let items = JSON.parse(response);
        let template = '';
        items.forEach(items => {
            template += `
            <p>Presupuesto ${items.titulo}</p> 
            <div class="btn-group" role="group"><button class="btn btn-light" type="button">Total</button><button class="btn btn-secondary btn-lg" type="button"><span style="font-size: 15px;">${items.presupuesto_total}</span></button></div>
            <div class="btn-group" role="group"><button class="btn btn-light" type="button">Usado</button><button class="btn btn-secondary btn-lg" type="button"><span style="font-size: 15px;">${items.presupuesto_utilizado}</span></button></div>
            <div class="btn-group" role="group"><button class="btn btn-light" type="button">Disponible</button><button class="btn btn-secondary btn-lg" type="button"><span style="font-size: 15px;">${items.presupuesto_disponible}</span></button></div>
            <div class="btn-group" role="group"><button class="btn btn-light" type="button">En proceso</button><button class="btn btn-secondary btn-lg" type="button"><span style="font-size: 15px;">${items.presupuesto_gestion}</span></button></div>
            <br>
            <br>
            `	
            });
        $('#subsBugdets').html(template);
    }
}); 
}

function listPME(requestId){  
    $.ajax({
        url: 'php/listPME.php',
        type: 'GET',
        data: {requestId},
        success: function(response){		
            let items = JSON.parse(response);
            let template = '';
            items.forEach(items => {
                template += `
                <tr>
                    <td>${items.nombre_subvencion}</td>
                    <td>${items.nombre_dimension}</td>
                    <td>${items.nombre_subdimension}</td>
                    <td><strong>${items.nombre_accion}</strong>:&nbsp; ${items.descripcion_accion}</td>
                </tr> 
                            
                `	
                });
            $('#listPME').html(template);
        }
    }); 
}

function sendRequest(requestId){
    directorRecommend=$("#directorRecommend").val();
    directorComment=$("#directorComment").val();
    reqData="requestId="+requestId+"&directorRecommend="+directorRecommend+"&directorComment="+directorComment;
    $.ajax({
        url: 'php/sendRequest.php',
        type: 'POST',
        data: reqData,
        success: function(response){		
            if(response==1){
                alertify.success("Solicitud Enviada");
                listRequest(requestId);
                listSchoolBugdet(requestId);
                listMoves(requestId);
                $('#sendReqModal').modal('hide');
            }else{
                alertify.error(response);
            }
        }
    });
}


$(document).ready(function(){
    requestId=$('#numero').val();
    listRequest(requestId);
    listPME(requestId);
    listSchoolBugdet(requestId);
    listSubsBugdets(requestId);
    listAttachments(requestId);
    listMoves(requestId); 
});