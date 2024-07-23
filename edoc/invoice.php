<?php
//include files
require "../require/modules.php";

if (isset($_GET['invoiceid'])) {
  $InvoiceId = SECURE($_GET['invoiceid'], "d");
  $_SESSION['InvoiceId'] = $InvoiceId;
} else {
  $InvoiceId = $_SESSION['InvoiceId'];
}
$InvoiceSql = "SELECT * FROM invoices where InvoiceId='$InvoiceId'";
$InvoiceProductsSql = "SELECT * FROM invoice_products where InvoiceMainId='$InvoiceId'";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>file_1662701056595</title>
  <style type="text/css">
    * {
      margin: 0;
      padding: 0;
      text-indent: 0;
    }

    .s1 {
      color: black;
      font-family: Arial, sans-serif;
      font-style: normal;
      font-weight: bold;
      text-decoration: none;
      font-size: 10pt;
    }

    .s2 {
      color: black;
      font-family: Arial, sans-serif;
      font-style: normal;
      font-weight: normal;
      text-decoration: none;
      font-size: 10pt;
    }

    .s3 {
      color: black;
      font-family: Arial, sans-serif;
      font-style: normal;
      font-weight: normal;
      text-decoration: none;
      font-size: 10pt;
    }

    .s4 {
      color: black;
      font-family: Arial, sans-serif;
      font-style: normal;
      font-weight: normal;
      text-decoration: none;
      font-size: 9pt;
    }

    .s5 {
      color: black;
      font-family: Arial, sans-serif;
      font-style: normal;
      font-weight: normal;
      text-decoration: none;
      font-size: 8pt;
    }

    .s6 {
      color: black;
      font-family: Arial, sans-serif;
      font-style: normal;
      font-weight: normal;
      text-decoration: none;
      font-size: 8pt;
      vertical-align: 1pt;
    }

    .s7 {
      color: black;
      font-family: Arial, sans-serif;
      font-style: normal;
      font-weight: normal;
      text-decoration: none;
      font-size: 9pt;
    }

    .s8 {
      color: black;
      font-family: Arial, sans-serif;
      font-style: normal;
      font-weight: normal;
      text-decoration: none;
      font-size: 7pt;
    }

    .s9 {
      color: black;
      font-family: Arial, sans-serif;
      font-style: italic;
      font-weight: bold;
      text-decoration: none;
      font-size: 9pt;
    }

    .s10 {
      color: black;
      font-family: Arial, sans-serif;
      font-style: italic;
      font-weight: normal;
      text-decoration: none;
      font-size: 8pt;
    }

    .s11 {
      color: black;
      font-family: Arial, sans-serif;
      font-style: normal;
      font-weight: bold;
      text-decoration: none;
      font-size: 9pt;
    }

    .s12 {
      color: black;
      font-family: Arial, sans-serif;
      font-style: normal;
      font-weight: normal;
      text-decoration: none;
      font-size: 10.5pt;
    }

    .s14 {
      color: black;
      font-family: Arial, sans-serif;
      font-style: normal;
      font-weight: bold;
      text-decoration: none;
      font-size: 7pt;
    }

    .s15 {
      color: black;
      font-family: Arial, sans-serif;
      font-style: normal;
      font-weight: normal;
      text-decoration: none;
      font-size: 8pt;
      vertical-align: -1pt;
    }

    .s16 {
      color: black;
      font-family: Arial, sans-serif;
      font-style: normal;
      font-weight: bold;
      text-decoration: none;
      font-size: 8pt;
    }

    table,
    tbody {
      vertical-align: top;
      overflow: visible;
    }
  </style>
</head>

