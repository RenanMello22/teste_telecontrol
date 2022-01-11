<button type="button" class="btn btn-success btn-sm" onclick="CadForn();">Cadastrar</button>

<div class="">

</div>

<table class="table" id="tableFornecedores">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nome</th>
            <th scope="col">Telefone</th>
            <th scope="col">Email</th>
            <th scope="col">Opções</th>
        </tr>
    </thead>
    <tbody>
        <td colspan="200" style="text-align: center;">Aguarde... Carregando Informações</td>
    </tbody>
</table>

<div class="modal" id="cadForn" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cadastrar Fornecedor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">
                        <div class="col-12">
                            <label for="exampleInputEmail1" class="form-label">Fornecedor</label>
                            <input type="text" class="form-control" id="txtForn" aria-describedby="emailHelp">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label for="exampleInputEmail1" class="form-label">CNPJ</label>
                            <input type="text" class="form-control" id="txtCNPJ" aria-describedby="emailHelp">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label for="exampleInputEmail1" class="form-label">Telefone</label>
                            <input type="text" class="form-control" id="txtTelefone" aria-describedby="emailHelp">
                        </div>
                        <div class="col-6">
                            <label for="exampleInputEmail1" class="form-label">Email</label>
                            <input type="email" class="form-control" id="txtEmail" aria-describedby="emailHelp">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label for="exampleInputEmail1" class="form-label">Login</label>
                            <input type="text" class="form-control" id="txtLogin" aria-describedby="emailHelp">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-primary" onclick="Cadastrar()">Salvar</button>
            </div>
        </div>
    </div>
</div>



<script type="text/javascript">
var base = "<?= site_url('fornecedores') ?>";
$(document).ready(function() {
    carregaTabela();
    $('#txtCNPJ').mask('00.000.000/0000-00');
    $('#txtTelefone').mask('(00)0000-0000');

});

function carregaTabela() {
    $.post(base + '/CarregarFornecedores', {}, function(retorno) {
        $('#tableFornecedores > tbody').html(retorno);
    })
}

function CadForn() {
    $('#cadForn').modal('show');
}

function Cadastrar() {
    var forn = $('#txtForn').val();
    var cnpj = $('#txtCNPJ').val();
    var telefone = $('#txtTelefone').val();
    var email = $('#txtEmail').val();
    var login = $('#txtLogin').val();

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

    $.post(base + '/CadastrarFornecedor', {
        'forn': forn,
        'cnpj': cnpj,
        'telefone': telefone,
        'email': email,
        'login': login
    }, function(retorno) {
        if (retorno.error) {
            alert(retorno.msg);
            return;
        } else {
            alert(retorno.msg);
            $('#cadForn').modal('hide');
            LimparCampos();
            carregaTabela();

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

function ExcluirFornecedor(id)
    {
        var agree=confirm("deseja deletar esse fornecedor?");
        if (agree)
        $.post(base + '/ExcluirFornecedor', {
            'id': id
        }, function(retorno) {
            console.log(retorno);
            if(retorno.error){
                alert(retorno.msg);
                return;
            }else{
                alert(retorno.msg);
                carregaTabela();
            }
        }, 'json')
        else
            return false ;
    }
</script>