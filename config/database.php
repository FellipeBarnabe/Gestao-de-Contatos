<?php
$host    = 'localhost';
$db      = 'gestao_contatos';
$user    = 'root';
$pass    = '';          // Laragon: senha vazia (so em ambiente local)
$charset = 'utf8mb4';

// DSN: "enderevco" da conexao
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // erros viram excecoes
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // linhas vem como array associativo
    PDO::ATTR_EMULATE_PREPARES   => false,                  // prepared statements reais
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    http_response_code(500);
    exit('Erro ao conectar ao banco de dados.');
}