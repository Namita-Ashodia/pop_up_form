<?php include "inc/session.php"; ?>
<?php include "inc/db.php"; ?>
<?php include "inc/header.php"; ?>
<style> .w3-white a{
         text-decoration:none;
	  }
	  .w3-input {padding:2%;}
	  
@media (max-width: 867px) { 
	.m3 {display:none;}
    .m10    {
        width:99.99999%;
    }

.w3-col.m9 {
    width: 99.99999%!important; 
}

}


@media (max-width: 867px) { 
	.m2 {display:none;}
    .m9    {
        width:99.99999%;
    }

.w3-col.m10 {
    width: 99.99999%!important; 
}

}
#error_message{
    background: #F3A6A6;
}
#error_client_add{
    background: #F3A6A6;
}

#success_message{
    background: #CCF5CC;
}

#success_client_add{
    background: #CCF5CC;
}

.ajax_response {
    padding: 10px 20px;
    border: 0;
    width:70%;
    display: inline-block;
    margin-top: 20px;
    cursor: pointer;
	display:none;
	color:#555;
}
	  </style>
<!-- Page Container -->
<div class="w3-container w3-content" style="max-width:1400px;margin-top:80px">    
   <!-- The Grid -->
  <div class="w3-row">
    <!-- Left Column -->
    <div class="w3-col m2">
      <!-- Profile -->
      <div class="w3-card-2 w3-round w3-white">
        <div class="w3-container">
          <p class="w3-center"><img src="images/employee/<?php echo $_SESSION['profile_picture']; ?>" class="w3-circle" style="height:106px;width:106px" alt="profile picture"></p>
         <hr>
         <p><i class="fa fa-pencil fa-fw w3-margin-right w3-text-theme"></i> <?php echo $_SESSION['fname']; ?> </p>
         <p><i class="fa fa-user fa-fw w3-margin-right w3-text-theme"></i> <?php echo $_SESSION['designation']; ?></p>
        <!-- <p><i class="fa fa-birthday-cake fa-fw w3-margin-right w3-text-theme"></i>Techabn</p>-->
        </div>
      </div>
      <br>
	   <style> .w3-white a{ text-decoration:none;  } .w3-input {padding:2%;}  </style>
      
     <?php include "inc/accordian.php"; ?>
      <br>
      
     
    <!-- End Left Column -->
    </div>
    <!-- Middle Column -->
    <div class="w3-col m10">
      <div class="w3-row-padding">
        <div class="w3-col m12">
          <div class="w3-card-2 w3-round w3-white" id="middlecol">
            <div class="w3-container">
			 <h2 class="w3-panel w3-green w3-leftbar w3-border-orange"> Lead </h2><br>

<?php  $hide = "";
// edit clients  
if(isset($_GET['editid'])) {
$editid = trim($_GET['editid']);
$hide = "w3-hide";
$editid_sql = "select * from tms_client where id ='$editid'";
$editid_res = mysqli_query($dbc, $editid_sql) or die(mysqli_error($dbc));
$edrs = mysqli_fetch_assoc($editid_res);
?>

 <div id="error_message" class="ajax_response"></div>
 <div id="success_message" class="ajax_response"></div>
 
 <a href="lead.php"><button class="w3-btn w3-padding w3-teal"  style="width:120px">Cancel &nbsp; < </button></a>
 
 <form class="w3-container w3-animate-top" id="editform" method="POST">
     
     <div class="w3-col l12 w3-center w3-padding">
<br>
  <div class="w3-col s3"> &nbsp; </div>

                    <div class="w3-col s12 l6 w3-padding w3-card-4">


<p><input  type="hidden" name="client_id" id="client_id" value="<?php echo $edrs['id']; ?>" required="">
<input class="w3-input" type="text"  id="clientname" name="client" placeholder="Client Name" value="<?php echo $edrs['client_name']; ?>" maxlength="25"  required="">
</p>

<p>  
<input class="w3-input" type="text"  id="clientnumber" name="client_number" placeholder="Contact Person" value="<?php echo $edrs['client_person']; ?>" maxlength="250"  required="">
</p>
<p>  
<input class="w3-input" type="text"  id="assignedto" name="assigned_to" placeholder="assigned to" value="<?php echo $edrs['assigned_to']; ?>" maxlength="30"  required="">
</p>


<p>  
<input class="w3-input" type="text"  id="clocation" name="location" placeholder="Client Location" value="<?php echo $edrs['client_location']; ?>" maxlength="20"  required="">
</p>


<br>

  <p><center><button type="submit" class="w3-btn w3-padding w3-teal" name="update_client" style="width:120px">Update &nbsp; ❯</button></p>
  
  </center>
  </div>
  </div>
  <div class="w3-col s3"> &nbsp;</div>
</form>
<?php

unset($editid);
unset($_GET['editid']);

}
?>
			 

