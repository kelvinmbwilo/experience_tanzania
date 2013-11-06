/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function(){
        
    $("#join_us").click(function(){
         
        var modal = "";
                modal +="<div id='addUser' class='modal hide fade' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='false'>";
                modal += "<div class='modal-header'>";
                modal += "<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>";
                modal += "<h3>Join Our Community</h3>";
                modal += "</div>";
                modal += "<div class='modal-body'>";
                modal += "</div>";
                $("body").append(modal);
                $('#addUser').modal("show");
                $(".modal-body").html("<img src='img/loading.gif'> Please Wait...");
                $(".modal-body").load("includes/applications.php?page=join_us",function(){
                    $(".modal-body form").on('submit', function(e) {
                        e.preventDefault();
                        var fname=$("#firstname").val(),lname=$("#lastname").val(),email=$("#email").val();
                        var gender=$("#gender").val(), country=$("#nationality").val(), phone= $("#phone").val();
                        $(".modal-body").html("<img src='img/loading.gif'> Please Wait...");
                        $.post("includes/applications.php?page=processjoin_us",
                        {
                            first_name:fname,
                            last_name:lname,
                            email:email,
                            gender:gender,
                            country:country,
                            phone_number: phone
                        },
                        function(data){
                            if(data === "success"){
                               $(".modal-body").html("Thank You for joining our community, We will keep you posted on our activies through email"); 
                              }else{
                              $(".modal-body").html("Your Email Has already been Registred, We will keep you posted on our activies through email"); 
                              }
                            setTimeout(function()  {
                                $('#addUser').modal("hide");
                              }, 4000);
                        });
                       
                    });
                    
                });
                
                $("#close").click(function(){
                    $('#addUser').modal("hide");
                })
                $('#addUser').on('hidden', function () {
                    $('#addUser').remove();
                });
              
});

    //////////////////////////////////////////////////////
    /////////////Volunteering ////////////////////////////
    ///////////////////////////////////////////////////////
    $("#volunteer").click(function(){
         
        var modal = "";
                modal +="<div id='addUser' class='modal hide fade' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='false'>";
                modal += "<div class='modal-header'>";
                modal += "<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>";
                modal += "<h3>Volunteer Now!</h3>";
                modal += "</div>";
                modal += "<div class='modal-body'>";
                modal += "</div>";
                $("body").append(modal);
                $('#addUser').modal("show");
                $(".modal-body").html("<img src='img/loading.gif'> Please Wait...");
                $(".modal-body").load("includes/applications.php?page=volunteer",function(){
                    $("#Birth_Date").datepicker({
                        changeMonth: true,
                        changeYear: true,
                        yearRange: "1910:2050",
                        dateFormat:"yy-mm-dd"
                    });
                    $(".modal-body form").on('submit', function(e) {
                        e.preventDefault();
                        var fname=$("#firstname").val(),lname=$("#lastname").val(),email=$("#email").val(),birth=$("#Birth_Date").val();
                        var gender=$("#gender").val(), country=$("#nationality").val(), phone= $("#phone").val();
                        $(".modal-body").html("<img src='img/loading.gif'> Please Wait...");
                        $.post("includes/applications.php?page=volunteerprocess",
                        {
                            first_name:fname,
                            last_name:lname,
                            email:email,
                            gender:gender,
                            country:country,
                            phone: phone,
                            date_of_birth:birth
                        },
                        function(data){
                            var iid = data.split("_");
                           $(".modal-body").load("includes/applications.php?page=selectVolunteerActivity",function(){
                               $(".modal-body form").on('submit', function(e) {
                                   e.preventDefault();
                                    var fname=$("#activity").val(),lname=$("#comments").val();
                                    $(".modal-body").html("<img src='img/loading.gif'> Please Wait...");
                                    $.post("includes/applications.php?page=volunteerprocess1",
                                    {
                                        id:iid[0],
                                        email:iid[1],
                                        status:"aply",
                                        activity_id:fname,
                                        comment:lname
                                    },
                                    function(data){
                                        if(data === "success"){
                                            $(".modal-body").html("Thank You for volunteering, Please stay posted we will contact you soon via email.."); 
                                           }else{
                                           $(".modal-body").html("Your Email Has already been Registred to this activity, Please stay posted we will contact you soon via email."); 
                                           }
                                         setTimeout(function()  {
                                             $('#addUser').modal("hide");
                                           }, 4000);
                                    });
                               });
                           });
                               
                        });
                       
                    });
                    
                });
                
                $("#close").click(function(){
                    $('#addUser').modal("hide");
                })
                $('#addUser').on('hidden', function () {
                    $('#addUser').remove();
                });
              
});

    $("#registercourse").click(function(){
         
        var modal = "";
                modal +="<div id='addUser' class='modal hide fade' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='false'>";
                modal += "<div class='modal-header'>";
                modal += "<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>";
                modal += "<h3>Language Program Registration</h3>";
                modal += "</div>";
                modal += "<div class='modal-body'>";
                modal += "</div>";
                $("body").append(modal);
                $('#addUser').modal("show");
                $(".modal-body").html("<img src='img/loading.gif'> Please Wait...");
                $(".modal-body").load("includes/applications.php?page=courseregister",function(){
                    $(".modal-body form").hide();
                    var id= "";
                    $("#courses").change(function(){
                       id = $(this).val();
                       $(".modal-body form").hide().show("slow");
                    });
                    $(".modal-body form").on('submit', function(e) {
                        e.preventDefault();
                        var fname=$("#firstname").val(),lname=$("#lastname").val(),email=$("#email").val();
                        var gender=$("#gender").val(), country=$("#nationality").val(), phone= $("#phone").val();
                        $(".modal-body").html("<img src='img/loading.gif'> Please Wait...");
                        $.post("includes/applications.php?page=processcourseregistry",
                        {
                            course_id:id,
                            first_name:fname,
                            last_name:lname,
                            email:email,
                            gender:gender,
                            nationality:country,
                            phone: phone
                        },
                        function(data){
                            if(data === "success"){
                               $(".modal-body").html("<b>Thank You, your registration has been received, We will keep you posted on our activies through email</b>"); 
                              }else{
                               $(".modal-body").html("<b>Your Email Has already been Registred, We will keep you posted on our activies through email</b>"); 
                              }
                            setTimeout(function()  {
                                $('#addUser').modal("hide");
                              }, 8000);
                        });
                       
                    });
                    
                });
                
                $("#close").click(function(){
                    $('#addUser').modal("hide");
                })
                $('#addUser').on('hidden', function () {
                    $('#addUser').remove();
                });
              
});

    $("#reserveroom").click(function(){
         
        var modal = "";
                modal +="<div id='addUser' class='modal hide fade' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='false'>";
                modal += "<div class='modal-header'>";
                modal += "<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>";
                modal += "<h3>Accommodation Reservation</h3>";
                modal += "</div>";
                modal += "<div class='modal-body'>";
                modal += "</div>";
                $("body").append(modal);
                $('#addUser').modal("show");
                $(".modal-body").html("<img src='img/loading.gif'> Please Wait...");
                $(".modal-body").load("includes/applications.php?page=roomreserve1",function(){
                     $( "#from" ).datepicker({
                        changeMonth: true,
                        changeYear: true,
                        dateFormat:"yy-mm-dd",
                        onClose: function( selectedDate ) {
                          $( "#to" ).datepicker( "option", "minDate", selectedDate );
                        }
                      });
                      $( "#to" ).datepicker({
                        changeMonth: true,
                        changeYear: true,
                        dateFormat:"yy-mm-dd",
                        onClose: function( selectedDate ) {
                          $( "#from" ).datepicker( "option", "maxDate", selectedDate );
                        }
                      });
                    $(".selec").on('click', function(e) {
                        var id = $(this).attr('id');
                        alert(id)
                        $(".modal-body").html("<img src='img/loading.gif'> Please Wait...");
                        $(".modal-body").load("includes/applications.php?page=roomreserve",function(){
                            $(".modal-body form").on('submit', function(e) {
                                e.preventDefault();
                                var fname=$("#firstname").val(),lname=$("#lastname").val(),email=$("#email").val();
                                var gender=$("#gender").val(), country=$("#nationality").val(), phone= $("#phone").val();
                                $(".modal-body").html("<img src='img/loading.gif'> Please Wait...");
                                $.post("includes/applications.php?page=processcaccomo",
                                {
                                    room_id:id,
                                    first_name:fname,
                                    last_name:lname,
                                    email:email,
                                    gender:gender,
                                    nationality:country,
                                    phone: phone
                                },
                                function(data){
                                    if(data === "success"){
                                        $(".modal-body").html("<b>Thank You, your registration has been received, We will keep you posted on our activies through email</b>"); 
                                       }else{
                                        $(".modal-body").html("<b>Your Email Has already been Registred, We will keep you posted on our activies through email</b>"); 
                                       }
                                     setTimeout(function()  {
                                         $('#addUser').modal("hide");
                                       }, 8000);
                                });


                            });
                            
                        });
                       
                    });
                    
                });
                
                $("#close").click(function(){
                    $('#addUser').modal("hide");
                })
                $('#addUser').on('hidden', function () {
                    $('#addUser').remove();
                });
              
            });
});

