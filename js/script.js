/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function(){
        $(".navbar .nav-collapse li").hover(function(){
            $("#navs .nav-collapse li").removeClass("active");
            $(this).css("background-color","#598DCA").css("height","60px");
        },function(){
            $(this).css("background-color","inherit").css("height","inherit");
        });
    
    $("#navs .nav-collapse li.dropdown").hover(function(){
            $("#navs .nav-collapse li.dropdown").removeClass("open");
            $(this).addClass("open")
        },function(){
            $(this).removeClass("open")
        });
})

