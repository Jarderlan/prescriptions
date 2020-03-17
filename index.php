<?php
  
    #Incluindo o arquivo de rotas 
    include_once 'model/config.php';

    # Incluindo o arquivo de dicionario
    include_once 'model/dictionary.php';

    # Incluindo o arquivo de validacoes
    include_once 'controller/validate.php'; 

    # Classe de modelo do Usuário
    include_once 'model/class/User.class.php';


    # inicia a sessao
    session_start();

    //testa se ja existe usuario logado
    if(isset($_SESSION[md5('us_inventory')])){      
        //recupera os dados do usuário
        $user = $_SESSION[md5('us_inventory')];

        header("location: ".$user->user_profile.".php?success=login_ok");
    }

?>

<!DOCTYPE html>
<html lang="pt-br">
<meta charset="UTF-8"/>
  <title> Santana Prescriptions </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    

<head>

  <!-- Link do css do Bootstrap -->
  <link rel="stylesheet" type="text/css" href="view/assets/bootstrap/css/bootstrap.min.css">

  <!-- Link do css do Font Awesome -->
  <link rel="stylesheet" type="text/css" href="view/assets/font-awesome/css/font-awesome.min.css">

  <!-- Script do Jquery -->
  <script type="text/javascript" src="view/assets/bootstrap/js/jquery.js">
  </script>

  <!-- JavaScript do BootStrap -->
  <script type="text/javascript" src="view/assets/bootstrap/js/bootstrap.min.js">
  </script>

  <!-- Link do css DataTable-->
    <link rel="stylesheet" type="text/css" href="view/assets/external_js/data-tables/data_tables.min.js">

    <!-- script do mask do jquery -->
    <script type="text/javascript" src="view/assets/external_js/jquery-mask/jquery.mask.js"></script>

</head>
<body style="background-color:#D3D3D3">
<br><br><br><br>
    <div class="container col-md-4 col-md-offset-4">
      <?php validate_message(); ?>
      <form class="form-signin" action="controller/login.php" method="POST">
        <div class="panel panel-primary">
          <div class="panel-heading">
            <h2 class="form-signin-heading"><i class="fa fa-user-md"></i> Login</h2>
          </div>
        <hr>
        <div class="panel-body">
          <label for="inputEmail" class="sr-only">Seu Email</label>
          <input type="email" id="inputEmail" class="form-control" placeholder="Seu email" required autofocus name="email"><br>
          <label for="inputPassword" class="sr-only">Sua Senha</label>
          <input type="password" id="inputPassword" class="form-control" placeholder="Senha ou Palavra Passe" required name="password"><br>
          <div class="checkbox">
            <label>
              <input type="checkbox" value="remember-me"> Lembrar-me
            </label>
          </div>
          <button class="btn btn-lg btn-primary btn-block" type="submit">Acesso</button>
        </div>
      </div>
      </form>

    </div> <!-- /container -->


</body>
</html>