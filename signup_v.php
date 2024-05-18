<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Sign Up</title>
        <link href="<?php echo base_url('assets/css/swe_css/login.css'); ?>" rel="stylesheet" type="text/css">

    </head>

    <body class="signup">
        <div class="containers">
            <header class="title"><span>Sign Up Form</span></header>
            <form action="<?php echo site_url('swe/login/signup'); ?>" class="form" method="POST">
                <div class="input-box">
                    <label>Full Name</label>
                    <input type="text" name="name" placeholder="Enter full name" required />
                </div>
                <div class="input-box">
                    <label>Email Address</label>
                    <input type="email" name="email" placeholder="Enter email address" required />
                </div>
                <div class="column">
                    <div class="input-box">
                        <label>Password</label>
                        <input type="password" name="password" placeholder="Enter password" required />
                    </div>
                    <div class="input-box">
                        <label>Confirm Password</label>
                        <input type="password" name="confirm_password" placeholder="Confirm your password" required />
                    </div>
                </div>
                <div class="gender-box">
                    <h3>Role</h3>
                    <div class="gender-option">
                        <div class="gender">
                            <input type="radio" id="check-customer" name="role" value="customer" checked/>
                            <label for="check-customer">Customer</label>
                        </div>
                        <div class="gender">
                            <input type="radio" id="check-admin" name="role" value="admin" />
                            <label for="check-admin">Admin</label>
                        </div>
                    </div>
                </div>
                <div id="admin-input" class="input-box" style="display: none;">
                    <label for="admin-input-field">Admin Input:</label>
                    <input type="text" id="admin-input-field" name="admin-input-field" placeholder="Enter admin password"/>
                </div>
                <button type="submit">Submit</button>
            </form>
        </div>
    </body>
    <script>
        // Get the radio buttons and the input column
        const customerRadio = document.getElementById('check-customer');
        const adminRadio = document.getElementById('check-admin');
        const adminInput = document.getElementById('admin-input');

        // Add event listeners to the radio buttons
        customerRadio.addEventListener('change', toggleAdminInput);
        adminRadio.addEventListener('change', toggleAdminInput);

        // Function to toggle the visibility of the input column based on the selected radio button
        function toggleAdminInput() {
            if (adminRadio.checked) {
                adminInput.style.display = 'block'; // Show the input column if admin is selected
                adminInputField.setAttribute('required', 'required');
            } else {
                adminInput.style.display = 'none'; // Hide the input column if customer is selected
                adminInputField.removeAttribute('required');
            }
        }
    </script>
</html>