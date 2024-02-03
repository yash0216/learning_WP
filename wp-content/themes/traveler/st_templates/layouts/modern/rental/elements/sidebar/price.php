<?php
$data_min_max = TravelerObject::get_min_max_price('st_rental');
$start = STInput::get('start');
$end = STInput::get('end');
$start = TravelHelper::convertDateFormat($start);
$end = TravelHelper::convertDateFormat($end);
$numberday = (STDate::dateDiff($start, $end) == 0) ? 1 : STDate::dateDiff($start, $end) ;
$max = ((float)$data_min_max['price_max'] > 0) ? (float)$data_min_max['price_max'] : 0;
$min = 0;
$rate_change = false;
if (TravelHelper::get_default_currency('rate') != 0 and TravelHelper::get_default_currency('rate')) {
    $rate_change = TravelHelper::get_current_currency('rate') / TravelHelper::get_default_currency('rate');
    $max = round($rate_change * $max);
    if ((float)$max < 0) $max = 0;

    $min = round($rate_change * $min);
    if ((float)$min < 0) $min = 0;
}

$value_show = $min*$numberday . ";" . $max*$numberday; // default if error

if ($rate_change) {
    if (STInput::request('price_range')) {
        $price_range = explode(';', STInput::request('price_range'));

        $value_show = $price_range[0]*$numberday . ";" . $price_range[1]*$numberday;
        $min = $price_range[ 0 ];
    } else {

        $value_show = $min*$numberday . ";" . $max*$numberday;
    }
}
?>
<div class="sidebar-item range-slider">
    <div class="item-title">
        <label><?php echo esc_html($title); ?></label>
        <i class="fa fa-angle-up" aria-hidden="true"></i>
    </div>
    <div class="item-content">
        <input type="text" class="price_range" name="price_range" value="<?php echo esc_attr($value_show); ?>" data-symbol="<?php echo TravelHelper::get_current_currency('symbol'); ?>" data-min="<?php echo esc_attr($min*$numberday); ?>" data-max="<?php echo esc_attr($max*$numberday); ?>" data-step="<?php echo st()->get_option('search_price_range_step',0); ?>"/>
        <button class="btn btn-link btn-apply-price-range"><?php echo __('APPLY', 'traveler'); ?></button>
    </div>
</div>