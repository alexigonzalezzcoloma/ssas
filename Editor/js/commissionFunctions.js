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

$(document).ready(function(){
    chargeComissions();
});