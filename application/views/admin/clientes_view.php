<button type="button" class="btn btn-success btn-sm" onclick="CadCliente();">Cadastrar</button>

<div class="">

</div>

<table class="table" id="tableCliente">
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

<div class="modal" id="cadCliente" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cadastrar Cliente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">
                        <div class="col-12">
                            <label for="exampleInputEmail1" class="form-label">Tipo de Cliente</label>
                            <select class="form-select" id="cbxTipo">
                                <option value="fisica" selected>Pessoa Física</option>
                                <option value="juridica">Pessoa Jurídica</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label for="exampleInputEmail1" class="form-label">Nome do Cliente</label>
                            <input type="text" class="form-control" id="txtNome" aria-describedby="emailHelp">
                        </div>
                    </div>
                    <div class="row" id="pf">
                        <div class="col-3">
                            <label for="exampleInputEmail1" class="form-label">Sexo</label>
                            <select class="form-select" id="cbxSexo">
                                <option value="masculino" selected>Masculino</option>
                                <option value="feminino">Feminino</option>
                            </select>
                        </div>
                        <div class="col-3">
                            <label for="exampleInputEmail1" class="form-label">Estado Civil</label>
                            <select class="form-select" id="cbxCivil">
                                <option value="solteiro" selected>Solteiro</option>
                                <option value="casado">Casado</option>
                                <option value="divorciado">Divorciado</option>
                                <option value="viuvo">Viúvo</option>
                            </select>
                        </div>
                        <div class="col-3">
                            <label for="exampleInputEmail1" class="form-label">CPF</label>
                            <input type="text" class="form-control" id="txtCPF" aria-describedby="emailHelp">
                        </div>
                        <div class="col-3">
                            <label for="exampleInputEmail1" class="form-label">RG</label>
                            <input type="text" class="form-control" id="txtRG" aria-describedby="emailHelp">
                        </div>
                    </div>
                    <div class="row d-none" id="pj">
                        <div class="col-6">
                            <label for="exampleInputEmail1" class="form-label">CNPJ</label>
                            <input type="text" class="form-control" id="txtCNPJ" aria-describedby="emailHelp">
                        </div>
                        <div class="col-6">
                            <label for="exampleInputEmail1" class="form-label">Inscrição Estudual</label>
                            <input type="text" class="form-control" id="txtIE" aria-describedby="emailHelp">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3">
                            <label for="exampleInputEmail1" class="form-label">CEP</label>
                            <input type="text" class="form-control" id="txtCEP" aria-describedby="emailHelp">
                        </div>
                        <div class="col-7">
                            <label for="exampleInputEmail1" class="form-label">Endereço</label>
                            <input type="text" class="form-control" id="txtEnd" aria-describedby="emailHelp" readonly>
                        </div>
                        <div class="col-2">
                            <label for="exampleInputEmail1" class="form-label">Nro</label>
                            <input type="text" class="form-control" id="txtNro" aria-describedby="emailHelp">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-5">
                            <label for="exampleInputEmail1" class="form-label">Bairro</label>
                            <input type="text" class="form-control" id="txtBairro" aria-describedby="emailHelp"
                                readonly>
                        </div>
                        <div class="col-5">
                            <label for="exampleInputEmail1" class="form-label">Cidade</label>
                            <input type="text" class="form-control" id="txtCidade" aria-describedby="emailHelp"
                                readonly>
                        </div>
                        <div class="col-2">
                            <label for="exampleInputEmail1" class="form-label">UF</label>
                            <input type="text" class="form-control" id="txtUF" aria-describedby="emailHelp" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label for="exampleInputEmail1" class="form-label">Celular</label>
                            <input type="text" class="form-control" id="txtCelular" aria-describedby="emailHelp">
                        </div>
                        <div class="col-6">
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
    function ExcluirCliente(id)
    {
        var agree=confirm("deseja deletar esse cliente?");
        if (agree)
        $.post(base + '/ExcluirCliente', {
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
var base = "<?= site_url('Clientes') ?>";
$(document).ready(function() {
    carregaTabela();
    $('#txtCEP').mask('00.000-000');
    $('#txtCPF').mask('000.000.000-00');
    $('#txtCNPJ').mask('00.000.000/0000-00');
    $('#txtCelular').mask('(00)9.0000-0000');

    $('#cbxTipo').on('change', function() {
        if (this.value === 'juridica') {
            $('#pj').removeClass('d-none');
            $('#pf').addClass('d-none');
        } else {
            $('#pj').addClass('d-none');
            $('#pf').removeClass('d-none');
        }
    });

    $('#txtCEP').on('change', function() {
        var cep = $('#txtCEP').val();

        if (cep == '') {
            alert('Informe o CEP');
            $('#txtCEP').focus();
            return;
        }

        $.post(base + '/consultaCEP', {
            'cep': cep
        }, function(dados) {
            $('#txtEnd').val(dados.logradouro);
            $('#txtCidade').val(dados.localidade);
            $('#txtBairro').val(dados.bairro);
            $('#txtUF').val(dados.uf);
            $('#txtNro').focus();
        }, 'json')
    })


});

function carregaTabela() {
    $.post(base + '/CarregarClientes', {}, function(retorno) {
        $('#tableCliente > tbody').html(retorno);
    })
}

function CadCliente() {
    $('#cadCliente').modal('show');
}

function Cadastrar() {
    var tipo = $('#cbxTipo').val();
    var nome = $('#txtNome').val();
    var cep = $('#txtCEP').val();
    var end = $('#txtEnd').val();
    var nro = $('#txtNro').val();
    var bairro = $('#txtBairro').val();
    var cidade = $('#txtCidade').val();
    var uf = $('#txtUF').val();
    var telefone = $('#txtCelular').val();
    var sexo = $('#cbxSexo').val();
    var civil = $('#cbxCivil').val();
    var cpf = $('#txtCPF').val();
    var rg = $('#txtRG').val();
    var cnpj = $('#txtCNPJ').val();
    var IE = $('#txtIE').val();
    var celular = $('#txtCelular').val();
    var email = $('#txtEmail').val();

    if (nome == '') {
        alert('Digite o nome do Cliente');
        $('#txtNome').focus();
        return;
    }

    if (tipo == 'juridica') {
        if (cnpj == '') {
            alert('Digite o CNPJ');
            $('#txtCNPJ').focus();
            return;
        }
        if (IE == '') {
            alert('Digite a Inscrição Estadual');
            $('#txtIE').focus();
            return;
        }
    } else {
        if (cpf == '') {
            alert('Digite o CPF');
            $('#txtCPF').focus();
            return;
        }
        if (rg == '') {
            alert('Digite o RG');
            $('#txtRG').focus();
            return;
        }
    }

    if (cep == '') {
        alert('Digite o CEP do Cliente');
        $('#txtCEP').focus();
        return;
    }
    if (nro == '') {
        alert('Digite o nro do Cliente');
        $('#txtNro').focus();
        return;
    }
    if (celular == '') {
        alert('Digite o celular do Cliente');
        $('#txtCelular').focus();
        return;
    }
    if (email == '') {
        alert('Digite o email do Cliente');
        $('#txtEmail').focus();
        return;
    }

    $.post(base + '/CadastrarCliente', {
        'tipo': tipo,
        'nome': nome,
        'cep': cep,
        'end': end,
        'nro': nro,
        'bairro': bairro,
        'cidade': cidade,
        'uf': uf,
        'telefone': telefone,
        'sexo': sexo,
        'civil': civil,
        'cpf': cpf,
        'rg': rg,
        'cnpj': cnpj,
        'IE': IE,
        'celular': celular,
        'email': email
    }, function(retorno) {
        if (retorno.error) {
            alert(retorno.msg);
            return;
        } else {
            alert(retorno.msg);
            $('#cadCliente').modal('hide');
            LimparCampos();
            carregaTabela();

        }
    }, 'json')

    function LimparCampos() {
        $('#cbxTipo').val();
        $('#txtNome').val('');
        $('#txtCEP').val('');
        $('#txtEnd').val('');
        $('#txtNro').val('');
        $('#txtBairro').val('');
        $('#txtCidade').val('');
        $('#txtUF').val('');
        $('#txtCelular').val('');
        $('#cbxSexo').val();
        $('#cbxCivil').val();
        $('#txtCPF').val('');
        $('#txtRG').val('');
        $('#txtCNPJ').val('');
        $('#txtIE').val('');
        $('#txtCelular').val('');
        $('#txtEmail').val('');
    }

}
</script>