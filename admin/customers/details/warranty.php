<?php
$Dir = "../../..";
require $Dir . '/require/modules.php';
require $Dir . '/require/admin/access-control.php';
require $Dir . '/require/admin/sessionvariables.php';

//pagevariables
$PageName = "All Replacements";
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
          <div class="col-md-4">
           <div class="user-dash">
            <div class="user-img">
             <img src="<?php echo STORAGE_URL; ?>/users/img/profile/<?php echo GET_DATA("UserProfileImage"); ?>" alt="<?php echo GET_DATA("UserFullName"); ?>" title="<?php echo GET_DATA("UserFullName"); ?>" />
            </div>
            <div class="user-details">
             <h4 class="user-name mb-0"><?php echo GET_DATA("UserSalutation"); ?> <?php echo GET_DATA("UserFullName"); ?></h4>
            </div>

            <p class="mt-0 mb-2">
             <a href="&?send_mail_to=<?php echo GET_DATA("UserEmailId"); ?>"><i class="fa fa-envelope"></i> <?php echo GET_DATA("UserEmailId"); ?></a><br>
             <a href="tel:<?php echo GET_DATA("UserPhoneNumber"); ?>"><i class="fa fa-phone-square"></i> <?php echo GET_DATA("UserPhoneNumber"); ?></a><br>
            </p>
            <div class="user-contact-info">
             <?php
             $GetAddress = FetchConvertIntoArray("SELECT * FROM user_addresses WHERE UserAddressUserId='$REQ_UserId'", true);
             if ($GetAddress != null) {
              foreach ($GetAddress as $Address) { ?>
               <p class="flex-s-b mt-0 mb-0">
                <span class="info-details">
                 <i class="fa fa-map-location"></i> <span>
                  <?php echo SECURE($Address->UserStreetAddress, "d"); ?>
                  <?php echo SECURE($Address->UserLocality, "d"); ?>
                  <?php echo SECURE($Address->UserCity, "d"); ?>
                  <?php echo SECURE($Address->UserState, "d"); ?>
                  <?php echo SECURE($Address->UserCountry, "d"); ?>
                  <?php echo SECURE($Address->UserPincode, "d"); ?><br>
                  <?php echo SECURE($Address->UserAddressContactPerson, "d"); ?><br>
                  <?php echo SECURE($Address->UserAddressNotes, "d"); ?><br>
                  <a href=" <?php echo SECURE($Address->UserAddressMapUrl, "d"); ?>" class="btn btn-sm btn-success">View Location On Map</a>
                 </span>
                </span>
               </p>
             <?php }
             } ?>
            </div>
           </div>
          </div>

          <div class="col-md-8">
           <a href="index.php" class="btn btn-sm btn-default">All Complaints</a>
           <a href="replacement.php" class="btn btn-sm btn-default">All Replacement</a>
           <a href="warranty.php" class="btn btn-sm btn-default">All Warranty Cards</a>
           <h4 class="app-heading">All Warranty Cards</h4>
           <div class="table-responsive">
            <table class="table table-striped">
             <thead>
              <tr>
               <th>Sno</th>
               <th>WarrantyNo</th>
               <th>SerialNo</th>
               <th>PurchaseDate</th>
               <th>ExpireDate</th>
               <th>Status</th>
               <th>Action</th>
              </tr>
             </thead>
             <tbody>
              <?php $WarrantyCards = FetchConvertIntoArray("SELECT * FROM warranty_products ORDER BY DATE(WarrantyExpireDate) DESC", true);
              if ($WarrantyCards != null) {
               $Sno = 0;
               foreach ($WarrantyCards as $Cards) {
                $Sno++;
                $WarrantyCustomerId = $Cards->WarrantyCustomerId;
                $UserFullName = FETCH("SELECT * FROM users where UserId='$WarrantyCustomerId'", "UserFullName");
                $UserPhoneNumber = FETCH("SELECT * FROM users WHERE UserId='$WarrantyCustomerId'", "UserPhoneNumber");
              ?>
                <tr>
                 <td><?php echo $Sno; ?></td>
                 <td><?php echo $Cards->WarrantyCustomId; ?></td>
                 <td><?php echo $Cards->WarrantyProductSno; ?></td>
                 <td><?php echo DATE_FORMATE2("d M, Y", $Cards->WarrantyProductPurchasedate); ?></td>
                 <td><?php echo DATE_FORMATE2("d M, Y", $Cards->WarrantyExpireDate); ?></td>
                 <td><?php echo StatusViewWithText($Cards->WarrantyStatus); ?></td>
                 <td>
                  <a href="../../../edoc/warranty.php?warrantyid=<?php echo $Cards->WarrantyProductsId; ?>" class="btn btn-sm btn-success" target="_blank">View Card</a>
                 </td>
                </tr>
              <?php
               }
              } else {
               NoDataTableView("No Warranty Cards Found!", "8");
              } ?>
             </tbody>
            </table>
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

  <?php
  include $Dir . "/include/admin/footer.php"; ?>
 </div>

 <?php include $Dir . "/include/admin/footer_files.php"; ?>

</body>

</html>