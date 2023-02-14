<?php
require_once dirname(__FILE__) . '/lib/ModbusMaster.php'; 

function afficher_menu() {
    echo "Menu:\n";
    echo "1. Option 1\n";
    echo "2. Option 2\n";
    echo "3. Option 3\n";
    echo "4. Option 4\n";
    echo "5. Option 5\n";
    echo "0. Quitter\n";
}

$ip = readline("Saisissez une adresse IP: ");
$protocol = readLine("Protocole (TCP ou UDP): ")
$modbus = new ModbusMaster($ip, $protocol);

/*
if ($this->socket_protocol == "TCP"){ 
    $this->sock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);      
} elseif ($this->socket_protocol == "UDP"){
    $this->sock = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);
} else {
    throw new Exception("Unknown socket protocol, should be 'TCP' or 'UDP'");
}
if (strlen($this->client)>0){
    $result = socket_bind($this->sock, $this->client, $this->client_port);
    if ($result === false) {
        throw new Exception("socket_bind() failed.</br>Reason: ($result)".
            socket_strerror(socket_last_error($this->sock)));
    } else {
        $this->status .= "Bound\n";
    }
}
// Connect the socket
$result = @socket_connect($this->sock, $this->host, $this->port);
if ($result === false) {
    throw new Exception("socket_connect() failed.</br>Reason: ($result)".
        socket_strerror(socket_last_error($this->sock)));
} else {
    $this->status .= "Connected\n";
    return true;        
}*/

do {
    afficher_menu();
    $choix = readline("Choisissez une option: ");
    switch ($choix) {
        case 1:
            
            break;
        case 2:
            // code pour l'option 2
            break;
        case 3:
            // code pour l'option 3
            break;
        case 4:
            // code pour l'option 4
            break;
        case 5:
            // code pour l'option 5
            break;
        case 0:
            echo "Au revoir!\n";
            break;
        default:
            echo "Choix invalide. Veuillez choisir une option entre 0 et 5.\n";
            break;
    }
} while ($choix != 0);

//FC1 - Read coils
//FC2 - Read input discretes
//FC3 - Read holding registers
//FC4 - Read holding input registers
//FC5 - Write single coil
//FC6 - Write single register
//FC15 - Write multiple coils
//FC16 - Write multiple registers
//FC23 - Read/Write multiple registers







try {
    $recData = $modbus->readMultipleRegisters(0, 12288, 5); 
}
catch (Exception $e) {
    // Print error information if any
    echo $modbus;
    echo $e;
    exit;
}
// Print data in string format
echo PhpType::bytes2string($recData); 
?>