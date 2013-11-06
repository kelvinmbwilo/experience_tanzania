<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include 'form.php';
include 'connection.php';
if (isset($_GET['page'])){
    if($_GET['page'] == "join_us"){
        ?>
<small>By Joining our community you will get updates of our activities </small><br />
<small><span class="text-error">*</span> - Required Field </small>
<form class="form-horizontal">
  <div class="control-group">
    <label class="control-label" for="inputEmail">First Name <span class="text-error"> *</span></label>
    <div class="controls">
        <input type="text" id="firstname" placeholder="First Name" required>
    </div>
  </div>
    
  <div class="control-group">
    <label class="control-label" for="inputEmail">Last Name <span class="text-error"> *</span></label>
    <div class="controls">
      <input type="text" id="lastname" placeholder="Last Name" required>
    </div>
  </div>
    
  <div class="control-group">
    <label class="control-label" for="inputEmail">Gender <span class="text-error"> *</span></label>
    <div class="controls">
      <?php echo form::genderDropdown(""); ?>
    </div>
  </div>
  
   <div class="control-group">
    <label class="control-label" for="inputEmail">Email <span class="text-error"> *</span></label>
    <div class="controls">
        <input type="email" id="email" placeholder="Email" required>
    </div>
  </div>
    
  <div class="control-group">
      <label class="control-label" for="inputPassword">Phone Number <span class="text-error"> *</span></label>
    <div class="controls">
        <input type="text" id="phone" placeholder="Phone Number" required >
    </div>
  </div>
    
  <div class="control-group">
    <label class="control-label" for="inputPassword">Country <span class="text-error"> *</span></label>
    <div class="controls">
      <?php form::countryList(); ?>
    </div>
  </div>
   
  <div class="control-group">
    <div class="controls">
        <button type="submit" class="btn btn-primary pull-right"><i class="icon-hand-right"></i>Join Us</button>
    </div>
  </div>
</form>

        <?php
    }
    
    if($_GET['page'] == "processjoin_us"){
        $query = mysql_query("SELECT * FROM our_community WHERE email='{$_POST['email']}'");
        if(mysql_num_rows($query) == 0){
            form::addUser($_POST, "our_community");
            echo "success";
        }else{
            echo "none";
        }
    }
    
     if($_GET['page'] == "checkmail"){
        
    }
    
    /////////////////////////////////////////////////////////////
    ///////////// VOluntereering ////////////////////////////////
    ////////////////////////////////////////////////////////////
    if($_GET['page'] == "volunteer"){
        ?>
<small>Volunteer To Participate In Volunteering Activities </small><br />
<small><span class="text-error">*</span> - Required Field </small>
<form class="form-horizontal">
  <div class="control-group">
    <label class="control-label" for="inputEmail">First Name <span class="text-error"> *</span></label>
    <div class="controls">
        <input type="text" id="firstname" placeholder="First Name" required>
    </div>
  </div>
    
  <div class="control-group">
    <label class="control-label" for="inputEmail">Last Name <span class="text-error"> *</span></label>
    <div class="controls">
      <input type="text" id="lastname" placeholder="Last Name" required>
    </div>
  </div>
    
  <div class="control-group">
    <label class="control-label" for="inputEmail">Gender <span class="text-error"> *</span></label>
    <div class="controls">
      <?php echo form::genderDropdown(""); ?>
    </div>
  </div>
    
    <div class="control-group">
    <label class="control-label" for="inputEmail">Birth Date <span class="text-error"> *</span></label>
    <div class="controls">
      <input type="text" id="Birth_Date" placeholder="yyyy-mm-dd" required>       
    </div>
  </div>
  
   <div class="control-group">
    <label class="control-label" for="inputEmail">Email <span class="text-error"> *</span></label>
    <div class="controls">
        <input type="email" id="email" placeholder="Email" required>
    </div>
  </div>
    
  <div class="control-group">
      <label class="control-label" for="inputPassword">Phone Number <span class="text-error"> *</span></label>
    <div class="controls">
      <input type="text" id="phone" placeholder="Phone Number" required >
    </div>
  </div>
    
  <div class="control-group">
    <label class="control-label" for="inputPassword">Country <span class="text-error"> *</span></label>
    <div class="controls">
      <?php form::countryList(); ?>
    </div>
  </div>
   
  <div class="control-group">
    <div class="controls">
        <button type="submit" class="btn btn-primary pull-right"><i class="icon-hand-right"></i>Volunteer</button>
    </div>
  </div>
</form>

        <?php
    }

    
    if($_GET['page'] == "volunteerprocess"){
        form::addUser($_POST, "volunteers");
        $query = mysql_query("select * from volunteers order by id desc limit 1");
        while ($row = mysql_fetch_array($query)) {
            echo $row['id']."_".$row['email'];
        }
    }
    
    if($_GET['page'] == "volunteerprocess1"){
        $query = mysql_query("SELECT * FROM volunteers WHERE email='{$_POST['email']}' AND activity_id='{$_POST['activity_id']}'");
        if(mysql_num_rows($query) == 0){
            form::editUser($_POST, "volunteers", "id", $_POST['id']);
            echo "success";
        }else{
            $query = mysql_query("DELETE FROM volunteers WHERE id='{$_POST['id']}'");
        }
    }
    
    if($_GET['page'] == "selectVolunteerActivity"){
        $day = date("Y-m-d");
        $query = mysql_query("SELECT * FROM volunteer_activity WHERE from_date >= '{$day}' AND Number_of_people != '0'");
        $arr = array();
        $srt = "<select id='activity' required class=''>";
        $srt .="<option value='' disabled >Select Activity</option>";
        while ($row1 = mysql_fetch_array($query)) {
            $from = date("M,j Y".strtotime($row1['from_date']));
            $to = date("M,j Y".strtotime($row1['to_date']));
            $srt .="<option value='{$row1['id']}'>".$row1['title']." - ".$from." - ".$to."</option>";
        }
        $srt .= "</select>";
        ?>
<form>
  <fieldset>
    <legend>Select Activity</legend>
    <label><b><em>Select The Activity You Want to Participate.</em></b></label>
    <?php echo $srt; ?>
    <label><b><em>Would you like to share any additional comments?</em></b></label>
    <textarea placeholder="Additional Comments" rows="5" id="comments"></textarea><br />
    <button type="submit" class="btn btn-info">Submit</button>
  </fieldset>
</form>

         <?php
    }

    ////////////////////////////////////////////////////////////////////
    ///////////////// Course Registry /////////////////////////////////
    ////////////////////////////////////////////////////////////////////
    if($_GET['page'] == "courseregister"){
        ?>
<small></small><br />
<small><span class="text-error">*</span> - Required Field </small>

  
   <div class="control-group">
    <label class="control-label" for="inputEmail">Select Course  <span class="text-error"> *</span></label>
    <div class="controls">
       <?php 
        $query = mysql_query("SELECT * FROM language_prog");
        $arr = array();
        $srt = "<select id='courses' required class=''>";
        $srt .="<option value='' selected='selected' disabled >Select Program</option>";
        while ($row1 = mysql_fetch_array($query)) {
            
            $srt .="<option value='{$row1['id']}'>".$row1['title']."</option>";
        }
        $srt .= "</select>";
        echo $srt; ?>
    </div>
  </div>
  <form class="form-horizontal">
  <div class="control-group">
    <label class="control-label" for="inputEmail">First Name <span class="text-error"> *</span></label>
    <div class="controls">
        <input type="text" id="firstname" placeholder="First Name" required>
    </div>
  </div>
     
   
  <div class="control-group">
    <label class="control-label" for="inputEmail">Last Name <span class="text-error"> *</span></label>
    <div class="controls">
      <input type="text" id="lastname" placeholder="Last Name" required>
    </div>
  </div>
    
  <div class="control-group">
    <label class="control-label" for="inputEmail">Gender <span class="text-error"> *</span></label>
    <div class="controls">
      <?php echo form::genderDropdown(""); ?>
    </div>
  </div>
  
   <div class="control-group">
    <label class="control-label" for="inputEmail">Email <span class="text-error"> *</span></label>
    <div class="controls">
        <input type="email" id="email" placeholder="Email" required>
    </div>
  </div>
    
  <div class="control-group">
      <label class="control-label" for="inputPassword">Phone Number <span class="text-error"> *</span></label>
    <div class="controls">
        <input type="text" id="phone" placeholder="Phone Number" required >
    </div>
  </div>
    
  <div class="control-group">
    <label class="control-label" for="inputPassword">Nationality <span class="text-error"> *</span></label>
    <div class="controls">
      <?php form::countryList(); ?>
    </div>
  </div>
   
  <div class="control-group">
    <div class="controls">
        <button type="submit" class="btn btn-primary pull-right"><i class="icon-hand-right"></i>Register</button>
    </div>
  </div>
</form>

        <?php
    }

    
    if($_GET['page'] == "processcourseregistry"){
        $query = mysql_query("SELECT * FROM course_registry WHERE email='{$_POST['email']}' AND course_id='{$_POST['course_id']}'");
        if(mysql_num_rows($query) == 0){
            form::addUser($_POST, "course_registry");
            echo "success";
        }else{
            echo "none";
        }
    }

    /////////////////////////////////////////////////////////////////////
    ////////////////Room Reservation ////////////////////////////////////
    /////////////////////////////////////////////////////////////////////
    if($_GET['page'] == "roomreserve"){
        ?>
<small></small><br />
<small><span class="text-error">*</span> - Required Field </small>
   <div class="control-group">
  </div>
  <form class="form-horizontal">
  <div class="control-group">
    <label class="control-label" for="inputEmail">First Name <span class="text-error"> *</span></label>
    <div class="controls">
        <input type="text" id="firstname" placeholder="First Name" required>
    </div>
  </div>
     
   
  <div class="control-group">
    <label class="control-label" for="inputEmail">Last Name <span class="text-error"> *</span></label>
    <div class="controls">
      <input type="text" id="lastname" placeholder="Last Name" required>
    </div>
  </div>
    
  <div class="control-group">
    <label class="control-label" for="inputEmail">Gender <span class="text-error"> *</span></label>
    <div class="controls">
      <?php echo form::genderDropdown(""); ?>
    </div>
  </div>
  
   <div class="control-group">
    <label class="control-label" for="inputEmail">Email <span class="text-error"> *</span></label>
    <div class="controls">
        <input type="email" id="email" placeholder="Email" required>
    </div>
  </div>
    
  <div class="control-group">
      <label class="control-label" for="inputPassword">Phone Number <span class="text-error"> *</span></label>
    <div class="controls">
        <input type="text" id="phone" placeholder="Phone Number" required >
    </div>
  </div>
    
  <div class="control-group">
    <label class="control-label" for="inputPassword">Nationality <span class="text-error"> *</span></label>
    <div class="controls">
      <?php form::countryList(); ?>
    </div>
  </div>
   
  <div class="control-group">
    <div class="controls">
        <button type="submit" class="btn btn-primary pull-right"><i class="icon-hand-right"></i>Reserve</button>
    </div>
  </div>
</form>
     <?php
    }

    if($_GET['page'] == "roomreserve1"){
        $query = mysql_query("SELECT * FROM rooms WHERE status = 'avv'");
        $arr = array();
        $srt = "<select id='rooms' required class=''>";
        $srt .="<option value='' disabled >Select Accomodation Space</option>";
            ?>
<h4>Select Your Favorite Place</h4>
<small>*Select date range first then click the forward arrow to select</small>
<!--date range-->
From
<input type="text" id="from" name="from" />
to
<input type="text" id="to" name="to" />
<div style="position: relative; height: 300px;width: 450px; overflow-y:scroll">
            <ul class="thumbnails">
<?php
        while ($row1 = mysql_fetch_array($query)) {
            ?>
                <li class="span2">
                    <div class="thumbnail">
                        <img src="uploads/rooms/<?php echo $row1['image'] ?>" alt="" class="img-rounded" style="height:100px">
                        <p><?php echo $row1['name']?> <button class="btn btn-info btn-mini selec" id="<?php echo $row1['id'] ?>"><i class="icon-arrow-right pull-left"></i></button></p>
                        <p class="text-center"><?php echo $row1['price']?></p>
                    </div>
                </li>
            <?php
            
        }
        
        ?>
                </ul>
           </div> 
        <?php
    }
    
    if($_GET['page'] == "processcaccomo"){
        form::addUser($_POST, "room_guest");
        echo "success";
    }
}

?>
