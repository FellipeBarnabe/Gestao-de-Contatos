<?php
require __DIR__ . '/../config/database.php';

// Só aceita POST. Se alguém abrir a URL direto no navegador (GET), volta para a lista.
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
if (!$id) {
    header('Location: index.php?status=nao_encontrado');
    exit;
}

$stmt = $pdo->prepare('DELETE FROM contatos WHERE id = :id');
$stmt->execute(['id' => $id]);

// rowCount() = quantas linhas foram apagadas
$status = $stmt->rowCount() > 0 ? 'excluido' : 'nao_encontrado';

header('Location: index.php?status=' . $status);
exit;