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
                        <input class="form-control" type="text" name="requestTitle" id="requestTitle" style="font-size: 14px;" placeholder="Solo el título en Mayusculas" value="${items.titulo}">
                        <label for="first_name" style="font-size: 14px;"><strong>Justificación</strong></label>
                        <textarea class="form-control" name="requestJustify" id="requestJustify" rows="8" placeholder="Ej: autorizar recursos SEP...">${items.justificacion}</textarea>
                        <label for="" style="font-size: 14px;"><strong>Voto Comisión Interna Colegio</strong></label>
                        <input class="form-control" type="text" name="InternalVote" id="InternalVote" style="font-size: 14px;" value="${items.voto_interno}">
                        <label for="" style="font-size: 14px;"><strong>Fecha de Voto</strong></label>
                        <input class="form-control" type="date" name="voteDate" id="voteDate" style="font-size: 14px;" value="${items.fecha_voto_interno}">
                        <label for="first_name" style="font-size: 14px;"><strong>Estado Actual de la Solicitud&nbsp;</strong></label>
                        <input class="form-control" type="text" name="RequestState" id="RequestState" style="font-size: 14px;" value="${items.estado_actual}">
                        <label for="username" style="font-size: 14px;"><strong>Total Monetario</strong></label>
                        <input class="form-control" type="text" name="requestTotal" id="requestTotal" style="font-size: 14px;" placeholder="No ingresar nada acá" value="${items.precio_total}">
                        
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
                                <!--<td>
                                    <a class="btn btn-success btn-circle" role="button">
                                        <i class="fas fa-check text-white"></i>
                                    </a>
                                </td>-->
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
                        <a class="btn btn-danger btn-circle" role="button" onclick="deleteAttachment('${requestId}','${items.id}','${items.ruta}')" style="font-size: 12px;width: 35px;height: 35px;margin: 10px; ">
                                <i class="fas fa-trash"></i>
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
                        <td>${items.monto_total}</td> 
                        <td> 
                            <a class="btn btn-warning btn-circle" onclick="editGoods('${items.id}','${items.nombre}','${items.cantidad}','${items.precio}','Bienes')" role="button">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a class="btn btn-danger btn-circle" role="button" onclick="deleteRequirement(${requestId},${items.id},'Bienes')">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
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
                        <td>${items.monto_total}</td>              
                        <td> 
                            <a class="btn btn-warning btn-circle" onclick="editServices('${items.id}','${items.nombre}','${items.cantidad}','${items.precio}','Servicios')" role="button">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a class="btn btn-danger btn-circle" role="button" onclick="deleteRequirement(${requestId},${items.id},'Servicios')">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
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
                        <td>${items.tiempo_contrato}</td>
                        <td>${items.profesional_contratado}</td>
                        <td>${items.nombre_profesional}</td>
                        <td>${items.nombre_subvencion}</td>               
                        <td> 
                            <a class="btn btn-warning btn-circle" onclick="editContract('${items.id}','${items.nombre}','${items.cantidad}','${items.nombre_profesional}','Contratos')" role="button">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a class="btn btn-danger btn-circle" role="button" onclick="deleteRequirement(${requestId},${items.id},'Contratos')">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
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
                    <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#addReqModal" onclick="chargeSubventions('goodSubs')">Agregar Bien</button>
                    <div class="table-responsive table-bordered table mt-2" id="dataTable-3" role="grid" aria-describedby="dataTable_info" style="font-size: 11px;height: auto;width: auto;">
                        <table class="table table-striped table-bordered dataTable my-0" id="dataTable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Cantidad</th>
                                    <th>Precio Unitario</th>
                                    <th>Subvencion</th>
                                    <th>Monto Total</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody id="listGoods">

                            </tbody>
                            <tfoot>
                                <tr>
                                    <td><strong>ID</strong></td>
                                    <td><strong>Nombre</strong></td>
                                    <td><strong>Cantidad</strong></td>
                                    <td><strong>Precio Unitario</strong></td>
                                    <td><strong>Subvencion</strong></td>
                                    <td><strong>Monto Total</strong></td>
                                    <td><strong>Acciones</strong></td>
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
                            <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#addserviceModal" onclick="chargeSubventions('serviceSubs')">Agregar Servicio</button>
                            <div class="table-responsive table-bordered table mt-2" id="dataTable-3" role="grid" aria-describedby="dataTable_info" style="font-size: 11px;height: auto;width: auto;">
                                <table class="table table-striped table-bordered dataTable my-0" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nombre</th>
                                            <th>Cantidad</th>
                                            <th>Precio Unitario</th>
                                            <th>Subvencion</th>
                                            <th>Monto Total</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody id="listServices">
                                        
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td><strong>ID</strong></td>
                                            <td><strong>Nombre</strong></td>
                                            <td><strong>Cantidad</strong></td>
                                            <td><strong>Precio Unitario</strong></td>
                                            <td><strong>Subvencion</strong></td>
                                            <td><strong>Monto Total</strong></td>
                                            <td><strong>Acciones</strong></td>
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
                            <button class="btn btn-primary" type="button" style="margin: 6px;" data-toggle="modal" data-target="#addContractModal" onclick="chargeProfessionalandSub('contractSubs')">Distribución de Horas</button>
                            <div class="table-responsive table-bordered table mt-2" id="dataTable-3"
                                role="grid" aria-describedby="dataTable_info" style="font-size: 11px;height: auto;width: auto;">
                                <table class="table table-striped table-bordered dataTable my-0" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Asignatura</th>
                                            <th>Cantidad Horas</th>
                                            <th>Tiempo de Contrato</th>
                                            <th>Profesional</th>
                                            <th>Nombre Profesional</th>
                                            <th>Subvencion</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody id="listContracts">
                                        
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td><strong>ID</strong></td>
                                            <td><strong>Nombre</strong></td>
                                            <td><strong>Cantidad de Horas</strong></td>
                                            <td><strong>Tiempo de Contrato</strong></td>
                                            <td><strong>Profesional</strong></td>
                                            <td><strong>Nombre Profesional</strong></td>
                                            <td><strong>Subvencion</strong></td>
                                            <td><strong>Acciones</strong></td>
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
function chargeSubventions(destiny){
    requestRbd=$('#requestRbd').val();
    destiny=$('#'+destiny);
    //alert(requestRbd);
    $.ajax({
        url: 'php/chargeSubventions.php',
        type: 'POST',
        data: {requestRbd},
        success: function(response){		
            let items = JSON.parse(response);
            let template = '';
            items.forEach(items => {
                template += ` 
                <option value="${items.id_sub}">${items.nombre_sub}</option>
                `
                });
            destiny.html(template);
        }
    });   
    
}
function chargeProfessionalandSub(destiny){
    destiny=$('#'+destiny);
    $.ajax({
        url: 'php/chargeSubventions.php',
        type: 'POST',
        success: function(response){		
            let items = JSON.parse(response);
            let template = '';
            items.forEach(items => {
                template += ` 
                <option value="${items.id_sub}">${items.nombre_sub}</option>
                `
                });
            destiny.html(template);
        }
    });   

    $.ajax({
        url: 'php/chargeProfessional.php',
        type: 'GET',
        success: function(response){		
            let items = JSON.parse(response);
            let template = '';
            items.forEach(items => {
                template += ` 
                <option value="${items.id_prof}">${items.nombre_prof}</option>
                `
                });
            $('#hiredProfessional').html(template);
        }
    });  
    
}
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
    reqId=$('#numero').val();
    destiny=$('#'+destiny);
    data1="subdimensionId="+subdimensionId+"&reqId="+reqId;
    console.log(data1)
    $.ajax({
        url: 'php/chargeActionsPME.php',
        type: 'POST',
        data: data1,
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
function sendHeaderReq(requestId){
    requestType=$('#requestType').val();
    requestTitle=$('#requestTitle').val();
    requestJustify=$('#requestJustify').val();
    InternalVote=$('#InternalVote').val();
    voteDate=$('#voteDate').val();

    if(requestType!=""){
        if(requestTitle!=""){
            if(requestJustify!=""){
                cadena="requestId="+requestId+"&requestType="+requestType+"&requestTitle="+requestTitle+"&requestJustify="+requestJustify+"&InternalVote="+InternalVote+"&voteDate="+voteDate;
                $.ajax({
                    url: 'php/sendHeaderReq.php',
                    type: 'POST',
                    data: cadena,
                    success: function(response){	
                        if(response==1){
                            alertify.success("Solicitud guardada con exito");
                            listRequest(requestId);
                            listSchoolBugdet(requestId);
                        }else{
                            alert(response);
                        }  
                    }
                });  
            }else{
                alertify.error("Debe ingresar una Justificación para su solicitud");
            }
        }else{
            alertify.error("Debe ingresar el titulo de la Solicitud");
        }
    }else{
        alertify.error("Debe Ingresar un tipo de solicitud");
    }
}

function cleanChar(str, char) {
    console.log('cleanChar()'); // HACK: trace
    while (true) {
        var result_1 = str.replace(char, '');
        if (result_1 === str) {
            break;
        }
        str = result_1;
    }
    return str;
}

function addRequirement(requestId,type){
    if(type==""){
        alertify.error("No se ha especificado un tipo de Requerimiento");
    }
    if(type=="Bienes"){
        goodName=$('#goodName').val();
        goodQuantity=$('#goodQuantity').val();
        goodPrice=$('#goodPrice').val();
        goodsSubs=$('#goodSubs').val();
        if(goodName!=""){
            if(goodQuantity!="" && isNaN(goodQuantity)==false){
                if(goodPrice!=""){
                    if(goodsSubs!=""){
                        goodPrice=cleanChar(goodPrice,'.');
                        cadena="requestId="+requestId+"&requestType="+type+"&name="+goodName+"&quantity="+goodQuantity+"&price="+goodPrice+"&subId="+goodsSubs;
                        $.ajax({
                            url: 'php/addRequirement.php',
                            type: 'POST',
                            data: cadena,
                            success: function(response){	
                                if(response==1){
                                    alertify.success("Requerimiento de Bien Agregado");
                                    listRequirements(requestId,type);
                                    listSchoolBugdet(requestId);
                                    listSubsBugdets(requestId);
                                    $("#addReqModal").modal('hide');
                                }else{
                                    alertify.error(response);
                                }  
                            }
                        });
                    }else{
                        alertify.error("Debe Ingresar la Subvención");
                    }
                }else{
                    alertify.error("Debe Ingresar el precio del Bien sin comas ni puntos");
                }
            }else{
                alertify.error("Debe Ingresar la cantidad de Bienes");
            }
        }else{
            alertify.error("Debe Ingresar el nombre del Bien");
        }
    }
    if(type=="Servicios"){
        serviceName = $('#serviceName').val();
        serviceQuantity = $('#serviceQuantity').val();
        servicePrice = $('#servicePrice').val();
        serviceSubs = $('#serviceSubs').val();
        if(serviceName!=""){
            if(serviceQuantity!="" && isNaN(serviceQuantity)==false){
                if(servicePrice!=""){
                    if(serviceSubs!=""){
                        servicePrice=cleanChar(servicePrice,'.');
                        cadena="requestId="+requestId+"&requestType="+type+"&name="+serviceName+"&quantity="+serviceQuantity+"&price="+servicePrice+"&subId="+serviceSubs;
                        $.ajax({
                            url: 'php/addRequirement.php',
                            type: 'POST',
                            data: cadena,
                            success: function(response){	
                                if(response==1){
                                    alertify.success("Requerimiento de Servicio Agregado");
                                    listRequirements(requestId,type);
                                    listSchoolBugdet(requestId);
                                    listSubsBugdets(requestId);
                                    $("#addserviceModal").modal('hide');
                                }else{
                                    alert(response);
                                }  
                            }
                        });
                    }else{
                        alertify.error("Debe Ingresar la Subvención");
                    }
                }else{
                    alertify.error("Debe Ingresar el precio del Servicio sin puntos ni comas");
                }
            }else{
                alertify.error("Debe Ingresar la cantidad del Servicio");
            }
        }else{
            alertify.error("Debe Ingresar el nombre del Servicio");
        }

        
    }
    if(type=="Contratos"){
        contractCourse = $('#contractCourse').val();
        contractHours = $('#contractHours').val();
        hiredProfessional = $('#hiredProfessional').val();
        contractSubs = $('#contractSubs').val();
        profesionalName = $('#profesionalName').val();
        contractStart = $('#contractStart').val();
        contractEnd = $('#contractEnd').val();
        if(contractCourse!=""){
            if(contractHours!=""){
                if(hiredProfessional!=""){
                    if(contractSubs!=""){
                        if(contractStart!=""){
                            cadena="requestId="+requestId+"&requestType="+type+"&name="+contractCourse+"&quantity="+contractHours+"&hiredProfessionalId="+hiredProfessional+"&profesionalName="+profesionalName+"&subId="+contractSubs+"&contractStart="+contractStart+"&contractEnd="+contractEnd;
                            console.log(cadena);
                            $.ajax({
                                url: 'php/addRequirement.php',
                                type: 'POST',
                                data: cadena,
                                success: function(response){
                                    if(response==1){
                                        alertify.success("Requerimiento de Contrato Agregado");
                                        listRequirements(requestId,type);
                                        listSchoolBugdet(requestId);
                                        listSubsBugdets(requestId);
                                        $("#addContractModal").modal('hide');
                                    }else{
                                        alert(response);
                                    }  
                                }
                            });
                        }else{
                            alertify.error("Debe Ingresar la fecha en que Inicia el Contrato");
                        }
                    }else{
                        alertify.error("Debe Ingresar la Subvención");
                    }
                }else{
                    alertify.error("Debe Ingresar el cargo del profesional");
                }
            }else{
                alertify.error("Debe Ingresar la cantidad del Horas Semanales");
            }
        }else{
            alertify.error("Debe Ingresar el nombre del de la Asignatura");
        }
    }
}

function chargeProfessional(destiny){
    destiny=$('#'+destiny);
    $.ajax({
        url: 'php/chargeProfessional.php',
        type: 'GET',
        success: function(response){		
            let items = JSON.parse(response);
            let template = '';
            items.forEach(items => {
                template += ` 
                <option value="${items.id_prof}">${items.nombre_prof}</option>
                `
                });
                destiny.html(template);
        }
    }); 
}

function addAttachment(requestId){
    attachName=$('#attachName').val();
    attachFile=$('#attachFile').val();
    var formData= new FormData();
    if(attachFile.length != 0){
        var File = $("#attachFile")[0].files[0];
        if ((/\.(pdf)$/i).test(File.name)){
            formData.append('requestId',requestId);
            formData.append('attachName',attachName);
            formData.append('attachFile',File);
            alertify.success("Se está subiendo el Archivo, espere hasta que la ventana se cierre automáticamente");            
            $.ajax({
                type:"POST",
                url:"php/addAttachment.php", 
                data:formData,
                contentType:false,
                processData:false,
                success:function(r){
                    if(r==1){
                        alertify.success("Adjunto Guardado correctamente!");
                        $('#addAttachModal').modal('hide');
                        listAttachments(requestId);
                    }else{
                        alertify.error("Error al Ingresar Adjunto :(");
                        console.log(r);
                        console.log(requestId);
                    }
                }
            });

        }else{
            alertify.error("Formato de documento no válido, solo se aceptan PDF's");
        }   
    }else{
        alertify.error("Debe ingresar una imagen");
    }
}

function deleteAttachment(requestId,attachmentId,path){
    alertify.confirm('Eliminar', '¿Esta segur@ de eliminar el Adjunto?', 
	    function(){ 
            attachData="requestId="+requestId+"&attachmentId="+attachmentId+"&path="+path;
            console.log(attachData);
            $.ajax({
                url: 'php/deleteAttachment.php',
                type: 'POST',
                data:attachData,
                success: function(response){
                    if(response==1){
                        alertify.success("Adjunto Eliminado");
                        listAttachments(requestId);
                    }else{
                        alertify.error(response);
                    }
                }
            });       
        }
	, function(){ alertify.error('Se canceló')});
}

function createPME(){
    $.ajax({
        url: 'php/chargeSubventions.php',
        type: 'POST',
        success: function(response){		
            let items = JSON.parse(response);
            let template = '';
            items.forEach(items => {
                template += `
                <div class="col" id="${items.id_sub}">
                ${items.id_sub}
                </div> 
                `	
                });
            $('#managePME').html(template);
            chargePME(2);
        }
    });
    
}

function selectPMEAction(schoolRbd){
    chargeSubventions('selectSubvention');
    chargeDim('selectDimension');
    //chargeSubdim('selectSubdimension');
    //chargeActions('selectAction',schoolRbd);
}

function addPME(requestId){
    subventionId=$('#selectSubvention').val();
    dimensionId=$('#selectDimension').val();
    subdimensionId=$('#selectSubdimension').val();
    actionId=$('#selectAction').val();
    data1="requestId="+requestId+"&subventionId="+subventionId+"&dimensionId="+dimensionId+"&subdimensionId="+subdimensionId+"&actionId="+actionId;
    console.log(data1);
    $.ajax({
        type:"POST",
        url:"php/addPME.php", 
        data:data1,
        success:function(r){
            if(r==1){
                alertify.success("Acción Guardada en los registros");
                $('#addPMEActionModal').modal('hide');
                listPME(requestId);
            }else{
                alertify.error("Error al Guardar la acción :(");
                console.log(r);
            }
        }
    });
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
                    <p>Presupuesto ${items.titulo} </p> 
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

function listExistenceSubs(requestId){
    $.ajax({
        url: 'php/listExistenceSubs.php',
        type: 'POST',
        data: {requestId},
        success: function(response){		
            let items = JSON.parse(response);
            items.forEach(items => {
                //alert(items.id_sub);
            });
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
                    <td>
                        <a class="btn btn-warning btn-circle" onclick="editPME('${items.id_seleccion}','${items.id_subvencion}','${items.id_dimension}','${items.id_subdimension}','${items.id_accion}','${items.id_solicitud}')" role="button">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a class="btn btn-danger btn-circle" role="button" onclick="deletePMESelection('${items.id_solicitud}','${items.id_seleccion}')">
                            <i class="fas fa-trash text-white"></i>
                        </a>
                    </td>
                </tr> 
                            
                `	
                });
            $('#listPME').html(template);
        }
    }); 
}

function deleteRequirement(requestId,requirementId,typeReq){
    alertify.confirm('Eliminar', '¿Esta segur@ de eliminar el requerimiento?', 
	    function(){ 
            reqData="requestId="+requestId+"&requirementId="+requirementId;
            $.ajax({
                url: 'php/deleteRequirement.php',
                type: 'POST',
                data:reqData,
                success: function(response){
                    if(response==1){
                        alertify.success("Requerimiento Eliminado");
                        listRequirements(requestId,typeReq);
                        listSchoolBugdet(requestId);
                        listSubsBugdets(requestId);
                    }else{
                        alertify.error(response);
                    }
                }
            });       
        }
	, function(){ alertify.error('Se canceló')});
}

function deletePMESelection(requestId,actionId){
    alertify.confirm('Eliminar', '¿Esta segur@ de eliminar la selección de acción del PME?', 
	    function(){ 
            pmeData="requestId="+requestId+"&actionId="+actionId;
            $.ajax({
                url: 'php/deletePMESelection.php',
                type: 'POST',
                data:pmeData,
                success: function(response){
                    if (response==1){
                        alertify.success("Acción Eliminada");
                        listPME(requestId);
                        listSchoolBugdet(requestId);
                    }else{
                        alertify.error(response);
                    }
                }
            });       
        }
	, function(){ alertify.error('Se cancelo')});
}

function sendRequest(requestId){
    recommend=$('#Recommend').val();
    comment=$('#Comment').val();
    thisData="requestId="+requestId+"&Recommend="+recommend+"&Comment="+comment;    
    alertify.confirm('Enviar Solicitud', '¿Esta segur@ de enviar la solicitud?', 
	    function(){ 
            $.ajax({
                url: 'php/sendRequest.php',
                type: 'POST',
                data:thisData,
                success: function(response){
                    if (response==1){
                        alertify.success("Solicitud Enviada");
                        listRequest(requestId);
                        listMoves(requestId);
                        $('#sendReqModal').modal('hide');
                    }else{
                        alertify.error(response);
                    }
                }
            });       
        }
	, function(){ alertify.error('Se cancelo')});
}

function sendRequestEditor(requestId){
    alertify.confirm('Enviar Solicitud', '¿Esta segur@ de enviar la solicitud?', 
	    function(){ 
            $.ajax({
                url: 'php/sendRequestEditor.php',
                type: 'POST',
                data:{requestId},
                success: function(response){
                    if (response==1){
                        alertify.success("Solicitud Enviada");
                        listRequest(requestId);
                        listMoves(requestId);
                        $('#sendReqModal').modal('hide');
                    }else{
                        alertify.error(response);
                    }
                }
            });       
        }
	, function(){ alertify.error('Se cancelo')});
}

function openCommentaryModal(){
    $('#finalCommentModal').modal('show');
}

function sendFinalComment(requestId){
    finalComment=$('#finalComment').val();
    data1="requestId="+requestId+"&finalComment="+finalComment;
    console.log(data1);
    alertify.confirm('Enviar Comentario', '¿Esta segur@ de enviar este comentario?', 
	    function(){ 
            $.ajax({
                url: 'php/sendFinalComment.php',
                type: 'POST',
                data:data1,
                success: function(response){
                    if (response==1){
                        alertify.success("Comentario Guardado");
                        listMoves(requestId);
                        $('#finalCommentModal').modal('hide');
                    }else{
                        alertify.error(response);
                    }
                }
            });       
        }
	, function(){ alertify.error('Se cancelo')});
}

function editGoods(id,nombre,cantidad,precio,type){
    chargeSubventions('goodSubsEdit');
    $('#goodId').val(id);
    $('#goodNameEdit').val(nombre);
    $('#goodQuantityEdit').val(cantidad);
    $('#goodPriceEdit').val(precio);
    $('#goodType').val(type);
    $('#editGoodModal').modal('show');
}
function editServices(id,nombre,cantidad,precio,type){
    chargeSubventions('servSubsEdit');
    $('#servId').val(id);
    $('#servNameEdit').val(nombre);
    $('#servQuantityEdit').val(cantidad);
    $('#servPriceEdit').val(precio);
    $('#servType').val(type);
    $('#editServModal').modal('show');
}
function editContract(id,nombre,cantidad,nombre_profesional,type){
    chargeSubventions('contractSubsEdit');
    $('#contractId').val(id);
    $('#contractCourseEdit').val(nombre);
    $('#contractHoursEdit').val(cantidad);
    $('#profesionalNameEdit').val(nombre_profesional);
    $('#reqType').val(type);
    chargeProfessional('hiredProfessionalEdit');
    $('#editContractModal').modal('show');
}
function updateGood(requestId,type){
    reqId=$('#goodId').val();
    reqName=$('#goodNameEdit').val();
    reqQuantity=$('#goodQuantityEdit').val();
    reqPrice=$('#goodPriceEdit').val();
    reqSubs=$('#goodSubsEdit').val();
    
    if(reqId!=""){
        if(reqName!=""){
            if(reqQuantity!=""){
                if(reqPrice!=""){
                    if(reqSubs!=""){
                        reqPrice=cleanChar(reqPrice,'.');
                        cadena="Id="+reqId+"&Name="+reqName+"&Quantity="+reqQuantity+"&Price="+reqPrice+"&Subs="+reqSubs;
                        console.log(cadena);
                        $.ajax({
                            url: 'php/updateReq.php',
                            type: 'POST',
                            data: cadena,
                            success: function(response){	
                                if(response==1){
                                    alertify.success("Requerimiento Actualizado");
                                    listRequirements(requestId,type);
                                    listSchoolBugdet(requestId);
                                    listSubsBugdets(requestId);
                                }else{
                                    alertify.error("Error al guardar el requerimiento");
                                    console.log(response);
                                }  
                            }
                        });  
                    }else{     
                        alertify.error("debe seleccionar la subvención");                   
                    }
                }else{  
                    alertify.error("debe especificar el precio");
                }
            }else{
                alertify.error("debe especificar la cantidad");
            }
        }else{
            alertify.error("el nombre no puede estar vacio");
        }
    }else{
        alertify.error("no se detecta el id del requerimiento");
    }
}
function updateService(requestId,type){
    servId=$('#servId').val();
    servName=$('#servNameEdit').val();
    servQuantity=$('#servQuantityEdit').val();
    servPrice=$('#servPriceEdit').val();
    servSubs=$('#servSubsEdit').val();
    
    if(servId!=""){
        if(servName!=""){
            if(servQuantity!=""){
                if(servPrice!=""){
                    if(servSubs!=""){
                        servPrice=cleanChar(servPrice,'.');
                        cadena="Id="+servId+"&Name="+servName+"&Quantity="+servQuantity+"&Price="+servPrice+"&Subs="+servSubs;
                        console.log(cadena);
                        $.ajax({
                            url: 'php/updateReq.php',
                            type: 'POST',
                            data: cadena,
                            success: function(response){	
                                if(response==1){
                                    alertify.success("Requerimiento Actualizado");
                                    listRequirements(requestId,type);
                                    listSchoolBugdet(requestId);
                                    listSubsBugdets(requestId);

                                }else{
                                    alertify.error("Error al guardar el requerimiento");
                                    console.log(response);
                                }  
                            }
                        });  
                    }else{     
                        alertify.error("debe seleccionar la subvención");                   
                    }
                }else{  
                    alertify.error("debe especificar el precio");
                }
            }else{
                alertify.error("debe especificar la cantidad");
            }
        }else{
            alertify.error("el nombre no puede estar vacio");
        }
    }else{
        alertify.error("no se detecta el id del requerimiento");
    }
}
function updateContract(requestId,type){
    id=$('#contractId').val();
    contractCourse=$('#contractCourseEdit').val();
    contractHours=$('#contractHoursEdit').val();
    contractStart=$('#contractStartEdit').val();
    contractEnd=$('#contractEndEdit').val();
    hiredProfessional=$('#hiredProfessionalEdit').val();
    profesionalName=$('#profesionalNameEdit').val();
    contractSubs=$('#contractSubsEdit').val();
    
    if(contractCourse!=""){
        if(contractHours!=""){
            if(hiredProfessional!=""){
                if(contractSubs!=""){
                    if(contractStart!=""){
                        if(contractStart!=""){
                            cadena="requestId="+requestId+"&requestType="+type+"&contractId="+id+"&course="+contractCourse+"&hours="+contractHours+"&hiredProfessionalId="+hiredProfessional+"&profesionalName="+profesionalName+"&subId="+contractSubs+"&contractStart="+contractStart+"&contractEnd="+contractEnd;
                            console.log(cadena);
                            $.ajax({
                                url: 'php/updateContract.php',
                                type: 'POST',
                                data: cadena,
                                success: function(response){
                                    if(response==1){
                                        alertify.success("Requerimiento Actualizado");
                                        listRequirements(requestId,type);
                                        listSchoolBugdet(requestId);
                                        listSubsBugdets(requestId);
                                        $("#editContractModal").modal('hide');
                                    }else{
                                        alert(response);
                                    }  
                                }
                            });
                        }else{
                            alertify.error("Debe Ingresar la fecha en que Finaliza el Contrato");  
                        }
                    }else{
                        alertify.error("Debe Ingresar la fecha en que Inicia el Contrato");
                    }
                }else{
                    alertify.error("Debe Ingresar la Subvención");
                }
            }else{
                alertify.error("Debe Ingresar el cargo del profesional");
            }
        }else{
            alertify.error("Debe Ingresar la cantidad del Horas Semanales");
        }
    }else{
        alertify.error("Debe Ingresar el nombre del de la Asignatura");
    }
}
function editPME(id,subId,dimId,subdimId,actionId){
    $('#PMEId').val(id);
    chargeSubventions('subventionEdit');
    chargeDim('dimensionEdit');
    $('#editPMEActionModal').modal('show');
}
function updatePME(requestId){
    id=$('#PMEId').val();
    subvention=$('#subventionEdit').val();
    dimension=$('#dimensionEdit').val();
    subdimension=$('#subdimensionEdit').val();
    action=$('#actionEdit').val();
    if(id!=""){
        if(subvention!=""){
            if(dimension!=""){
                if(subdimension!=""){
                    if(action!=""){
                        cadena="id="+id+"&subvention="+subvention+"&dimension="+dimension+"&subdimension="+subdimension+"&action="+action;
                        console.log(cadena);
                        $.ajax({
                            url: 'php/updatePME.php',
                            type: 'POST',
                            data: cadena,
                            success: function(response){	
                                if(response==1){
                                    alertify.success("PME Actualizado");
                                    listPME(requestId);
                                }else{
                                    alertify.error("Error al guardar los cambios en el PME");
                                    console.log(response);
                                }  
                            }
                        });
                    }else{
                        alertify.error("Debe Ingresar Acción");
                    }
                }else{
                    alertify.error("Debe Ingresar Subdimensión");
                }
            }else{
                alertify.error("Debe Ingresarse Dimensión");
            }
        }else{
            alertify.error("Ingrese Subvencion");
        }
    }else{
        alertify.error("Id no enontrado");
    }  
}
$(document).ready(function(){
    requestId=$('#numero').val();
    listRequest(requestId);
    listPME(requestId);
    listSchoolBugdet(requestId);
    listSubsBugdets(requestId);
    listMoves(requestId);
    listAttachments(requestId);
    $('#selectDimension').change(function(){
        dimensionId=$('#selectDimension').val();
        chargeSubdim('selectSubdimension',dimensionId);
    });
    $('#selectSubdimension').change(function(){
        subdimensionId=$('#selectSubdimension').val();
        chargeActions('selectAction',subdimensionId);
    });

    $('#dimensionEdit').change(function(){
        dimensionId2=$('#dimensionEdit').val();
        chargeSubdim('subdimensionEdit',dimensionId2);
    });
    $('#subdimensionEdit').change(function(){
        subdimensionId2=$('#subdimensionEdit').val();
        chargeActions('actionEdit',subdimensionId2);
    });

});