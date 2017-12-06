<!--Div de Cadastro-->
<div id="div_foraCadastro" style="background-color:<?php echo($corPrimaria); ?>;">
    <!--Botão fechar-->
    <div class="botao_fecharPopUp" onClick="fecharPopUpCadastro()" style="background-color:<?php echo($corQuartenaria); ?>;">
        <img src="../img/voltarIcon.png" alt="">
    </div>
    <!--Div de Login-->
    <div id="div_cadastro">
        <!--Título div Cadastro-->
        <div class="titulo_loginCadastro">
            <!--Linha atras do Titulo-->
            <div class="linha_atrasDoTitulo" style="background-color:<?php echo($corQuartenaria); ?>;">
            </div>
            <!--Texto do Título-->
            <div class="divTexto_loginCadastro" style="background-color:<?php echo($corPrimaria); ?>;">
                <span style="color:<?php echo($corSecundaria); ?>;">Crie uma conta</span>
            </div>
        </div>
        <!--Alerta para preenchimento-->
        <div id="alerta_preenchimento" style="background-color:<?php echo($corQuartenaria); ?>;">
            <span style="color:<?php echo($corSecundaria); ?>;">Os campos com * são obrigatórios o preenchimento</span>
        </div>
        <!--Formulário de preenchimento para Login-->
        <div class="formulario_cadastro">
            <form name="formCadastro" method="post" action="#">
                <!--Login-->
                <span class="asterisco">*</span><input id="caixa_loginCadastro" class="input_texto" type="text" name="txt_login" placeholder="Login" onkeypress="semEspaco(event)" onkeyup="verificarLogin()" required><br>
                <!--Div para verificação da condição existente em algumas inputs-->
                <div class="div_condicao" id="verificar_login">
                </div>
                <!--Senha-->
                <span class="asterisco">*</span><input id="texto_senha" class="input_texto" type="password" name="txt_senha" placeholder="Senha" onkeypress="semEspaco(event)" required><br>
                <!--Imagem para ao clique revelar a senha
                    No qual o onmousedown serve para no clique revelar e onmouseup ao soltar do clique
                    a senha voltar ao formato password
                -->
                <div class="ver_senha" onmousedown="textSenha()" onmouseup="passwordSenha()">
                    <img src="../img/revelarSenha.png" alt="">
                </div>
                <!--Confirmar a Senha-->
                <span class="asterisco">*</span>
                <input id="texto_confirmarSenha" class="input_texto" type="password" name="txt_confirmarSenha" placeholder="Confirme sua senha" onkeypress="semEspaco(event)" onkeyup="verificarConfSenha()" required><br>
                <!--Div para verificação da condição existente em algumas inputs-->
                <div class="div_condicao" id="verificar_senha">
                </div>
                <!--Nome-->
                <span class="asterisco">*</span>
                <input class="input_texto_lateral" type="text" name="txt_nome" placeholder="Nome" required>
                <!--Sobrenome-->
                <span class="asterisco">*</span>
                <input class="input_texto_lateral" type="text" name="txt_sobrenome" placeholder="Sobrenome" required><br>
                <!--E-mail-->
                <span class="asterisco">*</span>
                <input class="input_texto" id="caixa_emailCadastro" type="email" name="txt_email" onkeyup="verificarEmail()" onkeypress="semEspaco(event)" placeholder="E-mail"><br>
                <!--Div para verificação da condição existente em algumas inputs-->
                <div class="div_condicao" id="verificar_email">
                </div>
                <!--Celular-->
                <span class="asterisco">*</span>
                <input class="input_texto" id="celular" maxlength="15" type="text" name="txt_celular" placeholder="Celular" required><br>
                <!--Telefone-->
                <input class="input_texto" id="telefone" type="text" name="txt_telefone" placeholder="Telefone"><br>
                <!--Caixa de seleção dos Estados-->
                <span class="asterisco">*</span>
                <select id="selectEstado" class="select" name="selectEstado" onchange="pegarId()" required>
                    <option value="" selected disabled>Selecione um Estado</option>
                    <?php
					//Seleciona tudo da tabela estado
                    $sql = "select * from tbl_estado";

				    $select = mysql_query($sql) or die(mysql_error());

                    while($rs=mysql_fetch_array($select)){
      							$idEstado=$rs['id_estado'];
      							$nomeEstado=$rs['nome'];
                    ?>
                    <option value="<?php echo($idEstado); ?>"><?php echo($nomeEstado); ?></option>
                    <?php
                        }
                    ?>
                </select><br>
				<!--Ajax para pegar o id selecionado pelo usuário no Estado-->
                <script>
                    //Pega o id do Estado para fazer um select na cidade correspondida ao estado
                    function pegarId(){
                        //Coloca na variavel o value que está na caixa
                        var idEstadoAjax = $("#selectEstado option:checked").val();
                        //Coloca na variavel a url que vai redirecionar para fazer o processo
                        var url = "../ajax/processo_pegarId.php";

                        $.ajax({
                            //Define o método
                            method:"POST",
                            //Define a url
                            url:url,
                            //Coloca em formato JSON as informações para passar pelo POST
                            data:{idestadoajax:idEstadoAjax},
                            success:function(dados){
                                //Manda os dados que será concebido como $resultado para a div ou input em questão
                                $(".select[name='selectCidade']").html(dados);
                            }

                        });

                    }

                    //Verifica o input de login fazendo uma busca em tempo real no banco para compara se o login ja existe
                    function verificarLogin(){
                        //Coloca na variavel o value que está na caixa
                        var dadosLoginAjax = $("#caixa_loginCadastro").val();
                        //Coloca na variavel a url que vai redirecionar para fazer o processo
                        var url = "../ajax/verificarLogin.php";

                        $.ajax({
                            //Define o método
                            method:"POST",
                            //Define a url
                            url:url,
                            //Coloca em formato JSON as informações para passar pelo POST
                            data:{caixalogin:dadosLoginAjax},
                            success:function(dados){
                                //Manda os dados que será concebido como $resultado para a div ou input em questão
                                $("#verificar_login").html(dados);
                            }

                        });

                    }

                    //Verifica o input de login fazendo uma busca em tempo real no banco para compara se o login ja existe
                    function verificarEmail(){
                        //Coloca na variavel o value que está na caixa
                        var dadosEmailAjax = $("#caixa_emailCadastro").val();
                        //Coloca na variavel a url que vai redirecionar para fazer o processo
                        var url = "../ajax/verificarEmail.php";

                        $.ajax({
                            //Define o método
                            method:"POST",
                            //Define a url
                            url:url,
                            //Coloca em formato JSON as informações para passar pelo POST
                            data:{caixaemail:dadosEmailAjax},
                            success:function(dados){
                                //Manda os dados que será concebido como $resultado para a div ou input em questão
                                $("#verificar_email").html(dados);
                            }

                        });
                    }

                    //Verifica se a senha digitada no "confirmar senha" tem semelhança com a senha que o usuário digitou inicialmente
                    function verificarConfSenha(){
                        //Coloca na variavel o value que está na caixa
                        var dadosSenhaAjax = $("#texto_senha").val();
                        var dadosConfSenhaAjax = $("#texto_confirmarSenha").val();
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
                                $("#verificar_senha").html(dados);
                            }

                        });
                    }
                </script>
				<!--Caixa de seleção de Cidades-->
                <span class="asterisco">*</span>
                <select class="select" name="selectCidade" required>
                    <option value="" selected disabled>Selecione uma Cidade</option>
                </select><br>
                <!--Logradouro-->
                <input id="test" class="input_texto" type="text" name="txt_logradouro" placeholder="Logradouro"><br>
                <!--Rua-->
                <span class="asterisco">*</span>
                <input class="input_texto" type="text" name="txt_rua" placeholder="Rua" required><br>
                <!--Bairro-->
                <span class="asterisco">*</span>
                <input class="input_texto_lateral" type="text" name="txt_bairro" placeholder="Bairro" required>
                <!--Número-->
                <span class="asterisco">*</span>
                <input class="input_texto_lateral" type="text" maxlength="4" name="txt_numeroResidencia" onkeypress="semEspaco(event)"  placeholder="Número" required><br>
                <!--Bloco-->
                <input class="input_texto_lateral" type="text" maxlength="3" name="txt_bloco" onkeypress="semEspaco(event)" placeholder="Bloco">
                <!--Apartamento-->
                <input class="input_texto_lateral" type="text" maxlength="3" name="txt_apartamento" onkeypress="semEspaco(event)" placeholder="Apartamento"><br>
                <!--Caixa de seleção de Bandeiras de Cartões-->
                <select class="select" name="selectBandeiraDoCartao" onchange="desbloquearCampos()">
                    <option selected value="">Selecione uma Bandeira</option>
                    <?php
					//Seleciona tudo da tabela estado
                    $sql = "select * from tbl_banco";

				    $select = mysql_query($sql) or die(mysql_error());

                    while($rs=mysql_fetch_array($select)){
                        $idBanco=$rs['id_banco'];
                        $nomeBanco=$rs['nome'];
                    ?>
                    <option value="<?php echo($idBanco); ?>"><?php echo($nomeBanco); ?></option>
                    <?php
                        }
                    ?>
                </select><br>
                <!--Num de cartão-->
                <input class="input_textoC" id="cartao_de_credito" maxlength="19" type="text" name="txt_numCartao" placeholder="Número do Cartão de Crédito"><br>
                <!--Nome registrado no Cartão-->
                <input class="input_textoC" type="text" name="txt_nomeNoCartao" placeholder="Nome registrado no cartão"><br>
                <!--Data de Validade-->
                <input class="input_texto_lateralC" id="data_validade" maxlength="7" type="text" name="txt_dataValidade" placeholder="mm/aaaa">
                <!--Div Informativa-->
                <div class="div_informativa">
                    <img src="../img/cvv.png" alt="">
                </div>
                <!--Ícone para abrir janela explicativa-->
                <div class="icone_explicativo" onmouseover="abrirJanelaInformativa()" onmouseout="fecharJanelaInformativa()">
                    <img src="../img/duvida.ico" alt="">
                </div>
                <!--CVV-->
                <input class="input_texto_lateralC" maxlength="3" type="text" name="txt_cvv" onkeypress="semEspaco(event)" placeholder="CVV"><br>
                <!--Botão Cadastrar-->
                <button class="botao_formulario" name="btnCadastrar" style="background-color:<?php echo($corPrimaria); ?>;">
                    <span style="color:<?php echo($corSecundaria); ?>;">Cadastrar</span>
                </button>
            </form>
        </div>
    </div>
</div>
