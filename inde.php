
<?php
// /* Source File URL */
// $remote_file_url = 'http://192.168.1.101/karuppaiya.php.txt';

// /* New file name and path for this file */
// $local_file = 'login.php';

// /* Copy the file from source url to server */
// $copy = copy( $remote_file_url,$local_file );

// /* Add notice for success/failure */
// if( !$copy ) {
    // echo "Doh! failed to copy $local_file...\n";
// }
// else{
    // echo "WOOT! success to copy $local_file...\n";
// }

?>

<?php
$remote_file = 'share/files.php';

/* FTP Account (Remote Server) */
$ftp_host = '192.168.1.101'; /* host */
$ftp_user_name = 'karuppaiya'; /* username */
$ftp_user_pass = 'karuppaiya'; /* password */


/* File and path to send to remote FTP server */
$local_file = 'login.php';

/* Connect using basic FTP */
$connect_it = ftp_connect( $ftp_host );

/* Login to FTP */
$login_result = ftp_login( $connect_it, $ftp_user_name, $ftp_user_pass );

/* Send $local_file to FTP */
if ( ftp_put( $connect_it, $remote_file, $local_file, FTP_BINARY ) ) {
    echo "WOOT! Successfully transfer $local_file\n";
}
else {
    echo "Doh! There was a problem\n";
}

/* Close the connection */
ftp_close( $connect_it );

?>