<form>
    <input type="hidden" class="form-control" id="txtID" aria-describedby="emailHelp"
        value=<?php echo $retorno->id_usuario; ?>>

    <div class="row">
        <div class="col-12">
            <label for="exampleInputEmail1" class="form-label">Nome</label>
            <input type="text" class="form-control" id="txtNome" aria-describedby="emailHelp"
                value=<?php echo $retorno->nome; ?>>
                <input type="hidden" class="form-control" id="txtNomeDuplicidade" aria-describedby="emailHelp"
                value=<?php echo $retorno->nome; ?>>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <label for="exampleInputEmail1" class="form-label">Email</label>
            <input type="text" class="form-control" id="txtEmail" aria-describedby="emailHelp"
                value=<?php echo $retorno->email; ?>>
        </div>
    </div>

    
    <div class="row">
        <div class="col-12">
            <button type="button" class="btn btn-success btn-sm" onclick="AlterarUsuario();">Alterar</button>
            <button type="button" class="btn btn-success btn-sm" onclick="Voltar();">Voltar</button>
        </div>
    </div>

</form>

<script type="text/javascript">

var base = "<?= site_url('usuarios') ?>";
$(document).ready(function() {

});

function AlterarUsuario() {
    var nome = $('#txtNome').val();
    var email = $('#txtEmail').val();
    var NomeOri = $('#txtNomeDuplicidade').val();
    var id = $('#txtID').val();

    if (nome == '') {
        alert('Digite um nome');
        $('#txtNome').focus();
        return;
    }
    if (email == '') {
        alert('Digite o Email');
        $('#txtEmail').focus();
        return;
    }

    $.post(base + '/EditUser', {
        'id' : id,
        'nome': nome,
        'email': email,
        'NomeOri': NomeOri
    }, function(retorno) {
        if (retorno.error) {
            alert(retorno.msg);
            return;
        } else {
            alert(retorno.msg);
            LimparCampos();
            Voltar();

        }
    }, 'json')

}

function LimparCampos() {
    $('#txtNome').val();
    $('#txtEmail').val('');
}

function Voltar()
{
    $(location).attr('href','<?=base_url('/usuarios')?>');
}

</script>