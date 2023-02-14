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

$ip = readline("Saisissez une adresse IP: ");
$protocol = readLine("Protocole (TCP ou UDP): ");
$modbus = new ModbusMaster($ip, $protocol);
system('clear');

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
            }
            try
            {
                $modbus->writeMultipleCoils($unitID, $reference, $data);
            }
            catch(Exception $e)
            {
                echo $modbus;
                echo $e;
                exit;
            }
        break;
        default:
            echo "Choix invalide. Veuillez choisir une option entre 0 et 4.\n";
        break;
    }
}
?>
