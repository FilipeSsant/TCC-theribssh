<!--Div de Cadastro-->
<div id="div_foraNovaSenha" style="background-color:<?php echo($corPrimaria); ?>;">
    <!--Botão fechar-->
    <div class="botao_fecharPopUp" onClick="fecharPopUpAlterarSenha()" style="background-color:<?php echo($corQuartenaria); ?>;">
        <img src="../img/fecharPopUp.png" alt="">
    </div>
    <!--Div de Login-->
    <div id="div_novaSenha">
        <!--Título div Cadastro-->
        <div class="titulo_loginCadastro">
            <!--Linha atras do Titulo-->
            <div class="linha_atrasDoTitulo" style="background-color:<?php echo($corQuartenaria); ?>;">
            </div>
            <!--Texto do Título-->
            <div class="divTexto_loginCadastro" style="background-color:<?php echo($corPrimaria); ?>;">
                <span style="color:<?php echo($corSecundaria); ?>;">Altere sua senha</span>
            </div>
        </div>
        <script>
            //Verifica se a senha digitada no "confirmar senha" tem semelhança com a senha que o usuário digitou inicialmente
            function verificarConfSenha(){
                //Coloca na variavel o value que está na caixa
                var dadosSenhaAjax = $("#texto_senhaPerf").val();
                var dadosConfSenhaAjax = $("#texto_confirmarSenhaPerf").val();
                //Coloca na variavel a url que vai redirecionar para fazer o processo
                var url = "../ajax/verificarSenha.php";

                $.ajax({
                    //Define o método
                    method:"POST",
                    //Define a url
                    url:url,
                    //Coloca em formato JSON as informações para passar pelo POST
                    data:{caixasenha:dadosSenhaAjax, caixaconfirmarsenha:dadosConfSenhaAjax},
                    success:function(dados){
                        //Manda os dados que será concebido como $resultado para a div ou input em questão
                        $("#verificar_senhaPerf").html(dados);
                    }

                });
            }
        </script>
        <!--Formulário de preenchimento para Login-->
        <div class="formulario_cadastro">
            <form name="formAlterarSenha" method="post" action="meuperfil.php">
                <!--Senha atual-->
                <input class="input_texto" type="password" name="txt_senhaAtual" placeholder="Digite sua senha atual" onkeypress="semEspaco(event)" required><br>
                <!--Nova senha-->
                <input id="texto_senhaPerf" class="input_texto" type="password" name="txt_senha" placeholder="Digite sua nova senha" onkeypress="semEspaco(event)" required><br>
                <!--Imagem para ao clique revelar a senha
                    No qual o onmousedown serve para no clique revelar e onmouseup ao soltar do clique
                    a senha voltar ao formato password
                -->
                <div class="ver_senha" onmousedown="textSenha()" onkeypress="semEspaco(event)" onmouseup="passwordSenha()">
                    <img src="../img/revelarSenha.png" alt="">
                </div>
                <input id="texto_confirmarSenhaPerf" class="input_texto" type="password" name="txt_confirmarSenha" placeholder="Confirme sua senha" onkeypress="semEspaco(event)" onkeyup="verificarConfSenha()" required><br>
                <!--Div para verificação da condição existente em algumas inputs-->
                <div class="div_condicao" id="verificar_senhaPerf">
                </div>
                <!--Botão Cadastrar-->
                <button class="botao_formulario" name="btnMudarSenha" style="background-color:<?php echo($corPrimaria); ?>;">
                    <span style="color:<?php echo($corSecundaria); ?>;">Alterar</span>
                </button>
            </form>
        </div>
    </div>
</div>
