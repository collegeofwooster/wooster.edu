<?php


// include wp core.
require( '../../../../wp-load.php' );

// let's get $wpdb ready to use
global $wpdb;

// pull events feed
$events_raw = file_get_contents( 'https://25livepub.collegenet.com/calendars/web-calendar-of-events.json' );

$events = json_decode( $events_raw );

// if we have events
if ( !empty( $events ) ) {

	// start looping through them
	foreach ( $events as $event ) {

		// uncomment to dump first result and die for testing (prevents a full loop through all records)
		//print_r( $event ); die;

	    // get a previous post if it exists.
	    $previous_post = $wpdb->get_results( "SELECT * FROM `woo_postmeta` WHERE `meta_key`='_p_event_external_id' AND `meta_value`='" . $event->eventID . "' LIMIT 1;" );

	    // set up an array of the post data
		$post_data = array(
			'post_author' => 1,
			'post_title' => $event->title,
			'post_content' => $event->description,
			'post_type' => 'event',
			'post_status' => 'publish',
			'comment_status' => 'closed',
			'ping_status' => 'closed'
		);

		// if we're in a browser, add <pre> tags
		if ( !is_cli() ) print "<pre>";

		// if we're creating this event
		if ( empty( $previous_post ) ) {

			// insert it first
			$post_id = wp_insert_post( $post_data );

			// and then add the external event id for our new post id
			add_post_meta( $post_id, '_p_event_external_id', $event->eventID );

			// cli output
			echo "Added new event: " . $event->title . "\n";

		} else {

			// since the post exists already, set the id
			$post_id = $previous_post[0]->post_id;
			
			// also add that post ID to the $post_data array so we can use it to update the post
			$post_data['ID'] = $post_id;

			// update the post data from the original
			wp_update_post( $post_data );

			// cli output
			echo "Updated existing event: " . $event->title . "\n";

		}

		// if we're in a browser, add <pre> tags
		if ( !is_cli() ) print "</pre>";

		// set update some event details to postmeta (they'll be added if they don't exist)
		update_post_meta( $post_id, '_p_event_location_text', $event->location );
		update_post_meta( $post_id, '_p_event_start', strtotime( $event->startDateTime ) );
		update_post_meta( $post_id, '_p_event_end', strtotime( $event->endDateTime ) );
		update_post_meta( $post_id, '_p_event_website', '' );
		update_post_meta( $post_id, '_p_event_url_permalink', $event->permaLinkUrl );
		update_post_meta( $post_id, '_p_event_url_action', $event->eventActionUrl );
		update_post_meta( $post_id, '_p_event_url_signup', $event->signUpUrl );

		// loop through the custom fields from 25live
		foreach ( $event->customFields as $event_cf ) {

			// store whether the event is open to the public
			if ( $event_cf->fieldID == 20451 ) update_post_meta( $post_id, '_p_event_open', filter_var( $event_cf->value, FILTER_VALIDATE_BOOLEAN ) );

			// store the organization
			if ( $event_cf->fieldID == 17192 ) update_post_meta( $post_id, '_p_event_organization', $event_cf->value );

			// store the organization
			if ( $event_cf->fieldID == 17289 ) {

				// split out multiple categories by comma
				$event_cats = explode( ',', $event_cf->value );

				// loop through the categories
				foreach ( $event_cats as $event_cat ) {

					$tag_name = str_replace( 'Audience - ', '', $event_cat );

					// check if our term exists.
					$cat_info = term_exists( $tag_name, 'event_cat' );

					// if the term exists
					if ( $cat_info ) {

						// add our new post to that category
						if ( wp_set_post_terms( $post_id, $cat_info['term_id'], 'event_cat', 1 ) ) {
							echo "Added event to category: " . $tag_name . "\n";
						}

					} else {

						// create the category (returns either new category ID or old one)
						$cat_info = wp_insert_term( $tag_name, 'event_cat' );

						// if that worked
						if ( $cat_info ) {
							echo "Added event category: " . $tag_name . "\n";
						}

						// add our new post to that category
						if ( wp_set_post_terms( $post_id, $cat_info['term_id'], 'event_cat', 1 ) ) {
							echo "Added event to category: " . $tag_name . "\n";
						}

					}

				}
			}

		}

	}
}

