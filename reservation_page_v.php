<!Doctype html>
    <html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Reservation</title>
        <link href="<?php echo base_url('assets/css/swe_css/style.css'); ?>" rel="stylesheet" type="text/css">
    </head>
    <body>
        <header >
            <b>Reservation Page </b>
        </header>
        </br>

    <main>
        <form>
            <div class = name>
                <label class="name">Full Name</label></br>
                <input id="name" type="text" required/>
            </div>
            </br>
            <div class = email>
                <label class="email">Email</label></br>
                <input id="email" type="email" required/>
            </div>
            <div class = phone>
                <label class="phone">Phone Number</label></br>
                <input id="phone" type="number" required/>
            </div>
            <div class = date>
                <label class="date">Date</label></br>
                <input id="date" type="date" required/>
            </div>
            <div class = time>
                <label class="time">Time</label></br>
                <input id="time" type="time" required/>
            </div>
            <div class = pax>
                <label class="pax">Pax</label></br>
                <input id="pax" type="number" required/>
            </div>
            </br>
            <div class = addon>
                <label class="addon">Add On (optional)</label></br>
                <textarea id="addon" type="text"> </textarea>
            </div>
            <div class="full-width">
                <button type="submit" class="button" style = "border-radius : 30px;  width : 70%; height : 30px">Confirm my Booking</button>
            </div>
        </form>
    </main>
</body>
</html>