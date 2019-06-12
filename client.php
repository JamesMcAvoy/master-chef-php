<?php

/**
 * Client testing
 */

if (!($sock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP))) {
     $errorcode = socket_last_error();
     $errormsg = socket_strerror($errorcode);
     die("Couldn't create socket: [{$errorcode}] {$errormsg} \n");
}
echo "Socket created";
if (!socket_connect($sock, '127.0.0.1', 80)) {
    $errorcode = socket_last_error();
    $errormsg = socket_strerror($errorcode);
    die("Could not connect: [{$errorcode}] {$errormsg} \n");
}
echo "Connection established \n";
$msg = "Hello";
//Send the message to the server
if (!socket_send($sock, $msg, strlen($msg), 0)) {
    $errorcode = socket_last_error();
    $errormsg = socket_strerror($errorcode);
    die("Could not send data: [{$errorcode}] {$errormsg} \n");
}
echo "Message send successfully \n";
//Now receive reply from server
if (socket_recv($sock, $buf, 2045, MSG_WAITALL) === FALSE) {
    $errorcode = socket_last_error();
    $errormsg = socket_strerror($errorcode);
    die("Could not receive data: [{$errorcode}] {$errormsg} \n");
}
//print the received message
$visual = $buf;
socket_close($sock);
