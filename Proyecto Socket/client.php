<?php
$host = '127.0.0.1';
$port = 65432;

$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
socket_connect($socket, $host, $port);

echo "Introduce tu ID: ";
$cliente_id = trim(fgets(STDIN));
socket_write($socket, $cliente_id, strlen($cliente_id));

echo "Conectado al servidor. Puedes empezar a chatear.\n";

while (true) {
    $mensaje = trim(fgets(STDIN));
    socket_write($socket, $mensaje, strlen($mensaje));
}

socket_close($socket);
?>
