<?php
// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Coletando os dados do formulário
    $nome = htmlspecialchars($_POST['nome']);
    $email = htmlspecialchars($_POST['email']);
    $telefone = htmlspecialchars($_POST['telefone']);
    $data_nascimento = htmlspecialchars($_POST['data_nascimento']);
    $idade = htmlspecialchars($_POST['idade']);
    $sexo = isset($_POST['sexo']) ? htmlspecialchars($_POST['sexo']) : 'Não especificado';
    $habilidades = isset($_POST['habilidades']) ? implode(", ", $_POST['habilidades']) : 'Nenhuma';
    $outras_habilidades = htmlspecialchars($_POST['outras_habilidades']);
    $endereco = htmlspecialchars($_POST['endereco']);
    $comentarios = htmlspecialchars($_POST['comentarios']);
    $data_registro = htmlspecialchars($_POST['data_registro']);

    // Verificando se um arquivo foi enviado
    if (isset($_FILES['arquivo']) && $_FILES['arquivo']['error'] == 0) {
        $arquivo_nome = $_FILES['arquivo']['name'];
        $arquivo_tmp = $_FILES['arquivo']['tmp_name'];
        $diretorio_destino = 'uploads/';  // Pasta onde o arquivo será salvo

        // Criando o diretório caso ele não exista
        if (!file_exists($diretorio_destino)) {
            mkdir($diretorio_destino, 0777, true);
        }

        // Movendo o arquivo para o diretório de uploads
        $arquivo_destino = $diretorio_destino . $arquivo_nome;
        move_uploaded_file($arquivo_tmp, $arquivo_destino);
    } else {
        $arquivo_nome = 'Nenhum arquivo enviado';
    }

    // Exibindo as informações recebidas
    echo "<h2>Dados Recebidos</h2>";
    echo "<p><strong>Nome:</strong> $nome</p>";
    echo "<p><strong>Email:</strong> $email</p>";
    echo "<p><strong>Telefone:</strong> $telefone</p>";
    echo "<p><strong>Data de Nascimento:</strong> $data_nascimento</p>";
    echo "<p><strong>Idade:</strong> $idade</p>";
    echo "<p><strong>Sexo:</strong> $sexo</p>";
    echo "<p><strong>Habilidades:</strong> $habilidades</p>";
    echo "<p><strong>Outras Habilidades:</strong> $outras_habilidades</p>";
    echo "<p><strong>Endereço:</strong> $endereco</p>";
    echo "<p><strong>Comentários:</strong> $comentarios</p>";
    echo "<p><strong>Data de Registro:</strong> $data_registro</p>";
    echo "<p><strong>Arquivo Enviado:</strong> $arquivo_nome</p>";
    
    // Caso o arquivo tenha sido enviado, exibe um link para ele
    if ($arquivo_nome != 'Nenhum arquivo enviado') {
        echo "<p><a href='$arquivo_destino' target='_blank'>Clique aqui para ver o arquivo enviado</a></p>";
    }
} else {
    echo "<p>Dados não recebidos. Por favor, envie o formulário corretamente.</p>";
}
?>