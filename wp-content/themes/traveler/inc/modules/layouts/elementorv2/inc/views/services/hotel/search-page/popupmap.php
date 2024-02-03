<?php
get_header();
wp_enqueue_script('filter-hotel');

$sidebar_pos = get_post_meta(get_the_ID(), 'rs_hotel_siderbar_pos', true);
if(empty($sidebar_pos))
    $sidebar_pos = 'left';
?>
    <div id="st-content-wrapper" class="st-style-elementor search-result-page layout6" data-layout="6" data-format="popup">
        <?php echo stt_elementorv2()->loadView('services/hotel/components/banner'); ?>
        <div class="container">
            <div class="st-results st-hotel-result">
                <div class="row">
                    <?php
                    if($sidebar_pos == 'left') {
                        echo stt_elementorv2()->loadView('services/hotel/components/sidebar', ['format' => 'popupmap']);
                    }
                    ?>
                    <?php
                    $query           = array(
                        'post_type'      => 'st_hotel' ,
                        'post_status'    => 'publish' ,
                        's'              => ''
                    );
                    global $wp_query , $st_search_query;

                    $current_lang = TravelHelper::current_lang();
                    $main_lang = TravelHelper::primary_lang();
                    if (TravelHelper::is_wpml()) {
                        global $sitepress;
                        $sitepress->switch_lang($main_lang, true);
                    }

                    $hotel = STHotel::inst();
                    $hotel->alter_search_query();
                    query_posts( $query );
                    $st_search_query = $wp_query;
                    $hotel->remove_alter_search_query();
                    wp_reset_query();

                    if (TravelHelper::is_wpml()) {
                        global $sitepress;
                        $sitepress->switch_lang($current_lang, true);
                    }

                    echo stt_elementorv2()->loadView('services/hotel/components/content-popupmap');
                    echo stt_elementorv2()->loadView('services/hotel/components/popupmap');

                    if($sidebar_pos == 'right') {
                        echo stt_elementorv2()->loadView('services/hotel/components/sidebar', ['format' => 'popupmap']);
                    }
                    ?>
                </div>
                <div class="map-view map-view-mobile">
                    <a href="javascript:void(0);">
                        <span class="stt-icon stt-icon-map"></span>
                        <?php echo esc_html__('Map', 'traveler'); ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
<?php
get_footer();