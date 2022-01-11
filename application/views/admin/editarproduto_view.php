<form>
    <input type="hidden" class="form-control" id="txtID" aria-describedby="emailHelp"
        value=<?php echo $retorno->id_produto; ?>>

    <div class="row">
        <div class="col-12">
            <label for="exampleInputEmail1" class="form-label">Produto</label>
            <input type="text" class="form-control" id="txtProd" aria-describedby="emailHelp"
                value=<?php echo $retorno->produto; ?>>
        </div>
    </div>


    <div class="row" id="pj">
        <div class="col-3">
            <label for="exampleInputEmail1" class="form-label">Estoque</label>
            <input type="text" class="form-control" id="txtEstoque" aria-describedby="emailHelp"
                value=<?php echo $retorno->estoque; ?> readonly>
        </div>
        <div class="col-3">
            <label for="exampleInputEmail1" class="form-label">Fornecedor</label>
            <input type="text" class="form-control" id="txtFornecedor" aria-describedby="emailHelp"
                value=<?php echo $retorno->fornecedor; ?> readonly>
        </div>
        <div class="col-3">
            <label for="exampleInputEmail1" class="form-label">Preço de Custo</label>
            <input type="text" class="form-control" id="txtCusto" aria-describedby="emailHelp"
                value=<?php echo $retorno->custo; ?>>
        </div>
        <div class="col-3">
            <label for="exampleInputEmail1" class="form-label">Preço de Venda</label>
            <input type="text" class="form-control" id="txtVenda" aria-describedby="emailHelp"
                value=<?php echo $retorno->venda; ?>>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <button type="button" class="btn btn-success btn-sm" onclick="AlterarProduto();">Alterar</button>
            <button type="button" class="btn btn-success btn-sm" onclick="Voltar();">Voltar</button>
        </div>
    </div>

</form>

<script type="text/javascript">

var base = "<?= site_url('produtos') ?>";
$(document).ready(function() {

});

function AlterarProduto() {
    var prod = $('#txtProd').val();
    var custo = $('#txtCusto').val();
    var venda = $('#txtVenda').val();
    var id = $('#txtID').val();

    if (prod == '') {
        alert('Digite o Produto');
        $('#txtProd').focus();
        return;
    }
    if (custo == '') {
        alert('Digite o preço de Custo');
        $('#txtCusto').focus();
        return;
    }
    if (venda == '') {
        alert('Digite o preço de Venda');
        $('#txtVenda').focus();
        return;
    }

    $.post(base + '/EditProd', {
        'prod' : prod,
        'custo': custo,
        'venda': venda,
        'id': id
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
    $('#txtProd').val();
    $('#txtCusto').val('');
    $('#txtVenda').val('');
}

function Voltar()
{
    $(location).attr('href','<?=base_url('/produtos')?>');
}

</script>