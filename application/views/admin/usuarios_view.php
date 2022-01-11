<button type="button" class="btn btn-success btn-sm" onclick="CadUser();">Cadastrar</button>

<div class="">

</div>

<table class="table" id="tableUsers">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nome</th>
            <th scope="col">Email</th>
            <th scope="col">Opções</th>
        </tr>
    </thead>
    <tbody>
        <td colspan="200" style="text-align: center;">Aguarde... Carregando Informações</td>
    </tbody>
</table>

<div class="modal" id="cadUsers" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cadastrar Usuários</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">
                        <div class="col-12">
                            <label for="exampleInputEmail1" class="form-label">Nome</label>
                            <input type="text" class="form-control" id="txtNome" aria-describedby="emailHelp">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label for="exampleInputEmail1" class="form-label">Email</label>
                            <input type="email" class="form-control" id="txtEmail" aria-describedby="emailHelp">
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
var base = "<?= site_url('usuarios') ?>";
$(document).ready(function() {
    carregaTabela();
    $('#txtCNPJ').mask('00.000.000/0000-00');
    $('#txtTelefone').mask('(00)0000-0000');

});

function carregaTabela() {
    $.post(base + '/CarregarUsuarios', {}, function(retorno) {
        $('#tableUsers > tbody').html(retorno);
    })
}

function CadUser() {
    $('#cadUsers').modal('show');
}

function Cadastrar() {
    var nome = $('#txtNome').val();
    var email = $('#txtEmail').val();

    if (nome == '') {
        alert('Digite um nome');
        $('#txtNome').focus();
        return;
    }
    if (email == '') {
        alert('Digite o um email válido');
        $('#txtEmail').focus();
        return;
    }

    $.post(base + '/CadastrarUsuario', {
        'nome': nome,
        'email': email
    }, function(retorno) {
        if (retorno.error) {
            alert(retorno.msg);
            return;
        } else {
            alert(retorno.msg);
            $('#cadUsers').modal('hide');
            LimparCampos();
            carregaTabela();

        }
    }, 'json')
}

function LimparCampos() {
        $('#txtNome').val();
        $('#txtEmail').val('');
}

function ExcluirUsuario(id)
    {
        var agree=confirm("deseja deletar esse usuário?");
        if (agree)
        $.post(base + '/ExcluirUsuario', {
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