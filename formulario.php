<?php
if (isset($_POST['submit'])) {
    include_once('buscar_dados.php');


    $billing_email = $_POST['billing_email'];
    $billing_first_name = $_POST['billing_first_name'];
    $billing_phone = $_POST['billing_phone'];

   
    $result = mysqli_query($conexao, "INSERT INTO usuarios(email, nome, telefone) VALUES ('$billing_email', '$billing_first_name', '$billing_phone')");

    if ($result) {
        echo "Dados inseridos com sucesso.";
    } else {
        echo "Erro ao inserir dados: " . mysqli_error($conexao);
    }
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário com Autocompletar</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>


<body>
    <form action="formulario.php" method="POST">
        <input type="email" class="input-text" name="email" id="billing_email" placeholder="E-mail" required>
        <input type="text" class="input-text" name="nome" id="billing_first_name" placeholder="Nome" required>
        <input type="tel" class="input-text" name="telefone" id="billing_phone" placeholder="Telefone" required>
        <input type="submit" name="submit" id="submit">
    </form>



    <script>
$(document).ready(function() {
    $("#billing_email").keyup(function() {
        var emailDigitado = $(this).val();

        $.ajax({
            type: "POST",
            url: "buscar_dados.php", // Nome do seu arquivo PHP para buscar dados no banco
            data: {
                email: emailDigitado
            },
            success: function(data) {
                var dados = JSON.parse(data);
                $("#billing_first_name").val(dados.nome); // AQUI NO DADOS.NOME VOCÊ COLOCA O NOME DA SUA VARIÁVEL NO BANCO DE DADOS, EXEMPLO: DADOS.NAME, DADOS.NOMES, SE NÃO FOR COM A SUA VARIÁVEL NÃO VAI FUNCIONAR
                $("#billing_phone").val(dados.telefone); // MESMA COISA AQUI
            }
        });
    });

    $("#billing_phone").keyup(function() {
        var telefoneDigitado = $(this).val();

        $.ajax({
            type: "POST",
            url: "buscar_dados.php", // Nome do seu arquivo PHP para buscar dados no banco
            data: {
                telefone: telefoneDigitado
            },
            success: function(data) {
                var dados = JSON.parse(data);
                $("#billing_first_name").val(dados.nome); // AQUI NO DADOS.NOME VOCÊ COLOCA O NOME DA SUA VARIÁVEL NO BANCO DE DADOS, EXEMPLO: DADOS.NAME, DADOS.NOMES, SE NÃO FOR COM A SUA VARIÁVEL NÃO VAI FUNCIONAR
                $("#billing_email").val(dados.email);
            }
        });
    });
});
</script>


</body>

</html>