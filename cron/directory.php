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

// add a header row to the directory table.
$directory_table .= '<thead><tr><th>Name</th><th>Title</th><th>Office</th><th>Phone</th><th>Email</th></tr></thead>';

// begin looping thru the results
while ( $row = odbc_fetch_array( $result ) ) {

    // separate the position from the office
    $temp = explode( ' (', $row['POSITION'] );

    // put the position back into the original result array.
    $row['POSITION'] = $temp[0];

    // strip the end parenthesis from the office and store it back into the original result array values
    $row['OFFICE'] = str_replace( ')', '', $temp[1] );

    if($username == 'sbolton'){
        $row['EMAIL'] = 'president@wooster.edu';
    }

    // store each record in the final results array.
    $results_final[] = $row;

    // print_r( $row );
    $directory_table .= '<tr><td>' . $row['NAME'] . "</td><td>" . $row['POSITION'] . "</td><td nowrap=\"nowrap\">" . $row['OFFICE'] . '<br />' . $row['PHONE1'] . ' ext #' . $ext['EXT'] . "<br /><a href=\"mailto:" . $row['EMAIL'] . "\">" . $row['EMAIL'] . "</a></td></tr>";

}

$directory_table .= "</table>";


// store the json results in its own file in the uploads folder.
file_put_contents( '../../../uploads/directory/directory.json', json_encode( $results_final ) );


// store the directory table (html) in its own file so we can pull it in using a shortcode in WP.
file_put_contents( '../../../uploads/directory/directory.html', $directory_table );

