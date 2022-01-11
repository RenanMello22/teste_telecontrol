<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>SYS Ordem</title>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

	<link rel="stylesheet" href="<?=base_url('public/')?>css/style.css">

	<!--REFERENCIA PARA O FAVICON -->
	<link rel="shortcut icon" href="<?=base_url('public/')?>img/favicon/favicon.ico" type="image/x-icon">
	<link rel="icon" href="<?=base_url('public/')?>img/favicon/favicon2.ico" type="image/x-icon">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript"></script>


</head>
<body>

	<div class="login-form">
		<form action="" onsubmit="return false">
			<div class="logo">
				<img src="<?=base_url('public/')?>img/logo.jpg" alt="Sys Ordem">
			</div>
			<h2 class="text-center">
				Entre no Sistema
			</h2>
			<div class="form-group">
				<input class="form-control" type="email" id="txtLogin" placeholder="Insira seu Email!" required>
			</div>

			<div class="form-group">
				<input class="form-control" type="password" id="txtSenha" placeholder="Insira sua senha!" required>
			</div>

			<div class="form-group">
				<button class="btn btn-primary btn-lg btn-block" type="submit" name="btn-login" onclick="VerificaLogin()">LOGIN</button>	
			</div>

			<div class="clearfix">
				<a href="#" class="float-right">Recuperar Senha</a>
			</div>



		</form>
	</div>

</body>
</html>

<script type="text/javascript">
var base = "<?=site_url('Login')?>";
$(document).ready(function(){

});

function VerificaLogin()
{
    var login = $('#txtLogin').val();
    var senha = $('#txtSenha').val();
    
    if(login === ''){
      alert('Digite o Email');
      return;
    }
    
    if(senha === ''){
      alert('Digite a Senha');
      return;
    }
    
    $.post(base + '/ValidarLogin',{
        'login' : login,
        'senha' : senha
    }, function(retorno){
        if(retorno.error){
            alert(retorno.msg);
            return;
        }else{
            $(location).attr('href','painel');
        }
    },'json')
}
</script>
