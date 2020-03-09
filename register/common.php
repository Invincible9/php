<?php

session_start();
spl_autoload_register();

$template = new \Core\Template();
$dataBinder = new \Core\DataBinder();
$dbInfo = parse_ini_file("Config/db.ini");
$pdo = new PDO($dbInfo['dsn'], $dbInfo['user'], $dbInfo['pass']);
$db = new \Database\PDODatabase($pdo);
$userRepository = new \App\Repository\UserRepository($db, $dataBinder);
$encryptionService = new \App\Service\Encryption\ArgonEncryptionService();
$userService = new \App\Service\UserService($userRepository, $encryptionService);

$physicalEntityRepository = new \App\Repository\PhysicalEntityRepository($db, $dataBinder);
$physicalEntityService = new \App\Service\PhysicalEntityService($physicalEntityRepository);

$legalEntityRepository = new \App\Repository\LegalEntityRepository($db, $dataBinder);
$legalEntityService = new \App\Service\LegalEntityService($legalEntityRepository);

$typeEntityRepository = new \App\Repository\TypeEntityRepository($db, $dataBinder);
$typeEntityService = new \App\Service\TypeEntityService($typeEntityRepository);

$userHttpHandler = new \App\Http\UserHttpHandler($template, $dataBinder,
        $userService, $physicalEntityService, $legalEntityService, $typeEntityService);
