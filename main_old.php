<?php
require_once dirname(__FILE__) . '/lib/ModbusMaster.php';

function afficher_menu()
{
    echo "Menu:\n";
    echo "1. Read coils\n";
    echo "2. Read input discretes\n";
    echo "3. Read multiple registers\n";
    echo "4. Write multiple coils\n";
    echo "0. Quitter\n";
}

//FC1 - Read coils
//FC2 - Read input discretes
//FC3 - Read holding registers
//FC4 - Read holding input registers
//FC5 - Write single coil
//FC6 - Write single register
//FC15 - Write multiple coils
//FC16 - Write multiple registers
//FC23 - Read/Write multiple registers
$ip = readline("Saisissez une adresse IP: ");
$protocol = readLine("Protocole (TCP ou UDP): ");
$modbus = new ModbusMaster($ip, $protocol);
system('clear');

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
}
sleep(2000);
*/

do
{
    afficher_menu();
    $choix = readline("Choisissez une option: ");
    system('clear');
    switch ($choix)
    {
        case 1:
            echo "Option : Read Coils";
            $unitID = readline("Adresse automate (0): ");
            $reference = readline("Lire à partir du bit: ");
            $quantity = readline("Saisir quantité de bits: ");
            try
            {
                $recData = $modbus->readCoils($unitID, $reference, $quantity);
            }
            catch(Exception $e)
            {
                echo $modbus;
                echo $e;
                exit;
            }
            echo "</br>Status:</br>" . $modbus;
            echo "</br>Data:</br>";
            var_dump($recData);
            echo "</br>";
        break;
        case 2:
            echo "Option : Read Input Discretes";
            $unitID = readline("Adresse automate (0): ");
            $reference = readline("Lire à partir du bit: ");
            $quantity = readline("Saisir quantité de bits: ");
            try
            {
                $recData = $modbus->readInputDiscretes($unitID, $reference, $quantity);
            }
            catch(Exception $e)
            {
                echo $modbus;
                echo $e;
                exit;
            }
            echo "</br>Status:</br>" . $modbus;
            echo "</br>Data:</br>";
            var_dump($recData);
            echo "</br>";
        break;
        case 3:
            echo "Option : Read Multiple Registers";
            $unitID = readline("Adresse automate (0): ");
            $reference = readline("Lire à partir du bit: ");
            $quantity = readline("Saisir quantité de bits: ");
            try
            {
                $recData = $modbus->readMultipleRegisters($unitID, $reference, $quantity);
            }
            catch(Exception $e)
            {
                echo $modbus;
                echo $e;
                exit;
            }
            echo "</br>Status:</br>" . $modbus;
            echo "</br>Data:</br>";
            var_dump($recData);
            echo "</br>";
        break;
        case 4:
            echo "Option : Write Multiple Coils";
            $unitID = readline("Adresse automate (0): ");
            $reference = readline("Lire à partir du bit: ");
            $nb = readline();
            $data = [];

            if (is_numeric($nb)) {
                for ($i = 1; $i <= $nb; $i++) {
                $data[] = readline($i." : ");
                }
            try
            {
                $modbus->writeMultipleCoils($unitID, $reference, $data);
            }
            catch(Exception $e)
            {
                // Print error information if any
                echo $modbus;
                echo $e;
                exit;
            }}
        break;
        /*
        case 5:
            // code pour l'option 5
        break;
        case 6:
            // code pour l'option 6
        break;
        case 0:
            echo "Au revoir!\n";
        break;
        */
        default:
            echo "Choix invalide. Veuillez choisir une option entre 0 et 6.\n";
        break;
    
    }
}
?>