<?php  
// client delete 
if(isset($_GET['clid'])) {
$id = trim($_GET['clid']);
$clid_del = "delete from tms_client where id ='$id'";
$clid_res = mysqli_query($dbc, $clid_del) or die(mysqli_error($dbc));
unset($id);
unset($_GET['clid']);
if($clid_res) {
echo "<script type='text/javascript'>alert('Client Removed successfully'); </script>";
echo "<script type='text/javascript'> window.location.href='client.php'; </script>";
}
}
?>


               <!--###############  client & client Records #######################-->
<button class="w3-btn w3-right w3-hover-green w3-orange w3-margin-right w3-round" onclick="tableToExcel('id02', 'W3C Example Table')"><i class="fa fa-file-excel-o"></i></button>
<a href="#" onclick="document.getElementById('client').style.display='block'" class="w3-button w3-bar-item w3-hover-green w3-orange w3-text-white w3-right w3-margin-right <?php echo $hide; ?>" 
title="Add lead"><i class="fa fa-plus fa-fw w3-margin-right"></i>Lead</a>
     <br>
	      <div class="w3-padding-top"></div>
              <br> <div class="w3-padding-top"></div>
  <div class="w3-row-padding w3-responsive <?php echo $hide; ?>">
      <table class="w3-table-all w3-small w3-margin-bottom" id="id02">
    <tr class="w3-green">
      <th>Client id</th>
      <th>Client Name</th>
      <th>Client Number</th>
      <th>Assigned to </th>
    <!--  <th>Assigned to </th>-->
      <th>Location</th>
      <th>Action</th>
    </tr>

    
<?php  
     $clnt_qry ="SELECT * from `lead`";
     $clnt_result = mysqli_query($dbc, $clnt_qry) or die(mysqli_error($dbc));
     if(mysqli_num_rows($clnt_result)>0) : ?>
   <?php while($clnt_rs = mysqli_fetch_assoc($clnt_result)) : ?>
     <tr><th><?php echo $clid = $clnt_rs['id']; ?></th>
     <th><?php echo $clientname = $clnt_rs['clientname']; ?></th>
     <th><?php echo $clientnumber = $clnt_rs['clientnumber']; ?></th>
     <th><?php echo $assignedto = $clnt_rs['assignedto']; ?></th>
   
     <th><?php echo $clocation = $clnt_rs['location']; ?></th>
    <!-- <th><?php echo $project_name = $clnt_rs['projectname']; ?></th>-->
   
    <!-- <th><?php echo $clnt_rs['clientlocation']; ?></th>
    <th><?php echo $client_number = $clnt_rs['clientnumber']; ?></th>
    
     <th><?php echo $clnt_rs['clientlocation']; ?></th>
     <th><?php echo $project_rs['location']; ?></th>
     <th><?php echo $project_rs['addedon']; ?></th>
     <th><a href='client.php?details=<?php echo $clid; ?>' ><button class="w3-button-sm w3-green w3-round" style="border:none; cursor:pointer;"><i class="fa fa-eye"></i></button></a>
     <a href='client.php?editid=<?php echo $clid; ?>' ><button class="w3-button-sm w3-yellow w3-round" style="border:none; cursor:pointer;"><i class="fa fa-pencil"></i></button></a>
     <a href='client.php?clid=<?php echo $clid; ?>' ><button class="w3-button-sm w3-red w3-round" style="border:none; cursor:pointer;"><i class="fa fa-trash-o"></i></button></a></th>
    -->
     <th><a href='lead.php?details=<?php echo $clid; ?>' ><button class="w3-button-sm w3-green w3-round" style="border:none; cursor:pointer;"><i class="fa fa-eye"></i></button></a>
     <a href='lead.php?editid=<?php echo $clid; ?>' ><button class="w3-button-sm w3-yellow w3-round" style="border:none; cursor:pointer;"><i class="fa fa-pencil"></i></button></a>
     <a href='lead.php?clid=<?php echo $clid; ?>' ><button class="w3-button-sm w3-red w3-round" style="border:none; cursor:pointer;"><i class="fa fa-trash-o"></i></button></a></th>
     
     
 </tr>
   <?php endwhile; ?>
