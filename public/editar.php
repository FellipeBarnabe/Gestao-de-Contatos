<?php
require __DIR__ . '/../config/database.php';
require __DIR__ . '/../includes/funcoes.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) {
    header('Location: index.php?status=nao_encontrado');
    exit;
}

$stmt = $pdo->prepare('SELECT nome, email, telefone, endereco FROM contatos WHERE id = :id');
$stmt->execute(['id' => $id]);
$contato = $stmt->fetch();

if (!$contato) {
    header('Location: index.php?status=nao_encontrado');
    exit;
}

$erros = [];
$dados = $contato;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dados = lerDadosContato($_POST);
    $erros = validarContato($dados);

    if (empty($erros)) {
        $stmt = $pdo->prepare(
            'UPDATE contatos
                SET nome = :nome, email = :email, telefone = :telefone, endereco = :endereco
              WHERE id = :id'
        );

        $stmt->execute(array_merge($dados, ['id' => $id]));

        header('Location: index.php?status=atualizado');
        exit;
    }
}

$titulo = 'Editar contato';
require __DIR__ . '/../includes/header.php';
?>

<div class="pagina-topo">
    <div>
        <h2>Editar contato</h2>
        <p>Altere os dados e salve.</p>
    </div>
</div>

<?php if (!empty($erros)): ?>
    <div class="alerta alerta--erro" role="alert">
        <strong>Corrija os campos abaixo:</strong>
        <ul>
            <?php foreach ($erros as $erro): ?>
                <li><?= e($erro) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<div class="card card--padding">
    <form method="post" action="editar.php?id=<?= $id ?>">
        <div class="grade">

            <div class="campo">
                <label for="nome">Nome</label>
                <input type="text" id="nome" name="nome" maxlength="100" required
                       value="<?= e($dados['nome']) ?>">
            </div>
            <div class="campo">
                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" maxlength="150" required
                       value="<?= e($dados['email']) ?>">
            </div>
            <div class="campo">
                <label for="telefone">Telefone</label>
                <input type="text" id="telefone" name="telefone" maxlength="20" required
                       placeholder="(00) 00000-0000"
                       value="<?= e($dados['telefone']) ?>">
            </div>
            <div class="campo campo--cheio">
                <label for="endereco">Endereço</label>
                <input type="text" id="endereco" name="endereco" maxlength="255" required
                       value="<?= e($dados['endereco']) ?>">
            </div>
        </div>

        <div class="form-acoes">
            <button type="submit" class="btn btn--primario">Salvar alterações</button>
            <a href="index.php" class="btn btn--secundario">Cancelar</a>
        </div>
    </form>
</div>

<script src="js/mascara.js"></script>


<?php
require __DIR__ . '/../includes/footer.php';