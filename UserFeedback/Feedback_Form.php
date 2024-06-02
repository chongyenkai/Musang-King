//View - Feedback Form
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Feedback</title>
    <link rel="stylesheet" href="<?= base_url('css/styles.css') ?>">
</head>
<body>
    <div class="container">
        <h1>User Feedback</h1>
        <form id="feedbackForm" action="<?= base_url('feedback/submit') ?>" method="POST">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="feedback">Feedback:</label>
            <textarea id="feedback" name="feedback" rows="5" required></textarea>

            <button type="submit">Submit</button>
        </form>
    </div>

    <script src="<?= base_url('js/script.js') ?>"></script>
</body>
</html>
