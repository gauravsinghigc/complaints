<?php
$Dir = "../..";
require $Dir . '/require/modules.php';
require $Dir . '/require/admin/access-control.php';
require $Dir . '/require/admin/sessionvariables.php';

//pagevariables
$PageName = "All Customers";
$PageDescription = "Manage all customers";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title><?php echo $PageName; ?> | <?php echo APP_NAME; ?></title>
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
                    <div class="col-md-12 mb-4">
                      <div class="flex-s-b">
                        <a href="add.php" class="btn btn-sm btn-default mb-0 action-btn mr-1"><i class="fa fa-plus"></i></a>
                        <h4 class="app-heading w-100 mb-0 mt-0"><?php echo $PageName; ?> | <?php echo $PageDescription; ?></h4>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <form class="row">
                        <div class="col-md-4 mb-3">
                          <div class="flex-s-b">
                            <input type="search" onchange="form.submit()" value="<?php echo IfRequested("GET", "UserFullName", "", false); ?>" name="UserFullName" list="UserFullName" placeholder="Search User Name..." class="form-control mb-0 form-control-sm w-100">
                            <?php SUGGEST_SQL_DATA("SELECT * FROM users where UserType='Customer'", "UserFullName", "ASC"); ?>
                            <?php if (isset($_GET['UserFullName'])) { ?>
                              <a href="index.php" class="btn btn-sm btn-danger w-50 ml-3"><i class="fa fa-times"></i> Clear Search</a>
                            <?php } ?>
                          </div>
                        </div>
                      </form>
                    </div>
                    <div class="col-md-12">
                      <div class="table-responsive">
                        <table class="table table-striped">
                          <thead>
                            <tr>
                              <th>Sno</th>
                              <th>FullName</th>
                              <th>PhoneNumber</th>
                              <th>EmailId</th>
                              <th>Createdate</th>
                              <th>Complaints</th>
                              <th>Action</th>
                            </tr>
                          </thead>

                          <?php
                          if (isset($_GET['UserFullName'])) {
                            $UserFullName = $_GET['UserFullName'];
                            $AllCustomers = FetchConvertIntoArray("SELECT * FROM users where UserFullName like '%$UserFullName%' and UserType='Customer' ORDER BY UserId Desc", true);
                          } else {
                            $AllCustomers = FetchConvertIntoArray("SELECT * FROM users where UserType='Customer' ORDER BY UserId Desc", true);
                          }
                          if ($AllCustomers != null) {
                            $Sno = 0;
                            foreach ($AllCustomers as $Customers) {
                              $Sno++;
                          ?>
                              <tr>
                                <td><?php echo $Sno; ?></td>
                                <td><?php echo $Customers->UserFullName; ?></td>
                                <td><?php echo $Customers->UserPhoneNumber; ?></td>
                                <td><?php echo $Customers->UserEmailId; ?></td>
                                <td><?php echo DATE_FORMATE2("d M, Y", $Customers->UserCreatedAt); ?></td>
                                <td><?php echo TOTAL("SELECT * FROM complaints where ComplaintsUserId='" . $Customers->UserId . "'"); ?> Complaints</td>
                                <td>
                                  <a href="details/?uid=<?php echo SECURE($Customers->UserId, "e"); ?>" class="btn btn-sm btn-success">View Details</a>
                                </td>
                              </tr>
                          <?php
                            }
                          }
                          ?>
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