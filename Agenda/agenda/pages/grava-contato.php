<?php

// Recebe os dados do formulário
$nome_contato    = $_POST["nome_contato"];
$endereco        = $_POST["endereco"];
$nro_endereco    = $_POST["nro_endereco"];
$complemento     = $_POST["complemento"];
$bairro          = $_POST["bairro"];
$cidade_id       = $_POST["cidade_id"];
$cep             = $_POST["cep"];


// Verifica se os dados estão corretos
$nome_contato = utf8_decode(trim($nome_contato));
$endereco = utf8_decode(trim($endereco));
$nro_endereco = utf8_decode(trim($nro_endereco));
$bairro = utf8_decode(trim($bairro));
$cep = utf8_decode(trim($cep));

$erros = "";
if (empty($nome_contato)) {
    $erros .= "Campo nome do contato está vazio. ";
}

if (empty($endereco)) {
    $erros .= "Campo endereço do contato está vazio. ";
}

if (empty($nro_endereco)) {
    $erros .= "Campo numero de endereço está vazio. ";
}

if (empty($bairro)) {
    $erros .= "Campo Bairro do Contato está vazio. ";
}

if (empty($cep)) {
    $erros .= "Campo cep do contato está vazio. ";
}

if (!empty($erros)) {
    echo "
        <html>
            <head>
                <META http-equiv=\"refresh\" content=\"5;URL=http://localhost:80/agenda_novo_backup/pages/cad-contato.php\">
            </head>
            <body onload='alert($erros);'></body>
        </html>
    ";
} else {
    // Parametriza a conexão com o banco de dados
    $host     = "localhost:3306";
    $user     = "root";
    $password = "";
    $database = "agenda";

    // Faz a conexão com o servidor MySQL
    $con = mysqli_connect($host, $user, $password);

    // Verifica se ocorreu erro de conexão
    if (!$con) {
        // Se sim, então encerra o programa com uma mensagem de erro
        die("Erro de conexão com o servidor do BD");
    }

    // Determina qual banco de dados que será utilizado
    $db = mysqli_select_db($con, $database);

    // Verifica se ocorreu erro na seleção
    if (!$db) {
        // Se sim, então encerra o programa com uma mensagem de erro
        die("Erro ao selecionar o banco de dados.");
    }

    // Cria a sentença SQL para inserir o contato
    $sql = "insert into tbl_contatos (nome_contato, endereco, nro_endereco, complemento, bairro, cep, cidade_id) 
    values(\"$nome_contato\", \"$endereco\",\"$nro_endereco\",\"$complemento\",\"$bairro\",\"$cep\", \"$cidade_id\" )";

    // Envia o insert para o banco de dados
    $result = mysqli_query($con, $sql);

    echo "
    <html>
        <head>
            <META http-equiv=\"refresh\" content=\"1;URL=http://localhost:8088/pages/cad-contato.php\">
        </head>
    </html>";
}
?>