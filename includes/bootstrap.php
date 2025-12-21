<?php
session_start();

require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$isLoggedIn = !empty($_SESSION['user']);
$isAdmin = $isLoggedIn && ($_SESSION['user']['role'] === 'admin');