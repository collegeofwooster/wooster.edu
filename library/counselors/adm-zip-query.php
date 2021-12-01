<?php 

// ini_set('display_errors', true);
// ini_set('error_reporting', E_ALL ^ E_NOTICE );

// include core wp functionality
include( "../../../../../wp-load.php" );

$server = _IS_SERVER;
$user = _IS_USER;
$pass = _IS_PASS;
$db = _IS_DB;
$zipsearch = preg_replace( '/[^A-Za-z0-9\-]/', '', $_REQUEST['zip'] );

// a quick dump of zipcode to make sure we're getting that parameter effectively
// print $zipsearch; die;

// connect
$dbhandle = odbc_connect( "Driver={ODBC Driver 17 for SQL Server};SERVER=$server;DATABASE=$db;PORT=1433", $user, $pass )
	or die( "Could not connect to $server" );


// query
$query = "SELECT DISTINCT zip, username, staff_name, geomarket FROM x_adm_staff_assign_zip WHERE zip = '$zipsearch';";


// execute
$result = odbc_exec( $dbhandle, $query );


// if we have results
$return_obj = array();

if ( odbc_num_rows( $result ) > 0 ) {
	$return_obj[] = odbc_fetch_object( $result );
}

// print the object as a json string
print json_encode( $return_obj );


// close the connection
odbc_free_result( $result );
odbc_close( $dbhandle );

