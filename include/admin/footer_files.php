<?php include(__DIR__ . "/message.php"); ?>

<script src="<?php echo ASSETS_URL; ?>/admin/plugins/jquery/jquery.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/admin/plugins/ekko-lightbox/ekko-lightbox.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/admin/js/adminlte.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/admin/plugins/filterizr/jquery.filterizr.min.js"></script>

<script>
  window.onload = function() {
    document.getElementById("loader").style.display = "none";
  };
</script>

<script>
  function Databar(data) {
    databar = document.getElementById("" + data + "");
    if (databar.style.display === "block") {
      databar.style.display = "none";
    } else {
      databar.style.display = "block";
    }
  }
</script>