<body style="padding:1rem;">
  <div style="width:800px;margin:0% auto;">
    <table style="border-collapse: collapse; margin-left: 5.125pt" cellspacing="0">
      <tr style="height: 25pt">
        <td style="
      width: 285pt;
      border-top-style: solid;
      border-top-width: 1pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     " colspan="5" rowspan="5">
          <p class="s1" style="
       padding-top: 3pt;
       padding-left: 1pt;
       text-indent: 0pt;
       text-align: left;
      ">
            <?php echo APP_NAME; ?>
          </p>
          <p class="s2" style="
       padding-left: 1pt;
       padding-right: 72pt;
       text-indent: 0pt;
       text-align: left;
      ">
            <?php echo SECURE(PRIMARY_ADDRESS, "d"); ?>
          </p>
          E-Mail : <?php echo PRIMARY_EMAIL; ?><br>
          Phone no : <?php echo PRIMARY_PHONE; ?>
          </p>
        </td>
        <td style="
      width: 116pt;
      border-top-style: solid;
      border-top-width: 1pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-bottom-style: solid;
      border-bottom-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     " colspan="5">
          <p class="s4" style="
       padding-top: 2pt;
       padding-left: 2pt;
       text-indent: 0pt;
       text-align: left;
      ">
            Invoice No.
          </p>
          <p class="s1" style="
       padding-left: 2pt;
       text-indent: 0pt;
       line-height: 10pt;
       text-align: left;
      ">
            <?php echo FETCH($InvoiceSql, "InvoiceCustomId"); ?>
          </p>
        </td>
        <td style="
      width: 122pt;
      border-top-style: solid;
      border-top-width: 1pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-bottom-style: solid;
      border-bottom-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     " colspan="4">
          <p class="s4" style="
       padding-top: 2pt;
       padding-left: 1pt;
       text-indent: 0pt;
       text-align: left;
      ">
            Dated
          </p>
          <p class="s1" style="
       padding-left: 1pt;
       text-indent: 0pt;
       line-height: 10pt;
       text-align: left;
      ">
            <?php echo DATE_FORMATE2("d-M-Y", FETCH($InvoiceSql, "InvoiceDate")); ?>
          </p>
        </td>
      </tr>
      <tr style="height: 24pt">
        <td style="
      width: 116pt;
      border-top-style: solid;
      border-top-width: 1pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-bottom-style: solid;
      border-bottom-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     " colspan="5">
          <p class="s4" style="
       padding-top: 1pt;
       padding-left: 2pt;
       text-indent: 0pt;
       text-align: left;
      ">
            Delivery Note
          </p>
        </td>
        <td style="
      width: 122pt;
      border-top-style: solid;
      border-top-width: 1pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-bottom-style: solid;
      border-bottom-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     " colspan="4">
          <p class="s4" style="
       padding-top: 1pt;
       padding-left: 1pt;
       text-indent: 0pt;
       text-align: left;
      ">
            Mode/Terms of Payment
          </p>
        </td>
      </tr>
      <tr style="height: 24pt">
        <td style="
      width: 116pt;
      border-top-style: solid;
      border-top-width: 1pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-bottom-style: solid;
      border-bottom-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     " colspan="5">
          <p class="s4" style="
       padding-top: 1pt;
       padding-left: 2pt;
       text-indent: 0pt;
       text-align: left;
      ">
            Reference No. &amp; Date.
          </p>
        </td>
        <td style="
      width: 122pt;
      border-top-style: solid;
      border-top-width: 1pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-bottom-style: solid;
      border-bottom-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     " colspan="4">
          <p class="s4" style="
       padding-top: 1pt;
       padding-left: 1pt;
       text-indent: 0pt;
       text-align: left;
      ">
            Other References
          </p>
        </td>
      </tr>
      <tr style="height: 24pt">
        <td style="
      width: 116pt;
      border-top-style: solid;
      border-top-width: 1pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-bottom-style: solid;
      border-bottom-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     " colspan="5">
          <p class="s4" style="
       padding-top: 1pt;
       padding-left: 2pt;
       text-indent: 0pt;
       text-align: left;
      ">
            Buyer’s Order No.
          </p>
        </td>
        <td style="
      width: 122pt;
      border-top-style: solid;
      border-top-width: 1pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-bottom-style: solid;
      border-bottom-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     " colspan="4">
          <p class="s4" style="
       padding-top: 1pt;
       padding-left: 1pt;
       text-indent: 0pt;
       text-align: left;
      ">
            Dated
          </p>
        </td>
      </tr>
      <tr style="height: 2pt">
        <td style="
      width: 116pt;
      border-top-style: solid;
      border-top-width: 1pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     " colspan="5">
          <p style="text-indent: 0pt; text-align: left"><br /></p>
        </td>
        <td style="
      width: 122pt;
      border-top-style: solid;
      border-top-width: 1pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     " colspan="4">
          <p style="text-indent: 0pt; text-align: left"><br /></p>
        </td>
      </tr>
      <tr style="height: 4pt">
        <td style="
      width: 285pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-bottom-style: solid;
      border-bottom-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     " colspan="5">
          <p style="text-indent: 0pt; text-align: left"><br /></p>
        </td>
        <td style="
      width: 116pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     " colspan="5" rowspan="2">
          <p class="s4" style="
       padding-left: 2pt;
       text-indent: 0pt;
       line-height: 10pt;
       text-align: left;
      ">
            Dispatch Doc No.
          </p>
        </td>
        <td style="
      width: 122pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     " colspan="4" rowspan="2">
          <p class="s4" style="
       padding-left: 1pt;
       text-indent: 0pt;
       line-height: 10pt;
       text-align: left;
      ">
            Delivery Note Date
          </p>
        </td>
      </tr>
      <tr style="height: 15pt">
        <td style="
      width: 285pt;
      border-top-style: solid;
      border-top-width: 1pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     " colspan="5">
          <p class="s4" style="
       padding-top: 2pt;
       padding-left: 1pt;
       text-indent: 0pt;
       text-align: left;
      ">
            Consignee (Ship to)
          </p>
        </td>
      </tr>
      <tr style="height: 4pt">
        <td style="
      width: 285pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     " colspan="5" rowspan="3">
          <p class="s2" style="
       padding-left: 1pt;
       padding-right: 72pt;
       text-indent: 0pt;
       text-align: left;
      ">
            <?php
            $InvoiceCustomerId = FETCH($InvoiceSql, "InvoiceCustomerId");
            $Csql = "SELECT * FROM users where UserId='$InvoiceCustomerId'";
            $AddressSql = "SELECT * FROM user_addresses where UserAddressUserId='$InvoiceCustomerId'";

            echo "<b>" . FETCH($Csql, "UserCompanyName") . "</b><br>";
            echo SECURE(FETCH($AddressSql, "UserStreetAddress"), "d") . " <br>";
            echo SECURE(FETCH($AddressSql, "UserLocality"), "d") . " ";
            echo SECURE(FETCH($AddressSql, "UserCity"), "d") . "<br>";
            echo SECURE(FETCH($AddressSql, "UserState"), "d") . " ";
            echo SECURE(FETCH($AddressSql, "UserPincode"), "d") . "<br><br>";
            echo "Phone: " . FETCH($Csql, "UserPhoneNumber") . "<br>";
            echo "Email: " . FETCH($Csql, "UserEmailId") . "<br>";

            ?>
          </p>
        </td>
        <td style="
      width: 116pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-bottom-style: solid;
      border-bottom-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     " colspan="5">
        </td>
        <td style="
      width: 122pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-bottom-style: solid;
      border-bottom-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     " colspan="4">
        </td>
      </tr>
      <tr style="height: 24pt">
        <td style="
      width: 116pt;
      border-top-style: solid;
      border-top-width: 1pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-bottom-style: solid;
      border-bottom-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     " colspan="5">
          <p class="s4" style="
       padding-top: 1pt;
       padding-left: 2pt;
       text-indent: 0pt;
       text-align: left;
      ">
            Dispatched through
          </p>
        </td>
        <td style="
      width: 122pt;
      border-top-style: solid;
      border-top-width: 1pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-bottom-style: solid;
      border-bottom-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     " colspan="4">
          <p class="s4" style="
       padding-top: 1pt;
       padding-left: 1pt;
       text-indent: 0pt;
       text-align: left;
      ">
            Destination
          </p>
        </td>
      </tr>
      <tr style="height: 48pt">
        <td style="
      width: 238pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     " colspan="9">
          <p class="s4" style="
       padding-top: 1pt;
       padding-left: 2pt;
       text-indent: 0pt;
       text-align: left;
      ">
            Terms of Delivery
          </p>
        </td>
      </tr>
      <tr style="height: 12pt">
        <td style="
      width: 57pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-bottom-style: solid;
      border-bottom-width: 1pt;
     ">

        </td>
        <td style="width: 115pt; border-bottom-style: solid; border-bottom-width: 1pt">
          <p class="s6" style="
       padding-top: 2pt;
       padding-left: 21pt;
       text-indent: 0pt;
       line-height: 8pt;
       text-align: left;
      ">

          </p>
        </td>
        <td style="width: 36pt; border-bottom-style: solid; border-bottom-width: 1pt">
          <p style="text-indent: 0pt; text-align: left"><br /></p>
        </td>
        <td style="width: 18pt; border-bottom-style: solid; border-bottom-width: 1pt">
          <p style="text-indent: 0pt; text-align: left"><br /></p>
        </td>
        <td style="width: 37pt; border-bottom-style: solid; border-bottom-width: 1pt">
          <p style="text-indent: 0pt; text-align: left"><br /></p>
        </td>
        <td style="width: 5pt; border-bottom-style: solid; border-bottom-width: 1pt">
          <p style="text-indent: 0pt; text-align: left"><br /></p>
        </td>
        <td style="width: 12pt; border-bottom-style: solid; border-bottom-width: 1pt">
          <p style="text-indent: 0pt; text-align: left"><br /></p>
        </td>
        <td style="
      width: 5pt;
      border-bottom-style: solid;
      border-bottom-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     ">
          <p style="text-indent: 0pt; text-align: left"><br /></p>
        </td>
        <td style="
      width: 238pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     " colspan="6">
          <p style="text-indent: 0pt; text-align: left"><br /></p>
        </td>
      </tr>
      <tr style="height: 15pt">
        <td style="
      width: 285pt;
      border-top-style: solid;
      border-top-width: 1pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     " colspan="5">
          <p class="s4" style="
       padding-top: 2pt;
       padding-left: 1pt;
       text-indent: 0pt;
       text-align: left;
      ">
            Buyer (Bill to)
          </p>
        </td>
        <td style="
      width: 238pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     " colspan="9">

        </td>
      </tr>
      <tr style="height: 75pt">
        <td style="
      width: 285pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     " colspan="5">

          <p class="s2" style="
       padding-left: 1pt;
       padding-right: 72pt;
       text-indent: 0pt;
       text-align: left;
      ">
            <?php
            $InvoiceCustomerId = FETCH($InvoiceSql, "InvoiceCustomerId");
            $Csql = "SELECT * FROM users where UserId='$InvoiceCustomerId'";
            $AddressSql = "SELECT * FROM user_addresses where UserAddressUserId='$InvoiceCustomerId'";

            echo "<b>" . FETCH($Csql, "UserCompanyName") . "</b><br>";
            echo SECURE(FETCH($AddressSql, "UserStreetAddress"), "d") . " <br>";
            echo SECURE(FETCH($AddressSql, "UserLocality"), "d") . " ";
            echo SECURE(FETCH($AddressSql, "UserCity"), "d") . "<br>";
            echo SECURE(FETCH($AddressSql, "UserState"), "d") . " ";
            echo SECURE(FETCH($AddressSql, "UserPincode"), "d") . "<br><br>";
            echo "Phone: " . FETCH($Csql, "UserPhoneNumber") . "<br>";
            echo "Email: " . FETCH($Csql, "UserEmailId") . "<br>";

            ?>
          </p>

        </td>
        <td style="
      width: 238pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     " colspan="9">
          <p style="text-indent: 0pt; text-align: left"><br /></p>
        </td>
      </tr>
      <tr style="height: 17pt">
        <td style="
      width: 57pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-bottom-style: solid;
      border-bottom-width: 1pt;
     ">

        </td>
        <td style="width: 115pt; border-bottom-style: solid; border-bottom-width: 1pt">

        </td>
        <td style="width: 36pt; border-bottom-style: solid; border-bottom-width: 1pt">
          <p style="text-indent: 0pt; text-align: left"><br /></p>
        </td>
        <td style="width: 18pt; border-bottom-style: solid; border-bottom-width: 1pt">
          <p style="text-indent: 0pt; text-align: left"><br /></p>
        </td>
        <td style="width: 37pt; border-bottom-style: solid; border-bottom-width: 1pt">
          <p style="text-indent: 0pt; text-align: left"><br /></p>
        </td>
        <td style="width: 5pt; border-bottom-style: solid; border-bottom-width: 1pt">
          <p style="text-indent: 0pt; text-align: left"><br /></p>
        </td>
        <td style="width: 12pt; border-bottom-style: solid; border-bottom-width: 1pt">
          <p style="text-indent: 0pt; text-align: left"><br /></p>
        </td>
        <td style="
      width: 5pt;
      border-bottom-style: solid;
      border-bottom-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     ">
          <p style="text-indent: 0pt; text-align: left"><br /></p>
        </td>
        <td style="
      width: 238pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-bottom-style: solid;
      border-bottom-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     " colspan="6">
          <p style="text-indent: 0pt; text-align: left"><br /></p>
        </td>
      </tr>
      <tr style="height: 28pt">
        <td style="
      width: 12pt;
      border-top-style: solid;
      border-top-width: 1pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-bottom-style: solid;
      border-bottom-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     ">
          <p class="s2" style="
       padding-top: 3pt;
       padding-left: 1pt;
       text-indent: 0pt;
       line-height: 10pt;
       text-align: left;
      ">
            Serial No.
          </p>
        </td>
        <td style="
      width: 160pt;
      border-top-style: solid;
      border-top-width: 1pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-bottom-style: solid;
      border-bottom-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     ">
          <p class="s8" style="
       padding-top: 3pt;
       padding-left: 31pt;
       text-indent: 0pt;
       text-align: left;
      ">
            Description of Goods
          </p>
        </td>
        <td style="
      width: 54pt;
      border-top-style: solid;
      border-top-width: 1pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-bottom-style: solid;
      border-bottom-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     ">
          <p class="s8" style="
       padding-top: 3pt;
       padding-left: 4pt;
       text-indent: 0pt;
       text-align: left;
      ">
            HSN/SAC
          </p>
        </td>
        <td style="
      width: 54pt;
      border-top-style: solid;
      border-top-width: 1pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-bottom-style: solid;
      border-bottom-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     ">
          <p class="s8" style="
       padding-top: 3pt;
       padding-left: 8pt;
       text-indent: 0pt;
       text-align: left;
      ">
            Quantity
          </p>
        </td>
        <td style="
      width: 54pt;
      border-top-style: solid;
      border-top-width: 1pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-bottom-style: solid;
      border-bottom-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     " colspan="3">
          <p class="s8" style="
       padding-top: 3pt;
       padding-left: 16pt;
       text-indent: 0pt;
       text-align: left;
      ">
            Rate
          </p>
          <p class="s4" style="
       padding-top: 4pt;
       text-indent: 0pt;
       line-height: 10pt;
       text-align: left;
      ">
            (Incl. of Tax)
          </p>
        </td>
        <td style="
      width: 53pt;
      border-top-style: solid;
      border-top-width: 1pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-bottom-style: solid;
      border-bottom-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     " colspan="2">
          <p class="s8" style="
       padding-top: 3pt;
       padding-left: 16pt;
       text-indent: 0pt;
       text-align: left;
      ">
            Rate
          </p>
        </td>
        <td style="
      width: 22pt;
      border-top-style: solid;
      border-top-width: 1pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-bottom-style: solid;
      border-bottom-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     " colspan="2">
          <p class="s8" style="
       padding-top: 3pt;
       padding-left: 3pt;
       text-indent: 0pt;
       text-align: left;
      ">
            per
          </p>
        </td>
        <td style="
      width: 34pt;
      border-top-style: solid;
      border-top-width: 1pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-bottom-style: solid;
      border-bottom-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     ">
          <p class="s8" style="padding-top: 3pt; text-indent: 0pt; text-align: left">
            Disc. %
          </p>
        </td>
        <td style="
      width: 80pt;
      border-top-style: solid;
      border-top-width: 1pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-bottom-style: solid;
      border-bottom-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     " colspan="2">
          <p class="s8" style="
       padding-top: 3pt;
       padding-left: 22pt;
       text-indent: 0pt;
       text-align: left;
      ">
            Amount
          </p>
        </td>
      </tr>



      <tr style="height: 32pt">
        <td style="
      width: 12pt;
      border-top-style: solid;
      border-top-width: 1pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     ">
          <p class="s2" style="
       padding-top: 9pt;
       padding-left: 1pt;
       text-indent: 0pt;
       text-align: left;
      ">
            1
          </p>
        </td>
        <td style="
      width: 160pt;
      border-top-style: solid;
      border-top-width: 1pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     ">
          <p class="s1" style="
       padding-top: 8pt;
       text-indent: 0pt;
       line-height: 11pt;
       text-align: left;
      ">
            Trufast - TFTT2000 (200AH)
          </p>
          <p class="s1" style="text-indent: 0pt; line-height: 11pt; text-align: left">
            Battery
          </p>
        </td>
        <td style="
      width: 54pt;
      border-top-style: solid;
      border-top-width: 1pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     ">
          <p style="text-indent: 0pt; text-align: left"><br /></p>
          <p class="s4" style="text-indent: 0pt; text-align: left">8507200</p>
        </td>
        <td style="
      width: 54pt;
      border-top-style: solid;
      border-top-width: 1pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     ">
          <p class="s1" style="
       padding-top: 8pt;
       padding-left: 25pt;
       text-indent: 0pt;
       text-align: left;
      ">
            1 Pcs
          </p>
        </td>
        <td style="
      width: 54pt;
      border-top-style: solid;
      border-top-width: 1pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     " colspan="3">
          <p style="text-indent: 0pt; text-align: left"><br /></p>
          <p class="s4" style="padding-left: 12pt; text-indent: 0pt; text-align: left">
            10,400.00
          </p>
        </td>
        <td style="
      width: 53pt;
      border-top-style: solid;
      border-top-width: 1pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     " colspan="2">
          <p style="text-indent: 0pt; text-align: left"><br /></p>
          <p class="s4" style="padding-left: 17pt; text-indent: 0pt; text-align: left">
            8,125.00
          </p>
        </td>
        <td style="
      width: 22pt;
      border-top-style: solid;
      border-top-width: 1pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     " colspan="2">
          <p style="text-indent: 0pt; text-align: left"><br /></p>
          <p class="s4" style="padding-left: 5pt; text-indent: 0pt; text-align: left">
            Pcs
          </p>
        </td>
        <td style="
      width: 34pt;
      border-top-style: solid;
      border-top-width: 1pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-bottom-style: solid;
      border-bottom-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     " rowspan="7">
          <p style="text-indent: 0pt; text-align: left"><br /></p>
        </td>
        <td style="
      width: 80pt;
      border-top-style: solid;
      border-top-width: 1pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     " colspan="2">
          <p class="s1" style="
       padding-top: 8pt;
       padding-left: 36pt;
       text-indent: 0pt;
       text-align: left;
      ">
            8,125.00
          </p>
        </td>
      </tr>



      <tr style="height: 18pt">
        <td style="
      width: 12pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     ">
          <p style="text-indent: 0pt; text-align: left"><br /></p>
        </td>
        <td style="
      width: 160pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     ">
          <p style="text-indent: 0pt; text-align: left"><br /></p>
        </td>
        <td style="
      width: 54pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     ">
          <p style="text-indent: 0pt; text-align: left"><br /></p>
        </td>
        <td style="
      width: 54pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     ">
          <p style="text-indent: 0pt; text-align: left"><br /></p>
        </td>
        <td style="
      width: 54pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     " colspan="3">
          <p style="text-indent: 0pt; text-align: left"><br /></p>
        </td>
        <td style="
      width: 53pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     " colspan="2">
          <p style="text-indent: 0pt; text-align: left"><br /></p>
        </td>
        <td style="
      width: 22pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     " colspan="2">
          <p style="text-indent: 0pt; text-align: left"><br /></p>
        </td>
        <td style="
      width: 80pt;
      border-top-style: solid;
      border-top-width: 1pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     " colspan="2">
          <p class="s2" style="
       padding-top: 2pt;
       padding-left: 30pt;
       text-indent: 0pt;
       text-align: left;
      ">
            22,578.13
          </p>
        </td>
      </tr>
      <tr style="height: 16pt">
        <td style="
      width: 12pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     ">
          <p style="text-indent: 0pt; text-align: left"><br /></p>
        </td>
        <td style="
      width: 160pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     ">
          <p class="s9" style="
       padding-top: 3pt;
       padding-right: 8pt;
       text-indent: 0pt;
       text-align: right;
      ">
            CGST
          </p>
        </td>
        <td style="
      width: 54pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     ">
          <p style="text-indent: 0pt; text-align: left"><br /></p>
        </td>
        <td style="
      width: 54pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     ">
          <p style="text-indent: 0pt; text-align: left"><br /></p>
        </td>
        <td style="
      width: 54pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     " colspan="3">
          <p style="text-indent: 0pt; text-align: left"><br /></p>
        </td>
        <td style="
      width: 53pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     " colspan="2">
          <p style="text-indent: 0pt; text-align: left"><br /></p>
        </td>
        <td style="
      width: 22pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     " colspan="2">
          <p style="text-indent: 0pt; text-align: left"><br /></p>
        </td>
        <td style="
      width: 80pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     " colspan="2">
          <p class="s1" style="
       padding-top: 3pt;
       padding-left: 36pt;
       text-indent: 0pt;
       line-height: 11pt;
       text-align: left;
      ">
            3,160.94
          </p>
        </td>
      </tr>
      <tr style="height: 12pt">
        <td style="
      width: 12pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     ">
          <p style="text-indent: 0pt; text-align: left"><br /></p>
        </td>
        <td style="
      width: 160pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     ">
          <p class="s9" style="
       padding-right: 9pt;
       text-indent: 0pt;
       line-height: 10pt;
       text-align: right;
      ">
            SGST
          </p>
        </td>
        <td style="
      width: 54pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     ">
          <p style="text-indent: 0pt; text-align: left"><br /></p>
        </td>
        <td style="
      width: 54pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     ">
          <p style="text-indent: 0pt; text-align: left"><br /></p>
        </td>
        <td style="
      width: 54pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     " colspan="3">
          <p style="text-indent: 0pt; text-align: left"><br /></p>
        </td>
        <td style="
      width: 53pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     " colspan="2">
          <p style="text-indent: 0pt; text-align: left"><br /></p>
        </td>
        <td style="
      width: 22pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     " colspan="2">
          <p style="text-indent: 0pt; text-align: left"><br /></p>
        </td>
        <td style="
      width: 80pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     " colspan="2">
          <p class="s1" style="
       padding-left: 36pt;
       text-indent: 0pt;
       line-height: 11pt;
       text-align: left;
      ">
            3,160.94
          </p>
        </td>
      </tr>
      <tr style="height: 48pt">
        <td style="
      width: 12pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-bottom-style: solid;
      border-bottom-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     ">
          <p style="text-indent: 0pt; text-align: left"><br /></p>
        </td>
        <td style="
      width: 45pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-bottom-style: solid;
      border-bottom-width: 1pt;
     ">
          <p class="s10" style="padding-top: 1pt; text-indent: 0pt; text-align: left">
            Less :
          </p>
        </td>
        <td style="
      width: 115pt;
      border-bottom-style: solid;
      border-bottom-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     ">
          <p class="s9" style="
       padding-left: 48pt;
       text-indent: 0pt;
       line-height: 10pt;
       text-align: left;
      ">
            ROUND OFF
          </p>
        </td>
        <td style="
      width: 54pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-bottom-style: solid;
      border-bottom-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     ">
          <p style="text-indent: 0pt; text-align: left"><br /></p>
        </td>
        <td style="
      width: 54pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-bottom-style: solid;
      border-bottom-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     ">
          <p style="text-indent: 0pt; text-align: left"><br /></p>
        </td>
        <td style="
      width: 54pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-bottom-style: solid;
      border-bottom-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     " colspan="2">
          <p style="text-indent: 0pt; text-align: left"><br /></p>
        </td>
        <td style="
      width: 53pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-bottom-style: solid;
      border-bottom-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     " colspan="2">
          <p style="text-indent: 0pt; text-align: left"><br /></p>
        </td>
        <td style="
      width: 22pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-bottom-style: solid;
      border-bottom-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     " colspan="2">
          <p style="text-indent: 0pt; text-align: left"><br /></p>
        </td>
        <td style="
      width: 80pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-bottom-style: solid;
      border-bottom-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     " colspan="2">
          <p class="s1" style="padding-left: 48pt; text-indent: 0pt; text-align: left">
            (-)0.01
          </p>
        </td>
      </tr>
      <tr style="height: 16pt">
        <td style="
      width: 12pt;
      border-top-style: solid;
      border-top-width: 1pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-bottom-style: solid;
      border-bottom-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     ">
          <p style="text-indent: 0pt; text-align: left"><br /></p>
        </td>
        <td style="
      width: 160pt;
      border-top-style: solid;
      border-top-width: 1pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-bottom-style: solid;
      border-bottom-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     ">
          <p class="s5" style="
       padding-top: 3pt;
       padding-right: 7pt;
       text-indent: 0pt;
       text-align: right;
      ">
            Total
          </p>
        </td>
        <td style="
      width: 54pt;
      border-top-style: solid;
      border-top-width: 1pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-bottom-style: solid;
      border-bottom-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     ">
          <p style="text-indent: 0pt; text-align: left"><br /></p>
        </td>
        <td style="
      width: 54pt;
      border-top-style: solid;
      border-top-width: 1pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-bottom-style: solid;
      border-bottom-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     ">
          <p class="s11" style="
       padding-top: 2pt;
       padding-left: 25pt;
       text-indent: 0pt;
       text-align: left;
      ">
            3 Pcs
          </p>
        </td>
        <td style="
      width: 54pt;
      border-top-style: solid;
      border-top-width: 1pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-bottom-style: solid;
      border-bottom-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     " colspan="3">
          <p style="text-indent: 0pt; text-align: left"><br /></p>
        </td>
        <td style="
      width: 53pt;
      border-top-style: solid;
      border-top-width: 1pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-bottom-style: solid;
      border-bottom-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     " colspan="2">
          <p style="text-indent: 0pt; text-align: left"><br /></p>
        </td>
        <td style="
      width: 22pt;
      border-top-style: solid;
      border-top-width: 1pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-bottom-style: solid;
      border-bottom-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     " colspan="2">
          <p style="text-indent: 0pt; text-align: left"><br /></p>
        </td>
        <td style="
      width: 34pt;
      border-top-style: solid;
      border-top-width: 1pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-bottom-style: solid;
      border-bottom-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     ">
          <p style="text-indent: 0pt; text-align: left"><br /></p>
        </td>
        <td style="
      width: 80pt;
      border-top-style: solid;
      border-top-width: 1pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-bottom-style: solid;
      border-bottom-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     " colspan="2">
          <p class="s12" style="
       padding-top: 2pt;
       padding-left: 13pt;
       text-indent: 0pt;
       text-align: left;
      ">
            ₹ <b>28,900.00</b>
          </p>
        </td>
      </tr>
      <tr style="height: 28pt">
        <td style="
      width: 226pt;
      border-top-style: solid;
      border-top-width: 1pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-bottom-style: solid;
      border-bottom-width: 1pt;
     ">
          <p class="s5" style="
       padding-top: 2pt;
       padding-left: 1pt;
       text-indent: 0pt;
       text-align: left;
      ">
            Amount Chargeable (in words)
          </p>
          <p class="s1" style="
       padding-top: 1pt;
       padding-left: 1pt;
       text-indent: 0pt;
       text-align: left;
      ">
            INR Twenty Eight Thousand Nine Hundred Only
          </p>
        </td>
        <td style="
      width: 37pt;
      border-top-style: solid;
      border-top-width: 1pt;
      border-bottom-style: solid;
      border-bottom-width: 1pt;
     ">
          <p style="text-indent: 0pt; text-align: left"><br /></p>
        </td>
        <td style="
      width: 5pt;
      border-top-style: solid;
      border-top-width: 1pt;
      border-bottom-style: solid;
      border-bottom-width: 1pt;
     ">
          <p style="text-indent: 0pt; text-align: left"><br /></p>
        </td>
        <td style="
      width: 12pt;
      border-top-style: solid;
      border-top-width: 1pt;
      border-bottom-style: solid;
      border-bottom-width: 1pt;
     ">
          <p style="text-indent: 0pt; text-align: left"><br /></p>
        </td>
        <td style="
      width: 5pt;
      border-top-style: solid;
      border-top-width: 1pt;
      border-bottom-style: solid;
      border-bottom-width: 1pt;
     ">
          <p style="text-indent: 0pt; text-align: left"><br /></p>
        </td>
        <td style="
      width: 23pt;
      border-top-style: solid;
      border-top-width: 1pt;
      border-bottom-style: solid;
      border-bottom-width: 1pt;
     ">
          <p style="text-indent: 0pt; text-align: left"><br /></p>
        </td>
        <td style="
      width: 26pt;
      border-top-style: solid;
      border-top-width: 1pt;
      border-bottom-style: solid;
      border-bottom-width: 1pt;
     ">
          <p style="text-indent: 0pt; text-align: left"><br /></p>
        </td>
        <td style="
      width: 30pt;
      border-top-style: solid;
      border-top-width: 1pt;
      border-bottom-style: solid;
      border-bottom-width: 1pt;
     ">
          <p style="text-indent: 0pt; text-align: left"><br /></p>
        </td>
        <td style="
      width: 23pt;
      border-top-style: solid;
      border-top-width: 1pt;
      border-bottom-style: solid;
      border-bottom-width: 1pt;
     ">
          <p style="text-indent: 0pt; text-align: left"><br /></p>
        </td>
        <td style="
      width: 14pt;
      border-top-style: solid;
      border-top-width: 1pt;
      border-bottom-style: solid;
      border-bottom-width: 1pt;
     ">
          <p style="text-indent: 0pt; text-align: left"><br /></p>
        </td>
        <td style="
      width: 8pt;
      border-top-style: solid;
      border-top-width: 1pt;
      border-bottom-style: solid;
      border-bottom-width: 1pt;
     ">
          <p style="text-indent: 0pt; text-align: left"><br /></p>
        </td>
        <td style="
      width: 34pt;
      border-top-style: solid;
      border-top-width: 1pt;
      border-bottom-style: solid;
      border-bottom-width: 1pt;
     ">
          <p style="text-indent: 0pt; text-align: left"><br /></p>
        </td>
        <td style="
      width: 18pt;
      border-top-style: solid;
      border-top-width: 1pt;
      border-bottom-style: solid;
      border-bottom-width: 1pt;
     ">
          <p style="text-indent: 0pt; text-align: left"><br /></p>
        </td>
        <td style="
      width: 62pt;
      border-top-style: solid;
      border-top-width: 1pt;
      border-bottom-style: solid;
      border-bottom-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     ">
          <p class="s10" style="
       padding-top: 2pt;
       padding-right: 5pt;
       text-indent: 0pt;
       text-align: right;
      ">
            E. &amp; O.E
          </p>
        </td>
      </tr>
      <tr style="height: 14pt">
        <td style="
      width: 208pt;
      border-top-style: solid;
      border-top-width: 1pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-bottom-style: solid;
      border-bottom-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     " rowspan="2">
          <p class="s5" style="
       padding-top: 3pt;
       padding-left: 79pt;
       padding-right: 91pt;
       text-indent: 0pt;
       text-align: center;
      ">
            HSN/SAC
          </p>
        </td>
        <td style="
      width: 60pt;
      border-top-style: solid;
      border-top-width: 1pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-bottom-style: solid;
      border-bottom-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     " colspan="2" rowspan="2">
          <p class="s5" style="
       padding-top: 3pt;
       padding-right: 15pt;
       text-indent: 0pt;
       text-align: right;
      ">
            Taxable
          </p>
          <p class="s5" style="
       padding-top: 2pt;
       padding-right: 14pt;
       text-indent: 0pt;
       text-align: right;
      ">
            Value
          </p>
        </td>
        <td style="
      width: 96pt;
      border-top-style: solid;
      border-top-width: 1pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-bottom-style: solid;
      border-bottom-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     " colspan="5">
          <p class="s5" style="
       padding-top: 3pt;
       padding-left: 24pt;
       text-indent: 0pt;
       text-align: left;
      ">
            Central Tax
          </p>
        </td>
        <td style="
      width: 97pt;
      border-top-style: solid;
      border-top-width: 1pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-bottom-style: solid;
      border-bottom-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     " colspan="5">
          <p class="s5" style="
       padding-top: 3pt;
       padding-left: 28pt;
       text-indent: 0pt;
       text-align: left;
      ">
            State Tax
          </p>
        </td>
        <td style="
      width: 62pt;
      border-top-style: solid;
      border-top-width: 1pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-bottom-style: solid;
      border-bottom-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     " rowspan="2">
          <p class="s5" style="
       padding-left: 5pt;
       padding-right: 9pt;
       text-indent: 15pt;
       line-height: 12pt;
       text-align: left;
      ">
            Total Tax Amount
          </p>
        </td>
      </tr>
      <tr style="height: 12pt">
        <td style="
      width: 40pt;
      border-top-style: solid;
      border-top-width: 1pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-bottom-style: solid;
      border-bottom-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     " colspan="3">
          <p class="s5" style="
       padding-top: 1pt;
       padding-left: 13pt;
       text-indent: 0pt;
       text-align: left;
      ">
            Rate
          </p>
        </td>
        <td style="
      width: 56pt;
      border-top-style: solid;
      border-top-width: 1pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-bottom-style: solid;
      border-bottom-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     " colspan="2">
          <p class="s5" style="
       padding-top: 1pt;
       padding-left: 14pt;
       text-indent: 0pt;
       text-align: left;
      ">
            Amount
          </p>
        </td>
        <td style="
      width: 37pt;
      border-top-style: solid;
      border-top-width: 1pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-bottom-style: solid;
      border-bottom-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     " colspan="2">
          <p class="s5" style="
       padding-top: 1pt;
       padding-left: 10pt;
       text-indent: 0pt;
       text-align: left;
      ">
            Rate
          </p>
        </td>
        <td style="
      width: 60pt;
      border-top-style: solid;
      border-top-width: 1pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-bottom-style: solid;
      border-bottom-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     " colspan="3">
          <p class="s5" style="
       padding-top: 1pt;
       padding-left: 14pt;
       text-indent: 0pt;
       text-align: left;
      ">
            Amount
          </p>
        </td>
      </tr>
      <tr style="height: 13pt">
        <td style="
      width: 208pt;
      border-top-style: solid;
      border-top-width: 1pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     ">
          <p class="s4" style="
       padding-top: 1pt;
       padding-left: 1pt;
       text-indent: 0pt;
       line-height: 10pt;
       text-align: left;
      ">
            8507200
          </p>
        </td>
        <td style="
      width: 60pt;
      border-top-style: solid;
      border-top-width: 1pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     " colspan="2">
          <p class="s4" style="
       padding-top: 1pt;
       padding-left: 23pt;
       text-indent: 0pt;
       line-height: 10pt;
       text-align: left;
      ">
            15,703.13
          </p>
        </td>
        <td style="
      width: 40pt;
      border-top-style: solid;
      border-top-width: 1pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     " colspan="3">
          <p class="s4" style="
       padding-top: 1pt;
       padding-left: 21pt;
       text-indent: 0pt;
       line-height: 10pt;
       text-align: left;
      ">
            14%
          </p>
        </td>
        <td style="
      width: 56pt;
      border-top-style: solid;
      border-top-width: 1pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     " colspan="2">
          <p class="s4" style="
       padding-top: 1pt;
       padding-left: 23pt;
       text-indent: 0pt;
       line-height: 10pt;
       text-align: left;
      ">
            2,198.44
          </p>
        </td>
        <td style="
      width: 37pt;
      border-top-style: solid;
      border-top-width: 1pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     " colspan="2">
          <p class="s4" style="
       padding-top: 1pt;
       padding-left: 18pt;
       text-indent: 0pt;
       line-height: 10pt;
       text-align: left;
      ">
            14%
          </p>
        </td>
        <td style="
      width: 60pt;
      border-top-style: solid;
      border-top-width: 1pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     " colspan="3">
          <p class="s4" style="
       padding-top: 1pt;
       padding-left: 23pt;
       text-indent: 0pt;
       line-height: 10pt;
       text-align: left;
      ">
            2,198.44
          </p>
        </td>
        <td style="
      width: 62pt;
      border-top-style: solid;
      border-top-width: 1pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     ">
          <p class="s4" style="
       padding-top: 1pt;
       padding-right: 4pt;
       text-indent: 0pt;
       line-height: 10pt;
       text-align: right;
      ">
            4,396.88
          </p>
        </td>
      </tr>
      <tr style="height: 10pt">
        <td style="
      width: 208pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-bottom-style: solid;
      border-bottom-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     ">
          <p class="s4" style="
       padding-left: 1pt;
       text-indent: 0pt;
       line-height: 8pt;
       text-align: left;
      ">
            8507
          </p>
        </td>
        <td style="
      width: 60pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-bottom-style: solid;
      border-bottom-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     " colspan="2">
          <p class="s4" style="
       padding-left: 28pt;
       text-indent: 0pt;
       line-height: 8pt;
       text-align: left;
      ">
            6,875.00
          </p>
        </td>
        <td style="
      width: 40pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-bottom-style: solid;
      border-bottom-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     " colspan="3">
          <p class="s4" style="
       padding-left: 21pt;
       text-indent: 0pt;
       line-height: 8pt;
       text-align: left;
      ">
            14%
          </p>
        </td>
        <td style="
      width: 56pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-bottom-style: solid;
      border-bottom-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     " colspan="2">
          <p class="s4" style="
       padding-left: 31pt;
       text-indent: 0pt;
       line-height: 8pt;
       text-align: left;
      ">
            962.50
          </p>
        </td>
        <td style="
      width: 37pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-bottom-style: solid;
      border-bottom-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     " colspan="2">
          <p class="s4" style="
       padding-left: 18pt;
       text-indent: 0pt;
       line-height: 8pt;
       text-align: left;
      ">
            14%
          </p>
        </td>
        <td style="
      width: 60pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-bottom-style: solid;
      border-bottom-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     " colspan="3">
          <p class="s4" style="
       padding-left: 31pt;
       text-indent: 0pt;
       line-height: 8pt;
       text-align: left;
      ">
            962.50
          </p>
        </td>
        <td style="
      width: 62pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-bottom-style: solid;
      border-bottom-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     ">
          <p class="s4" style="
       padding-right: 4pt;
       text-indent: 0pt;
       line-height: 8pt;
       text-align: right;
      ">
            1,925.00
          </p>
        </td>
      </tr>
      <tr style="height: 15pt">
        <td style="
      width: 208pt;
      border-top-style: solid;
      border-top-width: 1pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-bottom-style: solid;
      border-bottom-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     ">
          <p class="s14" style="
       padding-top: 3pt;
       padding-right: 3pt;
       text-indent: 0pt;
       text-align: right;
      ">
            Total
          </p>
        </td>
        <td style="
      width: 60pt;
      border-top-style: solid;
      border-top-width: 1pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-bottom-style: solid;
      border-bottom-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     " colspan="2">
          <p class="s14" style="
       padding-top: 3pt;
       padding-left: 23pt;
       text-indent: 0pt;
       text-align: left;
      ">
            22,578.13
          </p>
        </td>
        <td style="
      width: 40pt;
      border-top-style: solid;
      border-top-width: 1pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-bottom-style: solid;
      border-bottom-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     " colspan="3">
          <p style="text-indent: 0pt; text-align: left"><br /></p>
        </td>
        <td style="
      width: 56pt;
      border-top-style: solid;
      border-top-width: 1pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-bottom-style: solid;
      border-bottom-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     " colspan="2">
          <p class="s14" style="
       padding-top: 3pt;
       padding-left: 23pt;
       text-indent: 0pt;
       text-align: left;
      ">
            3,160.94
          </p>
        </td>
        <td style="
      width: 37pt;
      border-top-style: solid;
      border-top-width: 1pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-bottom-style: solid;
      border-bottom-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     " colspan="2">
          <p style="text-indent: 0pt; text-align: left"><br /></p>
        </td>
        <td style="
      width: 60pt;
      border-top-style: solid;
      border-top-width: 1pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-bottom-style: solid;
      border-bottom-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     " colspan="3">
          <p class="s14" style="
       padding-top: 3pt;
       padding-left: 23pt;
       text-indent: 0pt;
       text-align: left;
      ">
            3,160.94
          </p>
        </td>
        <td style="
      width: 62pt;
      border-top-style: solid;
      border-top-width: 1pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-bottom-style: solid;
      border-bottom-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     ">
          <p class="s14" style="
       padding-top: 3pt;
       padding-right: 4pt;
       text-indent: 0pt;
       text-align: right;
      ">
            6,321.88
          </p>
        </td>
      </tr>
      <tr style="height: 77pt">
        <td style="
      width: 523pt;
      border-top-style: solid;
      border-top-width: 1pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     " colspan="14">
          <p class="s4" style="
       padding-top: 5pt;
       padding-left: 1pt;
       text-indent: 0pt;
       text-align: left;
      ">
            Tax Amount (in words) :
            <span class="s1">INR Six Thousand Three Hundred Twenty One and Eighty Eight paise
              Only</span>
          </p>
          <p class="s5" style="
       padding-top: 5pt;
       padding-left: 263pt;
       text-indent: 0pt;
       text-align: left;
      ">
            Company’s Bank Details
          </p>
          <p class="s15" style="padding-left: 263pt; text-indent: 0pt; text-align: left">
            A/c Holder’s Name : <b>TruFast Energy Private Limited</b>
          </p>
          <p class="s15" style="padding-left: 263pt; text-indent: 0pt; text-align: left">
            Bank Name : <b>KOTAK MAHINDRA BANK</b>
          </p>
          <p class="s15" style="
       padding-left: 263pt;
       text-indent: 0pt;
       line-height: 10pt;
       text-align: left;
      ">
            A/c No. <b>3245881502</b>
          </p>
          <p class="s4" style="
       padding-left: 1pt;
       text-indent: 0pt;
       line-height: 12pt;
       text-align: left;
      ">
            Company’s PAN : <b>AAHCT9114E </b><span class="s15">Branch &amp; IFS Code : </span><span class="s16">SURAJPUR &amp; KKBK0005304</span>
          </p>
        </td>
      </tr>
      <tr style="height: 13pt">
        <td style="
      width: 263pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     " colspan="2">
          <p class="s5" style="
       padding-top: 2pt;
       padding-left: 1pt;
       text-indent: 0pt;
       text-align: left;
      ">
            Declaration
          </p>
        </td>
        <td style="
      width: 260pt;
      border-top-style: solid;
      border-top-width: 1pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     " colspan="12">
          <p class="s11" style="
       padding-top: 1pt;
       padding-left: 117pt;
       text-indent: 0pt;
       text-align: left;
      ">
            for TruFast Energy Private Limited
          </p>
        </td>
      </tr>
      <tr style="height: 29pt">
        <td style="
      width: 263pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-bottom-style: solid;
      border-bottom-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     " colspan="2">
          <p class="s4" style="
       padding-left: 1pt;
       padding-right: 17pt;
       text-indent: 0pt;
       line-height: 106%;
       text-align: left;
      ">
            We declare that this invoice shows the actual price of the goods described
            and that all particulars are true and correct.
          </p>
        </td>
        <td style="
      width: 260pt;
      border-left-style: solid;
      border-left-width: 1pt;
      border-bottom-style: solid;
      border-bottom-width: 1pt;
      border-right-style: solid;
      border-right-width: 1pt;
     " colspan="12">
          <p style="text-indent: 0pt; text-align: left"><br /></p>
          <p class="s4" style="
       padding-top: 6pt;
       padding-right: 11pt;
       text-indent: 0pt;
       line-height: 10pt;
       text-align: right;
      ">
            Authorised Signatory
          </p>
        </td>
      </tr>
    </table>
  </div>
</body>

</html>