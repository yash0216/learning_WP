<?php
$filters = get_post_meta(get_the_ID(), 'rs_filter_car_transfer', true);

?>
<div class="col-lg-3 col-md-3 sidebar-filter">
    <div class="close-sidebar"><span class="stt-icon stt-icon-close"></span></div>
    <?php
    if(!empty($filters)){
        foreach ($filters as $k => $v){
            echo stt_elementorv2()->loadView('services/car_transfer/components/sidebar/' . esc_attr($v['rs_filter_type']), ['title' => $v['title'], 'taxonomy' => $v['rs_filter_type_taxonomy']]);
        }
    }
    ?>
</div>