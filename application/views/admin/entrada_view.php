<button type="button" class="btn btn-success btn-sm" onclick="CadEnter();">Cadastrar</button>
<div class="row">
    <div class="col-4">
        <label for="exampleInputEmail1" class="form-label">Data de:</label>
        <input type="date" class="form-control" id="txtDatade" aria-describedby="emailHelp">
    </div>
    <div class="col-4">
        <label for="exampleInputEmail1" class="form-label">Data até:</label>
        <input type="date" class="form-control" id="txtDataate" aria-describedby="emailHelp">
    </div>
    <div class="col-4">
    <button type="button" class="btn btn-success btn-sm" onclick="Busca();">Buscar</button>
    </div>
</div>
<div class="">

</div>

<table class="table" id="tableEntrada">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Data</th>
            <th scope="col">Produto</th>
            <th scope="col">Quantidade</th>
            <th scope="col">Opções</th>
        </tr>
    </thead>
    <tbody>
        <td colspan="200" style="text-align: center;">Aguarde... Carregando Informações</td>
    </tbody>
</table>

<div class="modal" id="cadEnters" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cadastrar Entrada</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">
                        <div class="col-12">
                            <label for="exampleInputEmail1" class="form-label">Produto</label>
                            <select class="form-select" id="cbxProduto">
                                
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label for="exampleInputEmail1" class="form-label">Quantidade</label>
                            <input type="email" class="form-control" id="txtQtd" aria-describedby="emailHelp">
                        </div>
                        <div class="col-6">
                            <label for="exampleInputEmail1" class="form-label">Nro da Nota</label>
                            <input type="email" class="form-control" id="txtNota" aria-describedby="emailHelp">
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

<div class="modal" id="Relatorio" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Relatório de Entrada</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">
                        <div class="col-12">
                            <label for="exampleInputEmail1" class="form-label">Produto</label>
                            <p id="Produto"></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <label for="exampleInputEmail1" class="form-label">Quantidade</label>
                            <p id="Quantidade"></p>
                        </div>
                        <div class="col-4">
                            <label for="exampleInputEmail1" class="form-label">Nro da Nota</label>
                            <p id="Nota"></p>
                        </div>
                        <div class="col-4">
                            <label for="exampleInputEmail1" class="form-label">Data da Compra</label>
                            <p id="Data"></p>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>



<script type="text/javascript">
var base = "<?= site_url('entrada') ?>";
$(document).ready(function() {
    carregaTabela();
    $('#txtCNPJ').mask('00.000.000/0000-00');
    $('#txtTelefone').mask('(00)0000-0000');

});

function carregaTabela() {
    $.post(base + '/CarregarEntrada', {}, function(retorno) {
        $('#tableEntrada > tbody').html(retorno);
    })
}

function LimparCampos() {
        $('#txtNome').val();
        $('#txtEmail').val('');
}

function Busca(){
    var datade = $('#txtDatade').val();
    var dataate = $('#txtDataate').val();

    $.post(base + '/BuscarEntrada', {
        'datade' : datade,
        'dataate' : dataate
    }, function(retorno) {
        $('#tableEntrada > tbody').html(retorno);
    })
}

function CarregaProdutos(){
    $.post(base + '/CarregarProdutos',{
            }, function(retorno){
		    $('#cbxProduto').html(retorno);
        })
}

function CadEnter() {
    CarregaProdutos();
    $('#cadEnters').modal('show');
}

function Cadastrar() {
    var prod = $('#cbxProduto').val();
    var qtd = $('#txtQtd').val();
    var nota = $('#txtNota').val();

    if (prod == '') {
        alert('Selecione um produto');
        $('#cbxProduto').focus();
        return;
    }
    if (qtd == '') {
        alert('Digite a quantidade de entrada');
        $('#txtQtd').focus();
        return;
    }
    if (nota == '') {
        alert('Digite numero da nota');
        $('#txtNota').focus();
        return;
    }

    $.post(base + '/CadastrarEntrada', {
        'prod': prod,
        'qtd': qtd,
        'nota': nota
    }, function(retorno) {
        if (retorno.error) {
            alert(retorno.msg);
            return;
        } else {
            alert(retorno.msg);
            $('#cadEnters').modal('hide');
            LimparCampos();
            carregaTabela();

        }
    }, 'json')
}

function LimparCampos() {
        $('#cbxProduto').val();
        $('#txtQtd').val('');
        $('#txtNota').val('');
}

function ShowRelatorio(id)
{
    $.post(base + '/BuscarEntradaRelatorio',{
        'id' : id
    }, function(retorno){

        $('#Produto').html(retorno.produto);
        $('#Quantidade').html(retorno.qtd);
        $('#Nota').html(retorno.nro_nota);
        $('#Data').html(retorno.data);
        $('#Relatorio').modal('show');
    },'json');
}

</script>