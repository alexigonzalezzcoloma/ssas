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

function chargeSubventions(destiny){
    destiny=$('#'+destiny);
    $.ajax({
        url: 'php/chargeSubventions.php',
        type: 'GET',
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

function chargeSchools(destiny){
    destiny=$('#'+destiny);
    $.ajax({
        url: 'php/listSchools.php',
        type: 'GET',
        success: function(response){		
            let items = JSON.parse(response);
            let template = '';
            items.forEach(items => {
                template += ` 
                <option value="${items.rbd}">${items.nombre}</option>
                `
                });
            destiny.html(template);
        }
    });   
}

function listSubsBugdetsByYear(destiny,schoolRbd,year){
    thisdata="schoolRbd="+schoolRbd+"&year="+year;
    destiny=$('#'+destiny);
    $.ajax({
        url: 'php/listSubsBugdetsByYear.php',
        type: 'POST',
        data: thisdata,
        success: function(response){		
            let items = JSON.parse(response);
            let template = '';
            items.forEach(items => {
                template += ` 
                <tr>
                    <td>${items.nombre_subvencion}</td>
                    <td>${items.presupuesto_total}</td>
                    <td>${items.presupuesto_usado}</td>
                    <td>${items.presupuesto_disponible}</td>
                    <td>
                        <button class="btn btn-warning btn-circle" role="button" onclick="callUpdateSubBugdet('${items.id_presupuesto}','${items.nombre_subvencion}','${items.presupuesto_total}')"><i class="fas fa-edit text-white"></i></button>
                    </td>
                </tr> 
                `
                });
            destiny.html(template);
        }
    });   
}

function listSchoolsBugdetsByYear(destiny,year){
    destiny=$('#'+destiny);
    $.ajax({
        url: 'php/listSchoolsBugdetsbyYear.php',
        type: 'POST',
        data: {year},
        success: function(response){		
            let items = JSON.parse(response);
            let template = '';
            items.forEach(items => {
                template += ` 
                <tr>
                    <td>${items.nombre_colegio}</td>
                    <td>${items.presupuesto_total}</td>
                    <td>${items.presupuesto_usado}</td>
                    <td>${items.presupuesto_disponible}</td>
                    <td>
                        <button class="btn btn-warning btn-circle" role="button" onclick="callUpdateSchoolBugdet('${items.id_presupuesto}','${items.nombre_colegio}','${items.presupuesto_total}')"><i class="fas fa-edit text-white"></i></button>
                    </td>
                </tr> 
                `;
                });
            destiny.html(template);
        }
    });   
}

function getYear(){
    year=$('#yearFilter').val();
    return year;
}

function listSchoolsWithOutBugdets(destiny){
    destiny=$('#'+destiny);
    $.ajax({
        url: 'php/listSchoolsWithOutBugdet.php',
        type: 'GET',
        success: function(response){		
            let items = JSON.parse(response);
            let template = '';
            items.forEach(items => {
                template += ` 
                <option value="${items.rbd_colegio}">${items.nombre_colegio}</option>
                `
                });
            destiny.html(template);
        }
    });   
}

function openModalAddSchoolBugdet(){
    listSchoolsWithOutBugdets('addBugdetSSchool');

    $('#addBugdetBySchool').modal('show');
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

function addBugdetSchool(){
    addBugdetSSchool=$('#addBugdetSSchool').val();
    addBugdetSMount=$('#addBugdetSMount').val();
    addBugdetSMount=cleanChar(addBugdetSMount,'.');
    bugdetYear=getYear();
    
    data1="schoolRbd="+addBugdetSSchool+"&schoolMount="+addBugdetSMount+"&bugdetYear="+bugdetYear;
    console.log(data1);
    $.ajax({
        type:"POST",
        url:"php/addBugdetSchool.php", 
        data:data1,
        success:function(r){
            if(r==1){
                alertify.success("Acción Guardada en los registros");
                $('#addBugdetBySchool').modal('hide');
                listSchoolsBugdetsByYear('listSchoolBugdet',getYear());
            }else{
                alertify.error("Error al Guardar Presupuesto del Colegio :(");
                console.log(r);
            }
        }
    });
}

function openModalAddSubBugdet(){
    chargeSubventions('addBugdetSSubId');
    $('#addBugdetBySub').modal('show');
}

function addSubBugdet(){
    schoolRbd=$('#selectSchool').val();
    if(schoolRbd!=""){
        subId=$('#addBugdetSSubId').val();
        subMount=$('#addBugdetSSubMount').val();
        bugdetYear=getYear();
        subMount=cleanChar(subMount,'.');
        data1="schoolRbd="+schoolRbd+"&subId="+subId+"&subMount="+subMount+"&bugdetYear="+bugdetYear;
        $.ajax({
            type:"POST",
            url:"php/addSubBugdet.php", 
            data:data1,
            success:function(r){
                if(r==1){
                    alertify.success("Acción Guardada en los registros");
                    $('#addBugdetBySub').modal('hide');
                    listSubsBugdetsByYear('listSubBugdets',schoolRbd,getYear());
                }else{
                    alertify.error(r);
                }
            }
        });
    }else{
        alertify.error("Debe seleccionar primero el colegio");
    }
}



function callUpdateSchoolBugdet(budgetId,schoolName,mount){
    $('#editSchoolBID').val(budgetId);
    $('#editSchoolBRBD').val(schoolName);
    $('#editSchoolBMount').val(mount);
    $('#editschoolBModal').modal('show');
}

function callUpdateSubBugdet(budgetId,subName,mount){
    $('#editSubBID').val(budgetId);
    $('#editSubBname').val(subName);
    $('#editSubBMount').val(mount);
    $('#editSubBModal').modal('show');
}

function updateSchoolBugdet(){
    bugdetId=$('#editSchoolBID').val();
    schoolMount=$('#editSchoolBMount').val();
    schoolMount=cleanChar(schoolMount,'.');
    data1="bugdetId="+bugdetId+"&schoolMount="+schoolMount;
    $.ajax({
        type:"POST",
        url:"php/updateSchoolBugdet.php", 
        data:data1,
        success:function(r){
            if(r==1){
                alertify.success("Acción Guardada en los registros");
                $('#editschoolBModal').modal('hide');
                listSchoolsBugdetsByYear('listSchoolBugdet',getYear());
            }else{
                alertify.error(r);
            }
        }
    });
}

function updateSubBugdet(){
    bugdetId=$('#editSubBID').val();
    subMount=$('#editSubBMount').val();
    subMount=cleanChar(subMount,'.');
    data1="bugdetId="+bugdetId+"&subMount="+subMount;
    console.log(data1);
    $.ajax({
        type:"POST",
        url:"php/updateSubBugdet.php", 
        data:data1,
        success:function(r){
            if(r==1){
                alertify.success("Acción Guardada en los registros");
                $('#editSubBModal').modal('hide');
                schoolRbd=$('#selectSchool').val();
                listSubsBugdetsByYear('listSubBugdets',schoolRbd,getYear());
            }else{
                alertify.error(r);
            }
        }
    });
}

$(document).ready(function(){
    chargeSchools('selectSchool');
    chargeSubventions('selectSub');
    listSchoolsBugdetsByYear('listSchoolBugdet',getYear());   
    
   
    $('#yearFilter').change(function(){
        listSchoolsBugdetsByYear('listSchoolBugdet',getYear());    
    });
    
    $('#selectSchool').change(function(){
        schoolRbd=$('#selectSchool').val();
        console.log(schoolRbd);
        listSubsBugdetsByYear('listSubBugdets',schoolRbd,getYear());
    });
});