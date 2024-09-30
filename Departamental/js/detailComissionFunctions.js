function chargeCommission(IdComision){
    chargeRecord(IdComision);
    listSummary(IdComision);
    listPriceSummary(IdComision);
    listTotalPrice(IdComision);
    //listAprovedReq(IdComision);
    //listDeniedReq(IdComision);
}

function chargeRecord(IdComision){
    $.ajax({
        url: 'php/chargeRecord.php',
        type: 'POST',
        data: {IdComision},
        success: function(response){		
            let items = JSON.parse(response);
            let template = '';
            items.forEach(items => {
            template += ` 
           
                <a href="../assets/uploads/docs/${items.acta}" class="button btn btn-primary">Ver Acta</a>
            `	
            });            
            $('#chargeRecord').html(template);
        }
    });
}

function listAprovedReq(IdComision){
    $.ajax({
        url: 'php/listApprovedRequests.php',
        type: 'POST',
        data: {IdComision},
        success: function(response){	
            let items = JSON.parse(response);
            let template = '';
            items.forEach(items => {
            template += ` 
            <tr>
                <td>${items.id_solicitud}</td>
                <td>${items.nombre_colegio}</td>
                <td><a href="solicitud.php?numero=${items.id_solicitud}" class="btn btn-success btn-circle ml-1" role="button" style="font-size: 12px;width: 35px;height: 35px;margin: -10px;">
                        <i class="far fa-eye text-white"></i>
                    </a>
                </td>           
            </tr>
            `	
            });            
            $('#listAprovedReq').html(template);
        }
    });
}

function listDeniedReq(IdComision){
    $.ajax({
        url: 'php/listDeniedRequests.php',
        type: 'POST',
        data: {IdComision},
        success: function(response){		
            let items = JSON.parse(response);
            let template = '';
            items.forEach(items => {
            template += ` 
            <tr>
                <td>${items.id_solicitud}</td>
                <td>${items.nombre_colegio}</td>
                <td><a href="solicitud.php?numero=${items.id_solicitud}" class="btn btn-success btn-circle ml-1" role="button" style="font-size: 12px;width: 35px;height: 35px;margin: -10px;">
                        <i class="far fa-eye text-white"></i>
                    </a>
                </td>          
            </tr>
            `	
            });            
            $('#listDeniedReq').html(template);
        }
    });

}

function listSummary(IdComision){
    var currentTime = new Date()
    var currentYear = currentTime.getFullYear()
    $.ajax({
        url: 'php/listSummary.php',
        type: 'POST',
        data: {IdComision},
        success: function(response){		
            let items = JSON.parse(response);
            let template = '';
            items.forEach(items => {
            template += ` 
            <tr>
                <td>${items.nombre_colegio}</td>
                <td>${currentYear}-${items.voto}</td>
                <td>${items.id_solicitud}</td>
                <td>${items.precio_total}</td>
                <td>${items.nombre_estado}</td>
                <td>${items.titulo}</td>
                <td>${items.subvenciones}</td>
                <td><a href="solicitud.php?numero=${items.id_solicitud}" class="btn btn-success btn-circle ml-1" role="button" style="font-size: 12px;width: 35px;height: 35px;margin: -10px;">
                        <i class="far fa-eye text-white"></i>
                    </a>
                </td>          
            </tr>
            `	
            });            
            $('#listSummary').html(template);
        }
    });
}

function listPriceSummary(IdComision){
    $.ajax({
        url: 'php/listPriceSummary.php',
        type: 'POST',
        data: {IdComision},
        success: function(response){		
            let items = JSON.parse(response);
            let template = '';
            items.forEach(items => {
            template += ` 
            <tr>
                <td>${items.nombre_colegio}</td>
                <td>${items.dinero_usado}</td>
            </tr>
            `	
            });            
            $('#listPriceSummary').html(template);
        }
    });
}

function listTotalPrice(IdComision){
    $.ajax({
        url: 'php/listTotalPrice.php',
        type: 'POST',
        data: {IdComision},
        success: function(response){		
            let items = JSON.parse(response);
            let template = '';
            items.forEach(items => {
            template += ` 
            <tr>
                <td>${items.titulo}</td>
                <td>${items.gasto_total}</td>
            </tr>
            `	
            });            
            $('#listTotalPrice').html(template);
        }
    });
}


$(document).ready(function(){
    IdComision=$("#IdComision").val();
    chargeCommission(IdComision);
});