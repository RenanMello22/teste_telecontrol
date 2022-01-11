<button type="button" class="btn btn-success btn-sm" onclick="CadOrdem();">Cadastrar</button>
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

<table class="table" id="tableOrdens">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Data</th>
            <th scope="col">Cliente</th>
            <th scope="col">Responsável</th>
            <th scope="col">Status</th>
            <th scope="col">Preço Total</th>
            <th scope="col">Opções</th>
        </tr>
    </thead>
    <tbody>
        <td colspan="200" style="text-align: center;">Aguarde... Carregando Informações</td>
    </tbody>
</table>

<div class="modal" id="cadOrdens" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cadastrar Ordem</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">
                        <div class="col-12">
                            <label for="exampleInputEmail1" class="form-label">Cliente</label>
                            <select class="form-select" id="cbxCliente">

                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label for="exampleInputEmail1" class="form-label">Técnico Responsável</label>
                            <select class="form-select" id="cbxUsuário">

                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label for="exampleInputEmail1" class="form-label">Problema</label>
                            <textarea id="txtproblema" rows="10" cols="50"></textarea>
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

<div class="modal" id="Detalhe" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detalhe da Ordem de Serviço</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">
                        <div class="col-12">
                            <label for="exampleInputEmail1" class="form-label">Cliente</label>
                            <p id="Cliente"></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label for="exampleInputEmail1" class="form-label">responsável</label>
                            <p id="Resp"></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label for="exampleInputEmail1" class="form-label">Problema</label>
                            <p id="Problema"></p>
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

<div class="modal" id="Lista" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Listagem de Serviços</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">
                        <div class="col-3">
                            <label for="exampleInputEmail1" class="form-label">Produto</label>
                            <select class="form-select" id="cbxProduto">

                            </select>
                        </div>
                        <div class="col-3">
                            <label for="exampleInputEmail1" class="form-label">Preço</label>
                            <input type="text" class="form-control" id="txtPrecoUni" aria-describedby="emailHelp" readonly>
                        </div>
                        <div class="col-3">
                            <label for="exampleInputEmail1" class="form-label">QTD</label>
                            <input type="text" class="form-control" id="txtQTD" aria-describedby="emailHelp">
                        </div>
                        <div class="col-3">
                            <label for="exampleInputEmail1" class="form-label">Produto</label>
                            <input type="text" class="form-control" id="txtTotal" aria-describedby="emailHelp" readonly>
                            <input type="hidden" class="form-control" id="txtID" aria-describedby="emailHelp" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <button type="button" class="btn btn-success btn-sm" onclick="CadServ();">Cadastrar</button>
                    </div>
                    <div class="row">
                        <hr>
                    </div>
                    <div class="row">
                        <table class="table" id="tableListagem">
                            <thead>
                                <tr>
                                    <th scope="col">Produto</th>
                                    <th scope="col">Preco Unitário</th>
                                    <th scope="col">QTD</th>
                                    <th scope="col">Preço Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <td colspan="200" style="text-align: center;">Aguarde... Carregando Informações</td>
                            </tbody>
                        </table>
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
var base = "<?= site_url('ordem') ?>";
$(document).ready(function() {
    carregaTabela();

    $('#cbxProduto').on('change', function() {
        var id = $('#cbxProduto').val();

        $.post(base + '/consultaProduto', {
            'id': id
        }, function(dados) {
            $('#txtPrecoUni').val(dados.valor);
            $('#txtQTD').focus();
        }, 'json')
    })

    $('#txtQTD').on('change', function() {
        var qtd = $('#txtQTD').val();
        var valor = $('#txtPrecoUni').val();
        var total = parseInt(valor) * qtd;
        $('#txtTotal').val(total);

    })
});

function carregaTabela() {
    $.post(base + '/CarregarOrdens', {}, function(retorno) {
        $('#tableOrdens > tbody').html(retorno);
    })
}

function LimparCampos() {
    $('#txtNome').val();
    $('#txtEmail').val('');
}

