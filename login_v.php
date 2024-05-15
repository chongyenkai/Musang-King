<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>
            Login Page
        </title>
        <link rel="stylesheet" href="<?php echo base_url('assets/login.css'); ?>" type="text/css">


    </head>

    <body>
        <div class ="container">
            <h1>Login</h1>
            <form action="#">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Enter your email">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password">

            </form>

            <form action="#">
                <div class="button-container">
                    <input type="submit" value="Login" class="button">
                </div>
            </form>

            <p>
                Don't have an account? <a href="<?php echo base_url('login/signup'); ?>">Sign Up</a>
            </p>
        </div>
    </body>
</html>