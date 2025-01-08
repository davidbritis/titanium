<?php

// Exibe erros para depuração (desativar em produção)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Carrega o autoloader do Composer
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Processa o formulário apenas se for enviado via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Coleta e sanitiza os dados do formulário
    $nome = htmlspecialchars($_POST['nome'] ?? '');
    $email = htmlspecialchars($_POST['email'] ?? '');
    $cpf = htmlspecialchars($_POST['cpf'] ?? '');
    $cep = htmlspecialchars($_POST['cep'] ?? '');
    $rua = htmlspecialchars($_POST['rua'] ?? '');
    $numero = htmlspecialchars($_POST['numero'] ?? '');
    $complemento = htmlspecialchars($_POST['complemento'] ?? '');
    $cidade = htmlspecialchars($_POST['cidade'] ?? '');
    $estado = htmlspecialchars($_POST['estado'] ?? '');
    $pais = htmlspecialchars($_POST['pais'] ?? '');
    $contas = htmlspecialchars(implode(', ', $_POST['contas'] ?? []));
    $nelogica = htmlspecialchars($_POST['nelogica'] ?? '');

    // Valida o e-mail
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "E-mail inválido!";
        exit();
    }

    // Valida campos obrigatórios
    if (empty($nome) || empty($email) || empty($cpf)) {
        echo "Campos obrigatórios não preenchidos!";
        exit();
    }

    // Configuração do PHPMailer
    $mail = new PHPMailer();

    // Ativa o debug (útil para depuração)
    $mail->SMTPDebug = 2; // Nível de debug: 0 (off), 1 (mensagens), 2 (detalhado)
    $mail->Debugoutput = 'html';

    // Configurações do servidor SMTP
    $mail->isSMTP();
    $mail->Host = 'smtp-mail.outlook.com';  // Servidor SMTP
    $mail->SMTPAuth = true;
    $mail->Username = 'davidbritis@hotmail.com'; // Seu e-mail
    $mail->Password = '#Forca147369';  // Sua senha (use variáveis de ambiente em produção)
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    // Configura remetente e destinatário
    $mail->setFrom('davidbritis@hotmail.com', 'David Britis');
    $mail->addAddress('davidbritis@gmail.com', 'David Britis');

    // Configura o corpo do e-mail
    $mail->isHTML(true);
    $mail->Subject = 'Novo Formulário de Inscrição';
    $mail->Body = "
        <h3>Dados do Cliente</h3>
        <p><strong>Nome:</strong> $nome</p>
        <p><strong>E-mail:</strong> $email</p>
        <p><strong>CPF:</strong> $cpf</p>
        <p><strong>CEP:</strong> $cep</p>
        <p><strong>Rua:</strong> $rua</p>
        <p><strong>Número:</strong> $numero</p>
        <p><strong>Complemento:</strong> $complemento</p>
        <p><strong>Cidade:</strong> $cidade</p>
        <p><strong>Estado:</strong> $estado</p>
        <p><strong>País:</strong> $pais</p>
        <p><strong>Contas Escolhidas:</strong> $contas</p>
        <p><strong>Possui conta na Nelogica?:</strong> $nelogica</p>
    ";
    $mail->AltBody = strip_tags($mail->Body);

    // Tenta enviar o e-mail
    if ($mail->send()) {
        // Redireciona para o gateway de pagamento após o envio
        header("Location: https://gatewaypagamento.com/checkout?total=150");
        exit();
    } else {
        echo "Erro ao enviar o formulário. Erro: " . $mail->ErrorInfo;
    }
} else {
    echo "Formulário não enviado corretamente.";
}
