
function editActivities(user){  

        $("#activityname").val($(user).parents("tr")[0].cells[0].innerText); 
        $("#startdate").val($(user).parents("tr")[0].cells[1].innerText); 
        $("#enddate").val($(user).parents("tr")[0].cells[2].innerText); 
        $("#starttime").val($(user).parents("tr")[0].cells[3].innerText); 
        $("#endtime").val($(user).parents("tr")[0].cells[4].innerText);

        //need to make ajax call to delete the previous record
        $.ajax({  
            type: 'POST',  
            url: 'editactivity.php',
            data: { 
                activityname:$(user).parents("tr")[0].cells[0].innerText,
                startdate:$(user).parents("tr")[0].cells[1].innerText,
                enddate:$(user).parents("tr")[0].cells[2].innerText,
                starttime:$(user).parents("tr")[0].cells[3].innerText,
                endtime:$(user).parents("tr")[0].cells[4].innerText,
            },
            // success: function(response) {
            //     alert(response);
            // }
        });
        
}




function deleteActivities(user){

    // alert($(user).parents("tr")[0].cells[0].innerText);
    $.ajax({  
        type: 'POST',  
        url: 'deleteactivity.php', 
        data: { 
            activityname:$(user).parents("tr")[0].cells[0].innerText,
        },
        success: function(response) {
            alert(response);
        }
    });

    $("table tr:eq(" + user.parentNode.parentNode.rowIndex + ")").remove();

}