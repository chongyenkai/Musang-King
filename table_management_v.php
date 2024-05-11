<?php $this->load->view('swe/header_v');?>

<h1>Select Table</h1>
    <div class="table-layout">
        <!-- Image with clickable areas -->
        <img src="restaurant_layout.png" alt="Restaurant Layout" usemap="#tableMap">
        <!-- Define clickable areas using map -->
        <map name="tableMap">
            <area shape="rect" coords="50,50,150,150" href="book_table.php?table=1" alt="Table 1">
            <area shape="rect" coords="200,50,300,150" href="book_table.php?table=2" alt="Table 2">
            <!-- Add more areas as needed -->
        </map>
    </div>