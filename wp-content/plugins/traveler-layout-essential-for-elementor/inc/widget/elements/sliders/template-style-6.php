<?php
if (!empty($list_st_sliders)) {
    $attrs = [
        'data-effect' => [
            esc_attr($effect_style)
        ],
        'data-slides-per-view' => [
            esc_attr($slides_per_view)
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
        'data-delay' => [
            esc_attr($delay)
        ],
        'data-center-slider' => [
            esc_attr($center_slider)
        ],
        'data-style-slider' => [
            esc_attr($style_slider)
        ],
        'data-space-between' => [
            esc_attr($space_slider['size'])
        ]
    ];
    ?>
    <div class="st-sliders st-list-slider <?php echo esc_attr($style_slider); ?>" <?php echo st_render_html_attributes($attrs); ?>>
        <div class="swiper-container">
            <div class="swiper-wrapper">
                <?php

                foreach ($list_st_sliders as $slider) {
                    if (!empty($slider['image'])) {
						$target = empty( $slider['url']['is_external'] ) ? '' : 'target="_blank"';
						?>
                        <div class="swiper-slide">

                            <img class="swiper-lazy" src="<?php echo esc_url($slider['image']['url']); ?>" alt="<?php echo esc_attr($slider['title']); ?>">
                            <div class="box-content">
                                <?php
                                if (!empty($slider['sub_title'])) { ?>
                                    <div class="sub_title">
                                        <span>
                                            <?php
                                            echo esc_html($slider['sub_title']);
                                            ?>
                                        </span>

                                    </div>

                                <?php }
                                ?>
                                <?php
                                if (!empty($slider['title'])) { ?>
                                    <div class="title">
                                        <span>
                                            <?php
                                            echo esc_html($slider['title']);
                                            ?>
                                        </span>

                                    </div>

                                <?php }
                                ?>
                                <?php
                                if (!empty($slider['button_text'])) { ?>
                                    <div class="button_text">
                                        <span>
                                            <a href="<?php echo esc_url($slider['url']['url']); ?>" <?= $target ?>>
                                                <?php
                                                echo esc_html($slider['button_text']);
                                                ?>
                                            </a>
                                        </span>

                                    </div>

                                <?php }
                                ?>

                            </div>
                        </div>
                    <?php }
                    ?>

                <?php }
                ?>
            </div>

			<?php
			$html = '';
			if ($pagination == 'on') {
				$html .= '<div class="swiper-pagination"></div>';
			}
			if ($navigation == 'on') {
				if ($style_slider === 'style-2' || $style_slider === 'style-3') {
					$html .= '<div class="st-button-prev"><span class="stt-icon stt-icon-arrow-left"></span></div><div class="st-button-next"><span class="stt-icon stt-icon-arrow-right"></span></div>';
				} else {
					$html .= '<div class="st-button-prev"><span></span></div><div class="st-button-next"><span></span></div>';
				}
			}
			if ($style_slider === 'style-2') {
				$html .= '<span class="count-item-index"></span>';
			}
			echo balanceTags($html);
			?>
        </div>
    </div>
<?php }
?>