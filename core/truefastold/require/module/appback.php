<?php
function APP_BACK($url)
{
 global $pname; ?>
 <!--- main content area -->
 <section class="container-fluid bg-white pb-2 pt-1" id="header">
  <div class="row">
   <div class="col-md-12 text-left mt-2">
    <a href="<?php echo DOMAIN; ?>/<?php echo $url; ?>" class="text-decoration-none flex-start">
     <img src="<?php echo STORAGE_URL_D . '/tool-img/back.png'; ?>" class="back-arrow p-t-0-3">
     <span class="fs-20 p-1 ml-4-pr text-black text-decoration-none"><?php echo $pname; ?></span>
    </a>
   </div>
  </div>
 </section>

<?php }

//back to previous
function BacktoPrevious($access = true)
{
 if ($access == true) {
  $_SESSION['BACK_TO_LAST_PAGE'] = GET_URL();
 } else {
  $_SESSION['BACK_TO_LAST_PAGE'] = DOMAIN;
 }
}

//Error page redirect
function RedirectoErrors($type = "err", $page = "index.php")
{
 if ($type == "err") {
  header("location:" . DOMAIN . "/errors/err/$page");
 } else {
  header("location:" . DOMAIN . "/errors/err/$page");
 }
}
