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
        if(!isset($_POST['descr']) || strlen($_POST['descr'])<1)
	{
		//required variables are empty
		die("Description is empty!");
	}
	 if(!isset($_POST['eventdate']) || strlen($_POST['eventdate'])<1)
	{
		//required variables are empty
		die("Date is empty!");
	}
        	
        //connect & insert file record in database
        $query = mysql_query("INSERT INTO conference VALUES ('', '{$_POST['mName']}','{$_POST['descr']}','{$_POST['eventdate']}')")or die(mysql_error());
        die("success");
   }else{
   		die('error uploading File!');
   
}


?>

