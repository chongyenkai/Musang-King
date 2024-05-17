<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
        <link href="<?php echo base_url('assets/css/swe_css/login.css'); ?>" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
    </head>

    <body>
    <div class="container">
        <div class="wrapper">
            <div class="title"><span>Login Form</span></div>
            <form action="#">
                <div class="row">
                    <i class="fas fa-user"></i>
                    <input type="text" placeholder="Email" required>
                </div>
                <div class="row">
                    <i class="fas fa-lock"></i>
                    <input type="password" placeholder="Password" required>
                </div>
                <div class="row button">
                    <input type="submit" value="Login">
                </div>
                <div class="signup-link">Not a member? <a href="<?php echo base_url('swe/login/signup'); ?>">Signup now</a></div>
            </form>
        </div>
    </div>
    </body>
</html>