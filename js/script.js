/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function(){
        $(".navbar .nav-collapse li").hover(function(){
            $("#navs .nav-collapse li").removeClass("active");
            $(this).css("background-color","#598DCA")
        },function(){
            $(this).css("background-color","inherit");
        });
    
    $("#navs .nav-collapse li.dropdown").hover(function(){
            $("#navs .nav-collapse li.dropdown").removeClass("open");
            $(this).addClass("open")
        },function(){
            $(this).removeClass("open")
        });
    
    
    $("#showCase .carousel-inner .item img").addClass("img-rounded");
    
    $("#showCase .carousel-inner .item").click(function(){
         
        var modal = "";
                modal +="<div id='addUser' class='modal hide fade' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='false'>";
                modal += "<div class='modal-header'>";
                modal += "<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>";
                modal += "<h3>Photo Album</h3>";
                modal += "</div>";
                modal += "<div class='modal-body'>";
                modal += "<div class='text-center' ><img src='"+$(this).find('img').attr("src") +"' height='300' width='300' /></div>";
                modal += "</div>";
                
                modal += "</div>";
                $("body").append(modal);
                $('#addUser').modal("show");
                $('#addUser').on('hidden', function () {
                    $('#addUser').remove();
                  });
              
});
});

