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
<p>You have <span class="badge badge-info"><?php echo mysql_num_rows($query1) ?></span> Unconfirmed Volunteers</p>
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

    if($_GET['page'] == "manageRoomSpace"){
        $query = mysql_query("SELECT * FROM rooms");
        ?>
<h3>Manage Accommodations</h3>

<table id="myTable" class="display tablesorter table-bordered"> 
    <thead>
    <tr>
        <th style="width:30px">#no</th><th class="">Name</th><th>Price</th><th>Rooms</th><th></th><th class="">Actions</th>
    </tr>
    </thead>
    <tbody>
       <?php
       $counter = 0;
        while ($row = mysql_fetch_array($query)) {
            $query1 = mysql_query("SELECT * FROM room_guest WHERE room_id='{$row['id']}'");
            $num = mysql_num_rows($query1);
            $counter++;
            $from = date("M,j Y".strtotime($row1['from']));
            $to = date("M,j Y".strtotime($row1['to']));
            $srt =$from." - ".$to;
            ?>
        <tr id="<?php echo $row['id'] ?>">
            <td><img src='../uploads/rooms/<?php echo $row['image'] ?>' style="width: 50px;height: 50px"></td>
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

    
///////////////////////////////////////////////
    ///////////////// Courses /////////////////////
    //////////////////////////////////////////////
//    Short courses
    if($_GET['page'] == "addInternalCourse"){
      ?>

<h3>Add Short Course</h3>
<form class="form-horizontal" action="uploadinternal.php" id="FileUploader" enctype="multipart/form-data" method="post">
    <input type="hidden" id="hidd" name="descr" />
  <div class="control-group">
    <label class="control-label" for="inputEmail">Course Title</label>
    <div class="controls text-left">
        <input type="text" name="mName" id="mName" placeholder="Course Title" class="span12" />
    </div>
  </div>
   <div class="control-group text-left">
    <label class="control-label" for="description">Description</label>
    <div class="controls">
        <textarea id="description" name="description"  rows="7" ></textarea>
    </div>
  </div>
  <div class="control-group text-left">
      <label class="control-label" for="inputPassword">Description  File(optional)</label>
    <div class="controls">
        <input type="file" name="mFile" id="mFile" />
        <span class="help-block">allowed extensions: pdf, doc,docs,html</span>
    </div>
  </div>
  <div class="control-group text-left">
    <label class="control-label" for="url">Course Url (option)</label>
    <div class="controls text-left">
        <input type="text" name="url" id="url" placeholder="http://www.example.com " class="span12" />
    </div>
  </div>
    <div class="control-group text-left">
    <div class="controls">
      <button type="submit" class="btn btn-primary" id="uploadButton">Add Course</button>
    </div>
  </div>
    <h3 id="output" ></h3>
</form>
        <?php  
    }
    
//    Academic Program
    if($_GET['page'] == "addProgram"){
      ?>

<h3>Add Academic Program</h3>
<form class="form-horizontal" action="uploadProgram.php" id="FileUploader" enctype="multipart/form-data" method="post">
    <input type="hidden" id="hidd" name="descr" />
  <div class="control-group">
    <label class="control-label" for="inputEmail">Course Title</label>
    <div class="controls text-left">
        <input type="text" name="mName" id="mName" placeholder="Course Title" class="span12" />
    </div>
  </div>
   <div class="control-group text-left">
    <label class="control-label" for="description">Description</label>
    <div class="controls">
        <textarea id="description" name="description"  rows="7" ></textarea>
    </div>
  </div>
  <div class="control-group text-left">
      <label class="control-label" for="inputPassword">Description  File(optional)</label>
    <div class="controls">
        <input type="file" name="mFile" id="mFile" />
        <span class="help-block">allowed extensions: pdf, doc,docs,html</span>
    </div>
  </div>
  <div class="control-group text-left">
    <label class="control-label" for="url">Course Url (option)</label>
    <div class="controls text-left">
        <input type="text" name="url" id="url" placeholder="http://www.example.com" class="span12" />
    </div>
  </div>
    <div class="control-group text-left">
    <div class="controls">
      <button type="submit" class="btn btn-primary" id="uploadButton">Add Course</button>
    </div>
  </div>
    <h3 id="output" ></h3>
</form>
        <?php  
    }
    
//    Seminars
    if($_GET['page'] == "addSemminar"){
      ?>

<h3>Add Seminar</h3>
<form class="form-horizontal" action="uploadSeminar.php" id="FileUploader" enctype="multipart/form-data" method="post">
    <input type="hidden" id="hidd" name="descr" />
  <div class="control-group">
    <label class="control-label" for="inputEmail">Seminar Title</label>
    <div class="controls text-left">
        <input type="text" name="mName" id="mName" placeholder="Course Title" class="span12" />
    </div>
  </div>
   <div class="control-group text-left">
    <label class="control-label" for="description">Description</label>
    <div class="controls">
        <textarea id="description" name="description"  rows="7" ></textarea>
    </div>
  </div>
  <div class="control-group text-left">
      <label class="control-label" for="inputPassword">Description  File(optional)</label>
    <div class="controls">
        <input type="file" name="mFile" id="mFile" />
        <span class="help-block">allowed extensions: pdf, doc,docs,html</span>
    </div>
  </div>
    <div class="control-group text-left">
    <div class="controls">
      <button type="submit" class="btn btn-primary" id="uploadButton">Add Course</button>
    </div>
  </div>
    <h3 id="output" ></h3>
</form>
        <?php  
    }
    
//    external courses
    if($_GET['page'] == "addExternalCourse"){
      ?>

<h3>Add New External Course</h3>
<form class="form-horizontal" action="uploadexternal.php" id="FileUploader" enctype="multipart/form-data" method="post">
    <input type="hidden" id="hidd" name="descr" />
  <div class="control-group">
    <label class="control-label" for="inputEmail">Course Title</label>
    <div class="controls text-left">
        <input type="text" name="mName" id="mName" placeholder="Course Title" class="span12" />
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="url">Course Url</label>
    <div class="controls text-left">
        <input type="text" name="url" id="url" placeholder="http://www.example.com" class="span12" />
    </div>
  </div>
  
    <div class="control-group text-left">
    <div class="controls">
      <button type="submit" class="btn btn-primary" id="uploadButton">Add Course</button>
    </div>
  </div>
    <h3 id="output"></h3>
</form>
        <?php  
    }
    
//    delete course
    if($_GET['page'] == "deletecourse"){
      $query = mysql_query("DELETE FROM course WHERE id='{$_POST['id']}'");
    }
    
//    view one course
    if($_GET['page'] == "viewcourse"){
      $query = mysql_query("SELECT * FROM course WHERE id='{$_POST['id']}'");
      while ($row1 = mysql_fetch_array($query)) {
          echo "<p class='lead'>{$row1['title']}</p>";
          echo ($row1['description'] == "")?"":"<p>{$row1['description']}</p><hr />";
          echo ($row1['url'] == "")?"":"<p><a href='{$row1['url']}'><i class='icon-globe'></i>{$row1['url']}</a></p>";
          echo ($row1['file'] == "")?"":"</p><a href='../uploads/".$row1['file']."'><i class='icon-file-text'></i> Description file</a></p>";
      }
    }
    
//    manage course
    if($_GET['page'] == "manageCourses"){
        $query = mysql_query("SELECT * FROM course");
        ?>
<h3>Manage Courses</h3>
<ul class="nav nav-tabs" id="myTab">
  <li class="active"><a href="#all">All</a></li>
  <li><a href="#home">Short Courses</a></li>
  <li><a href="#profile">Academic Programs</a></li>
  <li><a href="#messages">External courses</a></li>
  <li><a href="#settings">Seminars</a></li>
</ul>
 
<div class="tab-content">
  <div class="tab-pane active" id="all">
     <?php 
     $query = mysql_query("SELECT * FROM course");
     ?>
     <table class="table">
        <tr><th>#No</th>
            <th>Title</th>
            <th>Type</th>
            <th colspan="2">Action</th>
        </tr>
        <?php
       $counter = 0;
        while ($row = mysql_fetch_array($query)) {
            $counter++;
             ?>
    <tr id="<?php echo $row['id'] ?>">
        <td><?php echo $counter; ?></td>
        <td><?php echo $row['title']; ?></td>
        <td><?php echo $row['type']; ?></td>
        <td><a href='#e' class='details'><i class='icon-th-large'></i> Details</a></td>
        <td><a href='#d' class='delete' style="color: #fa0e0e"><i class='icon-trash'></i> Delete</a></td>
    </tr>
             <?php
        }
        ?>
    </table>
  </div>
  <div class="tab-pane fade" id="home">
      <?php 
     $query = mysql_query("SELECT * FROM course WHERE type='Short Course'");
     ?>
     <table class="table">
        <tr><th>#No</th>
            <th>Title</th>
            <th>Type</th>
            <th colspan="2">Action</th>
        </tr>
        <?php
       $counter = 0;
        while ($row = mysql_fetch_array($query)) {
            $counter++;
             ?>
    <tr id="<?php echo $row['id'] ?>">
        <td><?php echo $counter; ?></td>
        <td><?php echo $row['title']; ?></td>
        <td><?php echo $row['type']; ?></td>
        <td><a href='#e' class='details'><i class='icon-th-large'></i> Details</a></td>
        <td><a href='#d' class='delete' style="color: #fa0e0e"><i class='icon-trash'></i> Delete</a></td>
    </tr>
             <?php
        }
        ?>
    </table>
  </div>
  <div class="tab-pane fade" id="profile">
      <?php 
     $query = mysql_query("SELECT * FROM course WHERE type='Academic Program'");
     ?>
     <table class="table">
        <tr><th>#No</th>
            <th>Title</th>
            <th>Type</th>
            <th colspan="2">Action</th>
        </tr>
        <?php
       $counter = 0;
        while ($row = mysql_fetch_array($query)) {
            $counter++;
             ?>
    <tr id="<?php echo $row['id'] ?>">
        <td><?php echo $counter; ?></td>
        <td><?php echo $row['title']; ?></td>
        <td><?php echo $row['type']; ?></td>
        <td><a href='#e' class='details'><i class='icon-th-large'></i> Details</a></td>
        <td><a href='#d' class='delete' style="color: #fa0e0e"><i class='icon-trash'></i> Delete</a></td>
    </tr>
             <?php
        }
        ?>
    </table>
  </div>
  <div class="tab-pane fade" id="messages">
      <?php 
     $query = mysql_query("SELECT * FROM course WHERE type='External Course'");
     ?>
     <table class="table">
        <tr><th>#No</th>
            <th>Title</th>
            <th>Type</th>
            <th colspan="2">Action</th>
        </tr>
        <?php
       $counter = 0;
        while ($row = mysql_fetch_array($query)) {
            $counter++;
             ?>
    <tr id="<?php echo $row['id'] ?>">
        <td><?php echo $counter; ?></td>
        <td><?php echo $row['title']; ?></td>
        <td><?php echo $row['type']; ?></td>
        <td><a href='#e' class='details'><i class='icon-th-large'></i> Details</a></td>
        <td><a href='#d' class='delete' style="color: #fa0e0e"><i class='icon-trash'></i> Delete</a></td>
    </tr>
             <?php
        }
        ?>
    </table>
  </div>
  <div class="tab-pane fade" id="settings">
      <?php 
     $query = mysql_query("SELECT * FROM course WHERE type='Seminar'");
     ?>
     <table class="table">
        <tr><th>#No</th>
            <th>Title</th>
            <th>Type</th>
            <th colspan="2">Action</th>
        </tr>
        <?php
       $counter = 0;
        while ($row = mysql_fetch_array($query)) {
            $counter++;
             ?>
    <tr id="<?php echo $row['id'] ?>">
        <td><?php echo $counter; ?></td>
        <td><?php echo $row['title']; ?></td>
        <td><?php echo $row['type']; ?></td>
        <td><a href='#e' class='details'><i class='icon-th-large'></i> Details</a></td>
        <td><a href='#d' class='delete' style="color: #fa0e0e"><i class='icon-trash'></i> Delete</a></td>
    </tr>
             <?php
        }
        ?>
    </table>
  </div>
</div>
 
<script>
  $(function () {
   $('#myTab a').click(function (e) {
    e.preventDefault();
    $(this).tab('show');
}); 
  });
</script>

       <?php
    }
    
    /////////////////////////////////////////////////
    /////////////// Projects ///////////////////////
    ////////////////////////////////////////////////
    if($_GET['page'] == "addProject"){
      ?>

<h3>Add New Project</h3>
<form class="form-horizontal" action="uploadProject.php" id="FileUploader" enctype="multipart/form-data" method="post">
    <input type="hidden" id="hidd" name="descr" />
  <div class="control-group">
    <label class="control-label" for="inputEmail">Project Title</label>
    <div class="controls text-left">
        <input type="text" name="mName" id="mName" placeholder="Project Title" class="span12"/>
    </div>
  </div>
   <div class="control-group text-left">
    <label class="control-label" for="description">Description</label>
    <div class="controls">
        <textarea id="description" name="description"  rows="8" ></textarea>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="url">Project URL(optional)</label>
    <div class="controls text-left">
        <input type="text" name="url" id="url" placeholder="http://www.example.com" class="span12"/>
    </div>
  </div>
    <div class="control-group text-left">
    <div class="controls">
      <button type="submit" class="btn btn-primary" id="uploadButton">Add Project</button>
    </div>
  </div>
    <h3 id="output"></h3>
</form>
        <?php  
    }
     
    
    if($_GET['page'] == "manageProject"){
        $query = mysql_query("SELECT * FROM projects");
        ?>
<h3>Manage Projects</h3>
       <?php
       $counter = 0;
        while ($row = mysql_fetch_array($query)) {
            $counter++;
            echo "<div class='row-fluid contents' style='padding-top: 6px;' id='{$row['id']}'>";
             echo "<div class='span8 text-left'>";
              echo $counter.". " .$row['title'];
             echo "</div>";
             echo "<div class='span2'>";
              //echo "<a href='#' class='btn btn-primary btn-mini edit'><i class='icon-pencil'></i> Edit</a>";
             echo "</div>";
             echo "<div class='span2'>";
              echo "<a href='#' class='btn btn-danger btn-mini delete'><i class='icon-trash'></i> Delete</a>";
             echo "</div>";
            echo "</div>";
            echo "<hr />";
        }
    }
    
    if($_GET['page'] == "deleteproject"){
      $query = mysql_query("DELETE FROM projects WHERE id='{$_POST['id']}'");
    }
    ////////////////////////////////////////////////
    /////////////// Conferences ////////////////////
    ///////////////////////////////////////////////
    if($_GET['page'] == "addConference"){
      ?>

<h3>Add New Conference</h3>
<form class="form-horizontal" action="uploadConference.php" id="FileUploader" enctype="multipart/form-data" method="post">
    <input type="hidden" id="hidd" name="descr" />
  <div class="control-group">
    <label class="control-label" for="inputEmail">Title</label>
    <div class="controls text-left">
        <input type="text" name="mName" id="mName" placeholder="Title" class="span12"/>
    </div>
  </div>
  <div class="control-group text-left">
    <label class="control-label" for="inputPassword">Date</label>
    <div class="controls">
      <input type="text" name="eventdate" id="datepicker" placeholder="Conference date" class="span12">
    </div>
  </div>
   <div class="control-group text-left">
    <label class="control-label" for="description">Description</label>
    <div class="controls">
        <textarea id="description" name="description"  rows="8" ></textarea>
    </div>
  </div>
  <div class="control-group text-left">
    <div class="controls">
      <button type="submit" class="btn btn-primary" id="uploadButton">Add Conference</button>
    </div>
  </div>
    <h3 id="output"></h3>
</form>
        <?php  
    }
}

if($_GET['page'] == "manageConference"){
        $query = mysql_query("SELECT * FROM conference");
        ?>
<h3>Manage Conferences</h3>
       <?php
       $counter = 0;
       
        while ($row = mysql_fetch_array($query)) {
            $counter++;
            echo "<div class='row-fluid contents' style='padding-top: 6px;' id='{$row['id']}'>";
             echo "<div class='span8 text-left'>";
              echo $counter.". " .$row['title'];
             echo "</div>";
             echo "<div class='span2'>";
              //echo "<a href='#' class='btn btn-primary btn-mini edit'><i class='icon-pencil'></i> Edit</a>";
             echo "</div>";
             echo "<div class='span2'>";
              echo "<a href='#' class='btn btn-danger btn-mini delete'><i class='icon-trash'></i> Delete</a>";
             echo "</div>";
            echo "</div>";
            echo "<hr />";
        }
    }
    
    if($_GET['page'] == "deleteConference"){
      $query = mysql_query("DELETE FROM conference WHERE id='{$_POST['id']}'");
    }

    if($_GET['page'] == "addUpcoming"){
        //$query = mysql_query("SELECT * FROM course ");
        ?>

     <?php 
     $query = mysql_query("SELECT * FROM course WHERE type !='Seminar'");
     ?>
     <table class="table">
        <tr><th>#No</th>
            <th>Title</th>
            <th>Type</th>
            <th colspan="2">Action</th>
        </tr>
        <?php
       $counter = 0;
        while ($row = mysql_fetch_array($query)) {
            $counter++;
             ?>
    <tr id="<?php echo $row['id']?>">
        <td><?php echo $counter; ?></td>
        <td><?php echo $row['title']; ?></td>
        <td><?php echo $row['type']; ?></td>
        <td><a href='#e' class='add'><i class='icon-plus'></i> Add as upcoming course</a></td>
    </tr>
             <?php
        }
        ?>
    </table>
  
 
<script>
  $(function () {
   $('#myTab a').click(function (e) {
    e.preventDefault();
    $(this).tab('show');
}) 
  })
</script>
<table class="table">
    <tr><th>#No</th>
        <th>Title</th>
        <th>Type</th>
        <th colspan="2">Action</th>
    </tr>
       <?php
       $counter = 0;
        while ($row = mysql_fetch_array($query)) {
            $counter++;
             ?>
    <tr id="<?php echo $row['id'] ?>">
        <td><?php echo $counter; ?></td>
        <td><?php echo $row['title']; ?></td>
        <td><?php echo $row['type']; ?></td>
        <td><a href='#e' class='details'><i class='icon-th-large'></i> Details</a></td>
        <td><a href='#d' class='delete' style="color: #fa0e0e"><i class='icon-trash'></i> Delete</a></td>
    </tr>
             <?php
        }
        ?>
    </table>
       <?php
    }
    
    if($_GET['page'] == "manageUpcoming"){
        $query = mysql_query("SELECT * FROM upcoming_course");
        ?>
<h3>Manage Upcoming Courses</h3>
<div class="row-fluid">
    <div class="span7"><b>Course Title </b></div>
    <div class="span3"><b>Start Date</b></div>
    <div class="span2"></div>
</div>
<?php
       $counter = 0;
        while ($row = mysql_fetch_array($query)) {
            $counter++;
            $query1 = mysql_query("SELECT * FROM course WHERE id='{$row['course_id']}'");
            
            echo "<div class='row-fluid contents' style='padding-top: 6px;' id='{$row['id']}'>";
             echo "<div class='span7 text-left'>";
              while ($row3 = mysql_fetch_array($query1)) {
                echo $counter.". " .$row3['title'];
              }
             echo "</div>";
             echo "<div class='span3'>";
              echo "{$row['date']}";
             echo "</div>";
             echo "<div class='span2'>";
              echo "<a href='#' class='btn btn-danger btn-mini delete'><i class='icon-trash'></i> Delete</a>";
             echo "</div>";
            echo "</div>";
            echo "<hr />";
        }
    }
    
    if($_GET['page'] == "addUpcomingprocess"){
      $query = mysql_query("INSERT INTO  upcoming_course VALUES ('','{$_POST['id']}','{$_POST['date']}')")or die(mysql_error());
      die("sucess");
    }
    
    if($_GET['page'] == "deleteUpcoming"){
      $query = mysql_query("DELETE FROM conference WHERE id='{$_POST['id']}'");
    }
    ?>
