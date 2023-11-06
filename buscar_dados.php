<?php
// Arquivo "buscar_dados.php"

// Conexão com o banco de dados (lembre-se de incluir suas informações de conexão)
$dbHost = 'LocalHost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'form';

$conexao = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

if ($conexao->connect_errno) {
    echo "Erro na conexão com o banco de dados: " . $conexao->connect_error;
    exit();
}


if (isset($_POST['email'])) {
    $email = $_POST['email'];


    $query = "SELECT nome, telefone FROM usuarios WHERE email = '$email'";
    $result = mysqli_query($conexao, $query);

    if ($result) {
      
        $row = mysqli_fetch_assoc($result);

        $dados = array(
            'nome' => $row['nome'],
            'telefone' => $row['telefone']
        );

        echo json_encode($dados);
    } else {
        echo "Erro na consulta: " . mysqli_error($conexao);
    }

  
}

if (isset($_POST['telefone'])) {
    $telefone = $_POST['telefone']; 

   
    $query = "SELECT email, nome FROM usuarios WHERE telefone = '$telefone'";
    $result = mysqli_query($conexao, $query);

    if ($result) {
      
        $row = mysqli_fetch_assoc($result);

        $dados = array(
            'nome' => $row['nome'],
            'email' => $row['email']
        );

        echo json_encode($dados);
    } else {
        echo "Erro na consulta: " . mysqli_error($conexao);
    }

    $conexao->close();
}

?>