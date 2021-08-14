<?php


// turn on errors so we can troubleshoot
ini_set( 'display_errors', false );
// ini_set('error_reporting', E_ALL ^ E_NOTICE );


// load wordpress so we have access to the wp-config definitions (which hold the credentials for the employee database)
include( '../../../../wp-load.php' );


// connection info
$server = _IS_SERVER;
$user = _IS_USER;
$pass = _IS_PASS;
$db = _IS_DB;  


// establish database connection
$dbhandle = odbc_connect("Driver=ODBC Driver 17 for SQL Server;Server=$server;Database=$db;", $user, $pass)
    or die("Could not connect to $server");

// the query
$query = "SELECT NAME, POSITION, EXT, EMAIL, PHONE1, PERSONAL_PRONOUN ";
$query .= "FROM X_WEB_DIRECTORY_AZ ";
$query .= "WHERE LOWER(POSITION) NOT LIKE LOWER('%emeritus%') AND LOWER(POSITION) NOT LIKE LOWER('%emerita%') ";
$query .= "ORDER BY NAME;";


// begin the results array
$results_final = array();


// execute the query
$result = odbc_exec( $dbhandle, $query );

// begin the directory table string
$directory_table = '<table cellpadding=0 cellspacing=0 border=0 class="employee-directory">';

// begin looping thru the results
while ( $row = odbc_fetch_array( $result ) ) {

    // store each record in the final results array.
    $results_final[] = $row;

    print_r( $row );
    // $directory_table .= '<tr><td>' . $row['NAME'] . "</td><td>" . $position . "</td><td nowrap=\"nowrap\">" . $office . '<br />' . $phone1 . $phone2 . "<br /><a href=\"mailto:" . $email . "\">" . $email . "</a></td></tr>");

}

$directory_table .= "</table>";


// dump the results
file_put_contents( '../../../uploads/directory/directory.json', json_encode( $results_final ) );

