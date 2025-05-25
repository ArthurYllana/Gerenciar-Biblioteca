<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./styles/style.css">
    <link rel="stylesheet" type="text/css" href="./styles/home.css">
    <title>Página Inicial</title>
</head>
<body>
    <!-- Página inicial ... -->
     <div class="container">
        <h1>Bem-vindo!</h1>
        <h2>Sistema de Gestão de Livros</h2>
        <div class="card">
            <form>
                <label for="usuario">Usuário:</label><br>
                <input type="text" name="usuario" id="usuario"><br><br>

                <label for="senha">Senha:</label><br>
                <input type="password" name="senha" id="senha"><br><br>
            </form>
            <img class="icon" src="https://64.media.tumblr.com/c965e2a75b43822375b706f76b96806b/982075be0f94d66d-48/s500x750/73845aae39a30257034031259b2d2f08177b939c.pnj">
        </div>
        <a class="btn" id="entrar" href="./views/livro_index.php">Entrar</a>
    </div>
</body>
</html>