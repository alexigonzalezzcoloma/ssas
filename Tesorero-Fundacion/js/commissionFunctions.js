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

function chargeComissions(){
    $.ajax({
        url: 'php/chargeComissions.php',
        type: 'POST',
        success: function(response){		
            let items = JSON.parse(response);
            let template = '';
            items.forEach(items => {
            template += ` 
            <tr>
                <td>${items.id}</td>
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
    chargeComissions();
    $('#checkAll').change(function() {
        $('#formComission > input[type=checkbox]').prop('checked', $(this).is(':checked'));
    });
});