# 📇 Gestão de Contatos

Aplicação web para gerenciar uma lista de contatos, feita com **PHP**, **MySQL** e **PDO**.
Permite cadastrar, listar, editar e excluir contatos, com validação no servidor, proteção
contra SQL Injection e XSS, e interface responsiva.

## Funcionalidades

- **Cadastrar** contato (nome, e-mail, telefone e endereço)
- **Listar** todos os contatos
- **Editar** os dados de um contato
- **Excluir** um contato, com confirmação
- Validação no servidor e mensagens de sucesso e erro
- Layout responsivo (a tabela vira cartões no celular) e máscara de telefone

## Tecnologias

PHP 8+ · MySQL 8 · PDO · HTML5 · CSS3 · JavaScript

## Requisitos

- PHP 8.0 ou superior, com a extensão `pdo_mysql`
- MySQL 5.7+ ou MariaDB 10.3+
- Um servidor local como **Laragon** (recomendado), XAMPP ou similar

## Como rodar localmente

### 1. Copie o projeto

Coloque a pasta `contatos` dentro da raiz do servidor:

- Laragon: `C:\laragon\www\`
- XAMPP: `C:\xampp\htdocs\`

Ou clone direto no local:

```bash
git clone https://github.com/FellipeBarnabe/Gestao-de-Contatos.git contatos
```

### 2. Crie o banco de dados

Inicie o **Apache** e o **MySQL** no seu servidor local e importe o script `database/schema.sql`
por uma das opções:

**a) Pelo HeidiSQL ou phpMyAdmin:** abra o programa, escolha a opção de importar ou carregar
arquivo SQL, selecione `database/schema.sql` e execute.

**b) Pelo terminal**, dentro da pasta do projeto:

```bash
mysql -u root -e "source database/schema.sql"
```

(Se o seu MySQL tiver senha, adicione `-p`.)

Opcionalmente, importe também `database/dados_exemplo.sql` para ter contatos de teste.

### 3. Configure a conexão

Abra `config/database.php` e confira os dados de acesso:

```php
$host = 'localhost';
$db   = 'gestao_contatos';
$user = 'root';
$pass = '';   // senha vazia é o padrão do Laragon e do XAMPP
```

### 4. Acesse no navegador

```
http://localhost/contatos/
```

Sem servidor Apache, também funciona com o servidor embutido do PHP:

```bash
php -S localhost:8000 -t public
```

e acesse `http://localhost:8000`.

## Estrutura do projeto

```
contatos/
├── config/
│   └── database.php      # conexão com o banco (PDO)
├── database/
│   ├── schema.sql        # criação do banco e da tabela
│   └── dados_exemplo.sql # dados de teste (opcional)
├── includes/
│   ├── funcoes.php       # funções: e(), lerDadosContato(), validarContato()
│   ├── header.php        # topo do HTML
│   └── footer.php        # rodapé do HTML
├── public/
│   ├── css/style.css
│   ├── js/mascara.js     # máscara de telefone
│   ├── index.php         # listagem
│   ├── criar.php         # cadastro
│   ├── editar.php        # edição
│   └── excluir.php       # exclusão
└── index.php             # redireciona para public/
```

## Decisões técnicas

- **PDO com prepared statements** em todas as consultas que recebem dados externos (previne SQL Injection)
- **Escape de saída** com `htmlspecialchars` na função `e()` (previne XSS)
- **Validação no servidor**, centralizada em uma função e no mesmo tamanho das colunas do banco
- **Post/Redirect/Get** após cadastrar, editar e excluir (evita reenvio de formulário)
- **Exclusão apenas via POST**, com confirmação no navegador
- Código organizado em pastas por responsabilidade, com cabeçalho e rodapé reaproveitados

## Possíveis melhorias

Paginação e busca, token CSRF, validação de e-mail duplicado, autenticação de usuários,
separação em camadas (MVC) e testes automatizados.
