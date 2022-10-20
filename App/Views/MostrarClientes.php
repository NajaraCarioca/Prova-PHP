<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Prova - PHP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">s
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <style>
        td.details-control {
            background: url('components/images/details_open.png') no-repeat center center;
            cursor: pointer;
        }
        tr.details td.details-control {
            background: url('components/images/details_close.png') no-repeat center center;
        }
    </style>
  </head>
  <body>
    <div class="container-fluid"> 
    <h1>Lista de Clientes</h1>
    <button type="button" onclick="mostrarModal()" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#editarinfo" style="margin-top: 7px;"><i class="bi bi-person-plus-fill"></i> Adicionar</button>     
        <table id="clientes" class="table">
            <thead>
                <tr>
                    <th></th>
                    <th>Id</th>
                    <th>Nome</th>
                    <th>CPF_CNPJ</th>
                    <th>CEP</th>
                    <th>Endereco</th>
                    <th>Numero</th>
                    <th>Bairro</th>
                    <th>Cidade</th>
                    <th>UF</th>
                    <th>Compl.</th>
                    <th>Fone</th>
                    <th>Acoes</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
    <div class="modal fade" id="editarinfo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div class="mb-3">
            <label class="form-label">Id Usuário</label>
            <input type="text" class="form-control" id="idusuario">
        </div>
        <div class="mb-3">
            <label class="form-label">Nome</label>
            <input type="text" class="form-control" id="nome">
        </div>
        <div class="mb-3">
            <label class="form-label">CPF_CNPJ</label>
            <input type="text" class="form-control" id="cpf_cnpj">
        </div>
        
        <div class="row g-2 mb-3">
            <div class="col-auto">
                <label class="form-label">CEP</label>
                <input type="text" class="form-control" id="cep">
            </div>
            <div class="col-auto pt-4">
                <button type="button" onclick="pesquisaCEP()" class="btn btn-primary" style="margin-top: 7px;">Pesquisar</button>
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label">End.</label>
            <input type="text" class="form-control" id="endereco" readonly>
        </div>
        <div class="mb-3">
            <label class="form-label">Numero</label>
            <input type="text" class="form-control" id="numero">
        </div>
        <div class="mb-3">
            <label class="form-label">Bairro</label>
            <input type="text" class="form-control" id="bairro" readonly>
        </div>
        <div class="row mb-3">
            <div class="col-auto">
                <label class="form-label">Cidade</label>
                <input type="text" class="form-control" id="cidade" readonly>
            </div>
            <div class="col-auto">
                <label class="form-label">Estado</label>
                <input type="text" class="form-control" id="uf" readonly>
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label">Compl.</label>
            <input type="text" class="form-control" id="compl">
        </div>
        <div class="row mb-3">
            <div class="col-auto">
                <label class="form-label">Tel.</label>
                <input type="text" class="form-control" id="fone">
            </div>
            <div class="col-auto">
                <label class="form-label">Codigo</label>
                <input type="text" class="form-control" id="codigo">
            </div>
        </div>
        <div class="row">
            <div class="col-auto">
                <label class="form-label">Limite Crédito.</label>
                <input type="text" class="form-control" id="limcredito">
            </div>
            <div class="col-auto">
                <label class="form-label">Validade.</label>
                <input type="date" class="form-control" id="dtvalidade">
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
        <button type="button" id="btn-salvar" class="btn btn-primary">Salvar</button>
      </div>
    </div>
  </div>
