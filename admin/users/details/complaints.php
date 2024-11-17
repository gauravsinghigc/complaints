<?php
$Dir = "../../..";
require $Dir . '/require/modules.php';
require $Dir . '/require/admin/access-control.php';
require $Dir . '/require/admin/sessionvariables.php';

//pagevariables
$PageName = "All Complaints";
$PageDescription = "Manage all customers";

if (isset($_GET['uid'])) {
 $_SESSION['REQ_UserId'] = SECURE($_GET['uid'], "d");
 $REQ_UserId = $_SESSION['REQ_UserId'];
} else {
 $REQ_UserId = $_SESSION['REQ_UserId'];
}

$PageSqls = "SELECT * FROM users where UserId='$REQ_UserId'";
?>
<!DOCTYPE html>
<html lang="en">

<head>
 <meta charset="utf-8" />
 <title><?php echo GET_DATA("UserSalutation"); ?> <?php echo GET_DATA("UserFullName"); ?> | <?php echo APP_NAME; ?></title>
 <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
 <meta name="keywords" content="<?php echo APP_NAME; ?>">
 <meta name="description" content="<?php echo SHORT_DESCRIPTION; ?>">
 <?php include $Dir . "/include/admin/header_files.php"; ?>
 <script type="text/javascript">
  function SidebarActive() {
   document.getElementById("customers").classList.add("active");
   document.getElementById("emp_sec").classList.add("active");
  }
  window.onload = SidebarActive;
 </script>
</head>

<body class="hold-transition sidebar-mini">
 <div class="wrapper">
  <?php include $Dir . "/include/admin/loader.php"; ?>

  <?php
  include $Dir . "/include/admin/header.php";
  include $Dir . "/include/admin/sidebar.php"; ?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
   <!-- Main content -->
   <section class="content">
    <div class="container-fluid">
     <div class="row">

      <div class="col-12">
       <div class="card card-primary">
        <div class="card-body">

         <div class="row">
          <div class="col-md-3">
           <?php include "c-profile.php"; ?>
          </div>
          <div class="col-md-9">
           <div class="row">
            <div class="col-md-12 mb-2">
             <div class="flex-s-b">
              <a href="../index.php" class="btn btn-sm btn-default mr-1 back-btn"><i class="fa fa-angle-left"></i></a>
              <h4 class="app-heading w-100 mb-0 mt-0"><?php echo $PageName; ?></h4>
             </div>
            </div>
            <div class="col-md-12">
             <?php include "common-nav.php"; ?>

             <h5 class="app-sub-heading">Update Contact Address</h5>
            </div>
           </div>
           <div class="col-md-12">
            <div class="table-responsive">
             <table class="table table-striped">
              <tr>
               <th>Sno</th>
               <th>ComplaintNo</th>
               <th>SerialNo</th>
               <th>Createdate</th>
               <th>Status</th>
               <th>Action</th>
              </tr>
              <?php
              $Complaints = FetchConvertIntoArray("SELECT * FROM complaints where ComplaintAssignedTo='$REQ_UserId' ORDER BY DATE(ComplaintCreatedAt) DESC", true);
              if ($Complaints == null) {
               NoDataTableView("No Complaints Found!", 7);
              } else {
               $sNO = 0;
               foreach ($Complaints as $Complaint) {
                $sNO++; ?>
                <tr>
                 <td><?php echo $sNO; ?></td>
                 <td>
                  <a target="_blank" href="../../complaints/details/?id=php echo $Complaint->ComplaintsId; ?>">
                   <?php echo $Complaint->ComplaintsCustomRefId; ?>
                  </a>
                 </td>
                 <td>
                  <?php echo $Complaint->ComplaintProductId; ?>
                 </td>
                 <td>
                  <?php echo DATE_FORMATE2("d M, Y", $Complaint->ComplaintCreatedAt); ?>
                 </td>
                 <td>
                  <?php echo $Complaint->ComplaintStatus; ?></span>
                 </td>
                 <td>
                  <a target="_blank" href="../../complaints/details/?id=php echo $Complaint->ComplaintsId; ?>" class="btn btn-sm btn-success">
                   View Details
                  </a>
                 </td>
                </tr>
              <?php }
              } ?>
             </table>
            </div>
           </div>

          </div>
         </div>
        </div>
       </div>
      </div>
     </div>
    </div>
   </section>
  </div>
  <script>
   function checkpass() {
    var pass1 = document.getElementById("pass1");
    var pass2 = document.getElementById("pass2");
    if (pass1.value === pass2.value) {
     document.getElementById("passbtn").classList.remove("disabled");
     document.getElementById("passmsg").classList.add("text-success");
     document.getElementById("passmsg").classList.remove("text-danger");
     document.getElementById("passmsg").innerHTML = "<i class='fa fa-check-circle'></i> Password Matched!";
    } else {
     document.getElementById("passmsg").classList.remove("text-success");
     document.getElementById("passmsg").classList.add("text-danger");
     document.getElementById("passbtn").classList.add("disabled");
     document.getElementById("passmsg").innerHTML = "<i class='fa fa-warning'></i> Password do not matched!";
    }
   }
  </script>
  <?php
  include $Dir . "/include/admin/footer.php"; ?>
 </div>

 <?php include $Dir . "/include/admin/footer_files.php"; ?>

</body>

</html>