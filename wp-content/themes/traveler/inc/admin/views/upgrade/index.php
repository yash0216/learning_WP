<?php 

/**

*@since 1.3.0

**/

wp_enqueue_style( 'admin-location-nested' );

wp_enqueue_script('admin-location-nested.js' );

?>

<div class="notice notice-warning" style="padding-bottom: 10px">

	<p>Update new data, eg location structure... Please enable all services (Hotel, Car, Rental, Tour, Activity) in Theme Options > General Options before running it</p>



	<?php if( $upgraded ): ?>

		<p><em>(You did it once. If you want to do it again, click "Update Now" button.)</em></p>

	<?php endif; ?>

	<button id="st-update-glocation" class="button button-primary button-large" type="submit">Upgrade Data</button>

</div>

<div class="update-glocation-wrapper">

	<div class="update-glocation-content">

		<div class="update-glocation-title clear">

			<h3 class="title">

				<img src="<?php echo get_template_directory_uri(); ?>/img/logo-mini.png" alt="<?php echo TravelHelper::get_alt_image(); ?>" class="img-responsive"><?php echo __('Traveler Upgrade Data', 'traveler'); ?>

			</h3>

			<a href="#" class="update-glocation-close"></a>

		</div>

		<div class="update-glocation-description">

			Update new data, eg location structure... Please enable all services (Hotel, Car, Rental, Tour, Activity) in Theme Options > General Options before running it

			<br/>

			<h2>You will upgrade  these options below:</h2>

		</div>

		<form action="#" class="update-item-form">

			<div class="item step-1">

				<div class="info">

					<input checked id="update_table_post_type" type="checkbox" name="update_table_post_type" value="update_table_post_type" style="display: none">

					<p>Update <strong>services</strong>.</p>

					<p class="status"></p>

				</div>

			</div>

			<div class="item step-2">

				<div class="info">

					<input checked id="update_location_nested" type="checkbox" name="update_location_nested" value="update_location_nested" style="display: none">

					<p>Update <strong>location</strong>.</p>

					<p class="status"></p>

				</div>

			</div>

			<div class="item step-3">

				<div class="info">

					<input checked id="update_location_relationships" type="checkbox" name="update_location_relationships" value="update_location_relationships" style="display: none">

					<p>Update <strong>location relationships</strong>.</p>

					<p class="status"></p>

				</div>

			</div>

			<div class="update-glocation-progress">

				<div class="progress-bar"><span style="width: 0%"></span></div>

			</div>

		</form>

		<div class="update-glocation-note">

			(*) Note: "The updated data can occur errors corrupt the content or misleading information. We recommend that customers should back up your data before performing."

		</div>

		<div class="update-glocation-message"></div>

		<div class="update-glocation-button"><?php echo __('Run', 'traveler'); ?></div>

		

		<input checked id="reset_table" type="checkbox" name="reset_table" value="reset" style="display: none">

		

	</div>

</div>