<?php $this->load->view('swe/header_v'); ?>

<div class="containerbh">
    <div class="search-container">
        <div class="search">
            <label for="search">Search:</label>
            <input type="search" id="search" name="search">
        </div>
        <div class="table-title"><b>Booking History</b></div>
    </div>
    
    <table>
        <tr>
            <th>Reservation ID</th>
            <th>Table ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Date</th>
            <th>Table reserved</th>
            <th>Time</th>
            <th>Package</th>
            <th>Actions</th>
        </tr>
        <?php if(!empty($booking_history)): ?>
            <?php foreach($booking_history as $booking): ?>
                <?php if(isset($booking['status']) && $booking['status'] == 'booked'): ?>
                    <tr>
                        <td><?php echo $booking['id']; ?></td>
                        <td><?php echo $booking['table_id']; ?></td>
                        <td><?php echo $booking['name']; ?></td>
                        <td><?php echo $booking['email']; ?></td>
                        <td><?php echo $booking['phone']; ?></td>
                        <td><?php echo $booking['date']; ?></td>
                        <td><?php echo $booking['table_no']; ?></td>
                        <td><?php echo $booking['time']; ?></td>
                        <td><?php echo $booking['package']; ?></td>
                        <td>
                            <a class="editButton" href="<?php echo site_url('swe/reservation/edit_booking/' . $booking['id']); ?>">Edit</a> 
                            <a class="delButton" href="<?php echo site_url('swe/reservation/delete_booking/' . $booking['id']); ?>" onclick="return confirmDelete();">Cancel</a>
                        </td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="8">No records found.</td>
            </tr>
        <?php endif; ?>
    </table>
    <script>
        function confirmDelete() {
            return confirm("Are you sure you want to cancel this booking?");
        }
    </script>
</div>
</body>

</html>