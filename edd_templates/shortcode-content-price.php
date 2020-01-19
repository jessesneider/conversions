<?php
	echo '<div>
		<div class="edd_price">';

			// Get the download ID
			$download_id = get_the_ID();

			// Get the prices
			if ( edd_is_free_download( $download_id ) ) {
				$price = __( 'Free', 'conversions' );
 			} elseif ( edd_has_variable_prices( $download_id ) ) {
				$price = edd_price_range( $download_id );
			} else {
				$price = edd_price( $download_id );
			}

			echo $price;

		echo '</div>
	</div>';
?>