<?php
    wp_reset_postdata();
    wp_reset_query();
    $footer_template = TravelHelper::st_get_template_footer( get_the_ID(), true );
    if ( $footer_template ) {
        $vc_content = STTemplate::get_vc_pagecontent( $footer_template );
        if ( $vc_content ) {
            echo '<footer id="main-footer" class="clearfix">';
            echo balanceTags($vc_content);
            echo ' </footer>';
        }
    } else {
        ?>
        <footer id="main-footer" class="container-fluid">
            <div class="container text-center">
                <p><?php echo sprintf(__('Copy &copy; %s Shinetheme. All Rights Reserved', 'traveler'),date("Y")); ?></p>
            </div>

        </footer>
    <?php } ?>
<div class="container main-footer-sub">
    <div class="st-flex space-between">
        <div class="left mt20">
            <div class="f14"><?php echo sprintf( esc_html__( 'Copyright © %s by', 'traveler' ), date( 'Y' ) ); ?> <a
                        href="<?php echo esc_url( home_url( '/' ) ) ?>"
                        class="st-link"><?php bloginfo( 'name' ) ?></a></div>
        </div>
        <div class="right mt20">
            <img width="240" height="40" src="<?php echo get_template_directory_uri() ?>/v2/images/svg/ico_paymethod.svg" alt="<?php echo esc_attr__('Trust badges','traveler');?>"
                 class="img-responsive st_trustbase">
        </div>
    </div>
</div>
<?php wp_footer(); ?>
<?php do_action('st_after_footer');?>
</body>
</html>
