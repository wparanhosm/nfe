<!DOCTYPE html>
<html lang="en" style="display:flex; align-content:centers">
<?php $message = isset($mensagem) ? $mensagem : "";?>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Login</title>
  <!-- Bootstrap core CSS-->
  <link href="<?php echo base_url();?>plugins/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="<?php echo base_url();?>plugins/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="<?php echo base_url();?>plugins/css/sb-admin.css" rel="stylesheet">
</head>

<body class="bg-dark" style="height: 400; width: 100%; align-self:center">
  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Login</div>
      <div class="card-body">
        <form action="<?php echo base_url()?>/index.php/ControllerLogin/recebeLogin" method="post">
          <div class="form-group">
            <label for="usuario">Usuário</label>
            <input class="form-control" id="usuario" type="text" name="txt_user" placeholder="Insira o nome do Usuário">
          </div>
          <div class="form-group">
            <label for="senha">Senha</label>
            <input class="form-control" id="senha" type="password" name="txt_senha" placeholder="Digite a senha">
          </div>
          <div class="form-group">
            <div class="form-check">
              <label class="form-check-label">
                <input class="form-check-input" type="checkbox" name="lembrar_senha">Lembrar senha</label>
            </div>
          </div>
          <label for="enviar" class="btn btn-primary btn-block">Entrar</label>
          <input type="submit" id="enviar" style="display:none">
        </form>
          <center style="color:red; font-weight: bolder;"><?php echo $message;?></center>
      </div>
    </div>
  </div>
  <!-- Bootstrap core JavaScript-->
  <script src="<?php echo base_url();?>plugins/vendor/jquery/jquery.min.js"></script>
  <script src="<?php echo base_url();?>plugins/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="<?php echo base_url();?>plugins/vendor/jquery-easing/jquery.easing.min.js"></script>

</body>

</html>
