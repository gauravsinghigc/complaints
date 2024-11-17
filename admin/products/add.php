<?php
$Dir = "../..";
require $Dir . '/require/modules.php';
require $Dir . '/require/admin/access-control.php';
require $Dir . '/require/admin/sessionvariables.php';

//pagevariables
$PageName = "ADD New Products";
$PageDescription = "Manage all members";
$ProductLabel = "Battery";
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
      document.getElementById("products").classList.add("active");
      document.getElementById("add_products").classList.add("active");
    }
    window.onload = SidebarActive;
  </script>
</head>

<head>
  <meta charset="utf-8" />
  <title><?php echo $PageName; ?> | <?php echo APP_NAME; ?></title>
  <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
  <meta name="keywords" content="<?php echo APP_NAME; ?>">
  <meta name="description" content="<?php echo SHORT_DESCRIPTION; ?>">
  <?php include $Dir . "/include/admin/header_files.php"; ?>
  <script type="text/javascript">
    function SidebarActive() {
      document.getElementById("products").classList.add("active");
      document.getElementById("all_products").classList.add("active");
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
                    <form class="p-2" action="<?php echo CONTROLLER; ?>/products.php" method="POST" enctype="multipart/form-data">
                      <?php FormPrimaryInputs(true); ?>
                      <div class="row">
                        <div class="col-md-6">
                          <h4 class="app-heading">Product Information</h4>
                          <div class="row">
                            <div class="form-group col-lg-7 col-md-7 col-sm-7 col-12">
                              <label><?php echo $ProductLabel; ?> Name</label>
                              <input type="text" name="ProductName" class="form-control" required="">
                            </div>
                            <div class="form-group col-lg-4 col-md-4 col-sm-6 col-6">
                              <label> Manufacturer/Brand</label>
                              <input type="text" name="ProductBrandName" list="ProductBrandName" class="form-control">
                              <?php SUGGEST("products", "ProductBrandName", "ASC"); ?>
                            </div>
                          </div>
                          <div class="row mb-5px">
                            <div class="form-group col-lg-4 col-md-4 col-sm-6 col-6">
                              <label> Modal No</label>
                              <input type="modalno" name="ProductModalNo" class="form-control">
                            </div>
                            <div class="form-group col-lg-4 col-md-4 col-sm-6 col-6">
                              <label> Type</label>
                              <input type="text" name="ProductType" list="ProductType" class="form-control">
                              <?php SUGGEST("products", "ProductType", "ASC"); ?>
                            </div>
                            <div class="form-group col-lg-4 col-md-4 col-sm-6">
                              <label>Capacity (in AH)</label>
                              <input type="text" name="ProductCapacity" class="form-control">
                            </div>
                          </div>

                          <div class="row mb-5px">
                            <div class="form-group col-lg-4 col-md-4 col-sm-6 col-6">
                              <label> Life (In Years)</label>
                              <input type="number" name="ProductLife" class="form-control">
                            </div>
                            <div class="form-group col-lg-4 col-md-4 col-sm-6 col-6">
                              <label> Warranty in Months</label>
                              <input type="number" name="ProductWarrantyinMonths" class="form-control">
                            </div>
                          </div>

                          <div class="row mb-5px">
                            <div class="form-group col-lg-3 col-md-3 col-sm-3 col-6">
                              <label> Sale Price</label>
                              <input type="text" name="ProductSalePrice" id="ProductSalePrice" oninput="CalculateGSTPrice()" class="form-control">
                            </div>
                            <div class="form-group col-lg-3 col-md-3 col-sm-3 col-6">
                              <label> MRP</label>
                              <input type="text" name="ProductMrp" id="mrp" class="form-control">
                            </div>
                            <div class="form-group col-lg-3 col-md-3 col-sm-3 col-6">
                              <label> Application GST</label>
                              <select class="form-control" name="ProductApplicableTaxes" id="GstValue" onchange="CalculateGSTPrice()">
                                <?php InputOptions(["0", "5", "7", "10", "12", "15", "18", "20", "25", "28", "30"], "28"); ?>
                              </select>
                            </div>
                            <div class="form-group col-lg-4 col-md-4 col-sm-4 col-6">
                              <label> Net Price With GST</label>
                              <input type="text" name="ProductNetPayable" id="Netprice" class="form-control" readonly="">
                            </div>
                          </div>

                          <div class="row mb-5px">
                            <div class="form-group col-md-12">
                              <label>Other Information</label>
                              <textarea name="ProductDescription" class="form-control editor" rows="5"></textarea>
                            </div>
                          </div>



                        </div>
                        <div class="col-lg-6">
                          <div class="row">
                            <div class="col-md-12">
                              <h4 class="app-heading">Upload Photos</h4>
                            </div>
                          </div>

                          <div class="p-2 row">
                            <label for="UploadFiles" class="pointer">
                              <img src="<?php echo STORAGE_URL_D; ?>/tool-img/upload-img.png" class="img-fluid">
                            </label>
                            <input type="FILE" id="UploadFiles" name="ProductImages[]" value="null" hidden="" accept="image/*" multiple="">
                          </div>
                          <div class="row">
                            <div class="col-md-12">
                              <div class="gallery"></div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row mb-10px mb-20px">
                        <div class="form-group col-lg-12 col-md-12 col-12">
                          <button class="btn btn-md btn-success" type="submit" name="SaveProducts"><i class="fa fa-check-circle"></i> Save Products</button>
                          <button class="btn btn-md btn-default" type="reset"><i class="fa fa-refresh"></i> Reset</button><br>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>

    <script>
      function CalculateGSTPrice() {
        var GstValue = document.getElementById("GstValue");
        var Netprice = document.getElementById("Netprice");
        var ProductSalePrice = document.getElementById("ProductSalePrice");
        var mrp = document.getElementById("mrp");

        if (GstValue.value == 0) {
          Netprice.value = ProductSalePrice.value;
          mrp.value = +ProductSalePrice.value + 2599;
        } else {
          Netprice.value = (+ProductSalePrice.value * (+GstValue.value / 100)) + +ProductSalePrice.value;
          mrp.value = +ProductSalePrice.value + 2599;
        }
      }
    </script>
    <script>
      $(function() {
        // Multiple images preview in browser
        var imagesPreview = function(input, placeToInsertImagePreview) {

          if (input.files) {
            var filesAmount = input.files.length;

            for (i = 0; i < filesAmount; i++) {
              var reader = new FileReader();

              reader.onload = function(event) {
                $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
              }

              reader.readAsDataURL(input.files[i]);
            }
          }

        };

        $('#UploadFiles').on('change', function() {
          imagesPreview(this, 'div.gallery');
        });
      });
    </script>

    <?php
    include $Dir . "/include/admin/footer.php"; ?>
  </div>

  <?php include $Dir . "/include/admin/footer_files.php"; ?>