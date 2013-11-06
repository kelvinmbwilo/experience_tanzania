<?php

/*
 * this page will be used to display admin home page
 * author:kelvin mbwilo
 * kelvinmbwilo@gmail.com
 */
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Experience Tanzania Limited - Administration Page</title>
        <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap-responsive.min.css">
        <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../jqueryui/css/start/jquery-ui-1.10.3.custom.min.css">
        <link rel="stylesheet" type="text/css" href="../DataTables/media/css/jquery.dataTables.css">
        <link rel="stylesheet" type="text/css" href="../DataTables/media/css/jquery.dataTables_themeroller.css">
        <link rel="stylesheet" type="text/css" href="../themes/font-awesome/css/font-awesome.min.css">
    </head>
    <body>
        
        <div style="background: #F2F9FC">
           <?php include 'topmenu.php'; ?>
      </div>
        <div align="center" >
        
            <!--contents-->
            <div class="row-fluid">
                <div class="span1"></div>
                <div class="span10">
                    <div class="row-fluid" >
                    <div class="span3  text-left" id="leftnav">
                        <?php include 'adminMenu.php'; ?>
                    </div>
                   <div class="span9" id="adminContents">
                       
                   </div>
                </div>
                </div>
                <div class="span1"></div>
            </div>
               
            <!--recent events-->
            
            
            
            </div>
        
        <?php include '../includes/footer.php'; ?>
       
        <script type="text/javascript" src="../js/jquery-1.9.1.js"></script>
        <script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="../jqueryui/js/jquery-ui-1.10.3.custom.js"></script>
        <script type="text/javascript" src="../jqueryui/js/jquery-ui-1.10.3.custom.min.js"></script>
        <script type="text/javascript" src="../js/jquery.form.js"></script>
        <script type="text/javascript" src="../DataTables/media/js/jquery.dataTables.js"></script>
        <script type="text/javascript" src="../DataTables/media/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="../js/admin.js"></script>
        <script type="text/javascript" src="../ckeditor/ckeditor.js"></script>
    </body>
</html>