function Busca() {
    var datade = $('#txtDatade').val();
    var dataate = $('#txtDataate').val();

    $.post(base + '/BuscarOrdem', {
        'datade': datade,
        'dataate': dataate
    }, function(retorno) {
        $('#tableOrdens > tbody').html(retorno);
    })
}

function CarregaCliente() {
    $.post(base + '/CarregarClientes', {}, function(retorno) {
        $('#cbxCliente').html(retorno);
    })
}

function CarregaUsuario() {
    $.post(base + '/CarregarUsuarios', {}, function(retorno) {
        $('#cbxUsuário').html(retorno);
    })
}

function CadOrdem() {
    CarregaCliente();
    CarregaUsuario();
    $('#cadOrdens').modal('show');
}

function Cadastrar() {
    var cliente = $('#cbxCliente').val();
    var usuario = $('#cbxUsuário').val();
    var problema = $('#txtproblema').val();

    if (cliente == '') {
        alert('Selecione um cliente');
        $('#cbxCliente').focus();
        return;
    }
    if (usuario == '') {
        alert('Selecione um técnico');
        $('#cbxUsuário').focus();
        return;
    }
    if (problema == '') {
        alert('Digite o problema');
        $('#txtproblema').focus();
        return;
    }

    $.post(base + '/CadastrarOrdem', {
        'cliente': cliente,
        'usuario': usuario,
        'problema': problema
    }, function(retorno) {
        if (retorno.error) {
            alert(retorno.msg);
            return;
        } else {
            alert(retorno.msg);
            $('#cadOrdens').modal('hide');
            LimparCampos();
            carregaTabela();

        }
    }, 'json')
}

function LimparCampos() {
    $('#cbxCliente').val();
    $('#cbxUsuário').val('');
    $('#txtproblema').val('');
}

function ShowDetalhe(id) {
    $.post(base + '/BuscarDetalheOrdem', {
        'id': id
    }, function(retorno) {

        $('#Cliente').html(retorno.cliente);
        $('#Resp').html(retorno.usuario);
        $('#Problema').html(retorno.problema);
        $('#Detalhe').modal('show');
    }, 'json');
}

function CarregarLIstagem(id)
{
    $.post(base + '/BuscarListagemOrdem', {
        'id' : id
    }, function(retorno) {
        $('#tableListagem > tbody').html(retorno);
    })
}

function CarregaProdutos() {
    $.post(base + '/CarregarProdutos', {}, function(retorno) {
        $('#cbxProduto').html(retorno);
    })
}

function ShowListagem(id){
    CarregarLIstagem(id);
    CarregaProdutos();
    $('#txtID').val(id);
    $('#Lista').modal('show');
}

function CadServ()
{
    var prod = $('#cbxProduto').val();
    var precoUni = $('#txtPrecoUni').val();
    var qtd = $('#txtQTD').val();
    var total = $('#txtTotal').val();
    var id = $('#txtID').val();

    if (precoUni == '') {
        alert('Selecione um produto');
        $('#cbxProduto').focus();
        return;
    }
    if (qtd == '') {
        alert('Adicione a quantidade desejada');
        $('#cbxProduto').focus();
        return;
    }

    $.post(base + '/CadastrarListagem', {
        'prod': prod,
        'precoUni': precoUni,
        'qtd': qtd,
        'total' : total,
        'id' : id
    }, function(retorno) {
        if (retorno.error) {
            alert(retorno.msg);
            return;
        } else {
            LimparCamposLista();
            CarregaProdutos();
            CarregarLIstagem(id);
        }
    }, 'json')
}

function LimparCamposLista()
{
    $('#cbxProduto').val('');
    $('#txtPrecoUni').val('');
    $('#txtQTD').val('');
    $('#txtTotal').val('');
}

function Fechar(id)
{
    var agree=confirm("deseja fechar essa ordem?");
        if (agree)
        $.post(base + '/FecharOrdem', {
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