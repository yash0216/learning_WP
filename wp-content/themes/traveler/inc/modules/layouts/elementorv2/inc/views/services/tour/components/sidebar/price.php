<?php
$data_min_max = TravelerObject::get_min_max_price('st_tours');
$max = ((float)$data_min_max['price_max'] > 0) ? (float)$data_min_max['price_max'] : 0;
$max = TravelHelper::convert_money( $max );
$min = 0;


$value_show = $min . ";" . $max; // default if error

if (STInput::request('price_range')) {
    $price_range = explode(';', STInput::request('price_range'));

    $value_show = $price_range[0] . ";" . $price_range[1];
    $min = $price_range[ 0 ];
    $max = $price_range[ 1 ];
} else {

    $value_show = $min . ";" . $max;
}
?>
<div class="sidebar-item range-slider st-border-radius">
    <div class="item-title d-flex justify-content-between align-items-center">
        <div><?php echo esc_attr($title); ?></div>
        <i class="fa fa-angle-up" aria-hidden="true"></i>
    </div>
    <div class="item-content range-slider">
        <input type="text" class="price_range" name="price_range" value="<?php echo esc_attr($value_show); ?>" data-symbol="<?php echo TravelHelper::get_current_currency('symbol'); ?>" data-min="<?php echo esc_attr($min); ?>" data-max="<?php echo esc_attr($max); ?>" data-step="<?php echo st()->get_option('search_price_range_step',0); ?>"/>
        <div class="min-max-value">
            <div class="item-value">
                <?php echo esc_html__('Min price', 'traveler'); ?>
                <span><?php echo esc_html(TravelHelper::format_money(((float)$min > 0) ? (float)$min : 0)); ?></span>
            </div>
            <div class="item-value">
                <?php echo esc_html__('Max price', 'traveler'); ?>
                <span><?php echo esc_html(TravelHelper::format_money(((float)$data_min_max['price_max'] > 0) ? (float)$data_min_max['price_max'] : 0)); ?></span>
            </div>
        </div>
        <div class="price-action">
            <a href="javascript:void(0);" class="clear-price"><?php echo esc_html__('Clear', 'traveler'); ?></a>
            <button class="btn btn-link btn-apply-price-range"><?php echo __('Apply', 'traveler'); ?></button>
        </div>
    </div>
</div>