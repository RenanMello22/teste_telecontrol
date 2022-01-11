<button type="button" class="btn btn-success btn-sm" onclick="CadProd();">Cadastrar</button>

<div class="">

</div>

<table class="table" id="tableProdutos">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Produto</th>
            <th scope="col">Fornecedor</th>
            <th scope="col">Estoque</th>
            <th scope="col">Preço de Venda</th>
            <th scope="col">Opções</th>
        </tr>
    </thead>
    <tbody>
        <td colspan="200" style="text-align: center;">Aguarde... Carregando Informações</td>
    </tbody>
</table>

<div class="modal" id="cadProd" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cadastrar Produto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">
                        <div class="col-12">
                            <label for="exampleInputEmail1" class="form-label">Produto</label>
                            <input type="text" class="form-control" id="txtProd" aria-describedby="emailHelp">
                        </div>
                    </div>
                    <div class="row" id="pf">
                        <div class="col-6">
                            <label for="exampleInputEmail1" class="form-label">Fornecedor</label>
                            <select class="form-select" id="cbxFornecedor">
                                
                            </select>
                        </div>
                        <div class="col-3">
                            <label for="exampleInputEmail1" class="form-label">Preço de Custo</label>
                            <input type="text" class="form-control" id="txtCusto" aria-describedby="emailHelp">
                        </div>
                        <div class="col-3">
                            <label for="exampleInputEmail1" class="form-label">Preço de Venda</label>
                            <input type="text" class="form-control" id="txtVenda" aria-describedby="emailHelp">
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
    
var base = "<?= site_url('Produtos') ?>";
$(document).ready(function() {
    carregaTabela();
    
    });

function carregaTabela() {
    $.post(base + '/CarregarProdutos', {}, function(retorno) {
        $('#tableProdutos > tbody').html(retorno);
    })
}

function CarregaFornecedores(){
    $.post(base + '/CarregarFornecedores',{
            }, function(retorno){
		    $('#cbxFornecedor').html(retorno);
        })
}

function CadProd() {
    CarregaFornecedores();
    $('#cadProd').modal('show');
}

function Cadastrar() {
    var prod = $('#txtProd').val();
    var fornecedor = $('#cbxFornecedor').val();
    var custo = $('#txtCusto').val();
    var venda = $('#txtVenda').val();

    if (prod == '') {
        alert('Digite o Produto');
        $('#txtProd').focus();
        return;
    }
    if (fornecedor == '') {
        alert('Selecione o Fornecedor');
        $('#cbxFornecedor').focus();
        return;
    }
    if (custo == '') {
        alert('Digite o preço de Custo');
        $('#txtCusto').focus();
        return;
    }
    if (venda == '') {
        alert('Digite opreço de Venda');
        $('#txtVenda').focus();
        return;
    }

    $.post(base + '/CadastrarProduto', {
        'prod': prod,
        'fornecedor': fornecedor,
        'custo': custo,
        'venda': venda
    }, function(retorno) {
        if (retorno.error) {
            alert(retorno.msg);
            return;
        } else {
            alert(retorno.msg);
            $('#cadProd').modal('hide');
            LimparCampos();
            carregaTabela();

        }
    }, 'json')
}

function LimparCampos() {
        $('#txtProd').val();
        $('#cbxFornecedor').val('');
        $('#txtCusto').val('');
        $('#txtVenda').val('');
}

function ExcluirProduto(id)
    {
        var agree=confirm("deseja deletar esse produto?");
        if (agree)
        $.post(base + '/ExcluirProduto', {
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