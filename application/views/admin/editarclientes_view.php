
<form>
<input type="hidden" class="form-control" id="txtID" aria-describedby="emailHelp" value=<?php echo $retorno->id_cliente; ?>>
<input type="text" class="form-control" id="txtTipoBD" aria-describedby="emailHelp" readonly value=<?php echo $retorno->tipo ?>>
    <div class="row">
        
        <div class="col-12">
            <label for="exampleInputEmail1" class="form-label">Tipo de Cliente</label>
            <?php $tipo = ''; if($retorno->tipo == 'fisica'){
                $tipo = 'Física';
            }else{
                $tipo = 'Jurídica';
            } ?>
            <input type="text" class="form-control" id="txtTipo" aria-describedby="emailHelp" readonly value=<?php echo $tipo ?>>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <label for="exampleInputEmail1" class="form-label">Nome do Cliente</label>
            <input type="text" class="form-control" id="txtNome" aria-describedby="emailHelp" value=<?php echo $retorno->nome; ?>>
        </div>
    </div>
    <?php if($retorno->tipo == 'fisica'){
        $esconder = false;
        $hiden = '';
        ?>
    <div class="row" id="pf">
        <div class="col-3">
            <label for="exampleInputEmail1" class="form-label">Sexo</label>
            <select class="form-select" id="cbxSexo">
                <?php 
                if($retorno->civil == 'M'){
                    ?>
                <option value="M" selected>Masculino</option>
                <option value="F">Feminino</option>
                <?php
                }else{
                    ?>
                <option value="M">Masculino</option>
                <option value="F" selected>Feminino</option>
                <?php
                }
                ?>


            </select>
        </div>
        <div class="col-3">
            <label for="exampleInputEmail1" class="form-label">Estado Civil</label>
            <select class="form-select" id="cbxCivil">
                <?php
                if($retorno->civil == 'solteiro'){
                ?>
                <option value="solteiro" selected>Solteiro</option>
                <option value="casado">Casado</option>
                <option value="divorciado">Divorciado</option>
                <option value="viuvo">Viúvo</option>
                <?php
                }else{
                    if($retorno->civil == 'casado'){
                        ?>
                <option value="solteiro">Solteiro</option>
                <option value="casado" selected>Casado</option>
                <option value="divorciado">Divorciado</option>
                <option value="viuvo">Viúvo</option>
                <?php
                    }else{
                        if($retorno->civil == 'divorciado'){
                            ?>
                <option value="solteiro">Solteiro</option>
                <option value="casado">Casado</option>
                <option value="divorciado" selected>Divorciado</option>
                <option value="viuvo">Viúvo</option>
                <?php
                        }else{
                            ?>
                <option value="solteiro">Solteiro</option>
                <option value="casado">Casado</option>
                <option value="divorciado" selected>Divorciado</option>
                <option value="viuvo" selected>Viúvo</option>
                <?php
                        }
                    }
                }
                ?>
            </select>
        </div>
        <div class="col-3">
            <label for="exampleInputEmail1" class="form-label">CPF</label>
            <input type="text" class="form-control" id="txtCPF" aria-describedby="emailHelp" value=<?php echo $retorno->cpf; ?>>
            <input type="hidden" class="form-control" id="txtCPFDuplicidade" aria-describedby="emailHelp" value=<?php echo $retorno->cpf; ?>>
        </div>
        <div class="col-3">
            <label for="exampleInputEmail1" class="form-label">RG</label>
            <input type="text" class="form-control" id="txtRG" aria-describedby="emailHelp" value=<?php echo $retorno->rg; ?>>
        </div>
    </div>
    <?php
    }else{
        ?>
        <div class="row" id="pj">
        <div class="col-6">
            <label for="exampleInputEmail1" class="form-label">CNPJ</label>
            <input type="text" class="form-control" id="txtCNPJ" aria-describedby="emailHelp" value=<?php echo $retorno->cpf; ?>>
            <input type="hidden" class="form-control" id="txtCNPJDuplicidade" aria-describedby="emailHelp" value=<?php echo $retorno->cpf; ?>>
        </div>
        <div class="col-6">
            <label for="exampleInputEmail1" class="form-label">Inscrição Estudual</label>
            <input type="text" class="form-control" id="txtIE" aria-describedby="emailHelp" value=<?php echo $retorno->rg; ?>>
        </div>
    </div>
        <?php
    }
                    ?>
    <div class="row">
        <div class="col-3">
            <label for="exampleInputEmail1" class="form-label">CEP</label>
            <input type="text" class="form-control" id="txtCEP" aria-describedby="emailHelp" value=<?php echo $retorno->cep; ?>>
        </div>
        <div class="col-7">
            <label for="exampleInputEmail1" class="form-label">Endereço</label>
            <input type="text" class="form-control" id="txtEnd" aria-describedby="emailHelp" readonly value=<?php echo $retorno->endereco; ?>>
        </div>
        <div class="col-2">
            <label for="exampleInputEmail1" class="form-label">Nro</label>
            <input type="text" class="form-control" id="txtNro" aria-describedby="emailHelp" value=<?php echo $retorno->nro; ?>>
        </div>
    </div>
    <div class="row">
        <div class="col-5">
            <label for="exampleInputEmail1" class="form-label">Bairro</label>
            <input type="text" class="form-control" id="txtBairro" aria-describedby="emailHelp" readonly value=<?php echo $retorno->bairro; ?>>
        </div>
        <div class="col-5">
            <label for="exampleInputEmail1" class="form-label">Cidade</label>
            <input type="text" class="form-control" id="txtCidade" aria-describedby="emailHelp" readonly value=<?php echo $retorno->cidade; ?>>
        </div>
        <div class="col-2">
            <label for="exampleInputEmail1" class="form-label">UF</label>
            <input type="text" class="form-control" id="txtUF" aria-describedby="emailHelp" readonly value=<?php echo $retorno->uf; ?>>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <label for="exampleInputEmail1" class="form-label">Celular</label>
            <input type="text" class="form-control" id="txtCelular" aria-describedby="emailHelp" value=<?php echo $retorno->telefone; ?>>
        </div>
        <div class="col-6">
            <label for="exampleInputEmail1" class="form-label">Email</label>
            <input type="email" class="form-control" id="txtEmail" aria-describedby="emailHelp" value=<?php echo $retorno->email; ?>>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
        <button type="button" class="btn btn-success btn-sm" onclick="AlterarCliente();">Alterar</button>
        <button type="button" class="btn btn-success btn-sm" onclick="Voltar();">Voltar</button>
        </div>
    </div>

</form>

<script type="text/javascript">
    function Voltar()
    {
        $(location).attr('href','<?=base_url('/clientes')?>');
    }

var base = "<?= site_url('Clientes') ?>";
$(document).ready(function() {
    $('#txtCEP').mask('00.000-000');
    $('#txtCPF').mask('000.000.000-00');
    $('#txtCNPJ').mask('00.000.000/0000-00');
    $('#txtCelular').mask('(00)9.0000-0000');

    $('#cbxTipo').on('change', function() {
        if (this.value === 'juridica') {
            $('#pj').removeClass('d-none');
            $('#pf').addClass('d-none');
        } else {
            alert('Teste');
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


function AlterarCliente() {
    var tipo = $('#txtTipoBD').val();
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
    var cpfori = $('#txtCPFDuplicidade').val();
    var cnpjori = $('#txtCNPJDuplicidade').val();
    var id = $('#txtID').val();

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

    $.post(base + '/EditCliente', {
        'tipo' : tipo,
        'id' : id,
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
        'email': email,
        'cnpjori' : cnpjori,
        'cpfori' : cpfori
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