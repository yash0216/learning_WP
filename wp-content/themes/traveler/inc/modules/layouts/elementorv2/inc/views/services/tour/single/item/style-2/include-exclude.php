<?php
$include = get_post_meta(get_the_ID(), 'tours_include', true);
$exclude = get_post_meta(get_the_ID(), 'tours_exclude', true);
if (!empty($include) || !empty($exclude)) {
    ?>
    <div class="st-inexclude">
        <h2 class="st-heading-section" id="headingInExClude">
            <?php echo __('Included/Excluded', 'traveler'); ?>
        </h2>
        <div class="row">
            <?php if (!empty($include)) { ?>
                <div class="col-12 col-lg-6">
                    <ul class="include">
                        <?php
                        $in_arr = explode("\n", $include);
                        if (!empty($in_arr)) {
                            foreach ($in_arr as $k => $v) {
                                echo '<li>' . TravelHelper::getNewIcon( 'check-1', '#36bca1', '15px', '15px', false ) . esc_attr( $v ) . '</li>';
                            }
                        }
                        ?>
                    </ul>
                </div>
            <?php } ?>
            <?php if (!empty($exclude)) { ?>
                <div class="col-12 col-lg-6">
                    <ul class="exclude">
                        <?php
                        $ex_arr = explode("\n", $exclude);
                        if (!empty($ex_arr)) {
                            foreach ($ex_arr as $k => $v) {
                                echo '<li>' . TravelHelper::getNewIcon( 'remove', '#ec927e', '15px', '15px', false ) . esc_attr( $v ) . '</li>';
                            }
                        }
                        ?>
                    </ul>
                </div>
            <?php } ?>
        </div>
    </div>
<?php } ?>