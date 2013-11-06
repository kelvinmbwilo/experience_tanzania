<?php
session_start();
include '../includes/connection.php';


if($_POST)
{	
	if(!isset($_POST['mName']) || strlen($_POST['mName'])<1)
	{
		//required variables are empty
		die("Title is empty!");
	}
	
        if(!isset($_POST['url']) || strlen($_POST['url'])<1)
	{
		//required variables are empty
		die("Course URL is empty!");
	}
        
        $query = mysql_query("INSERT INTO course VALUES('', '{$_POST['mName']}','','','{$_POST['url']}','External Course')")or die(mysql_error());
        die("success");
   }else{
   		die('error uploading File!');
   }

 
?>
