<?php

wp_enqueue_script('affilate-api.js');

$fields = array(
    array(
        'title' => esc_html__('Origin', 'traveler'),
        'name' => 'origin',
        'placeholder' => esc_html__('Origin', 'traveler'),
        'layout_col' => '6',
        'layout2_col' => '6',
        'is_required' => 'on'
    ),
    array(
        'title' => esc_html__('Destination', 'traveler'),
        'name' => 'destination',
        'placeholder' => esc_html__('Destination', 'traveler'),
        'layout_col' => '6',
        'layout2_col' => '6',
        'is_required' => 'on'
    ),
    array(
        'title' => esc_html__('Depart date', 'traveler'),
        'name' => 'depart',
        'placeholder' => esc_html__('Depart date', 'traveler'),
        'layout_col' => '4',
        'layout2_col' => '4',
        'is_required' => 'on'
    ),
    array(
        'title' => esc_html__('Return date', 'traveler'),
        'name' => 'return',
        'placeholder' => esc_html__('Return date', 'traveler'),
        'layout_col' => '4',
        'layout2_col' => '4',
        'is_required' => 'off'
    ),
    array(
        'title' => esc_html__('Passengers/Class', 'traveler'),
        'name' => 'passengers-class',
        'placeholder' => esc_html__('Passengers/Class', 'traveler'),
        'layout_col' => '4',
        'layout2_col' => '4',
        'is_required' => 'off'
    )
);

$st_direction = !empty($st_direction) ? $st_direction : "horizontal";

$marker = st()->get_option('tp_marker', '326912');
$class = '';
$id = 'id="sticky-nav"';
if(isset($in_tab)) {
    $class = 'in_tab';
    $id = '';
}

if (!isset($field_size)) $field_size = '';
?>
<div class="search-form hotel-search-form-home st-traveler-payout hotel-search-form st-border-radius <?php echo esc_attr($class); ?>">
    <?php
    $tp_show_api_info = st()->get_option('tp_show_api_info', 'on');
    $tp_locale_default = st()->get_option('tp_locale_default', 'en');
    $tp_currency_default = st()->get_option('tp_currency_default', 'usd');
    $action = 'https://jetradar.com/searches/new';
    $target = '_blank';
    $button_class = '';

    ?>
    <form role="search" method="get" class="form search main-search" autocomplete="off" action="<?php echo esc_url($action); ?>" target="<?php echo esc_attr($target); ?>">
        <input type="hidden" name="marker" value="<?php echo esc_attr($marker); ?>">
        <?php
			$page_id = st()->get_option('tp_whitelabel_page','');

			if(empty($page_id)){
				$whitelabel_name = st()->get_option('tp_whitelabel', 'whitelabel.travelerwp.com');
			}else{
				$whitelabel_name = get_permalink($page_id).'/#/flights';
			}
			echo '<input type="hidden" id="current_url" name="current_url" value="'.esc_url($whitelabel_name).'/">';
        ?>
        <?php echo '<input type="hidden" id="tp_locale_default" name="tp_locale_default" value="'.esc_attr($tp_locale_default).'">';
        echo '<input type="hidden" id="tp_currency_default" name="tp_currency_default" value="'.esc_attr($tp_currency_default).'">'; ?>
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-4">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-6 field-origin">
                        <?php echo stt_elementorv2()->loadView('services/travelpayouts_api/search/flight/field-origin'); ?>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-6 field-destination">
                        <?php echo stt_elementorv2()->loadView('services/travelpayouts_api/search/flight/field-destination'); ?>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-4">
                <div class="field-depart">
                    <?php echo stt_elementorv2()->loadView('services/travelpayouts_api/search/flight/field-depart'); ?>
                </div>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-4 field-passenger">
                <?php echo stt_elementorv2()->loadView('services/travelpayouts_api/search/flight/field-passengers-class'); ?>
            </div>
        </div>
		<input type="hidden" name="with_request" value="true">
    </form>
</div>
