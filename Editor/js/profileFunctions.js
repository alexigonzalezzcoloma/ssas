function chargeUserData(){
    $.ajax({
        url: 'php/chargeUserData.php',
        type: 'POST',
        success: function(response){		
            let items = JSON.parse(response);
            let template = '';
            items.forEach(items => {
            template += `   
                <div class="form-row">
                <div class="col">
                    <div class="form-group"><label for="username"><strong>Rut</strong></label><input class="form-control" type="text"  id="userRut" value="${items.userRut}" readonly></div>
                    <div class="form-group"><label for="first_name"><strong>Nombre</strong></label><input class="form-control" type="text"  id="userName" value="${items.userName}"></div>
                    <div class="form-group"><label for="first_name"><strong>Clave</strong></label><input class="form-control" type="password" id="userPass"></div>
                </div>
                <div class="col">
                    <div class="form-group"><label for="email"><strong>Email</strong></label><input class="form-control" type="email" placeholder="user@example.com" id="userMail" value="${items.userMail}"></div>
                    <div class="form-group"><label for="first_name"><strong>Tipo de Usuario</strong></label><input class="form-control" type="text" placeholder="Rol Usuario " id="userRol" value="${items.userRol}" readonly></div>
                    <!--<div class="form-group"><label for="last_name"><strong>Firma</strong></label><input type="file"></div>-->
                    <div class="form-group"><label for="last_name"><strong>Confirmacion Clave</strong></label>
                    <input class="form-control" type="password" id="userPassCp"></div>
                </div>
            </div>
            
            <div class="form-group"><button class="btn btn-primary btn-sm" type="button" onclick="updateUserData()">Guardar Cambios</button></div>
                    `	
            });            
            $('#chargeUserData').html(template);
        }
    });
}

function updateUserData(){
    userName=$("#userName").val();
    userMail=$("#userMail").val();
    userPass=$("#userPass").val();
    userPassCp=$("#userPassCp").val();
    thisData="userName="+userName+"&userMail="+userMail+"&userPass="+userPass;
    if(userName!=""){
        if(ValidateEmail(userMail)==true){
            if(userPass.length>7){
                if(userPass==userPassCp){
                    $.ajax({
                        url: 'php/updateUserData.php',
                        type: 'POST',
                        data: thisData,
                        success: function(response){	
                            if(response==1){
                                alertify.success("Datos guardados con exito");
                                chargeUserData();
                            }else{
                                console.log(response);
                            }  
                        }
                    });
                }else{
                    alertify.error("Las claves ingresadas no coinciden");
                }
            }else{
                alertify.error("La clave debe tener 8 caractéres");
            }
        }else{
            alertify.error("El email ingresado no está en un formato válido");
        }
    }else{
        alertify.error("Debe ingresar su Nombre y Apellido");
    }
}

function ValidateEmail(mail) 
{
 if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(mail))
  {
    return (true)
  }
    return (false)
}

$(document).ready(function(){
    chargeUserData();
});