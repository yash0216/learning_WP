<?php
$tour_programs = get_post_meta(get_the_ID(), 'tours_program', true);
if(!empty($tour_programs)){
    $i = 0;
    foreach ($tour_programs as $k => $v){
        ?>
        <div class="item <?php echo ($i == 0) ? 'active' : '' ?>">
            <div class="header">
                <h5><?php echo balanceTags($v['title']); ?></h5>
                <span class="arrow">
                    <i class="fa fa-angle-down"></i>
                </span>
            </div>
            <div class="body">
                <?php
                    if(isset($v['image']) and !empty($v['image'])){
                        $img = $v['image'];
                        ?>
                        <div class="row">
                            <div class="col-lg-4">
                                <img src="<?php echo esc_url($v['image']) ?>" alt="<?php echo esc_attr($v['title']) ?>" class="img-responsive"/>
                            </div>
                            <div class="col-lg-8">
                                <p>
                                <?php echo do_shortcode( wpautop( $v['desc'] ) ); ?>
                                </p>
                            </div>
                        </div>
                        <?php
                    }else{
                        echo '<p>';
                        echo do_shortcode( wpautop( $v['desc'] ) );
                        echo '</p>';
                    }
                ?>
            </div>
        </div>
        <?php
        $i++;
    }
}