<?php endif; ?>     
    
  </table>
<br>
    </center></div>

 <br>
   </div>
     </div>
   </div>
   </div>
   </div>
   <!-- End Middle Column -->
   </div>  
<!-- End Page Container -->
</div>
<br>
<!-- Add lead -->
<div id="client" class="w3-modal">
    <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px;border-radius:3px;">
      <div class="w3-center"><br>
        <span onclick="document.getElementById('client').style.display='none'" class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close">&times;</span>
        <img src="../images/techabnlogo.png" alt="Avatar" style="width:30%" class="w3-circle w3-margin-top">
      </div>
      <div id="error_client_add" class="ajax_response"></div>
 <div id="success_client_add" class="ajax_response"></div>
 <br>
      <form id="clientadd" class="w3-container w3-card-4" method="POST">
<br>

<div class="w3-row-padding">
    
    <div class="w3-half">
     <p><input class="w3-input" type="text" id="clientname" name="clientname" maxlength="25" placeholder="Client Name" required=""></p>
    <p><input class="w3-input" type="text" id="clientnumber" name="clientnumber" maxlength="25" placeholder="Client number" required=""></p>
 
  <p>  
    <label class="w3-text-grey">Start Date</label>
    <input type="date" class="w3-input w3-border" id="startdate" name="startdate" placeholder="Start Date" required="">
  </p>
  <p>  
   <label class="w3-text-grey">Next Appointment</label>
   <input type="date" class="w3-input w3-border" id="nextappointment" name="nextappointment" placeholder="next appointment" required="">
  </p>  
  
               
    </div>
    <div class="w3-half">
     <p><input class="w3-input" type="text" id="clocation" name="clocation" placeholder="Client Location" maxlength="20" required=""></p>
           
   <?php 
        $sql_user = "select * from tms_employee";
        $sql_user_res = mysqli_query($dbc, $sql_user) or die(mysqli_error($dbc));
    ?>
    
     <div >
     <label class="w3-text-grey">Assigned to</label>
       <select class="w3-select w3-border" id="assignedto" name="assigned_to[]" multiple>
             <option value="" disabled selected>Assigned to</option>
             <?php while($sql_user_rs = mysqli_fetch_assoc($sql_user_res)) : ?>
             <option value="<?php echo trim($sql_user_rs['email']); ?>" <?php if($assigned_to == trim($sql_user_rs['email'])){echo 'selected';} ?>  ><?php echo trim($sql_user_rs['fname'])." ".trim($sql_user_rs['lname'])." (".trim($sql_user_rs['email']).")" ; ?></option>
             <?php endwhile; ?>
        </select>
    </div>   
</div>

<textarea class="w3-input w3-border" style="width:90%" id="taskdescription" name="taskdescription" placeholder="Task Description" required></textarea>

