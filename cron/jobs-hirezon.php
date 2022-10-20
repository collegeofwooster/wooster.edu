<?php


// include wp core.
include( '../../../../wp-load.php' );

// let's get $wpdb ready to use
global $wpdb;

// pull events feed
$jobs_raw = simplexml_load_file( 'https://www.interviewexchange.com/jobsrss.jsp?COMPANYID=548&showCompleteDetails=1', 'SimpleXMLElement', LIBXML_NOCDATA );

// encode as json
$jobs_json = json_encode( $jobs_raw );

// decode the json (because we hate php's xml parser lol)
$jobs = json_decode( $jobs_json );

// print_r( $jobs ); die;

// if we have jobs
if ( !empty( $jobs->channel->item ) ) {

	// start looping through them
	foreach ( $jobs->channel->item as $job ) {

		// uncomment to dump first result and die for testing (prevents a full loop through all records)
		// print_r( $job ); die;

		// if it's not a student job.
		if ( $job->category != 'Student' ) {

		    // get a previous post if it exists.
		    $previous_post = $wpdb->get_results( "SELECT * FROM `woo_postmeta` WHERE `meta_key`='_p_job_external_id' AND `meta_value`='" . $job->guid . "' LIMIT 1;" );

		    // set up an array of the post data
			$post_data = array(
				'post_author' => 1,
				'post_title' => $job->title,
				'post_content' => $job->description,
				'post_type' => 'job',
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
				add_post_meta( $post_id, '_p_job_external_id', $job->guid );

				// cli output
				echo "Added new job: " . $job->title . "\n";

			} else {

				// since the post exists already, set the id
				$post_id = $previous_post[0]->post_id;
				
				// also add that post ID to the $post_data array so we can use it to update the post
				$post_data['ID'] = $post_id;

				// update the post data from the original
				wp_update_post( $post_data );

				// cli output
				echo "Updated existing job: " . $job->title . "\n";

			}

			// if we're in a browser, add <pre> tags
			if ( !is_cli() ) print "</pre>";

			// set update some event details to postmeta (they'll be added if they don't exist)
			update_post_meta( $post_id, '_p_job_expires', date( 'Y-m-d', strtotime( $job->endDate ) ) );
			update_post_meta( $post_id, '_p_job_apply_email', 'info@interviewexchange.com' );
			update_post_meta( $post_id, '_p_job_apply_link', $job->link );

			// see if the term exists
			$cat_info = term_exists( $job->category, 'job_cat' );

			// if the term exists
			if ( $cat_info ) {

				// add our new post to that category
				if ( wp_set_post_terms( $post_id, $cat_info['term_id'], 'job_cat', 1 ) ) {
					echo "Added job to category: " . $job->category . "\n";
				}

			} else {

				// create the category (returns either new category ID or old one)
				$cat_info = wp_insert_term( $job->category, 'job_cat' );

				// if that worked
				if ( $cat_info ) {
					echo "Added job category: " . $job->category . "\n";
				}

				// add our new post to that category
				if ( wp_set_post_terms( $post_id, $cat_info['term_id'], 'job_cat', 1 ) ) {
					echo "Added job to category: " . $job->category . "\n";
				}

			}

		}

	}

}

