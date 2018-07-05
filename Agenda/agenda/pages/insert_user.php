<?php

/* Recebe os dados do formulário e verifica se estão corretos (trim) */

$nome_usuario = trim($_POST["user"]);
$email = trim($_POST["email"]);
$senha = trim($_POST["password"]);

/* Verifica se os dados estão corretos */

$erros = "";
if ( empty($nome_usuario) ){
    $erros .= "Campo 'Nome do Usuário' está vazio.<br>";
}
if ( empty($email) ){
    $erros .= "Campo 'E-mail do Usuário' está vazio.<br>";
}
if ( empty($senha) ){
    $erros .= "Campo 'Senha' está vazio.<br>";
}
if ( !empty($erros) ){
    echo "
        <script>
            alert($erros)
        </scritp>
        <html>
            <head>
                <META http-equiv=\"refresh\" content=\"0;URL=http://localhost:8088/agenda/pages/register.php\">
            </head>
        </html>
    ";
}

/* Parametriza a conexão com o banco de dados */

$host = "localhost:3306";
$user = "root";
$password = "";
$database = "agenda";

/* Faz a conexão com o servidor */
$con = mysqli_connect($host, $user, $password);

/* Verifica se ocorreu erro de conexão */
if (!$con){
    /* Se sim, então encerra o programa com uma mensagem de erro */
    die("Erro de conexão com o servidor do BD");
}

/* Determina qual banco de dados que será utilizado */
$db = mysqli_select_db($con, $database);

/* Verifica se ocorreu erro na seleção */
if(!$db){
    /* Se sim, então encessa o programa com uma mensagem de erro */
    die("Erro ao selecionar o banco de dados.");
}

/* Cria a sentença SQL para inserir o usuário */
$sql = "insert into tbl_usuarios (nome_usuario, senha) values (\"$nome_usuario\", \"$senha\")";

/* Envia o insert para o banco de dados */
$result = mysqli_query ($con, $sql);

?>

<html>
    <head>
        <META http-equiv="refresh" content="1;URL=http://localhost:8088/agenda/pages/login.php">
    </head>
</html>