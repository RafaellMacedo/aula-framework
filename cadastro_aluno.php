<?php
include "resources/layout/header.php"
?>
<body>
    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <?php
            include "resources/layout/menu.php";
            ?>
        </nav>

        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Cadastro de Aluno
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.php">Home</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-edit"></i> Cadastro de Aluno
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="mensagem alert"></div>
                    <div class="col-lg-6">

                        <form role="form">

                            <input type="hidden" name="idaluno" id="idaluno" value=""/>

                            <div class="form-group">
                                <label>Nome</label>
                                <input class="form-control" name="nome" id="nome" placeholder="Informe o primeiro Nome">
                            </div>

                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Idade</label>
                                    <input class="form-control" name="idade" id="idade" maxlength="2">
                                </div>
                            </div>

                            <div class="col-lg-5">
                                <div class="form-group">
                                    <label>Sexo</label>
                                    <select class="form-control" name="sexo" id="sexo">
                                        <option value="">Selecione</option>
                                        <option value="feminino">Feminino</option>
                                        <option value="masculino">Masculino</option>
                                    </select>
                                </div>
                            </div>

                        </form>
                    </div>
                    <div class="col-lg-6">

                        <form role="form">

                            <div class="form-group">
                                <label>E-mail</label>
                                <input class="form-control" name="email" id="email" placeholder="Informe seu e-mail" type="email">
                            </div>

                            <div class="form-group">
                                <label>Curso</label>
                                <input class="form-control" name="curso" id="curso" placeholder="Informe seu curso">
                            </div>

                        </form>
                    </div>

                    <div class="col-lg-6">

                        <form role="form">
                            <button type="button" class="btn btn-success" id="btSalvar">Salvar</button>
                        </form>
                    </div>
                    
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th>Idade</th>
                                        <th>Sexo</th>
                                        <th>E-mail</th>
                                        <th>Curso</th>
                                        <th>Ação</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function(){
            $("li").removeClass("active");
            $("li.cadastro").addClass("active");

            function consultaAluno(){
                 $.ajax({
                    url: "data/alunoTable.php",
                    type: "POST",
                    data: {
                        action: "select"
                    }
                }).done(function(result) {
                    result = JSON.parse(result);
                    console.log(result.data);

                    $.each(result.data, function(index, value){

                        var count = $("table > tbody > tr").length;
                        count++;
                        
                        var tr = '<tr id="aluno_' + count + '">';
                        tr += '<td id="nome_' + count + '" data-nome="' + value.nome + '">' + value.nome + '</td>';
                        tr += '<td id="idade_' + count + '" data-idade="' + value.idade + '">' + value.idade + '</td>';
                        tr += '<td id="sexo_' + count + '" data-sexo="' + value.sexo + '">' + value.sexo + '</td>';
                        tr += '<td id="email_' + count + '" data-email="' + value.email + '">' + value.email + '</td>';
                        tr += '<td id="curso_' + count + '" data-curso="' + value.curso + '">' + value.curso + '</td>';
                        tr += '<td style="width:16%">';
                        tr += '<button type="button" class="btn btn-primary btEditar" id="btEditar_' + count + '">Editar</button>';
                        tr += '<button type="button" class="btn btn-danger btDeletar" id="btDeletar_' + count + '">Deletar</button>';
                        tr += '</td>';
                        tr += '</tr>';

                        $("table > tbody").append(tr);
                    });
                });
            }
            
            consultaAluno();

            $("#btSalvar").on("click",function(){
                limparCampos();
                var idaluno = $("#idaluno").val();
                var nome    = $("#nome").val();
                var idade   = $("#idade").val();
                var sexo    = $("#sexo").val();
                var email   = $("#email").val();
                var curso   = $("#curso").val();

                var erro = false;

                if(nome.length == 0){
                    $("#nome").css("border-color","red");
                    $("#nome").css("color","red");
                    erro = true;
                }

                if(idade.length == 0){
                    $("#idade").css("border-color","red");
                    $("#idade").css("color","red");
                    erro = true;
                }

                if(sexo.length == 0){
                    $("#sexo").css("border-color","red");
                    $("#sexo").css("color","red");
                    erro = true;
                }
                
                if(email.length == 0){
                    $("#email").css("border-color","red");
                    $("#email").css("color","red");
                    erro = true;
                }

                if(curso.length == 0){
                    $("#curso").css("border-color","red");
                    $("#curso").css("color","red");
                    erro = true;
                }

                if(erro == true){
                    $("div.mensagem").addClass("alert-danger").html("<h4>Preencha todos os campos</h4>").show();
                }else{
                    if(idaluno.length == 0){
                        var count = $("table > tbody > tr").length;
                        count++;
                        
                        var tr = '<tr id="aluno_' + count + '">';
                        tr += '<td id="nome_' + count + '" data-nome="' + nome + '">' + nome + '</td>';
                        tr += '<td id="idade_' + count + '" data-idade="' + idade + '">' + idade + '</td>';
                        tr += '<td id="sexo_' + count + '" data-sexo="' + sexo + '">' + sexo + '</td>';
                        tr += '<td id="email_' + count + '" data-email="' + email + '">' + email + '</td>';
                        tr += '<td id="curso_' + count + '" data-curso="' + curso + '">' + curso + '</td>';
                        tr += '<td style="width:16%">';
                        tr += '<button type="button" class="btn btn-primary btEditar" id="btEditar_' + count + '">Editar</button>';
                        tr += '<button type="button" class="btn btn-danger btDeletar" id="btDeletar_' + count + '">Deletar</button>';
                        tr += '</td>';
                        tr += '</tr>';

                        $("table > tbody").append(tr);
                        $("div.mensagem").addClass("alert-success").html("<h4>Cadastrado com sucesso!</h4>").show();

                    }else{
                        $("tr[id=aluno_" + idaluno + "] > td[id=nome_" + idaluno + "]").removeAttr("data-nome");
                        $("tr[id=aluno_" + idaluno + "] > td[id=idade_" + idaluno + "]").removeAttr("data-idade");
                        $("tr[id=aluno_" + idaluno + "] > td[id=sexo_" + idaluno + "]").removeAttr("data-sexo");
                        $("tr[id=aluno_" + idaluno + "] > td[id=email_" + idaluno + "]").removeAttr("data-email");
                        $("tr[id=aluno_" + idaluno + "] > td[id=curso_" + idaluno + "]").removeAttr("data-curso");
                        
                        $("tr[id=aluno_" + idaluno + "] > td[id=nome_" + idaluno + "]").attr("data-nome",nome).html(nome);
                        $("tr[id=aluno_" + idaluno + "] > td[id=idade_" + idaluno + "]").attr("data-idade",idade).html(idade);
                        $("tr[id=aluno_" + idaluno + "] > td[id=sexo_" + idaluno + "]").attr("data-sexo",sexo).html(sexo);
                        $("tr[id=aluno_" + idaluno + "] > td[id=email_" + idaluno + "]").attr("data-email",email).html(email);
                        $("tr[id=aluno_" + idaluno + "] > td[id=curso_" + idaluno + "]").attr("data-curso",curso).html(curso);

                        
                    }
                    $("#idaluno").val("");
                    $("#nome").val("");
                    $("#idade").val("");
                    $('#sexo option').removeAttr('selected').filter('[value=""]').attr('selected', true);
                    $("#email").val("");
                    $("#curso").val("");
                }
            });

            $("#idade").on("keyup",function(){
                var idade = this.value;
                this.value = idade.replace(/[^\d]+/g,'');
            });

            $(document).on("click","button.btEditar",function(){
                var idaluno = this.id.replace(/[^\d]+/g,'');

                var nome  = $("tr[id=aluno_"+idaluno+"]").find('td[data-nome]').data('nome');
                var idade = $("tr[id=aluno_"+idaluno+"]").find('td[data-idade]').data('idade');
                var sexo  = $("tr[id=aluno_"+idaluno+"]").find('td[data-sexo]').data('sexo');
                var email = $("tr[id=aluno_"+idaluno+"]").find('td[data-email]').data('email');
                var curso = $("tr[id=aluno_"+idaluno+"]").find('td[data-curso]').data('curso');

                $("#nome").val(nome);
                $("#idade").val(idade);

                // $('#sexo option:contains("' + sexo + '")').prop('selected','selected');

                $('#sexo option').removeAttr('selected').filter('[value='+ sexo +']').prop('selected', true);

                $("#email").val(email);
                $("#curso").val(curso);
                $("#idaluno").val(idaluno);
            });

            $(document).on("click","button.btDeletar",function(){
                var idaluno = this.id.replace(/[^\d]+/g,'');
                if(confirm("Deseja realmente deletar este aluno?")){
                    $("#aluno_"+idaluno).remove();
                }
            });
        });

        function limparCampos(){
            $("#nome").css("border-color","");
            $("#nome").css("color","");

            $("#idade").css("border-color","");
            $("#idade").css("color","");

            $("#sexo").css("border-color","");
            $("#sexo").css("color","");
        
            $("#email").css("border-color","");
            $("#email").css("color","");

            $("#curso").css("border-color","");
            $("#curso").css("color","");

            $("div.mensagem").removeClass("alert-danger  alert-success").html("").hide();
        }
    </script>
    </body>
</html>