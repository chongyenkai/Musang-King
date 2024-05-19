<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta name="description" content="Notification Page" />
  <meta name="keywords" content="PHP, Notification, MusangKing Reservation System" />
  <meta name="author" content="Wallace Iglesias Chandrio"  />
  <link href="<?php echo base_url('styles/style.css'); ?>" rel="stylesheet"/>
  <title>Musang King Reservation - Notification</title>
</head>
<body>
    <h1>Notifications</h1>
    <br>
    <div class="notification-container">
        <?php foreach ($reservations as $reservation): ?>
            <div class="notification">
                <p>Your reservation for <?php echo date('d/m/Y', strtotime($reservation['date'])); ?> has been confirmed!</p>
                <div class="notification-buttons">
                    <button class="edit-button">Edit</button>
                    <button class="delete-button">Delete</button>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
