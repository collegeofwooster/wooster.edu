<?php 

ini_set('display_errors', true);
ini_set('error_reporting', E_ALL ^ E_NOTICE );

// include core wp functionality
require('../../../../../wp-config.php');

$server = _IS_SERVER;
$user = _IS_USER;
$pass = _IS_PASS;
$db = _IS_DB;
$port = _IS_PORT;
$zipsearch = preg_replace('/[^A-Za-z0-9\-]/', '', $_REQUEST['zip']);


// connect
$dbhandle = odbc_connect( "Driver={ODBC Driver 17 for SQL Server};SERVER=$server;DATABASE=$db;PORT=$port", $user, $pass )
	or die( "Could not connect to $server" );


// query
$query = "SELECT username, staff_name, geomarket, zip ";
$query .= "FROM x_adm_staff_assign_zip ";
$query .= "WHERE zip = '$zipsearch' ";


// execute
$result = odbc_exec( $dbhandle, $query );


// odbc_result_all($result);
if ( odbc_num_rows( $result ) == 0 ) {
	echo( "error" );
	print odbc_error( $result );
	print odbc_errormsg( $result );
} else {
	while ( odbc_fetch_row( $result ) ) {
		$zip = odbc_result( $result, username );
		$url = "https://wooster.edu/bio/" . $zip;
		echo( $url );
	}
}


// close the connection
odbc_free_result( $result );
odbc_close( $dbhandle );

