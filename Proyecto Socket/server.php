<?php
$host = '127.0.0.1';
$port = 65432;

$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
socket_bind($socket, $host, $port);
socket_listen($socket);

echo "Servidor en ejecución en {$host}:{$port}\n";

while (true) {
    $nuevo_cliente = socket_accept($socket);
    $cliente_id = socket_read($nuevo_cliente, 1024);
    echo "Nuevo cliente conectado: {$cliente_id}\n";

    $pid = pcntl_fork();
    if ($pid == -1) {
        die('Error al crear el proceso hijo.');
    } elseif ($pid) {
        // Proceso padre
        socket_close($nuevo_cliente);
    } else {
        // Proceso hijo
        while (true) {
            $mensaje = socket_read($nuevo_cliente, 1024);
            // Aquí puedes agregar la lógica para reenviar el mensaje a otros clientes
        }
        exit();
    }
}

socket_close($socket);
?>
