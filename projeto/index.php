<?php
session_start();
if (isset($_SESSION['idSession'])) {
  header("location:home.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="shortcut icon" href="assets/favicon-32x32.png" type="image/x-icon" />
  <link rel="stylesheet" href="css/index.css" />

  <meta name="theme-color" content="#000000">
  <link rel="manifest" href="manifest.json" />
  <script src="service-worker.js" defer></script>
  <title>IFrame</title>
</head>

<body>

  <div class="container-inicial">
    <div class="inicial-all-box">
      <div class="inicial-box">
        <div class="container-info">
          <div class="logo">
            <h1 class="title-logo">
              <img class="img-logo" src="assets/icos/logo_ico1.png" alt="IFrame logo" />IFrame
            </h1>
          </div>
          <div class="text-info">
            <p>
              O IFrame é uma rede social de compartilhamento de imagens baseada em
              Instagram e Fotolog para interação entre todos que frequentam
              IFRS Feliz.
            </p>
            <p>
              O projeto foi feito para o trabalho final de programação, por um grupo da turma do 3º de 2022
            </p>
            <p>
              Lembrando que o IFrame só pode ser acessado por dispositivos conectados à rede wi-fi do campus.
            </p>
            <p>
              Mantenha o respeito e o bom senso, todos podem conseguem ver a hora e o conteúdo das postagens.
            </p>
            <p>
              Em caso de problemas ou feedbacks, envie um email para o suporte: murilo.silva@aluno.feliz.ifrs.edu.br
            </p>
          </div>
        </div>

        <div class="container-funcional">
          <div class="ops-funcional">
            <div class="ops-div">
              <a href="login.php">Sign in</a>
            </div>
            <div class="ops-div">
              <a href="register.php">Create account</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>