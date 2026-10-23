<?php


function e(?string $texto): string
{
    return htmlspecialchars($texto ?? '', ENT_QUOTES, 'UTF-8');
}

function lerDadosContato(array $origem): array
{
    $dados = [];
    foreach (['nome', 'email', 'telefone', 'endereco'] as $campo) {
        $valor = $origem[$campo] ?? '';
        $dados[$campo] = is_string($valor) ? trim($valor) : '';
    }
    return $dados;
}

function validarContato(array $dados): array
{
    $erros = [];
    $rotulos = [
        'nome'     => 'o nome',
        'email'    => 'o e-mail',
        'telefone' => 'o telefone',
        'endereco' => 'o endereço',
    ];
    $limites = ['nome' => 100, 'email' => 150, 'telefone' => 20, 'endereco' => 255];

    foreach ($rotulos as $campo => $rotulo) {

        if ($dados[$campo] === '') {
            $erros[] = "Informe $rotulo.";
        } elseif (mb_strlen($dados[$campo]) > $limites[$campo]) {
            $erros[] = "Texto muito longo para $rotulo (máximo {$limites[$campo]} caracteres).";
        }
    }

    if ($dados['email'] !== '' && !filter_var($dados['email'], FILTER_VALIDATE_EMAIL)) {
        $erros[] = 'E-mail inválido.';
    }

    return $erros;
}