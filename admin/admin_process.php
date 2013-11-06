<?php
include_once '../includes/connection.php';
include '../includes/form.php';
if(isset($_GET['page'])){
    
    /////////////////////////////////////////////////////////
    //////////////// Volunteering Activities ////////////////
    /////////////////////////////////////////////////////////
    if($_GET['page'] == "addeventform"){
       ?>

<h3>Add Volunteering Activity</h3>
<form class="form-horizontal" action="uploader.php" id="FileUploader" enctype="multipart/form-data" method="post">
    <input type="hidden" id="hidd" name="descr" />
  <div class="control-group">
    <label class="control-label" for="inputEmail">Title</label>
    <div class="controls text-left">
        <input type="text" name="mName" id="mName" placeholder="Event Title" class="span12"/>
    </div>
  </div>
  <div class="control-group text-left">
    <label class="control-label" for="inputPassword">From</label>
    <div class="controls">
      <input type="text" name="from" id="from" placeholder="Starting Date" class="span12">
    </div>
  </div>
  <div class="control-group text-left">
    <label class="control-label" for="inputPassword">To</label>
    <div class="controls">
      <input type="text" name="to" id="to" placeholder="Ending Date" class="span12">
    </div>
  </div>
   <div class="control-group text-left">
    <label class="control-label" for="inputPassword">Number Of Chances</label>
    <div class="controls">
      <input type="text" name="number" id="chances" placeholder="Number Of Chances" class="span12">
    </div>
  </div>
   <div class="control-group text-left">
    <label class="control-label" for="inputPassword">Description</label>
    <div class="controls">
        <textarea id="description" name="description"  rows="7" ></textarea>
    </div>
  </div>
  <div class="control-group text-left">
      <label class="control-label" for="inputPassword">Event Image</label>
    <div class="controls">
        <input type="file" name="mFile" id="mFile" />
        <span class="help-block">allowed extensions: jpg, png,jpeg,gif</span>
    </div>
  </div>
    <h3 id="output" ></h3>
    <div class="control-group text-left">
    <div class="controls">
      <button type="submit" class="btn btn-primary" id="uploadButton">Add Activity</button>
    </div>
  </div>
    
</form>
        <?php
    }
    
    if($_GET['page'] == "editVolunteeracti"){
        echo $_POST['id'];
        $query = mysql_query("SELECT * FROM volunteer_activity WHERE id='{$_POST['id']}'");
        while ($row = mysql_fetch_array($query)) {
       ?>

<h3>Add Volunteering Activity</h3>
<form class="form-horizontal" action="editVoluntActi.php" id="FileUploader" enctype="multipart/form-data" method="post">
    <input type="hidden" id="hidd" name="descr" />
    <input type="hidden" name="id" value="<?php echo $row['id'] ?>" />
  <div class="control-group">
    <label class="control-label" for="inputEmail">Title</label>
    <div class="controls text-left">
        <input type="text" name="mName" id="mName" value="<?php echo $row['title'] ?>" class="span12"/>
        
    </div>
  </div>
  <div class="control-group text-left">
    <label class="control-label" for="inputPassword">From</label>
    <div class="controls">
      <input type="text" name="from" id="from" value="<?php echo $row['from_date'] ?>" class="span12">
    </div>
  </div>
  <div class="control-group text-left">
    <label class="control-label" for="inputPassword">To</label>
    <div class="controls">
      <input type="text" name="to" id="to" value="<?php echo $row['to_date'] ?>" class="span12">
    </div>
  </div>
   <div class="control-group text-left">
    <label class="control-label" for="inputPassword">Number Of Chances</label>
    <div class="controls">
      <input type="text" name="number" id="chances" value="<?php echo $row['Number_of_people'] ?>" class="span12">
    </div>
  </div>
   <div class="control-group text-left">
    <label class="control-label" for="inputPassword">Description</label>
    <div class="controls">
        <textarea id="description" name="description"  rows="7" ><?php echo $row['discr'] ?></textarea>
    </div>
  </div>
  <div class="control-group text-left">
      <label class="control-label" for="inputPassword"><img src="../uploads/volunteer/<?php echo $row['image'] ?>" class="img-rounded" style="height: 70px; width: 70px" > Change</label>
    <div class="controls">
        <input type="file" name="mFile" id="mFile" />
        <span class="help-block">allowed extensions: jpg, png,jpeg,gif</span>
    </div>
  </div>
    <div class="control-group text-left">
    <div class="controls">
      <button type="submit" class="btn btn-primary" id="uploadButton">Edit Activity</button>
    </div>
  </div>
    <h3 id="output" ></h3>
</form>
        <?php
        }
    }
    
    if($_GET['page'] == "manageVolunteers"){
        $query = mysql_query("SELECT * FROM volunteers");
        $query1 = mysql_query("SELECT * FROM volunteers WHERE status='aply'");
        ?>
<h3>Manage Volunteers</h3>
<p>You have <span class="badge badge-info blink"><?php echo mysql_num_rows($query1) ?></span> Unconfirmed Volunteers</p>
<table id="myTable" class="display tablesorter table-bordered"> 
    <thead>
    <tr>
        <th style="width:50px">#no</th><th class="span4">Name</th><th>Gender</th><th>email</th><th class="span3">Actions</th>
    </tr>
    </thead>
    <tbody>
       <?php
       $counter = 0;
        while ($row = mysql_fetch_array($query)) {
            $counter++;
            ?>
        <tr id="<?php echo $row['id'] ?>">
        <td><?php echo $counter ?></td>
        <td><?php echo $row['first_name']." ".$row['last_name'] ?></td>
        <td><?php echo $row['gender'] ?></td>
        <td><?php echo $row['email'] ?></td>
        <td>
            <a href='#' class='btn btn-info btn-mini view' id="<?php echo $row['id'] ?>"><i class='icon-th-large'></i></a>
            <?php if($row['status'] == "aply"){ ?>
            <a href='#' class='btn btn-warning btn-mini confirm'><i class='icon-thumbs-up'></i>Confirm</a>
            <?php }else{?>
            <a href='#' class='btn btn-success btn-mini' title="confirmed"><i class='icon-thumbs-up icon-white'></i>Confirmed</a>
            <?php }?>
            <a href='#' class='btn btn-danger btn-mini delete'><i class='icon-trash'></i> </a>
        </td>
    </tr>
    
           <?php
        }
        ?>
    </tbody>
    <tfoot>
        <tr>
        <th>#no</th><th>Name</th><th>Gender</th><th>email</th><th>Actions</th>
    </tr>
    </tfoot>
</table>
<?php 
    }
    
    if($_GET['page'] == "manageactivites"){
        $query = mysql_query("SELECT * FROM volunteer_activity");
        
        
        ?>
<h3>Manage Volunteering Activities</h3>

<table id="myTable" class="display tablesorter table-bordered"> 
    <thead>
    <tr>
        <th style="width:30px">#no</th><th class="">Title</th><th>Duration</th><th>Required Volunteers</th><th>Number Of Volunteers</th><th class="">Actions</th>
    </tr>
    </thead>
    <tbody>
       <?php
       $counter = 0;
        while ($row = mysql_fetch_array($query)) {
            $query1 = mysql_query("SELECT * FROM volunteers WHERE activity_id='{$row['id']}'");
            $num = mysql_num_rows($query1);
            $counter++;
            $from = date("M,j Y".strtotime($row1['from']));
            $to = date("M,j Y".strtotime($row1['to']));
            $srt =$from." - ".$to;
            ?>
        <tr id="<?php echo $row['id'] ?>">
            <td><img src='../uploads/volunteer/<?php echo $row['image'] ?>' style="width: 50px;height: 50px"></td>
        <td><?php echo $row['title']?></td>
        <td><?php echo $srt ?></td>
        <td><?php echo $row['Number_of_people'] ?></td>
        <td><?php echo $num ?></td>
        <td>
            <a href='#' class='btn btn-info btn-mini view' id="<?php echo $row['id'] ?>"><i class='icon-th-large'></i></a>
            <a href='#' class='btn btn-warning btn-mini edit' id="<?php echo $row['id'] ?>"><i class='icon-pencil'></i></a>
            <a href='#' class='btn btn-danger btn-mini delete'><i class='icon-trash'></i> </a>
        </td>
    </tr>
    
           <?php
        }
        ?>
    </tbody>
    <tfoot>
        <tr>
        <th style="width:50px">#no</th><th class="">Title</th><th>Duration</th><th>Required Volunteers</th><th>Number Of Volunteers</th><th class="">Actions</th>
    </tr>
    </tfoot>
</table>
<?php 
    }
    
    if($_GET['page'] == "viewvolunteer"){
       
      $query = mysql_query("SELECT * FROM volunteers WHERE id='{$_POST['id']}'");
      ?>
<table  class="table table-bordered table-hover table-striped"> 
    
    <tbody>
       <?php
       $counter = 0;
        while ($row = mysql_fetch_array($query)) {
            $counter++;
            ?>
        
        <tr><th>Name</th><td><?php echo $row['first_name']." ".$row['last_name'] ?></td> </tr>
        <tr><th>Gender</th><td><?php echo $row['gender'] ?></td> </tr>
        <tr><th>Birth Date</th><td><?php echo $row['date_of_birth'] ?></td> </tr>
        <tr><th>Email</th><td><?php echo $row['email']?></td> </tr>
       <tr> <th>Country</th><td><?php echo $row['country'] ?></td> </tr>
       <tr> <th>Activity</th><td> 
            <?php 
            $query2 = mysql_query("SELECT * FROM volunteer_activity WHERE id='{$row['activity_id']}'");
            while ($row2 = mysql_fetch_array($query2)) {
                echo $row2['title'];
            }
             ?>
        </td> </tr>
        
   
    
           <?php
        }
        ?>
    </tbody>
    
    </tfoot>
</table>
<?php
    }
    
    
    if($_GET['page'] == "confirmvolunteer"){
        //form::editUser(array("status"=>"confirmed"),"volunteers", "id", $_POST['id']); 
        $query = mysql_query("SELECT * FROM volunteers WHERE id='{$_POST['id']}'");
        while ($row4 = mysql_fetch_array($query)) {
            $query1 = mysql_query("SELECT * FROM volunteer_activity WHERE id='{$row4['activity_id']}'");
            while ($row5 = mysql_fetch_array($query1)) {
                if($row5['Number_of_people'] != 0){
                    $num = intval($row5['Number_of_people'])-1;
                    form::editUser(array("status"=>"confirmed"),"volunteers", "id", $_POST['id']);
                    form::editUser(array("Number_of_people"=>$num),"volunteer_activity", "id", $row5['id']);
                    echo "success";
                 }else{
                     echo "discarded";
                 }
                 
            }
        }
    }
    
    if($_GET['page'] == "deletevolunteer"){
       
      $query = mysql_query("DELETE FROM volunteers WHERE id='{$_POST['id']}'");
    }
    
    if($_GET['page'] == "deleteactivity"){
       
      $query = mysql_query("DELETE FROM volunteer_activity WHERE id='{$_POST['id']}'");
    }
    
    if($_GET['page'] == "deleteevent"){
      $query = mysql_query("DELETE FROM event WHERE id='{$_POST['id']}'");
    }
    
    if($_GET['page'] == "viewvolunteactivity"){
      $query = mysql_query("SELECT * FROM volunteer_activity WHERE id='{$_POST['id']}'");
      while ($row6 = mysql_fetch_array($query)) {
          ?>
<h3><?php echo $row6['title'] ?></h3>
<p class="lead"><b>From: </b> <?php echo date("M,j Y",  strtotime($row6['from_date'])) ?> <b>To: </b><?php echo date("M,j Y",  strtotime($row6['to_date'])) ?></p>
<p>
    <img src="../uploads/volunteer/<?php echo $row6['image'] ?>" class="img-rounded pull-left" style="height: 150px;width: 150px">
    <?php echo $row6['discr'] ?>
</p>
          <?php
      }
    }
    
    
    ///////////////////////////////////////////////////////
    /////////////// Language Program //////////////////////
    ///////////////////////////////////////////////////////
    if($_GET['page'] == "addlanguageprog"){
       ?>
<h3>Add Language Program</h3>
<form class="form-horizontal" action="admin_process.php?page=addlanguageproc" id="FileUploader"  method="post">
    <input type="hidden" id="hidd" name="descr" />
  <div class="control-group">
    <label class="control-label" for="inputEmail">Title</label>
    <div class="controls text-left">
        <input type="text" name="mName" id="mName" placeholder="Event Title" class="span12"/>
    </div>
  </div>
<!--  <div class="control-group text-left">
    <label class="control-label" for="inputPassword">From</label>
    <div class="controls">
      <input type="text" name="from" id="from" placeholder="Starting Date" class="span12">
    </div>
  </div>
  <div class="control-group text-left">
    <label class="control-label" for="inputPassword">To</label>
    <div class="controls">
      <input type="text" name="to" id="to" placeholder="Ending Date" class="span12">
    </div>
  </div>-->
   <div class="control-group text-left">
    <label class="control-label" for="inputPassword">Description</label>
    <div class="controls">
        <textarea id="description" name="description"  rows="7" ></textarea>
    </div>
  </div>
<h3 id="output" ></h3>
    <div class="control-group text-left">
    <div class="controls">
      <button type="submit" class="btn btn-primary" id="uploadButton">Add Program</button>
    </div>
  </div>
</form>
        <?php
    }
    
    if($_GET['page'] == 'addlanguageproc'){
        $FileTitle= mysql_real_escape_string($_POST['mName']); // file title
        $query = mysql_query("INSERT INTO language_prog VALUES ('', '$FileTitle','{$_POST['descr']}')")or die(mysql_error());
        die("success");
     }
 
     if($_GET['page'] == "editlangprogr"){
        $query = mysql_query("SELECT * FROM language_prog WHERE id='{$_POST['id']}'");
        while ($row = mysql_fetch_array($query)) {
       ?>
            <h3>Edit Language Program</h3>
            <form class="form-horizontal" action="admin_process.php?page=editlanguageproc" id="FileUploader"  method="post">
                <input type="hidden" id="hidd" name="descr" />
                <input type="hidden"  name="id" value="<?php echo $row['id'] ?>" />
              <div class="control-group">
                <label class="control-label" for="inputEmail">Title</label>
                <div class="controls text-left">
                    <input type="text" name="mName" id="mName" value="<?php echo $row['title'] ?>" class="span12"/>
                </div>
              </div>
               <div class="control-group text-left">
                <label class="control-label" for="inputPassword">Description</label>
                <div class="controls">
                    <textarea id="description" name="description"  rows="7" ><?php echo $row['description'] ?></textarea>
                </div>
              </div>
            <h3 id="output" ></h3>
                <div class="control-group text-left">
                <div class="controls">
                  <button type="submit" class="btn btn-primary" id="uploadButton">Edit</button>
                </div>
              </div>
            </form>
        <?php
        }
    }
    
     if($_GET['page'] == "manageLanguageProg"){
        $query = mysql_query("SELECT * FROM language_prog");
        ?>
<h3>Manage Language Programs</h3>

<table id="myTable" class="display tablesorter table-bordered"> 
    <thead>
    <tr>
        <th style="width:30px">#no</th><th class="span7">Title</th><th><small>Applicants</small></th><th class="">Actions</th>
    </tr>
    </thead>
    <tbody>
       <?php
       $counter = 0;
        while ($row = mysql_fetch_array($query)) {
            $query1 = mysql_query("SELECT * FROM course_registry WHERE course_id='{$row['id']}'");
            $num = mysql_num_rows($query1);
            $counter++;
            ?>
        <tr id="<?php echo $row['id'] ?>">
            <td><?php echo $counter ?></td>
        <td><?php echo $row['title']?></td>
        <td><?php echo $num ?></td>
        <td>
            <a href='#' class='btn btn-info btn-mini view' id="<?php echo $row['id'] ?>"><i class='icon-th-large'></i></a>
            <a href='#' class='btn btn-warning btn-mini edit' id="<?php echo $row['id'] ?>"><i class='icon-pencil'></i></a>
            <a href='#' class='btn btn-danger btn-mini delete'><i class='icon-trash'></i> </a>
        </td>
    </tr>
    
           <?php
        }
        ?>
    </tbody>
    <tfoot>
        <tr>
        <th style="width:30px">#no</th><th class="span7">Title</th><th><small>Applicants</small></th><th class="">Actions</th>
    </tr>
    </tfoot>
</table>
<?php 
    }
    
    if($_GET['page'] == "viewlanguageprog"){
        $query = mysql_query("SELECT * FROM language_prog WHERE id='{$_POST['id']}'");
        while ($row = mysql_fetch_array($query)) {
            ?>
<p class="lead"> <?php echo $row['title'] ?></p>
<?php echo $row['description'] ?>
            <?php
        }
    }
    
    if($_GET['page'] == "editlanguageproc"){
        $FileTitle= mysql_real_escape_string($_POST['mName']); // file title
        $query = mysql_query("UPDATE language_prog SET title = '$FileTitle',description = '{$_POST['descr']}' WHERE id='{$_POST['id']}'")or die(mysql_error());
        die("success");
    }
    
    if($_GET['page'] == "deletelanguageproc"){
      $query = mysql_query("DELETE FROM language_prog WHERE id='{$_POST['id']}'");
    }
    
    if($_GET['page'] == "managelangAppl"){
        $query = mysql_query("SELECT * FROM course_registry");
        $query1 = mysql_query("SELECT * FROM volunteers WHERE status='aply'");
        ?>
<h3>Manage Course Applicants</h3>
<table id="myTable" class="display tablesorter table-bordered"> 
    <thead>
    <tr>
        <th style="width:50px">#no</th><th class="span4">Name</th><th>Gender</th><th>email</th><th class="span3">Actions</th>
    </tr>
    </thead>
    <tbody>
       <?php
       $counter = 0;
        while ($row = mysql_fetch_array($query)) {
            $counter++;
            ?>
        <tr id="<?php echo $row['id'] ?>">
        <td><?php echo $counter ?></td>
        <td><?php echo $row['first_name']." ".$row['last_name'] ?></td>
        <td><?php echo $row['gender'] ?></td>
        <td><?php echo $row['email'] ?></td>
        <td>
            <a href='#' class='btn btn-info btn-mini view' id="<?php echo $row['id'] ?>"><i class='icon-th-large'></i></a>
            <a href='#' class='btn btn-danger btn-mini delete'><i class='icon-trash'></i> </a>
        </td>
    </tr>
    
           <?php
        }
        ?>
    </tbody>
    <tfoot>
        <tr>
        <th>#no</th><th>Name</th><th>Gender</th><th>email</th><th>Actions</th>
    </tr>
    </tfoot>
</table>
<?php 
    }

    if($_GET['page'] == "viewlanguageprogappl"){
       
      $query = mysql_query("SELECT * FROM course_registry WHERE id='{$_POST['id']}'");
      ?>
<table  class="table table-bordered table-hover table-striped"> 
    
    <tbody>
       <?php
       $counter = 0;
        while ($row = mysql_fetch_array($query)) {
            $counter++;
            ?>
        
        <tr><th>Name</th><td><?php echo $row['first_name']." ".$row['last_name'] ?></td> </tr>
        <tr><th>Gender</th><td><?php echo $row['gender'] ?></td> </tr>
        <tr><th>Phone</th><td><?php echo $row['phone'] ?></td> </tr>
        <tr><th>Email</th><td><?php echo $row['email']?></td> </tr>
       <tr> <th>Nationality</th><td><?php echo $row['nationality'] ?></td> </tr>
       <tr> <th>Course</th><td> 
            <?php 
            $query2 = mysql_query("SELECT * FROM language_prog WHERE id='{$row['course_id']}'");
            while ($row2 = mysql_fetch_array($query2)) {
                echo $row2['title'];
            }
             ?>
        </td> </tr>
        
   
    
           <?php
        }
        ?>
    </tbody>
    
    </tfoot>
</table>
<?php
    }
 
    if($_GET['page'] == "deletelanguageapp"){
      $query = mysql_query("DELETE FROM course_registry WHERE id='{$_POST['id']}'");
    }

    

///////////////////////////////////////////////////////////////////////////////////////
////////////////////////////Room Reservation /////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////
    if($_GET['page'] == "addRoomSpace"){
       ?>

<h3>Add Accommodation </h3>
<form class="form-horizontal" action="addAccomodation.php" id="FileUploader" enctype="multipart/form-data" method="post">
    <input type="hidden" id="hidd" name="descr" />
  <div class="control-group">
    <label class="control-label" for="inputEmail">Name</label>
    <div class="controls text-left">
        <input type="text" name="mName" id="mName" placeholder="Name" class="span12"/>
    </div>
  </div>
  <div class="control-group text-left">
    <label class="control-label" for="inputPassword">Number Of Rooms</label>
    <div class="controls">
      <input type="text" name="rooms" id="from" placeholder="Number Of Rooms" class="span12">
    </div>
  </div>
  <div class="control-group text-left">
    <label class="control-label" for="inputPassword">Price Range</label>
    <div class="controls">
      <input type="text" name="price" id="to" placeholder="Price Range" class="span12">
    </div>
  </div>
   <div class="control-group text-left">
    <label class="control-label" for="inputPassword">Area Description</label>
    <div class="controls">
        <textarea id="description" name="description"  rows="7" ></textarea>
    </div>
  </div>
  <div class="control-group text-left">
      <label class="control-label" for="inputPassword">Image</label>
    <div class="controls">
        <input type="file" name="mFile" id="mFile" />
        <span class="help-block">allowed extensions: jpg, png,jpeg,gif</span>
    </div>
  </div>
    <h3 id="output" ></h3>
    <div class="control-group text-left">
    <div class="controls">
      <button type="submit" class="btn btn-primary" id="uploadButton">Submit</button>
    </div>
  </div>
    
</form>
        <?php
    }

    if($_GET['page'] == "editroomspace"){
        $query = mysql_query("SELECT * FROM rooms WHERE id = '{$_POST['id']}'");
        while ($row = mysql_fetch_array($query)) {
        
       ?>
<h3>Edit Accommodation </h3>
<form class="form-horizontal" action="editAccomodation.php" id="FileUploader" enctype="multipart/form-data" method="post">
    <input type="hidden" id="hidd" name="descr" />
    <input type="hidden"  name="id" value="<?php echo $row['id'] ?>"/>
  <div class="control-group">
    <label class="control-label" for="inputEmail">Name</label>
    <div class="controls text-left">
        <input type="text" name="mName" id="mName" value="<?php echo $row['name'] ?>" class="span12"/>
    </div>
  </div>
  <div class="control-group text-left">
    <label class="control-label" for="inputPassword">Number Of Rooms</label>
    <div class="controls">
      <input type="text" name="rooms" id="from" value="<?php echo $row['rooms'] ?>" class="span12">
    </div>
  </div>
  <div class="control-group text-left">
    <label class="control-label" for="inputPassword">Price Range</label>
    <div class="controls">
      <input type="text" name="price" id="to" value="<?php echo $row['price'] ?>" class="span12">
    </div>
  </div>
    <div class="control-group text-left">
    <label class="control-label" for="inputPassword">Status</label>
    <div class="controls">
      <?php echo form::generalDropdown("status","Status",array("available","not available"), $row['status']) ?>
    </div>
  </div>
   <div class="control-group text-left">
    <label class="control-label" for="inputPassword">Area Description</label>
    <div class="controls">
        <textarea id="description" name="description"  rows="7" ><?php echo $row['discr'] ?></textarea>
    </div>
  </div>
  <div class="control-group text-left">
      <label class="control-label" for="inputPassword"><img src="../uploads/rooms/<?php echo $row['image'] ?>" class="img-rounded" style="height: 70px; width: 70px" > Change</label>
    <div class="controls">
        <input type="file" name="mFile" id="mFile" />
        <span class="help-block">allowed extensions: jpg, png,jpeg,gif</span>
    </div>
  </div>
    <h3 id="output" ></h3>
    <div class="control-group text-left">
    <div class="controls">
      <button type="submit" class="btn btn-primary" id="uploadButton">Submit</button>
    </div>
  </div>
    
</form>
        <?php    
        }
    }
    
    if($_GET['page'] == "manageRoomSpace"){
        $query = mysql_query("SELECT * FROM rooms");
        ?>
<h3>Manage Accommodations</h3>

<table id="myTable" class="display tablesorter table-bordered"> 
    <thead>
    <tr>
        <th style="width:50px">#</th><th class="">Name</th><th>Price</th><th>Rooms</th><th class="">Actions</th>
    </tr>
    </thead>
    <tbody>
       <?php
       $counter = 0;
        while ($row = mysql_fetch_array($query)) {
            $query1 = mysql_query("SELECT * FROM room_guest WHERE room_id='{$row['id']}'");
            $num = mysql_num_rows($query1);
            ?>
        <tr id="<?php echo $row['id'] ?>">
            <td><img src='../uploads/rooms/<?php echo $row['image'] ?>' style="width: 50px;height: 50px"></td>
        <td><?php echo $row['name']?></td>
        <td><?php echo $row['price'] ?></td>
        <td><?php echo $row['rooms'] ?></td>
        <td>
            <a href='#' class='btn btn-info btn-mini view' id="<?php echo $row['id'] ?>"><i class='icon-th-large'></i></a>
            <a href='#' class='btn btn-warning btn-mini edit' id="<?php echo $row['id'] ?>"><i class='icon-pencil'></i></a>
            <a href='#' class='btn btn-danger btn-mini delete'><i class='icon-trash'></i> </a>
        </td>
    </tr>
    
           <?php
        }
        ?>
    </tbody>
    <tfoot>
        <tr>
        <th style="width:50px">#</th><th class="">Name</th><th>Price</th><th>Rooms</th><th class="">Actions</th>
    </tr>
    </tfoot>
</table>
<?php 
    }

    if($_GET['page'] == "deleteroomspace"){
      $query = mysql_query("DELETE FROM rooms WHERE id='{$_POST['id']}'");
    }
    
    if($_GET['page'] == "viewroomspace"){
        $query = mysql_query("SELECT * FROM rooms WHERE id='{$_POST['id']}'");
        while ($row = mysql_fetch_array($query)) {
            ?>
<p class="lead"> <?php echo $row['name'] ?></p>
<img src="../uploads/rooms/<?php echo $row['image'] ?>" class="pull-left img-rounded" style="height: 120px;width: 150px">
<p><?php echo "Price: ".$row['price'] ?></p>
<p><?php echo "Rooms: ".$row['rooms'] ?></p><hr/>
<?php echo $row['discr'] ?>
            <?php
        }
    }
    
    if($_GET['page'] == "manageroomguest"){
        $query = mysql_query("SELECT * FROM room_guest");
        $query1 = mysql_query("SELECT * FROM room_guest WHERE status='aply'");
        ?>
<h3>Manage Volunteers</h3>
<p>You have <span class="badge badge-info blink"><?php echo mysql_num_rows($query1) ?></span> Unconfirmed Guest</p>
<table id="myTable" class="display tablesorter table-bordered"> 
    <thead>
    <tr>
        <th style="width:50px">#no</th><th class="">Name</th><th>Email</th><th>Space</th><th class="">Actions</th>
    </tr>
    </thead>
    <tbody>
       <?php
       $counter = 0;
        while ($row = mysql_fetch_array($query)) {
            $counter++;
            ?>
        <tr id="<?php echo $row['id'] ?>">
        <td><?php echo $counter ?></td>
        <td><?php echo $row['first_name']." ".$row['last_name'] ?></td>
        <td><?php echo $row['email'] ?></td>
        <td><?php 
        $query2 = mysql_query("SELECT * FROM rooms WHERE id='{$row['room_id']}'");
        $row2 = mysql_fetch_array($query2);
        echo $row2['name']."<br />From: ".date("j,M Y",  strtotime($row['start_date']))."<br /> To: ".date("j,M Y",  strtotime($row['end_date']));
        ?></td>
        <td>
            <a href='#' class='btn btn-info btn-mini view' id="<?php echo $row['id'] ?>"><i class='icon-th-large'></i></a>
            <?php if($row['status'] == "aply"){ ?>
            <a href='#' class='btn btn-warning btn-mini confirm'><i class='icon-thumbs-up'></i>Confirm</a>
            <?php }else{?>
            <a href='#' class='btn btn-success btn-mini' title="confirmed"><i class='icon-thumbs-up icon-white'></i>Confirmed</a>
            <?php }?>
            <a href='#' class='btn btn-danger btn-mini delete'><i class='icon-trash'></i> </a>
        </td>
    </tr>
    
           <?php
        }
        ?>
    </tbody>
    <tfoot>
        <tr>
        <th>#no</th><th>Name</th><th>Email</th><th>Space</th><th>Actions</th>
    </tr>
    </tfoot>
</table>
<?php 
    }
    
    if($_GET['page'] == "deleteroomguest"){
      $query = mysql_query("DELETE FROM room_guest WHERE id='{$_POST['id']}'");
    }
    
    if($_GET['page'] == "viewroomguest"){
       
      $query = mysql_query("SELECT * FROM room_guest WHERE id='{$_POST['id']}'");
      ?>
<table  class="table table-bordered table-hover table-striped"> 
    
    <tbody>
       <?php
       $counter = 0;
        while ($row = mysql_fetch_array($query)) {
            $counter++;
            ?>
        
        <tr><th>Name</th><td><?php echo $row['first_name']." ".$row['last_name'] ?></td> </tr>
        <tr><th>Gender</th><td><?php echo $row['gender'] ?></td> </tr>
        <tr><th>Email</th><td><?php echo $row['email']?></td> </tr>
        <tr><th>Phone Number</th><td><?php echo $row['phone']?></td> </tr>
       <tr> <th>Nationality</th><td><?php echo $row['nationality'] ?></td> </tr>
       <tr> <th>From</th><td><?php echo date("j,M Y",  strtotime($row['start_date'])) ?></td> </tr>
       <tr> <th>To</th><td><?php echo date("j,M Y",  strtotime($row['end_date'])) ?></td> </tr>
       <tr> <th>Space</th><td> 
            <?php 
            $query2 = mysql_query("SELECT * FROM rooms WHERE id='{$row['room_id']}'");
            while ($row2 = mysql_fetch_array($query2)) {
                echo "<img src='../uploads/rooms/{$row2['image']}' style='width: 50px;height: 50px'>";
                echo $row2['name'];
            }
             ?>
        </td> </tr>
        
   
    
           <?php
        }
        ?>
    </tbody>
    
    </tfoot>
</table>
<?php
    }

    if($_GET['page'] == "confirmroomguest"){
        form::editUser(array("status"=>"confirmed"),"room_guest", "id", $_POST['id']); 
        
    }

    //////////////////////////////////////////////////////////////////////////////
    /////////////////Safari And Tours ///////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////
    if($_GET['page'] == "addSafari"){
       ?>

<h3>Add Safari Or Tour </h3>
<form class="form-horizontal" action="addSafari.php" id="FileUploader" enctype="multipart/form-data" method="post">
    <input type="hidden" id="hidd" name="descr" />
  <div class="control-group">
    <label class="control-label" for="inputEmail">Title</label>
    <div class="controls text-left">
        <input type="text" name="mName" id="mName" placeholder="Title" class="span12"/>
    </div>
  </div>
  <div class="control-group text-left">
    <label class="control-label" for="inputPassword">Destination</label>
    <div class="controls">
      <input type="text" name="rooms" id="from" placeholder="Destination" class="span12">
    </div>
  </div>
  <div class="control-group text-left">
    <label class="control-label" for="inputPassword">Price Range</label>
    <div class="controls">
      <input type="text" name="price" id="to" placeholder="Price Range" class="span12">
    </div>
  </div>
   <div class="control-group text-left">
    <label class="control-label" for="inputPassword">Area Description</label>
    <div class="controls">
        <textarea id="description" name="description"  rows="7" ></textarea>
    </div>
  </div>
  <div class="control-group text-left">
      <label class="control-label" for="inputPassword">Image</label>
    <div class="controls">
        <input type="file" name="mFile" id="mFile" />
        <span class="help-block">allowed extensions: jpg, png,jpeg,gif</span>
    </div>
  </div>
    <h3 id="output" ></h3>
    <div class="control-group text-left">
    <div class="controls">
      <button type="submit" class="btn btn-primary" id="uploadButton">Submit</button>
    </div>
  </div>
    
</form>
        <?php
    }
}

    ?>