</div>
<br><!--
<div class="w3-row-padding">
    <div class="w3-half">
         <div class="w3-panel w3-green w3-leftbar w3-border-orange w3-padding" style="color:#fff;"> Billing Address </div>
         <p><input class="w3-input" type="text" name="billing_address_1" placeholder="Address 1" maxlength="45"  required=""></p>
            <p><input class="w3-input" type="text" name="billing_address_2" placeholder="Address 2" maxlength="45"  required=""></p>
            <p><input class="w3-input" type="text" name="billing_address_pincode" placeholder="Pincode" maxlength="6"  required=""></p>
            <p><input class="w3-input" type="text" name="billing_address_contact" placeholder="Contact no" maxlength="10"  required=""></p>
    </div>
    
    <div class="w3-half">
         <div class="w3-panel w3-green w3-leftbar w3-border-orange w3-padding" style="color:#fff;"> Work Address </div> 
         <p><input class="w3-input" type="text" name="work_address_1" placeholder="Address 1" maxlength="45"  required=""></p>
            <p><input class="w3-input" type="text" name="work_address_2" placeholder="Address 2" maxlength="45"  required=""></p>
            <p><input class="w3-input" type="text" name="work_address_pincode" placeholder="Pincode" maxlength="6"  required=""></p>
            <p><input class="w3-input" type="text" name="work_address_contact" placeholder="Contact no" maxlength="10"  required=""></p>
    </div> 
    
</div>  
-->
<br>
  <p><center><button type="submit" id="lead" class="w3-btn w3-padding w3-teal" name="client" style="width:120px">Add &nbsp; ❯</button></center></p>
</form>
      <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
        <button onclick="document.getElementById('client').style.display='none'" type="button" class="w3-button w3-red">Cancel</button>
      </div>

    </div>
  </div>

  <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>

$("#editform").submit(function(e) {
	e.preventDefault();
	var id = $("#client_id").val();
	var client_name = $("#client_name").val();
	var clientnumber = $("#client_number").val();
	var assignedto = $("#assigned_to").val();
	var clocation = $("#client_location").val();

	if(id == "" || client_name == "" || client_number == "" || assigned_to =="" || client_location =="") {
		$("#error_message").show().html("All Fields are Required");
	} else {
		$("#error_message").html("").hide();
		$.ajax({
			type: "POST",
			url: "processform/client-update.php",
			data: "id="+id+"&client_name="+client_name+"&client_number="+client_number+"&assigned_to="+assigned_to+"&client_location="+client_location,
			success: function(data){
				$('#success_message').fadeIn().html(data);
				setTimeout(function() {
					$('#success_message').fadeOut("slow");
				}, 5000 );
                 window.location.replace("lead.php");
			}
		});
	}
})
</script>
<script>

$("#clientadd").submit(function(e) {
	e.preventDefault();
	var clientname = $("#clientname").val();
	var clientnumber = $("#clientnumber").val();
    var assignedto = $("#assignedto").val();
    var startdate=$("#startdate").val();
    var nextappointment = $("#nextappointment").val();
	//var cpname = $("#cpname").val();
	var clocation = $("#clocation").val();
	var taskdescription = $("#taskdescription").val();
	if(clientname == "" || clientnumber == "" || assignedto == "" || startdate == "" || nextappointment =="" || location =="" || taskdescription =="") {
		$("#error_client_add").show().html("All Fields are Required");
	} else {
		$("#error_client_add").html("").hide();
		$.ajax({
			type: "POST",
			url: "processform/lead-add.php",
			data: "clientname="+clientname+"&clientnumber="+clientnumber+"&assignedto="+assignedto+"&startdate="+startdate+"&nextappoinment="+nextappoinment+"&taskdescription="+taskdescription+"&location="+location,
			success: function(data){
				$('#success_client_add').fadeIn().html(data);
				setTimeout(function() {
					$('#success_client_add').fadeOut("slow");
				}, 5000 );
                 window.location.replace("lead.php");
			}
		});
	}
})
var tableToExcel = (function() {
  var uri = 'data:application/vnd.ms-excel;base64,'
    , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'
    , base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }
    , format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }
  return function(table, name) {
    if (!table.nodeType) table = document.getElementById(table)
    var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}
    window.location.href = uri + base64(format(template, ctx))
  }
})()
</script>
<script>
	  $(document).ready(function() {
  function setHeight() {
    windowHeight = $(window).innerHeight();
    $('#middlecol').css('min-height', windowHeight);
  };
  setHeight();
  
  $(window).resize(function() {
    setHeight();
  });
});
</script>
<?php include "inc/footer.php"; ?>
