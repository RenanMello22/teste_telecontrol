<form>
    <input type="hidden" class="form-control" id="txtID" aria-describedby="emailHelp"
        value=<?php echo $retorno->id_fornecedor; ?>>

    <div class="row">
        <div class="col-12">
            <label for="exampleInputEmail1" class="form-label">Nome do Cliente</label>
            <input type="text" class="form-control" id="txtForn" aria-describedby="emailHelp"
                value=<?php echo $retorno->fornecedor; ?>>
        </div>
    </div>


    <div class="row" id="pj">
        <div class="col-6">
            <label for="exampleInputEmail1" class="form-label">CNPJ</label>
            <input type="text" class="form-control" id="txtCNPJ" aria-describedby="emailHelp"
                value=<?php echo $retorno->cnpj; ?>>
            <input type="hidden" class="form-control" id="txtCNPJDuplicidade" aria-describedby="emailHelp"
                value=<?php echo $retorno->cnpj; ?>>
        </div>
        <div class="col-6">
            <label for="exampleInputEmail1" class="form-label">Celular</label>
            <input type="text" class="form-control" id="txtTelefone" aria-describedby="emailHelp"
                value=<?php echo $retorno->telefone; ?>>
        </div>
    </div>

    <div class="row">
        <div class="col-6">
            <label for="exampleInputEmail1" class="form-label">Login</label>
            <input type="text" class="form-control" id="txtLogin" aria-describedby="emailHelp"
                value=<?php echo $retorno->login; ?>>
        </div>
        <div class="col-6">
            <label for="exampleInputEmail1" class="form-label">Email</label>
            <input type="email" class="form-control" id="txtEmail" aria-describedby="emailHelp"
                value=<?php echo $retorno->email; ?>>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <button type="button" class="btn btn-success btn-sm" onclick="AlterarFornecedor();">Alterar</button>
            <button type="button" class="btn btn-success btn-sm" onclick="Voltar();">Voltar</button>
        </div>
    </div>

</form>

<script type="text/javascript">

var base = "<?= site_url('fornecedores') ?>";
$(document).ready(function() {

});

function AlterarFornecedor() {
    var forn = $('#txtForn').val();
    var cnpj = $('#txtCNPJ').val();
    var telefone = $('#txtTelefone').val();
    var email = $('#txtEmail').val();
    var login = $('#txtLogin').val();
    var CNPJOri = $('#txtCNPJDuplicidade').val();
    var id = $('#txtID').val();

    if (forn == '') {
        alert('Digite o Forncedor');
        $('#txtForn').focus();
        return;
    }
    if (cnpj == '') {
        alert('Digite o CNPJ');
        $('#txtCNPJ').focus();
        return;
    }
    if (telefone == '') {
        alert('Digite o Telefone');
        $('#txtTelefone').focus();
        return;
    }
    if (email == '') {
        alert('Digite o Email');
        $('#txtEmail').focus();
        return;
    }
    if (login == '') {
        alert('Digite um login para o Fornecedor');
        $('#txtLogin').focus();
        return;
    }

    $.post(base + '/EditForn', {
        'id' : id,
        'forn': forn,
        'cnpj': cnpj,
        'telefone': telefone,
        'email': email,
        'login': login,
        'cnpjOri' : CNPJOri
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
    $('#txtForn').val();
    $('#txtCNPJ').val('');
    $('#txtTelefone').val('');
    $('#txtEmail').val('');
    $('#txtLogin').val('');
}

function Voltar()
{
    $(location).attr('href','<?=base_url('/fornecedores')?>');
}

</script>