</div>
    <script>
        var dt = "";
        var detailRows = [];
        function carregarTabela(){
            dt = $('#clientes').DataTable({
                "oLanguage": {
                    "sUrl": "components/js/pt-BR.json"
                },
                "destroy": true,
                "processing": true,
                "ajax": {
                    "url": 'http://localhost:8080/php-api-rest/public_html/api/cliente',
                    //"url": 'http://localhost/php-api-rest/public_html/api/cliente',
                    "dataSrc": 'data'
                },
                columns: [
                {
                    "class":          "details-control",
                    "orderable":      false,
                    "searchable":       false,
                    "data":           null,
                    "defaultContent": ""
                },
                    { data: 'Id' },
                    { data: 'Nome' },
                    { data: 'CPF_CNPJ' },
                    { data: 'CEP' },
                    { data: 'Endereco' },
                    { data: 'Numero' },
                    { data: 'Bairro' },
                    { data: 'Cidade' },
                    { data: 'UF' },
                    { data: 'Complemento' },
                    { data: 'Fone' },
                    { data: 'Id',
                    render: function (data, type, row){
                        var html =  '<button type="button" id="bt-editar" class="bg-transparent border-0" data-bs-toggle="modal" data-bs-target="#editarinfo" onclick=editar('+row.Id+')><i class="bi-card-text" style="font-size: 1rem; color: cornflowerblue;"></i></buton>'+
                                    '<button type="button" id="bt-excluir" class="bg-transparent border-0" data-bs-toggle="modal" data-bs-target="#excluirinfo" onclick=deletar('+row.Id+')><i class="bi-x-square" style="font-size: 1rem; color: cornflowerblue;"></i></buton>';
                        return html;
                    },
                    
                }/*,
                    { data: 'LimiteCredito' },
                    { data: 'Validade' },
                    { data: 'created_at' },
                    { data: 'update_at' }*/
                ]
            });
            }
        function setarDados(d){
            console.log(d.DataHoraCadastro);
            var data = new Date(d.DataHoraCadastro);            
            $("#idusuario").val(d.IdUsuario);
            $("#nome").val(d.Nome);
            $("#cpf_cnpj").val(d.CPF_CNPJ);
            $("#cep").val(d.CEP);
            $("#endereco").val(d.Endereco);
            $("#numero").val(d.Numero);
            $("#bairro").val(d.Bairro);
            $("#cidade").val(d.Cidade);
            $("#uf").val(d.UF);
            $("#compl").val(d.Complemento);
            $("#fone").val(d.Fone);
            $("#limcredito").val(d.LimiteCredito);
            $("#dtvalidade").val(data.toISOString().split('T')[0]);

        }
        function pesquisaCEP(){
            var cep = $("#cep").val();
            console.log(cep.length);
            if(cep.length <= 7){
                cep = '0'+cep;
            }
            var url = 'https://viacep.com.br/ws/'+cep+'/json/';
            axios.get(url)
                .then((response) => {
                    console.log(response.data)
                    $("#endereco").val(response.data.logradouro);     
                    $("#numero").val("");          
                    $("#bairro").val(response.data.bairro);
                    $("#cidade").val(response.data.localidade);
                    $("#uf").val(response.data.uf);
                })
                .catch((err) => {
                    console.error("ops! ocorreu um erro" + err);
            });

        }
        function deletar(id){
           
            var url = 'http://localhost:8080/php-api-rest/public_html/api/cliente/'+id;
            axios.delete(url)
                .then((response) => {
                    carregarTabela();
                })
                .catch((err) => {
                    console.error("ops! ocorreu um erro" + err);
            });
        }
        function mostrarModal(){
            $("#idusuario").val("");
            $("#nome").val("");
            $("#cpf_cnpj").val("");
            $("#cep").val("");
            $("#endereco").val("");
            $("#numero").val("");
            $("#bairro").val("");
            $("#cidade").val("");
            $("#uf").val("");
            $("#compl").val("");
            $("#fone").val("");
            $("#limcredito").val("");
            $("#dtvalidade").val("");
            $('#btn-salvar').attr('onclick', 'inserir()');
        }
        function inserir(){
            var data = new Date(); 
            data = data.toISOString().split('T')[0]
            var idusuario   = $("#idusuario").val();
            var nome        = $("#nome").val();
            var cpf_cnpj    = $("#cpf_cnpj").val();
            var cep         = $("#cep").val();
            var endereco    = $("#endereco").val();
            var numero      = $("#numero").val();
            var bairro      = $("#bairro").val();
            var cidade      = $("#cidade").val();
            var uf          = $("#uf").val();
            var compl       = $("#compl").val();
            var fone        = $("#fone").val();
            var limcredito  = $("#limcredito").val();
            var dtvalidade  = $("#dtvalidade").val();
            var codigo      = $("#codigo").val();
            var body = {
                idusuario: idusuario,  
                nome: nome,
                cpf_cnpj: cpf_cnpj,
                codigo: codigo,
                cep: cep,
                endereco: endereco, 
                numero:  numero,
                bairro: bairro,
                cidade: cidade,
                uf:  uf,
                compl: compl,
                fone: fone,
                limcredito: limcredito,
                validade: dtvalidade,
                dtcadastro: data
            }
            var url = 'http://localhost:8080/php-api-rest/public_html/api/cliente';
            axios.post(url, body, {
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            })
                .then((response) => {                    
                    carregarTabela();
                })
                .catch((err) => {
                    console.error("ops! ocorreu um erro" + err);
            });
        }
        function atualizar(id){
            var idusuario   = $("#idusuario").val();
            var nome        = $("#nome").val();
            var cpf_cnpj    = $("#cpf_cnpj").val();
            var cep         = $("#cep").val();
            var endereco    = $("#endereco").val();
            var numero      = $("#numero").val();
            var bairro      = $("#bairro").val();
            var cidade      = $("#cidade").val();
            var uf          = $("#uf").val();
            var compl       = $("#compl").val();
            var fone        = $("#fone").val();
            var limcredito  = $("#limcredito").val();
            var dtvalidade  = $("#dtvalidade").val();
            var body = {
                idusuario: idusuario,  
                nome: nome,
                cpf_cnpj: cpf_cnpj,
                cep: cep,
                endereco: endereco, 
                numero:  numero,
                bairro: bairro,
                cidade: cidade,
                uf:  uf,
                compl: compl,
                fone: fone,
                limcredito: limcredito,
                dtvalidade: dtvalidade
            }
            var url = 'http://localhost:8080/php-api-rest/public_html/api/cliente/'+id;
            axios.put(url, body, {
                headers: {"Content-Type": "multipart/form-data"}
            })
                .then((response) => {
                    carregarTabela();
                })
                .catch((err) => {
                    console.error("ops! ocorreu um erro" + err);
            });
        }
        function editar(id){
            console.log(id);
            var url = 'http://localhost:8080/php-api-rest/public_html/api/cliente/'+id;
            axios.get(url)
                .then((response) => {
                    setarDados(response.data.data)
                    $('#btn-salvar').attr('onclick', 'atualizar('+id+')');
                })
                .catch((err) => {
                    console.error("ops! ocorreu um erro" + err);
            });

        }
        $(document).ready(function () {
            carregarTabela();
            
            //$('#clientes tbody').on( 'click', 'tr', function () {
                function informacoes ( d ) {
                    return  'IdUsuario: '+d.IdUsuario+'<br>'+
                            'Data Cadastro: '+d.DataHoraCadastro+'<br>'+
                            'Código: '+d.Codigo+'<br>'+
                            'Limite Crédito: '+d.LimiteCredito+'<br>'+
                            'Validade: '+d.Validade+'<br>'+
                            'Criado em: '+d.created_at+'<br>'+
                            'Alterar em: '+d.update_at+'<br>';
                }
                
                
                
            $('#clientes tbody').on( 'click', 'tr td:first-child', function () {
                var tr = $(this).parents('tr');
                var row = dt.row( tr );
                var idx = $.inArray( tr.attr('id'), detailRows );
        
                if ( row.child.isShown() ) {
                    tr.removeClass( 'details' );
                    row.child.hide();
        
                    detailRows.splice( idx, 1 );
                }
                else {
                    tr.addClass( 'details' );
                    row.child( informacoes( row.data() ) ).show();
        
                    if ( idx === -1 ) {
                        detailRows.push( tr.attr('id') );
                    }
                }
            });        
            
            dt.on( 'draw', function () {
                $.each( detailRows, function ( i, id ) {
                    $('#'+id+' td:first-child').trigger( 'click' );
                });
            });            
        });
    </script>
  </body>
</html>