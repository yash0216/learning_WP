<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 3/28/2019
 * Time: 1:46 PM
 */
$url         = st_get_link_with_search( get_permalink(), [ 'start', 'end', 'date', 'adult_number', 'child_number' ], $_GET );
$start       = STInput::get( 'start' ) ? STInput::get( 'start' ) : date( TravelHelper::getDateFormat() );
$end         = STInput::get( 'end' ) ? STInput::get( 'end' ) : date( TravelHelper::getDateFormat(), strtotime( '+ 1 day' ) );
$start       = TravelHelper::convertDateFormat( $start );
$end         = TravelHelper::convertDateFormat( $end );
$price       = STPrice::getSalePrice( get_the_ID(), strtotime( $start ), strtotime( $end ) );
$orgin_price = STPrice::getRentalPriceOnlyCustomPrice( get_the_ID(), strtotime( $start ), strtotime( $end ) );
// $price      = ! empty( $price['total_price_not_bulk_discount'] ) ? floatval( $price['total_price_not_bulk_discount'] ) : 0;
$info_price = STRental::inst()->get_info_price();
$numberday  = STDate::dateDiff( $start, $end );
if ( $numberday == 0 ) {
	$numberday = 1;
}
$min_price = get_post_meta( get_the_ID(), 'min_price', true );
$min_price = floatval( $min_price ) * $numberday;
$min_price = ! empty( $price['total_price_not_bulk_discount'] ) ? floatval( $price['total_price_not_bulk_discount'] ) : $min_price;

$regular_price = get_post_meta( get_the_ID(), 'price', true );
?>

<div class="item-service grid-item has-matchHeight">
	<div class="featured-image">
		<?php echo STFeatured::get_featured(); ?>
		<?php if ( ! empty( $info_price['discount'] ) && $info_price['discount'] > 0 && $info_price['price_new'] > 0 ) { ?>
				<?php echo STFeatured::get_sale( $info_price['discount'] ); ?>
		<?php } ?>
		<?php if ( is_user_logged_in() ) { ?>
			<?php $data = STUser_f::get_icon_wishlist(); ?>
			<div class="service-add-wishlist login <?php echo ( $data['status'] ) ? 'added' : ''; ?>"
				data-id="<?php echo get_the_ID(); ?>" data-type="<?php echo get_post_type( get_the_ID() ); ?>"
				title="<?php echo ( $data['status'] ) ? __( 'Remove from wishlist', 'traveler' ) : __( 'Add to wishlist', 'traveler' ); ?>">
				<i class="fa fa-heart"></i>
				<div class="lds-dual-ring"></div>
			</div>
		<?php } else { ?>
			<a href="#" class="login" data-toggle="modal" data-target="#st-login-form">
				<div class="service-add-wishlist" title="<?php echo __( 'Add to wishlist', 'traveler' ); ?>">
					<i class="fa fa-heart"></i>
					<div class="lds-dual-ring"></div>
				</div>
			</a>
		<?php } ?>
		<a href="<?php echo esc_url( $url ); ?>">
			<?php
			if ( has_post_thumbnail() ) {
				the_post_thumbnail( [ 740, 560 ], [
					'alt'   => TravelHelper::get_alt_image(),
					'class' => 'img-responsive',
				] );
			} else {
				echo '<img src="' . get_template_directory_uri() . '/img/no-image.png' . '" alt="Default Thumbnail" class="img-responsive" />';
			}
			?>
		</a>
		<?php echo st_get_avatar_in_list_service( get_the_ID(), 70 ) ?>
		<div class="price-wrapper">
			<?php if ( ! empty( $info_price['discount'] ) && $info_price['discount'] > 0 && $info_price['price_new'] > 0 ) : ?>
				<div class="price-regular">
					<span><?php echo esc_html__( TravelHelper::format_money( $orgin_price ), 'traveler' ) ?></span>
				</div>
			<?php endif; ?>
			<div class="price-sale">
				<span class="sale-top">
					<?php echo __( 'From ', 'traveler' ); ?>
				</span>
				<?php echo wp_kses( sprintf( __( '<span class="price">%1$s</span><span class="unit">/ %2$d night(s)</span>', 'traveler' ), TravelHelper::format_money( $min_price ), $numberday ), [ 'span' => [ 'class' => [] ] ] ) ?>
			</div>
		</div>
	</div>
	<div class="item-content">
		<h4 class="service-title"><a href="<?php echo esc_url( $url ); ?>"><?php echo get_the_title(); ?></a></h4>
		<?php if ( $address = get_post_meta( get_the_ID(), 'address', true ) ) : ?>
			<p class="service-location"><?php echo esc_html( $address ); ?></p>
		<?php endif; ?>
		<div class="service-review">
			<?php
			$count_review = STReview::count_comment( get_the_ID() );
			$avg          = STReview::get_avg_rate();
			?>
			<span class="rate">
				<?php echo esc_html( $avg ) . '/5'; ?>
				<span class="rate-text"><?php echo TravelHelper::get_rate_review_text( $avg, $count_review ); ?></span>
			</span>
			<span class="review"><?php echo esc_html( $count_review ) . ' ' . _n( esc_html__( 'Review', 'traveler' ), esc_html__( 'Reviews', 'traveler' ), $count_review ); ?></span>
		</div>
		<div class="amenities d-flex align-items-center justify-content-start clearfix">
			<span class="amenity total" data-toggle="tooltip" title="<?php echo esc_attr__( 'No. People', 'traveler' ) ?>"><?php echo TravelHelper::getNewIcon( 'ico_people_1', '', '22px', '22px', false ); ?><?php echo (int) get_post_meta( get_the_ID(), 'rental_max_adult', true ) + (int) get_post_meta( get_the_ID(), 'rental_max_children', true ); ?></span>
			<span class="amenity bed" data-toggle="tooltip" title="<?php echo esc_attr__( 'No. Bed', 'traveler' ) ?>"><?php echo TravelHelper::getNewIcon( 'ico_bed_1', '', '20px', '22px', false ); ?><?php echo (int) get_post_meta( get_the_ID(), 'rental_bed', true ) ?></span>
			<span class="amenity bath" data-toggle="tooltip" title="<?php echo esc_attr__( 'No. Bathroom', 'traveler' ) ?>"><?php echo TravelHelper::getNewIcon( 'ico_bathroom_1', '', '22px', '22px', false ); ?><?php echo (int) get_post_meta( get_the_ID(), 'rental_bath', true ) ?></span>
			<span class="amenity size" data-toggle="tooltip" title="<?php echo esc_attr__( 'Square', 'traveler' ) ?>"><?php echo TravelHelper::getNewIcon( 'ico_square_1', '', '21px', '21px', false ); ?><?php echo (int) get_post_meta( get_the_ID(), 'rental_size', true ); ?><?php echo __( 'm<sup>2</sup>', 'traveler' ); ?></span>
		</div>
	</div>
</div>
