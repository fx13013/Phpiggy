<?php

use App\Config\Paths;
use Dotenv\Dotenv;
use Framework\Database;

include __DIR__ . "/vendor/autoload.php";
include __DIR__ . "/src/Framework/Database.php";

$dotenv = Dotenv::createImmutable(Paths::ROOT);
$dotenv->load();

$db = new Database($_ENV['DB_DRIVER'], [
    'host' => $_ENV['DB_HOST'],
    'port' => $_ENV['DB_PORT'],
    'dbname' => $_ENV['DB_NAME']
], $_ENV['DB_USER'], $_ENV['DB_PASS']);

$sqlFile = file_get_contents("./database.sql");

$db->query($sqlFile);

// Example de transaction
// try {
//     $db->connection->beginTransaction();

//     $db->connection->query("INSERT INTO products VALUES(51,'Sneakers')");

//     $search = "Hats";
//     $query = "SELECT * FROM products WHERE name=:name";

//     $stmt = $db->connection->prepare($query);
//     $stmt->bindValue('name', 'Sneakers', PDO::PARAM_STR);
//     $stmt->execute();

//     $products = $stmt->fetchAll(PDO::FETCH_OBJ);

//     var_dump($products);

//     $db->connection->commit();
// } catch (Exception $e) {
//     if ($db->connection->inTransaction()) {
//         $db->connection->rollBack();
//     }
//     echo '💀 Transaction failed!';
// }

// echo "🌟 Connected to database 🖥️";
