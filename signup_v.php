<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>
            Sign Up Form
        </title>
        <link rel="stylesheet" href="<?php echo base_url('assets/login.css'); ?>">

    </head>

    <body>
        <div class = "container">
            <h1> Create Your Account</h1>
            <form action="#">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Enter your email">
                <label for="name">Name</label>
                <input type = "text" id="name" name="name" placeholder="Enter your name">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password">
                <label for="confirm_password">Comfirm Password</label>
                <input type="password" id="confirm_password" name="confirm_password" placeholder="Comfirm your password">
                
                <div class="account-type">
                    <label for="account-type">Account Type:</label>
                    <input type="radio" id="admin" name="account-type" value="admin"> Admin
                    <input type="radio" id="customer" name="account-type" value="customer" checked> Customer
                </div>
            </form>

            <form action="#">
                <div class="button-container">
                    <input type="submit" value="Create" class="button">
                </div>
            </form>

            <p>Already a member? <a href="<?php echo base_url('login'); ?>">Sign in</a></p>
        </div>
    </body>
</html>