<?php
require __DIR__ . '/../config/database.php';
require __DIR__ . '/../includes/funcoes.php';

$mensagens = [
    'criado'         => ['sucesso', 'Contato cadastrado com sucesso!'],
    'atualizado'     => ['sucesso', 'Contato atualizado com sucesso!'],
    'excluido'       => ['sucesso', 'Contato excluído com sucesso!'],
    'nao_encontrado' => ['erro', 'Contato não encontrado.'],
];
$status = $_GET['status'] ?? '';

$stmt = $pdo->query('SELECT id, nome, email, telefone, endereco FROM contatos ORDER BY nome');
$contatos = $stmt->fetchAll();
$total = count($contatos);

$titulo = 'Contatos';
require __DIR__ . '/../includes/header.php';
?>

<div class="pagina-topo">
    <div>
        <h2>Contatos</h2>
        <p><?= $total ?> <?= $total === 1 ? 'contato cadastrado' : 'contatos cadastrados' ?></p>
    </div>
    <a href="criar.php" class="btn btn--primario">+ Novo contato</a>
</div>

<?php if (isset($mensagens[$status])): [$tipo, $texto] = $mensagens[$status]; ?>
    <div class="alerta alerta--<?= $tipo ?>" role="status"><?= e($texto) ?></div>
<?php endif; ?>


<div class="card">
    <?php if (empty($contatos)): ?>
        <div class="vazio">
            <p>Nenhum contato cadastrado ainda.</p>
            <a href="criar.php" class="btn btn--primario">Cadastrar o primeiro contato</a>
        </div>
    <?php else: ?>
        <table class="tabela">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Telefone</th>
                    <th>Endereço</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($contatos as $contato): ?>
                    <tr>
                        <td data-label="Nome"><?= e($contato['nome']) ?></td>
                        <td data-label="E-mail"><?= e($contato['email']) ?></td>
                        <td data-label="Telefone"><?= e($contato['telefone']) ?></td>
                        <td data-label="Endereço"><?= e($contato['endereco']) ?></td>
                        <td data-label="Ações">
                            <div class="acoes">
                                <a href="editar.php?id=<?= (int) $contato['id'] ?>"
                                   class="btn btn--secundario btn--pequeno">Editar</a>

                                <form method="post" action="excluir.php" class="form-inline"
                                      onsubmit="return confirm('Tem certeza que deseja excluir este contato?');">
                                    <input type="hidden" name="id" value="<?= (int) $contato['id'] ?>">

                                    <button type="submit" class="btn btn--perigo btn--pequeno">Excluir</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<?php
require __DIR__ . '/../includes/footer.php';