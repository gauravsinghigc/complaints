<div id="footer" class="app-footer m-0">
    <div class="time-block" hidden="">
        <span><i class="fa fa-clock-o pl-1"></i> </span>
        <span id="clock"> 8:10:45</span>
        <span> | </span>
        <span class="date"><?php echo date("d D M, Y"); ?></span>
    </div>
    <script>
        setInterval(showTime, 1000);

        function showTime() {
            let time = new Date();
            let hour = time.getHours();
            let min = time.getMinutes();
            let sec = time.getSeconds();
            am_pm = "AM ";

            if (hour > 12) {
                hour -= 12;
                am_pm = " PM";
            }
            if (hour == 0) {
                hr = 12;
                am_pm = " AM";
            }

            hour = hour < 10 ? "0" + hour : hour;
            min = min < 10 ? "0" + min : min;
            sec = sec < 10 ? "0" + sec : sec;

            let currentTime = hour + ":" +
                min + ":" + sec + " " + am_pm + "";

            document.getElementById("clock")
                .innerHTML = "&nbsp;" + currentTime + " ";
        }

        showTime();
    </script>

    <div class="text-center">Copyrighted &copy; <?php echo date("Y"); ?> | <?php echo DEVELOPED_BY; ?> </div>
</div>