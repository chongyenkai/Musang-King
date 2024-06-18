<?php $this->load->view('swe/header_v'); ?>

<body onload="limitSelection(<?php echo $num_table; ?>)">

    <p class="review-header"><b>Please Select the Table</b></p>
    <form action="<?php echo site_url('swe/reservation/review_booking'); ?>" method="post">
        <input type="hidden" name="name" value="<?php echo $name; ?>">
        <input type="hidden" name="email" value="<?php echo $email; ?>">
        <input type="hidden" name="phone" value="<?php echo $phone; ?>">
        <input type="hidden" name="date" value="<?php echo $date; ?>">
        <input type="hidden" name="time" value="<?php echo $time; ?>">
        <input type="hidden" name="package" value="<?php echo $package; ?>">
        <input type="hidden" name="num_table" value="<?php echo $num_table; ?>">

        <div class="container-table">
            <div class="row g-2">
                <!-- 3x4 Column (spanning 3 columns each) -->
                <div class="col-12 col-md-6">
                    <div class="row g-2">
                        <?php for ($i = 1; $i <= 12; $i++): ?>
                            <div class="col-4 mt-3">
                                <?php $is_available = in_array($i, $available_data); ?>
                                <div class="table-container">
                                    <?php if ($is_available): ?>
                                        <label>
                                            <input type="checkbox" name="tables[]" value="<?php echo $i; ?>">
                                            <img src="<?php echo base_url('assets/image/swe_image/Rectable.png'); ?>" id="Table_<?php echo $i; ?>" class="table-image img-fluid">
                                        </label>
                                    <?php else: ?>
                                        <img src="<?php echo base_url('assets/image/swe_image/Rectable.png'); ?>" id="Table_<?php echo $i; ?>" class="table-image img-fluid unavailable">
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endfor; ?>
                    </div>
                </div>

                <!-- 1x2 Column (spanning 3 columns) -->
                <div class="col-12 col-md-3">
                    <div class="row g-2">
                        <?php for ($i = 13; $i <= 14; $i++): ?>
                            <div class="col-12 mt-3">
                                <?php $is_available = in_array($i, $available_data); ?>
                                <div class="table-container">
                                    <?php if ($is_available): ?>
                                        <label>
                                            <input type="checkbox" name="tables[]" value="<?php echo $i; ?>">
                                            <img src="<?php echo base_url('assets/image/swe_image/Roundtable.png'); ?>" id="Table_<?php echo $i; ?>" class="round-image img-fluid">
                                        </label>
                                    <?php else: ?>
                                        <img src="<?php echo base_url('assets/image/swe_image/Roundtable.png'); ?>" id="Table_<?php echo $i; ?>" class="round-image img-fluid unavailable">
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endfor; ?>
                    </div>
                </div>

                <!-- 1x3 Column (spanning 3 columns) -->
                <div class="col-12 col-md-3">
                    <div class="row g-2">
                        <?php for ($i = 15; $i <= 17; $i++): ?>
                            <div class="col-12 mt-4">
                                <?php $is_available = in_array($i, $available_data); ?>
                                <div class="table-container">
                                    <?php if ($is_available): ?>
                                        <label>
                                            <input type="checkbox" name="tables[]" value="<?php echo $i; ?>">
                                            <img src="<?php echo base_url('assets/image/swe_image/Squaretable.png'); ?>" id="Table_<?php echo $i; ?>" class="square-image img-fluid">
                                        </label>
                                    <?php else: ?>
                                        <img src="<?php echo base_url('assets/image/swe_image/Squaretable.png'); ?>" id="Table_<?php echo $i; ?>" class="square-image img-fluid unavailable">
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endfor; ?>
                    </div>
                </div>
            </div>

            <!-- Additional Elements -->
            <div class="row mt-4 g-2">
                <div class="col-12 col-md-4">
                    <div class="exit">Exit</div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="kitchen">Kitchen</div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="window-view">Window View</div>
                </div>
            </div>
            <div class="row mt-4 g-2">
                <div class="col-12 col-md-4">
                    <div class="bar">Bar</div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="restroom">Restroom</div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="waiting-area">Waiting Area</div>
                </div>
            </div>
            <div class="row mt-4 g-2">
                <div class="col-12 col-md-4">
                    <div class="window-view-vertical">Window View</div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-12 text-center">
                <button type="submit" class="btn btn-primary">Confirm Tables</button>
            </div>
        </div>
    </form>
    <script>
        function limitSelection(max) {
            let checkboxes = document.querySelectorAll('input[type="checkbox"]');
            checkboxes.forEach(function(checkbox) {
                checkbox.addEventListener('change', function() {
                    let checkedCount = document.querySelectorAll('input[type="checkbox"]:checked').length;
                    if (checkedCount > max) {
                        this.checked = false;
                        alert('You can only select up to ' + max + ' tables.');
                    }
                });
            });
        }
    </script>
</body>

<?php $this->load->view('swe/footer_v'); ?>
