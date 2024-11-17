<?php
//message variables
if (CONTROL_NOTIFICATION == "true") {
  $Time = CONTROL_MSG_DISPLAY_TIME;
  $APP_DOMAIN = STORAGE_URL_D . ""; ?>
  <?php if (isset($_SESSION['success'])) { ?>
    <div class="notification-box" id="MsgArea1">
      <?php if (CONTROL_NOTIFICATION_SOUND == "true") { ?>
        <audio controls autoplay hidden="">
          <source src="<?php echo $APP_DOMAIN; ?>/sys-tone/success.mp3" type="audio/ogg">
          <source src="<?php echo $APP_DOMAIN; ?>/sys-tone/success.mp3" type="audio/ogg">
        </audio>
      <?php } ?>
      <h4 class="bg-success p-3 text-white" onclick="HideMsgNote()"><i class="fa fa-check-circle"></i> Success!
        <i class="fa fa-times"></i>
      </h4>
      <p class="mb-0">
        <span class="font-14">
          <?php echo $_SESSION['success']; ?>
        </span>
        <br><br>
      </p>

      <script>
        setTimeout(function() {
          $("#MsgArea1").fadeOut("slow");
        }, <?php echo $Time; ?>);
      </script>
    </div>
    <script>
      function HideMsgNote() {
        document.getElementById("MsgArea1").style.display = "none";
      }
    </script>

  <?php unset($_SESSION['success']);
  } elseif (isset($_SESSION['info'])) { ?>

    <div class="notification-box" id="MsgArea2">
      <?php if (CONTROL_NOTIFICATION_SOUND == "true") { ?>
        <audio controls autoplay hidden="">
          <source src="<?php echo $APP_DOMAIN; ?>/sys-tone/info.mp3" type="audio/ogg">
          <source src="<?php echo $APP_DOMAIN; ?>/sys-tone/info.mp3" type="audio/ogg">
        </audio>
      <?php } ?>
      <h4 class="bg-info p-3 text-white" onclick="HideMsgNote()"><i class="fa fa-bell"></i> Notification
        <i class="fa fa-times"></i>
      </h4>
      <p class="mb-0">
        <span class="font-14">
          <?php echo $_SESSION['info']; ?>
        </span>
        <br><br>
      </p>
      <script>
        setTimeout(function() {
          $("#MsgArea2").fadeOut("slow");
        }, <?php echo $Time; ?>);
      </script>
    </div>
    <script>
      function HideMsgNote() {
        document.getElementById("MsgArea2").style.display = "none";
      }
    </script>
    <?php if (!empty($_SESSION['info'])) {
      unset($_SESSION['info']);
    }
  } elseif (isset($_SESSION['warning'])) { ?>

    <div class="notification-box" id="MsgArea3">
      <?php if (CONTROL_NOTIFICATION_SOUND == "true") { ?>
        <audio controls autoplay hidden="">
          <source src="<?php echo $APP_DOMAIN; ?>/sys-tone/danger.mp3" type="audio/ogg">
          <source src="<?php echo $APP_DOMAIN; ?>/sys-tone/danger.mp3" type="audio/ogg">
        </audio>
      <?php } ?>
      <h4 class="bg-danger p-3 text-white" onclick="HideMsgNote()">Failed
        <i class="fa fa-times"></i>
      </h4>
      <p class="mb-0">
        <span class="font-14">
          <?php echo $_SESSION['warning']; ?>
        </span>
        <br><br>
      </p>
      <script>
        setTimeout(function() {
          $("#MsgArea3").fadeOut("slow");
        }, <?php echo $Time; ?>);
      </script>
    </div>
    <script>
      function HideMsgNote() {
        document.getElementById("MsgArea3").style.display = "none";
      }
    </script>
    <?php if (!empty($_SESSION['warning'])) {
      unset($_SESSION['warning']);
    }
  } elseif (isset($_SESSION['danger'])) { ?>
    <div class="notification-box" id="MsgArea4">
      <?php if (CONTROL_NOTIFICATION_SOUND == "true") { ?>
        <audio controls autoplay hidden="">
          <source src="<?php echo $APP_DOMAIN; ?>/sys-tone/warning.mp3" type="audio/ogg">
          <source src="<?php echo $APP_DOMAIN; ?>/sys-tone/warning.mp3" type="audio/ogg">
        </audio>
      <?php } ?>
      <h4 class="bg-danger p-3 text-white" onclick="HideMsgNote()"> <i class="fa fa-warning"></i> Something Went Wrong!
        <i class="fa fa-times"></i>
      </h4>
      <p class="mb-0">
        <span class="font-14">
          <?php echo $_SESSION['danger']; ?>
        </span>
        <br><br>
      </p>
      <script>
        setTimeout(function() {
          $("#MsgArea4").fadeOut("slow");
        }, <?php echo $Time; ?>);
      </script>
    </div>
    <script>
      function HideMsgNote() {
        document.getElementById("MsgArea4").style.display = "none";
      }
    </script>
<?php if (!empty($_SESSION['danger'])) {
      unset($_SESSION['danger']);
    }
  } else {
  }
}
?>