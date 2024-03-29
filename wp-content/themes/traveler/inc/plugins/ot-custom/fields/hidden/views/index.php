<?php global $post; ?>
<div class="row calendar-wrapper" data-post-id="<?php echo esc_attr($post->ID); ?>">
    <div class="col-xs-12 col-lg-4">
        <div class="calendar-form">
            <div class="form-group">
                <label for="calendar_check_in"><strong><?php echo __('Check In', 'traveler'); ?></strong></label>
                <input readonly="readonly" type="text" class="widefat option-tree-ui-input date-picker" name="calendar_check_in" id="calendar_check_in" placeholder="<?php echo __('Check In', 'traveler'); ?>">
            </div>
            <div class="form-group">
                <label for="calendar_check_out"><strong><?php echo __('Check Out', 'traveler'); ?></strong></label>
                <input readonly="readonly" type="text" class="widefat option-tree-ui-input date-picker" name="calendar_check_out" id="calendar_check_out" placeholder="<?php echo __('Check Out', 'traveler'); ?>">
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="form-group">
                        <label><strong><?php echo __('Price ($)', 'traveler'); ?></strong></label>
                    </div>
                </div>
                <div class="col-xs-12 col-md-6 col-lg-4 <?php if(get_post_meta($post_id,'hide_adult_in_booking_form',true) == 'on') echo 'hide' ?>">
                    <div class="form-group">
                        <label for="calendar_adult_price"><?php echo __('Adult', 'traveler'); ?></label>
                        <input type="text" name="calendar_adult_price" id="calendar_adult_price" class="form-control" placeholder="<?php echo __('Price of adult', 'traveler'); ?>">
                    </div>
                </div>
                <div class="col-xs-12 col-md-6 col-lg-4 <?php if(get_post_meta($post_id,'hide_children_in_booking_form',true) == 'on') echo 'hide' ?>" >
                    <div class="form-group">
                        <label for="calendar_child_price"><?php echo __('Children', 'traveler'); ?></label>
                        <input type="text" name="calendar_child_price" id="calendar_child_price" class="form-control" placeholder="<?php echo __('Price of children', 'traveler'); ?>">
                    </div>
                </div>
                <div class="col-xs-12 col-md-6 col-lg-4 <?php if(get_post_meta($post_id,'hide_infant_in_booking_form',true) == 'on') echo 'hide' ?>">
                    <div class="form-group">
                        <label for="calendar_infant_price"><?php echo __('Infant', 'traveler'); ?></label>
                        <input type="text" name="calendar_infant_price" id="calendar_infant_price" class="form-control" placeholder="<?php echo __('Price of infant', 'traveler'); ?>">
                    </div>
                </div>
            </div><!--
            <div class="form-group">
                <label for="calendar_number"><?php echo __('Number of People', 'traveler'); ?></label>
                <input type="text" name="calendar_number" id="calendar_number" class="form-control">
            </div> -->
            <div class="form-group">
                <label for="calendar_status"><?php echo __('Status', 'traveler'); ?></label>
                <select name="calendar_status" id="calendar_status">
                    <option value="available"><?php echo __('Available', 'traveler'); ?></option>
                    <option value="unavailable"><?php echo __('Unavailable', 'traveler'); ?></option>
                </select>
            </div>
            <div class="form-group">
                <input type="checkbox" name="calendar_groupday" id="calendar_groupday" value="1"><span class="ml5"><?php echo __('Group day', 'traveler'); ?></span>
            </div>
            <div class="form-group">
                <div class="form-message">
                    <p></p>
                </div>
            </div>
            <div class="form-group">
                <input type="hidden" name="calendar_post_id" value="<?php echo esc_attr($post->ID); ?>">
                <input type="submit" id="calendar_submit" class="option-tree-ui-button button button-primary" name="calendar_submit" value="<?php echo __('Update', 'traveler'); ?>">
                <?php do_action('traveler_after_form_submit_tour_calendar'); ?>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-lg-8">
        <div class="calendar-content"
             data-hide_adult="<?php echo get_post_meta($post->ID,'hide_adult_in_booking_form',true) ?>"
             data-hide_children="<?php echo get_post_meta($post->ID,'hide_children_in_booking_form',true) ?>"
             data-hide_infant="<?php echo get_post_meta($post->ID,'hide_infant_in_booking_form',true) ?>"
            >
        </div>
        <div class="overlay">
            <span class="spinner is-active"></span>
        </div>
    </div>
    <?php do_action('traveler_after_form_tour_calendar'); ?>
</div>