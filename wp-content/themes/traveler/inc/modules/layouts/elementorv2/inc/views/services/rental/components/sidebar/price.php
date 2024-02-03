<?php
$data_min_max = TravelerObject::get_min_max_price('st_rental');
$start = STInput::get('start');
$end = STInput::get('end');
$start = TravelHelper::convertDateFormat($start);
$end = TravelHelper::convertDateFormat($end);
$numberday = (STDate::dateDiff($start, $end) == 0) ? 1 : STDate::dateDiff($start, $end) ;
$max = ((float)$data_min_max['price_max'] > 0) ? (float)$data_min_max['price_max'] : 0;
$max = TravelHelper::convert_money( $max );
$min = 0;

if (STInput::request('price_range')) {
    $price_range = explode(';', STInput::request('price_range'));
    $value_show = $price_range[0]*$numberday . ";" . $price_range[1]*$numberday;
} else {

    $value_show = $min*$numberday . ";" . $max*$numberday;
}
?>
<div class="sidebar-item range-slider st-border-radius">
    <div class="item-title d-flex justify-content-between align-items-center">
        <div><?php echo esc_attr($title); ?></div>
        <i class="fa fa-angle-up" aria-hidden="true"></i>
    </div>
    <div class="item-content range-slider">
        <input type="text" class="price_range" name="price_range" value="<?php echo esc_attr($value_show); ?>" data-symbol="<?php echo TravelHelper::get_current_currency('symbol'); ?>" data-min="0" data-max="<?php echo esc_attr($max*$numberday); ?>" data-step="<?php echo st()->get_option('search_price_range_step',0); ?>"/>
        <div class="min-max-value">
            <div class="item-value">
                <?php echo esc_html__('Min price', 'traveler'); ?>
                <span>0</span>
            </div>
            <div class="item-value">
                <?php echo esc_html__('Max price', 'traveler'); ?>
                <span><?php echo esc_html(TravelHelper::format_money(((float)$data_min_max['price_max']*$numberday > 0) ? (float)$data_min_max['price_max']*$numberday : 0)); ?></span>
            </div>
        </div>
        <div class="price-action">
            <a href="javascript:void(0);" class="clear-price"><?php echo esc_html__('Clear', 'traveler'); ?></a>
            <button class="btn btn-link btn-apply-price-range"><?php echo __('Apply', 'traveler'); ?></button>
        </div>
    </div>
</div>