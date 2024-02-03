<?php
$currency = get_post_meta( $order_id, 'currency', true );
$order_data = STUser_f::get_booking_meta($order_id);
$date_format = TravelHelper::getDateFormat();
$data_price = get_post_meta($order_id, 'data_prices', true);
$price_type = 'person';
if(!empty($data_price)){
 if(!empty($data_price['price_type'])){
     $price_type = $data_price['price_type'];
 }
}
?>
<div class="st_tab st_tab_order tabbable">
    <ul class="nav nav-tabs tab_order">
        <li class="active">
            <?php
            $post_type = get_post_type( $service_id );
            $obj = get_post_type_object( $post_type ); ?>
            <a data-toggle="tab" href="#tab-booking-detail" aria-expanded="true"> <?php echo sprintf(esc_html__("%s Details",'traveler'),$obj->labels->singular_name) ?></a>
        </li>
        <li class="">
            <a data-toggle="tab" href="#tab-customer-detail" aria-expanded="false"> <?php esc_html_e("Customer Details",'traveler') ?></a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent973">
        <div id="tab-booking-detail" class="tab-pane fade active in">
            <div class="info">
                <div class="row">
                <div class="col-md-6">
                    <div class="item_booking_detail">
                        <strong><?php esc_html_e("Booking ID",'traveler') ?>:  </strong>
                        #<?php echo esc_html($order_id) ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="item_booking_detail">
                        <strong><?php esc_html_e("Payment Method: ",'traveler') ?> </strong>
                        <?php echo STPaymentGateways::get_gatewayname(get_post_meta($order_id, 'payment_method', true)); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="item_booking_detail">
                        <strong><?php esc_html_e("Order Date",'traveler') ?>:  </strong>
                        <?php echo esc_html(date_i18n($date_format, strtotime($order_data['created']))) ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="item_booking_detail">
                        <strong><?php esc_html_e("Booking Status",'traveler') ?>:  </strong>
                        <?php
                        $data_status =  STUser_f::_get_all_order_statuses();
                        $status = $order_data['status'];
                        if(!empty($status_string = $data_status[$status])){
                            $status_string = $data_status[$status];
    	                    $status_string = $data_status[get_post_meta($order_id, 'status', true)];
                            if( isset( $order_data['cancel_refund_status'] ) && $order_data['cancel_refund_status'] == 'pending'){
                                $status_string = __('Cancelling', 'traveler');
                            }
                        }
                        ?>
                        <span class=""> <?php  echo esc_html($status_string); ?></span>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="item_booking_detail">
                        <strong><?php esc_html_e("Tour Name",'traveler') ?>:  </strong>
                        <a href="<?php echo get_the_permalink($service_id) ?>"><?php echo get_the_title($service_id) ?></a>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="item_booking_detail">
                        <strong><?php esc_html_e("Tour Type",'traveler') ?>:  </strong>
                        <?php
                        $tour_name = '';
                        if($price_type == 'fixed_depart'){
                            $tour_name = __('Fixed Departure', 'traveler');
                        }else{
    	                    $tour_type = get_post_meta( $order_id, 'type_tour', true );
    	                    if ( $tour_type == 'daily_tour' ) {
    		                    $tour_name = __( 'Daily Tour', 'traveler' );
    	                    } elseif ( $tour_type == 'specific_date' ) {
    		                    $tour_name = __( 'Specific Date', 'traveler' );
    	                    }
                        }
                        echo esc_html($tour_name);
                        ?>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="item_booking_detail">
                        <strong><?php esc_html_e("Address: ",'traveler') ?>:  </strong>
                        <?php  echo get_post_meta( $service_id, 'address', true); ?>
                    </div>
                </div>
                    <?php if($price_type != 'fixed_depart'){ ?>
                        <div class="col-md-6">
                            <div class="item_booking_detail">
                                <strong><?php esc_html_e("Departure date:",'traveler') ?> </strong>
                                <?php
                                $check_in = date( $date_format, $order_data['check_in_timestamp'] );
                                echo esc_html($check_in) . ($order_data['starttime'] != '' ? ' - ' . esc_html($order_data['starttime']) : '');
                                ?>
                            </div>
                        </div>
                        <div class="col-md-6 <?php if ( $tour_type == 'daily_tour' ) echo 'hide'; ?>">
                            <div class="item_booking_detail">
                                <strong><?php esc_html_e("Return date:",'traveler') ?> </strong>
                                <?php
                                $check_out = date( $date_format, $order_data['check_out_timestamp'] );
                                echo esc_html($check_out);
                                ?>
                            </div>
                        </div>
                        <div class="col-md-6 <?php if ( $tour_type != 'daily_tour' ) echo 'hide'; ?>">
                            <div class="item_booking_detail">
                                <strong><?php esc_html_e("Duration:",'traveler') ?> </strong>
                                <?php
                                echo get_post_meta( $order_id, 'duration', true );
                                ?>
                            </div>
                        </div>
                    <?php }else{ ?>
                        <div class="col-md-6">
                            <div class="item_booking_detail">
                                <strong><?php esc_html_e("Start date:",'traveler') ?> </strong>
    		                    <?php
                                $day_check_in = TourHelper::getDayFromNumber(date('N',  $order_data['check_in_timestamp']));
    		                    $check_in = date( $date_format, $order_data['check_in_timestamp'] );
    		                    echo esc_html($day_check_in . ' ' . $check_in);
    		                    ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="item_booking_detail">
                                <strong><?php esc_html_e("End date:",'traveler') ?> </strong>
    		                    <?php
    		                    $day_check_out = TourHelper::getDayFromNumber(date('N',  $order_data['check_out_timestamp']));
    		                    $check_out = date( $date_format, $order_data['check_out_timestamp'] );
    		                    echo esc_html($day_check_out . ' ' . $check_out);
    		                    ?>
                            </div>
                        </div>
                    <?php } ?>
                <?php if(st_print_order_item_guest_name(json_decode($order_data['raw_data'],true))){?>
                <div class="col-md-12">
                    <div class="item_booking_detail">
                        <?php st_print_order_item_guest_name(json_decode($order_data['raw_data'],true)) ?>
                    </div>
                </div>
                <?php }?>
                <div class="line col-md-12"></div>
                <div class="col-md-6">
                    <div class="item_booking_detail">
                        <strong><?php esc_html_e("No. Adults :",'traveler') ?> </strong>
                        <?php echo get_post_meta( $order_id, 'adult_number', true ); ?>
                    </div>
                </div>
                <?php if($price_type == 'person'): ?>
                <div class="col-md-6">
                    <div class="item_booking_detail">
                        <strong><?php esc_html_e("Adult Price :",'traveler') ?> </strong>
                        <?php $adult_price =  get_post_meta( $order_id, 'adult_price', true ); ?>
                        <?php echo TravelHelper::format_money( $adult_price ); ?>
                    </div>
                </div>
                    <?php endif; ?>
                <div class="col-md-6">
                    <div class="item_booking_detail">
                        <strong><?php esc_html_e("No. Children :",'traveler') ?> </strong>
                        <?php echo get_post_meta( $order_id, 'child_number', true ); ?>
                    </div>
                </div>
	                <?php if($price_type == 'person'): ?>
                <div class="col-md-6">
                    <div class="item_booking_detail">
                        <strong><?php esc_html_e("Children Price :",'traveler') ?> </strong>
                        <?php $child_price =  get_post_meta( $order_id, 'child_price', true ); ?>
                        <?php echo TravelHelper::format_money( $child_price ); ?>
                    </div>
                </div>
                    <?php endif; ?>
                <div class="col-md-6">
                    <div class="item_booking_detail">
                        <strong><?php esc_html_e("No. Infant :",'traveler') ?> </strong>
                        <?php echo get_post_meta( $order_id, 'infant_number', true ); ?>
                    </div>
                </div>
	                <?php if($price_type == 'person'): ?>
                <div class="col-md-6">
                    <div class="item_booking_detail">
                        <strong><?php esc_html_e("Infant Price :",'traveler') ?> </strong>
                        <?php $infant_price =  get_post_meta( $order_id, 'infant_price', true ); ?>
                        <?php echo TravelHelper::format_money( $infant_price ); ?>
                    </div>
                </div>
                    <?php endif; ?>
	                <?php if($price_type == 'fixed'): ?>
                        <div class="col-md-6">
                            <div class="item_booking_detail">
                                <strong><?php esc_html_e("Base Price :",'traveler') ?> </strong>
    			                <?php echo !empty($data_price['origin_price']) ? TravelHelper::format_money( $data_price['origin_price'] ) : '0'; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php
                $extra_price = get_post_meta( $order_id, 'extra_price', true );
                $extras      = get_post_meta( $order_id, 'extras', true );
                $data_extra = [];
                if ( isset( $extras[ 'value' ] ) && is_array( $extras[ 'value' ] ) && count( $extras[ 'value' ] ) ) {
                    foreach ( $extras[ 'value' ] as $name => $number ) {
                        if(!empty($extras[ 'value' ][ $name ])){
                            $data_extra[ $name ] = array(
                                'title'=>$extras[ 'title' ][ $name ],
                                'price'=>$extras[ 'price' ][ $name ],
                                'value'=>$extras[ 'value' ][ $name ],
                            );
                        }
                    }
                }
                ?>
                <div class="col-md-6 <?php if(empty($data_extra)) echo "hide"; ?>">
                    <div class="item_booking_detail">
                        <strong><?php esc_html_e("Extra Price:",'traveler') ?> </strong>
                        <?php echo TravelHelper::format_money($extra_price); ?>
                        <?php if ( is_array( $data_extra ) && count( $extras ) ){ ?>
                            <table class="table mt10 mb10" style="table-layout: fixed;" width="200">
                                <tr>
                                    <td>
                                        <label>
                                            <strong><?php esc_html_e("Name Extra",'traveler') ?></strong>
                                        </label>
                                    </td>
                                    <td width="40%">
                                        <strong><?php esc_html_e("Price",'traveler') ?></strong>
                                    </td>
                                </tr>
                                <?php foreach ( $data_extra as $key => $val ):
                                    $price = intval( $val[ 'value' ]) * floatval($val[ 'price' ]);
                                    ?>
                                    <tr>
                                        <td>
                                            <label>
                                                <?php echo esc_html($val[ 'title' ]) . ' x ' . esc_html(intval( $val[ 'value' ])); ?>
                                            </label>
                                        </td>
                                        <td width="40%">
                                            <?php echo TravelHelper::format_money( $price ); ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </table>
                        <?php }else{ echo 0 ;} ?>
                    </div>
                </div>

                    <!-- Tour package -->
                    <?php
                    $hotel_packages = get_post_meta( $order_id, 'package_hotel', true );
                    $hotel_package_price = get_post_meta( $order_id, 'package_hotel_price', true );
                    ?>
                    <div class="col-md-6 <?php if(empty($hotel_packages)) echo "hide"; ?>">
                        <div class="item_booking_detail">
                            <strong><?php esc_html_e("Hotel Package:",'traveler') ?> </strong>
                            <?php echo TravelHelper::format_money($hotel_package_price); ?>
                            <?php if ( is_array( $hotel_packages ) && count( $hotel_packages ) ){ ?>
                                <table class="table mt10 mb10" style="table-layout: fixed;" width="200">
                                    <tr>
                                        <td>
                                            <label>
                                                <strong><?php esc_html_e("Hotel Name",'traveler') ?></strong>
                                            </label>
                                        </td>
                                        <td width="40%">
                                            <strong><?php esc_html_e("Price",'traveler') ?></strong>
                                        </td>
                                    </tr>
                                    <?php foreach ( $hotel_packages as $key => $val ):
                                        $price = $val->hotel_price;
                                        $price = $price * $val->qty;
                                        ?>
                                        <tr>
                                            <td>
                                                <label>
                                                    <?php echo esc_html($val->hotel_name); ?>
                                                </label>
                                            </td>
                                            <td width="40%">
                                                <?php echo TravelHelper::format_money( $price ); ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </table>
                            <?php }else{ echo 0 ;} ?>
                        </div>
                    </div>
                    <?php
                    $activity_packages = get_post_meta( $order_id, 'package_activity', true );
                    $activity_package_price = get_post_meta( $order_id, 'package_activity_price', true );
                    ?>
                    <div class="col-md-6 <?php if(empty($activity_packages)) echo "hide"; ?>">
                        <div class="item_booking_detail">
                            <strong><?php esc_html_e("Activity Package:",'traveler') ?> </strong>
                            <?php echo TravelHelper::format_money($activity_package_price); ?>
                            <?php if ( is_array( $activity_packages ) && count( $activity_packages ) ){ ?>
                                <table class="table mt10 mb10" style="table-layout: fixed;" width="200">
                                    <tr>
                                        <td>
                                            <label>
                                                <strong><?php esc_html_e("Activity Name",'traveler') ?></strong>
                                            </label>
                                        </td>
                                        <td width="40%">
                                            <strong><?php esc_html_e("Price",'traveler') ?></strong>
                                        </td>
                                    </tr>
                                    <?php foreach ( $activity_packages as $key => $val ):
                                        $price = $val->activity_price;
                                        ?>
                                        <tr>
                                            <td>
                                                <label>
                                                    <?php echo esc_html($val->activity_name); ?>
                                                </label>
                                            </td>
                                            <td width="40%">
                                                <?php echo TravelHelper::format_money( $price ); ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </table>
                            <?php }else{ echo 0 ;} ?>
                        </div>
                    </div>
                    <?php
                    $car_packages = get_post_meta( $order_id, 'package_car', true );
                    $car_package_price = get_post_meta( $order_id, 'package_car_price', true );
                    ?>
                    <div class="col-md-6 <?php if(empty($car_packages)) echo "hide"; ?>">
                        <div class="item_booking_detail">
                            <strong><?php esc_html_e("Car Package:",'traveler') ?> </strong>
                            <?php echo TravelHelper::format_money($car_package_price); ?>
                            <?php if ( is_array( $car_packages ) && count( $car_packages ) ){ ?>
                                <table class="table mt10 mb10" style="table-layout: fixed;" width="200">
                                    <tr>
                                        <td>
                                            <label>
                                                <strong><?php esc_html_e("Car Name",'traveler') ?></strong>
                                            </label>
                                        </td>
                                        <td width="40%">
                                            <strong><?php esc_html_e("Price",'traveler') ?></strong>
                                        </td>
                                    </tr>
                                    <?php foreach ( $car_packages as $key => $val ):
                                        $price = $val->car_price;
                                        ?>
                                        <tr>
                                            <td>
                                                <label>
                                                    <?php echo esc_html($val->car_name); ?>
                                                </label>
                                            </td>
                                            <td width="40%">
                                                <?php echo TravelHelper::format_money( $price ) . ' x ' . esc_html($val->car_quantity); ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </table>
                            <?php }else{ echo 0 ;} ?>
                        </div>
                    </div>
	                <?php
	                $flight_packages = get_post_meta( $order_id, 'package_flight', true );
	                $flight_package_price = get_post_meta( $order_id, 'package_flight_price', true );
	                ?>
                    <div class="col-md-6 <?php if(empty($flight_packages)) echo "hide"; ?>">
                        <div class="item_booking_detail">
                            <strong><?php esc_html_e("Flight Package:",'traveler') ?> </strong>
    		                <?php echo TravelHelper::format_money($flight_package_price); ?>
    		                <?php if ( is_array( $hotel_packages ) && count( $hotel_packages ) ){ ?>
                                <table class="table mt10 mb10" style="table-layout: fixed;" width="200">
                                    <tr>
                                        <td>
                                            <label>
                                                <strong><?php esc_html_e("Origin/Destination",'traveler') ?></strong>
                                            </label>
                                        </td>
                                        <td width="40%">
                                            <strong><?php esc_html_e("Price",'traveler') ?></strong>
                                        </td>
                                    </tr>
    				                <?php foreach ( $flight_packages as $key => $val ):
    					                $name_flight_package = $val->flight_origin . ' <i class="fa fa-long-arrow-right"></i> ' . $val->flight_destination;
    					                $price_flight_package = '';
    					                if($val->flight_price_type == 'business'){
    						                $price_flight_package = $val->flight_price_business;
    					                }else{
    						                $price_flight_package = $val->flight_price_economy;
    					                }
    					                ?>
                                        <tr>
                                            <td>
                                                <label>
    								                <?php
                                                        echo esc_html($name_flight_package) . '<br />';
                                                        echo __('Departure time', 'traveler') . ': ' . esc_html($val->flight_departure_time) . '<br />';
    								                    echo __('Duration', 'traveler') . ': ' . esc_html($val->flight_duration);
                                                    ?>
                                                </label>
                                            </td>
                                            <td width="40%">
    							                <?php
                                                    echo strtoupper($val->$price_flight_package);
                                                    echo TravelHelper::format_money( $price_flight_package );
                                                ?>
                                            </td>
                                        </tr>
    				                <?php endforeach; ?>
                                </table>
    		                <?php }else{ echo 0 ;} ?>
                        </div>
                    </div>
                    <!-- End Tour Package -->
                <?php echo st()->load_template('user/detail-booking-history/detail-price',false,
                    array(
                        'order_data'=>$order_data,
                        'order_id'=>$order_id,
                        'service_id'=>$service_id,
                    )
                ) ?>
            </div>
            </div>
        </div>
        <div id="tab-customer-detail" class="tab-pane fade">
            <div class="container-customer">
                <?php echo apply_filters( 'st_customer_info_booking_history', st()->load_template('user/detail-booking-history/customer',false,array("order_id"=>$order_id)),$order_id ); ?>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <?php do_action("st_after_body_order_information_table",$order_id); ?>
    <button data-dismiss="modal" class="btn btn-default" type="button"><?php esc_html_e("Close",'traveler') ?></button>
</div>