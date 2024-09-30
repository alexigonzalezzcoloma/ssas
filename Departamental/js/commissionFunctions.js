function listRequestsCommission(){
    $.ajax({
        url: 'php/listRequestsCommission.php',
        type: 'POST',
        success: function(response){		
            let items = JSON.parse(response);
            let template = '';
            items.forEach(items => {
            template += `
            <tr>
                <td>
                    <div class="form-check" id="formComission">
                        <input name="checkrequest[]" class="form-check-input" type="checkbox" value="${items.id}">
                    </div>
                </td>
                <td><a href="solicitud.php?numero=${items.id}">${items.id}</a><input name="reqid[]" value="${items.id}" hidden></td>
                <td>${items.titulo}</td>
                <td>${items.colegio}</td>
                <td>${items.tipo}</td>
                <td>${items.precio_total}</td>
                <td>${items.recursos}</td>
                <td>${items.estado_actual}</td 
            </tr>
            `	
            });            
            $('#listRequestsCommision').html(template);
        }
    });

}

function acceptRequests(){
    var requests = document.getElementsByName('checkrequest[]');
    arrayYesRequests=new Array();
    arrayNotRequests=new Array();
    for (var i = 0; i < requests.length; i++) {
        var a = requests[i];
        req=a.value;
        if (requests[i].checked == true) {
            arrayYesRequests.push(req);
        }else{
            arrayNotRequests.push(req);
        }
    }
    var stringYesRequests = arrayYesRequests.toString();
    var stringNotRequests = arrayNotRequests.toString();
    
    $("#acceptRequestModal").modal('show');

    $("#sendRequestApproved").click(function(){
        recordFile = $("#recordFile").val();
        realizationDate= $("#recordFile").val();
        var formData= new FormData();
        if(realizationDate!=""){
            if(recordFile.length != 0){
                var File = $("#recordFile")[0].files[0];
                if ((/\.(pdf)$/i).test(File.name)){
                    formData.append('realizationDate',realizationDate);
                    formData.append('File',File);
                    formData.append('arrayYesRequests',stringYesRequests);
                    formData.append('arrayNotRequests',stringNotRequests);
                    alertify.success("Se está subiendo el Archivo, espere hasta que la ventana se cierre automáticamente"); 
                    $.ajax({
                        type:"POST",
                        url:"php/acceptRequests.php", 
                        data:formData,
                        contentType:false,
                        processData:false,
                        success:function(r){
                            if(r==1){
                                alertify.success("Proceso realizado correctamente!");
                                $('#acceptRequestModal').modal('hide');
                                window.location.href="comision-interna.php";
                            }else{
                                alertify.error("Hubieron errores: ");
                                console.log(r);
                            }
                        }
                    }); 
                }else{
                    alertify.error("El acta debe estar en formato PDF");
                }
            }else{
                alertify.error("Debe Seleccionar un fichero");
            }
        }else{
            alertify.error("Debe Seleccionar Fecha de Realización de la Comisión")
        }
    });
}
function chargeComissions(year){
    $.ajax({
        url: 'php/chargeComissions.php',
        type: 'POST',
        data: {year},
        success: function(response){		
            let items = JSON.parse(response);
            let template = '';
            items.forEach(items => {
            template += ` 
            <tr>
                <td>${items.nro}</td>
                <td>${items.fecha}</td>
                <td><a href="detalle-comision.php?IdComision=${items.id}" class="btn btn-success btn-circle ml-1" role="button" style="font-size: 12px;width: 35px;height: 35px;margin: -10px;">
                        <i class="far fa-eye text-white"></i>
                    </a>
                </td>           
            </tr>
            `	
            });            
            $('#chargeCommissions').html(template);
        }
    });
}

function recordGeneration(){
$('#genRecord').modal('show');
}

function diaryGeneration(){
$('#genDiary').modal('show');
}

$(document).ready(function(){
    listRequestsCommission();
    year=$("#yearComissions").val();

    chargeComissions(year);
    $('#checkAll').change(function() {
        $('#formComission > input[type=checkbox]').prop('checked', $(this).is(':checked'));
    });
});