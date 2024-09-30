function sendAllRequest(){
    alertify.confirm('Enviar a Agenda', '¿Esta segur@ de enviar todas las solicitudes a la Agenda', 
	    function(){ 
            $.ajax({
                url: 'php/sendAllRequest.php',
                type: 'POST',
                success: function(response){
                    if(response==1){
                        alertify.success("Solicitudes Enviadas");
                    }else{
                        alertify.error(response);
                        console.log(response);
                    }
                }
            });       
        }
	, function(){ alertify.error('Se canceló')});

}
function listNotifications(){
    $.ajax({
        url: '../assets/php/notificationCenter/listNotifications.php',
        type: 'GET',
        success: function(response){		
            let items = JSON.parse(response);
            let template = '';
            items.forEach(items => {
                template += `
                <div class="container" style="font-size: 11px">
                    <div class="row d-flex align-items-center dropdown-item">
                        <div class="col">
                            <div><span class="small text-gray-500">${items.fecha}</span>
                                <p>${items.mensaje}</p>
                            </div>
                        </div>
                        <div class="col-md-auto">
                        <a class="btn btn-success btn-circle ml-1" role="button" style="font-size: 11px; width: 30px;height: 30px;margin: -8px;" href="solicitud.php?numero=${items.id_solicitud}/#movimientos"><i class="far fa-eye text-white"></i></a>
                        </div>
                        <div class="col-md-auto">
                        <button class="btn btn-danger btn-circle ml-1" role="button" style="font-size: 11px; width: 30px;height: 30px;margin: -8px;" onclick="deleteNotification(${items.id})"><i class="fas fa-trash text-white"></i></button>
                        </div>
                    </div>
                </div>           
                `	
                });
            $('#notificationCenter').html(template);
        }
    });       
}

function countNotifications(){
    $.ajax({
        url: '../assets/php/notificationCenter/countNotifications.php',
        type: 'GET',
        success: function(response){		
            let items = JSON.parse(response);
            let template = '';
            items.forEach(items => {
                template += `
                ${items.num_notificaciones}
                `	
                });
            $('#numNotifications').html(template);
        }
    });       
}

function deleteNotification(notificationId){
    $.ajax({
        url: '../assets/php/notificationCenter/deleteNotification.php',
        type: 'POST',
        data: {notificationId},
        success: function(response){	
            if(response==1){
                alertify.success("Notificación eliminada");
                listNotifications();
            }else{
                alertify.error(response);
            }
        }
    });  
}

function requestStart(){
    $.ajax({
        url: 'php/requestStart.php',
        type: 'POST',
        success: function(response){	
            alertify.success("Solicitud Iniciada");
            requestId=response;
            //alert("Solicitud creada con exito");
            window.location.href="solicitud.php?numero="+requestId;	
            /*if(response==1){
                
            }else{
                alert("No se inició la solicitud");
                console.log(response);
            }
            */
        }
    });  
}


$(document).ready(function(){
    listNotifications();
    countNotifications();
    $('#btnStartRequest').click(requestStart);
});