<?php
get_header();
wp_enqueue_script('filter-car');

$sidebar_pos = get_post_meta(get_the_ID(), 'rs_car_sidebar_pos', true);
if(empty($sidebar_pos))
    $sidebar_pos = 'left';
?>
    <div id="st-content-wrapper" class="st-style-elementor search-result-page  car-layout3" data-layout="3" data-format="popup">
        <?php echo stt_elementorv2()->loadView('services/car/components/banner'); ?>
        <div class="container">
            <div class="st-results st-hotel-result st-search-tour">
                <div class="row">
                    <?php
                    if($sidebar_pos == 'left') {
                        echo stt_elementorv2()->loadView('services/car/components/sidebar', ['format' => 'popupmap']);
                    }
                    ?>
                    <?php
                    $query           = array(
                        'post_type'      => 'st_cars' ,
                        'post_status'    => 'publish' ,
                        's'              => ''
                    );
                    global $wp_query , $st_search_query;
                    $car = STCars::get_instance();
                    $car->alter_search_query();
                    query_posts( $query );
                    $st_search_query = $wp_query;
                    $car->remove_alter_search_query();
                    wp_reset_query();

                    if (TravelHelper::is_wpml()) {
                        global $sitepress;
                        $sitepress->switch_lang($current_lang, true);
                    }

                    echo stt_elementorv2()->loadView('services/car/components/content');

                    if($sidebar_pos == 'right') {
                        echo stt_elementorv2()->loadView('services/car/components/sidebar', ['format' => 'popupmap']);
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
<?php
get_footer();