<?php
$attrs = array();
$attrs = [
    'data-slides-per-view' => [
        esc_attr($item_row)
    ],
    'data-pagination' => [
        esc_attr($pagination)
    ],
    'data-navigation' => [
        esc_attr($navigation)
    ],
    'data-auto-play' => [
        esc_attr($auto_play)
    ],
    'data-loop' => [
        esc_attr($loop)
    ],
    'data-center-slider' => [
        esc_attr($center_slider)
    ],
    'data-delay' => [
        esc_attr($delay)
    ],

];

$html = '';
$args = [
    'post_type' => 'post',
    'posts_per_page' => $posts_per_page,
    'order' => $order,
    'orderby' => $orderby,
];
if ($orderby === 'post__in' && !empty($post_ids)) {
    $list_ids = ST_Elementor::st_explode_select2($post_ids);
    $args['post__in'] = array_keys($list_ids);
}
$query_service = new WP_Query($args);
if ($query_service->have_posts()) { ?>
    <div class="st-sliders st-style-arrow nav-top <?php echo esc_attr($layout_style); ?>" <?php echo st_render_html_attributes($attrs); ?>>

        <div class="service-list-wrapper st-blog-list-el st-blog-list-lib swiper-container">
            <div class="swiper-wrapper">
                <?php while ($query_service->have_posts()) :
                    $query_service->the_post(); ?>
                    <div class="swiper-slide">
                        <?php
                        $post_id = get_the_ID();
                        $post_translated = TravelHelper::post_translated($post_id);
                        $thumbnail_id = get_post_thumbnail_id($post_translated);
                        ?>
                        <div class="services-item grid item-elementor">
                            <div class="item service-border-lib">
                                <div class="featured-image">
                                    <a href="<?php echo get_the_permalink(); ?>">
                                        <img itemprop="photo" src="<?php echo wp_get_attachment_image_url($thumbnail_id, array(450, 300)); ?>" alt="<?php echo get_the_title(); ?>" class="img-fluid st-hover-grow" />
                                    </a>
                                    <?php do_action('st_list_compare_button', get_the_ID(), get_post_type(get_the_ID())); ?>
                                </div>
                                <div class="content-item">

                                    <h3 class="title" itemprop="name">
                                        <a href="<?php echo get_the_permalink(); ?>" class="st-link c-main"><?php echo get_the_title($post_translated) ?></a>
                                    </h3>

                                    <div class="excerpt-wrapper d-flex align-items-end justify-content-between">
                                        <?php echo wp_trim_words(get_the_excerpt(), 40); ?>
                                    </div>
                                    <div class="read-more-lib">
                                        <a href="<?php echo get_the_permalink(); ?>"><?php echo esc_html("Explore more", "traveler-layout-essential") ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                endwhile;
                wp_reset_postdata();
                ?>
            </div>
            <?php if ($pagination == 'on') { ?>
                <div class="swiper-pagination"></div>
            <?php } ?>
        </div>
        <?php
        if ($navigation == 'on') { ?>
            <div class="st-button-prev"><svg width="20" height="16" viewBox="0 0 20 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M8.10033 14.6003C7.80744 14.8932 7.33256 14.8932 7.03967 14.6003L0.96967 8.53034C0.829018 8.38968 0.750001 8.19892 0.750001 8.00001C0.750001 7.80109 0.829018 7.61033 0.96967 7.46968L7.03967 1.39968C7.33256 1.10678 7.80744 1.10678 8.10033 1.39968C8.39322 1.69257 8.39322 2.16744 8.10033 2.46034L3.31066 7.25001L18.5 7.25001C18.9142 7.25001 19.25 7.58579 19.25 8.00001C19.25 8.41422 18.9142 8.75001 18.5 8.75001L3.31066 8.75001L8.10033 13.5397C8.39322 13.8326 8.39322 14.3074 8.10033 14.6003Z" fill="#7B7B7B"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M8.27711 14.7771C7.88658 15.1676 7.25342 15.1676 6.86289 14.7771L0.792893 8.70711C0.605357 8.51958 0.500001 8.26522 0.500001 8.00001C0.500001 7.73479 0.605357 7.48044 0.792893 7.2929L6.86289 1.2229C7.25342 0.832375 7.88658 0.832375 8.27711 1.2229C8.66763 1.61342 8.66763 2.24659 8.27711 2.63711L3.91421 7.00001L18.5 7.00001C19.0523 7.00001 19.5 7.44772 19.5 8.00001C19.5 8.55229 19.0523 9.00001 18.5 9.00001L3.91421 9.00001L8.27711 13.3629C8.66763 13.7534 8.66763 14.3866 8.27711 14.7771ZM7.21645 14.4236C7.41171 14.6188 7.72829 14.6188 7.92355 14.4236C8.11882 14.2283 8.11882 13.9117 7.92355 13.7165L3.13388 8.92678C3.06238 8.85528 3.041 8.74775 3.07969 8.65434C3.11839 8.56092 3.20955 8.50001 3.31066 8.50001L18.5 8.50001C18.7761 8.50001 19 8.27615 19 8.00001C19 7.72386 18.7761 7.50001 18.5 7.50001L3.31066 7.50001C3.20955 7.50001 3.11839 7.4391 3.07969 7.34568C3.041 7.25226 3.06238 7.14473 3.13389 7.07323L7.92355 2.28356C8.11882 2.0883 8.11882 1.77172 7.92355 1.57645C7.72829 1.38119 7.41171 1.38119 7.21645 1.57645L1.14645 7.64645C1.05268 7.74022 1 7.8674 1 8.00001C1 8.13261 1.05268 8.25979 1.14645 8.35356L7.21645 14.4236Z" fill="#7B7B7B"></path>
                </svg></div>
            <div class="st-button-next"><svg width="20" height="16" viewBox="0 0 20 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M11.8997 14.6003C12.1926 14.8932 12.6674 14.8932 12.9603 14.6003L19.0303 8.53034C19.171 8.38969 19.25 8.19892 19.25 8.00001C19.25 7.80109 19.171 7.61033 19.0303 7.46968L12.9603 1.39968C12.6674 1.10678 12.1926 1.10678 11.8997 1.39968C11.6068 1.69257 11.6068 2.16745 11.8997 2.46034L16.6893 7.25001L1.5 7.25001C1.08579 7.25001 0.75 7.58579 0.75 8.00001C0.75 8.41422 1.08579 8.75001 1.5 8.75001H16.6893L11.8997 13.5397C11.6068 13.8326 11.6068 14.3074 11.8997 14.6003Z" fill="#7B7B7B"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M11.7229 14.7771C12.1134 15.1676 12.7466 15.1676 13.1371 14.7771L19.2071 8.70711C19.3946 8.51958 19.5 8.26522 19.5 8.00001C19.5 7.73479 19.3946 7.48044 19.2071 7.2929L13.1371 1.2229C12.7466 0.832376 12.1134 0.832376 11.7229 1.2229C11.3324 1.61343 11.3324 2.24659 11.7229 2.63711L16.0858 7.00001L1.5 7.00001C0.947715 7.00001 0.5 7.44772 0.5 8.00001C0.5 8.55229 0.947715 9.00001 1.5 9.00001H16.0858L11.7229 13.3629C11.3324 13.7534 11.3324 14.3866 11.7229 14.7771ZM12.7836 14.4236C12.5883 14.6188 12.2717 14.6188 12.0764 14.4236C11.8812 14.2283 11.8812 13.9117 12.0764 13.7165L16.8661 8.92678C16.9376 8.85528 16.959 8.74776 16.9203 8.65434C16.8816 8.56092 16.7905 8.50001 16.6893 8.50001H1.5C1.22386 8.50001 1 8.27615 1 8.00001C1 7.72386 1.22386 7.50001 1.5 7.50001L16.6893 7.50001C16.7905 7.50001 16.8816 7.4391 16.9203 7.34568C16.959 7.25226 16.9376 7.14473 16.8661 7.07323L12.0764 2.28356C11.8812 2.0883 11.8812 1.77172 12.0764 1.57646C12.2717 1.38119 12.5883 1.38119 12.7836 1.57646L18.8536 7.64645C18.9473 7.74022 19 7.8674 19 8.00001C19 8.13262 18.9473 8.25979 18.8536 8.35356L12.7836 14.4236Z" fill="#7B7B7B"></path>
                </svg></div>
        <?php }
        echo balanceTags($html);
        ?>

    </div>
<?php }
?>