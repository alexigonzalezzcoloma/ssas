function getYear(){
    year=$('#yearFilter').val();
    return year;
}

function listSchoolBugdetByYear(destiny,year){
    destiny=$('#'+destiny);
    $.ajax({
        url: 'php/listSchoolBugdetByYear.php',
        type: 'POST',
        data: {year},
        success: function(response){		
            let items = JSON.parse(response);
            let template = '';
            items.forEach(items => {
                template += `    
                <tr>
                    <td>${items.titulo}</td>
                    <td>${items.presupuesto_total}</td>
                    <td>${items.presupuesto_utilizado}</td>
                    <td>${items.presupuesto_disponible}</td>
                </tr> 
                    
                    `;
                });
            destiny.html(template);
        }
    });   
}

function listSubsBugdetsByYear(destiny,year){
    destiny=$('#'+destiny);
    $.ajax({
        url: 'php/listSubsBugdetsByYear.php',
        type: 'POST',
        data: {year},
        success: function(response){		
            let items = JSON.parse(response);
            let template = '';
            items.forEach(items => {
                template += ` 
                <tr>
                    <td>${items.titulo}</td>
                    <td>${items.presupuesto_total}</td>
                    <td>${items.presupuesto_utilizado}</td>
                    <td>${items.presupuesto_disponible}</td>
                </tr> 
                `
                });
            destiny.html(template);
        }
    });   
}


$(document).ready(function(){
   
    listSchoolBugdetByYear('listSchoolBugdet',getYear());   
    listSubsBugdetsByYear('listSubsBugdets',getYear());
   
    $('#yearFilter').change(function(){
        listSchoolBugdetByYear('listSchoolBugdet',getYear());    
    });
    
});