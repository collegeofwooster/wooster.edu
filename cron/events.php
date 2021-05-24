<?php


// include wp core.
include( '../../../../wp-load.php' );


// pull events feed
$events = file_get_contents( 'https://25livepub.collegenet.com/calendars/college-of-wooster-template-all-campus-events-2621.json' );


// dump for testing
print_r( $events );

