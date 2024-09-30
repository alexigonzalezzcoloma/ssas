function chargeSelects(){
    chargeFoundations($('#userFoundation'));
    chargeSchools($('#userSchool'));
    chargeRols($('#userRol'));
}

function chargeSchools(destiny){
    $.ajax({
        url: 'php/chargeSchools.php',
        type: 'POST',
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

function chargeRols(destiny){
    $.ajax({
        url: 'php/chargeRols.php',
        type: 'POST',
        success: function(response){		
            let items = JSON.parse(response);
            let template = '';
            items.forEach(items => {
                template += `
                <option value="${items.id}">${items.nombre}</option>
                `	
                });
            destiny.html(template);
        }
    });   
}

function chargeFoundations(destiny){
    $.ajax({
        url: 'php/chargeFoundations.php',
        type: 'POST',
        success: function(response){		
            let items = JSON.parse(response);
            let template = '';
            items.forEach(items => {
                template += `
                <option value="${items.rut}">${items.nombre}</option>
                `	
                });
            destiny.html(template);
        }
    });   
}

function chargeModalEdit(rut,name,email,rutFoundation,rbdSchool,idRol,isEnabled){
    chargeFoundations($('#userFoundationEdit'));
    chargeSchools($('#userSchoolEdit'));
    chargeRols($('#userRolEdit'));

    $('#editUserModal').modal('show');

    $('#userRutEdit').val(rut);
    $('#userNameEdit').val(name);
    $('#userMailEdit').val(email);
    //$('#userFoundationEdit').val(rutFoundation);
    //$('#userSchoolEdit').val(rbdSchool);
    //$('#userRolEdit').val(idRol);
    //$('#userIsEnabled').val(isEnabled);
}

function disableUser(userRut){
    $.ajax({
        url: 'php/disableUser.php',
        type: 'POST',
        data: {userRut},
        success: function(response){
            if (response==1){
                alertify.success("Se dehabilitó el Usuario");
                listUsers();
            }else{
                alertify.error("No se pudo deshabilitar el Usuario");
            }	
        }
    });   
}

function listUsers(){
    $.ajax({
        url: 'php/listUsers.php',
        type: 'POST',
        success: function(response){		
            let items = JSON.parse(response);
            let template = '';
            items.forEach(items => {
                template += `
                    <tr>
                        <td>${items.rut}</td>
                        <td>${items.nombre}</td>
                        <td>${items.email}</td>
                        <td>${items.rol_usr}</td>
                        <td>${items.nombre_fundacion}</td>
                        <td>${items.nombre_colegio}</td>
                        <td>${items.habilitado}</td>
                        <td>
                            <a class="btn btn-warning btn-circle" role="button" onclick="chargeModalEdit('${items.rut}','${items.nombre}','${items.email}','${items.rut_fundacion}','${items.rbd_colegio}','${items.id_rol}','${items.habilitado}')">
                            <i class="fas fa-edit"></i>
                            </a>
                            <a class="btn btn-danger btn-circle" role="button" onclick="disableUser('${items.rut}')">
                            <i class="fa fa-trash" aria-hidden="true"></i>
                            </a>
                        </td>
                    </tr>
                `	
                });
            $('#listUsers').html(template);
        }
    });   
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

function addUser(){
    userRut=$('#userRut').val();
    userName=$('#userName').val();
    userMail=$('#userMail').val();
    userFoundation=$('#userFoundation').val();
    userSchool=$('#userSchool').val();
    userRol=$('#userRol').val();
    userPass=$('#userPass').val();
    userPassCp=$('#userPassCp').val();

    if(userRut!=""){
        if(userName!=""){
            if(userMail!=""){
                if(userFoundation!=""){
                    if(userSchool!=""){
                        if(userRol){
                            if(userPass!="" && userPass==userPassCp && userPass.length>7){
                                var formData= new FormData();
                                userRut=cleanChar(userRut, ".");
                                formData.append('userRut',userRut);
                                formData.append('userName',userName);
                                formData.append('userMail',userMail);
                                formData.append('userFoundation',userFoundation);
                                formData.append('userSchool',userSchool);
                                formData.append('userRol',userRol);
                                formData.append('userPass',userPass)
                                $.ajax({
                                    type:"POST",
                                    url:"php/addUser.php", 
                                    data:formData,
                                    contentType:false,
                                    processData:false,
                                    success:function(r){
                                        if(r==1){
                                            alertify.success("Usuario Agregado Correctamente");
                                            $('#createUserModal').modal('hide');
                                            listUsers();
                                        }else{
                                            alertify.error("Error al Agregar Usuario");
                                            console.log(r);
                                        }
                                    }
                                });
                            }else{
                                alertify.error("Debe ingresar su clave de 8 caracteres y repetirla en la casilla correspondiente");
                            }
                        }else{
                            alertify.error("Debe ingresar un cargo para el usuario");
                        }
                    }else{
                        alertify.error("Debe ingresar un Colegio Válido");
                    }
                }else{
                    alertify.error("Debe seleccionar una Fundación Educacional");
                }
            }else{
                alertify.error("Debe ingresar el mail");
            }
        }else{
            alertify.error("Debe ingresar el nombre del Usuario");
        }
    }else{
        alertify.error("Debe Ingresar el Rut");
    }    
}

function updateUser(){
    userRutEdit=$('#userRutEdit').val();
    userNameEdit=$('#userNameEdit').val();
    userMailEdit=$('#userMailEdit').val();
    userFoundationEdit=$('#userFoundationEdit').val();
    userSchoolEdit=$('#userSchoolEdit').val();
    userRolEdit=$('#userRolEdit').val();
    userIsEnabled=$('#userIsEnabled').val();
    userPassEdit=$('#userPassEdit').val();
    userPassCpEdit=$('#userPassCpEdit').val();
    if(userRut!=""){
        if(userNameEdit!=""){
            if(userMailEdit!=""){
                if(userFoundationEdit!=""){
                    if(userSchoolEdit!=""){
                        if(userRolEdit){
                            if(userIsEnabled!=""){
                                if(userPassEdit!="" && userPassEdit==userPassCpEdit && userPassEdit.length>7){
                                    userRutEdit=cleanChar(userRutEdit, ".");
                                    userdata='userRut='+userRutEdit+'&userName='+userNameEdit+'&userMail='+
                                    userMailEdit+'&userFoundation='+userFoundationEdit+'&userSchool='+
                                    userSchoolEdit+'&userRolE='+userRolEdit+'&userPassE='+userPassEdit+
                                    '&isEnabledE='+userIsEnabled;
                                    console.log(userdata);
                                   
                                    $.ajax({
                                        type:"POST",
                                        url:"php/updateUser.php", 
                                        data:userdata,
                                        success:function(r){
                                            if(r==1){
                                                alertify.success("Usuario Actualizado Correctamente");
                                                $('#editUserModal').modal('hide');
                                                listUsers();
                                            }else{
                                                alertify.error("Error al Actualizar Datos de Usuario");
                                                console.log(r);
                                            }
                                        }
                                    });
                                }
                            }else{
                                alertify.error("Debe ingresar su clave de 8 caracteres y repetirla en la casilla correspondiente"); 
                            }
                        }else{
                            alertify.error("Debe ingresar un cargo para el usuario");
                        }    
                    }else{
                        alertify.error("Debe ingresar un Colegio Válido");
                    }
                }else{
                    alertify.error("Debe seleccionar una Fundación Educacional");
                }
            }else{
                alertify.error("Debe ingresar el mail");
            }
        }else{
            alertify.error("Debe ingresar el nombre del Usuario");
        }
    }else{
        alertify.error("Debe Ingresar el Rut");
    }    
}

$(document).ready(function(){
    listUsers();
    $('#createUser').click(addUser);
    $('#updateUsr').click(updateUser);
});