
$("#registerform").submit(function(){
    $.ajax({  
        type: 'POST',  
        url: 'php_filemaker.php', 
        data: { 
            firstname:$("#firstname").val(),
            lastname:$("#lastname").val(),
            emailid:$("#emailid").val(),
            contactno:$("#contact").val(),
            adminemail:$("#adminemail").val(),
            password:$("#pwd").val(),

        },
        success: function(response) {
            alert(response);
        }
    });
})

$("#activityform").submit(function(){

    $.ajax({  
        type: 'POST',  
        url: 'activity.php', 
        data: { 
            activity:$("#activityname").val(),
            startdate:$("#startdate").val(),
            enddate:$("#enddate").val(),
            starttime:$("#starttime").val(),
            endtime:$("#endtime").val(),

        },
        success: function(response) {
            alert(response);
        }
    });
});