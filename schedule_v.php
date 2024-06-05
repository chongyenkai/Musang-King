<?php $this->load->view('swe/header_v'); ?>

  <div class="container">
    <h2 class="header">Schedule</h2>

    <div class="week-selector">
        <label for="week">Select the week to view bookings</label>
        <input type="week" id="week" name="week" onchange="changeWeek()" value="<?php echo date('Y-\WW', strtotime($start_date)); ?>"/>
    </div>

    <div class="week-info">
        <p><strong>Week:</strong> <?php echo date('j/n', strtotime($start_date)) . ' - ' . date('j/n', strtotime($end_date)); ?></p>
    </div>

    <table class="schedule-table">
      <tr>
        <th>Day\Time</th>
        <th>Afternnon session</th>
        <th>Evening session</th>
        <th>Night session</th>
      </tr>

      <?php
      //days of the week array
      $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];

      //initialize an empty array for the schedule
      $schedule = [];

      //populate the schedule array with the reservation
      foreach ($reservations as $reservation) {
        $day = date('l', strtotime($reservation->date));
        $session = $reservation->time;

        $schedule[$day][$session] = $reservation;
      }
      
      //generate table row
      foreach ($days as $day) {
        echo "<tr>";
        echo "<td>$day</td>";

        $sessions = ['afternoon', 'evening', 'night'];
        foreach ($sessions as $session) {
          echo "<td>";

          if (isset($schedule[$day][$session])) {
            $reservation = $schedule[$day][$session];
            echo "Reserved By ($reservation->name)";
            echo "<br>Date: " . date('Y-m-d', strtotime($reservation->date));
          } else {
            echo "";
          }
          echo "</td>";
        }
        echo "</tr>";

      }
      ?>
    </table>
  </div>

    <script>
      function changeWeek() {
        const week = document.getElementById('week').value;
        window.location.href = "<?php echo site_url('swe/reservation/schedule'); ?>?week=" + week;
      }

    </script>

    <?php $this->load->view('swe/footer_v'); ?>
  </body>
</html>