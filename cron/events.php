<?php


// include wp core.
include( '../../../../wp-load.php' );


// check if we have 25live web services credentials in wp-config
if ( !defined( '_25LWS_USER' ) || !defined( '_25LWS_PASS' ) ) {
	die( json_encode( array( 'error' => 'no credentials set in config' ) ) );
}

// print _25LWS_USER . ":" . _25LWS_PASS; die;


// https://webservices.collegenet.com/r25ws/wrd/wooster/run/events.xml?query_id=4027&start_dt=20210523&otransform=json.xsl
$ch = curl_init( 'https://webservices.collegenet.com/r25ws/wrd/wooster/run/events.xml?query_id=4027&start_dt=20210523&otransform=json.xsl' );

curl_setopt( $ch, CURLOPT_HTTPHEADER, array( 'Content-Type: application/xml' ) );
curl_setopt( $ch, CURLOPT_USERPWD, _25LWS_USER . ":" . _25LWS_PASS );
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, TRUE );
$return = curl_exec( $ch );
curl_close( $ch );


print_r( $return );

