<?php

    if(isset($_GET['alterar'])){
        $idC = $_GET['id'];
        //Select de informações do usuário
        $sql = "select c.login, c.senha, c.nome, c.sobrenome, c.celular, c.telefone, 
                c.email, e.logradouro, e.bairro, e.rua, e.aptbloco, e.numero, cid.id_cidade ,
                est.id_estado from tbl_cliente as c 
                inner join tbl_endereco as e on c.id_endereco = e.id_endereco 
                inner join tbl_cidade as cid on e.id_cidade = cid.id_cidade 
                inner join tbl_estado as est on cid.id_estado = est.id_estado where id_cliente = ".$idC;

        $select = mysql_query($sql) or die(mysql_error());

        if($rs=mysql_fetch_array($select)){
            //Resgatando valores digitados pelo usuário
            $login = $rs['login'];
            $nome = $rs['nome'];
            $sobrenome = $rs['sobrenome'];
            $email = $rs['email'];
            $celular = $rs['celular'];
            $telefone = $rs['telefone'];
            $logradouro = $rs['logradouro'];
            $rua = $rs['rua'];
            $bairro = $rs['bairro'];
            $numeroResidencia = $rs['numero'];
            $seletorDoEstado = $rs['id_estado'];
            $seletorDaCidade = $rs['id_cidade'];
            $apartamentobloco = $rs['aptbloco'];

            //usa o comando explode para separar em vetor as informações
            //que estão agrupadas por "-"
            $partes = explode("-", $apartamentobloco);
            

            $sql2 = "select * from tbl_cartaocredito where id_cliente = ".$idC;

            $select2 = mysql_query($sql2);

            if($rs2=mysql_fetch_array($select2)){
                @$seletorBandeiraDoCartao = $rs2['id_banco'];
                $numCartao = $rs2['numero'];
                $nomeRegistradoCartao = $rs2['nome_cartao'];
                $dataValidade = $rs2['data'];
                $CVV = $rs2['cvv'];
            } 
            
            ?>
                <script>
                    $(document).ready(function(){
                        abrirPopUpAlterar();
                    });
                </script>    
            <?php
?>
<!--Div de Cadastro-->
<div id="div_foraAlterar" style="background-color:<?php echo($corPrimaria); ?>;">
    <!--Botão fechar-->
    <div class="botao_fecharPopUp" onClick="fecharPopUpCadastroAlterar()" style="background-color:<?php echo($corQuartenaria); ?>;">
        <img src="../img/fecharPopUp.png" alt="">
    </div>
    <!--Div de Login-->
    <div id="div_alterar">
        <!--Título div Cadastro-->
        <div class="titulo_loginCadastro">
            <!--Linha atras do Titulo-->
            <div class="linha_atrasDoTitulo" style="background-color:<?php echo($corQuartenaria); ?>;">
            </div>
            <!--Texto do Título-->
            <div class="divTexto_loginCadastro" style="background-color:<?php echo($corPrimaria); ?>;">
                <span style="color:<?php echo($corSecundaria); ?>;">Altere seus dados</span>
            </div>
        </div>
        <!--Alerta para preenchimento-->

        <!--Formulário de preenchimento para Login-->
        <div class="formulario_cadastro">
            <form name="formAlterar" method="post" action="meuperfil.php">
                <!--Login-->
                <input value="<?php echo($login); ?>" id="caixa_loginCadastro" class="input_texto" type="text" name="txt_login" placeholder="Login" onkeypress="semEspaco(event)" onkeyup="verificarLoginAlterarMP()" required><br>
                <!--Div para verificação da condição existente em algumas inputs-->
                <div class="div_condicao" name="verificar_login">
                </div>
                <!--Nome-->
                <input value="<?php echo($nome); ?>" class="input_texto_lateral" type="text" name="txt_nome" placeholder="Nome">
                <!--Sobrenome-->
                <input value="<?php echo($sobrenome); ?>" class="input_texto_lateral" type="text" name="txt_sobrenome" placeholder="Sobrenome"><br>
                <input id="texto_senhaAlterarMP" class="input_texto" type="password" name="txt_senha" placeholder="Senha" onkeypress="semEspaco(event)" required><br>
                <!--Imagem para ao clique revelar a senha
                    No qual o onmousedown serve para no clique revelar e onmouseup ao soltar do clique
                    a senha voltar ao formato password
                -->
                <div class="ver_senha" onmousedown="textSenha()" onmouseup="passwordSenha()">
                    <img src="../img/revelarSenha.png" alt="">
                </div>
                <!--Confirmar a Senha-->
                <input id="texto_confirmarSenhaAlterarMP" class="input_texto" type="password" name="txt_confirmarSenha" placeholder="Confirme sua senha" onkeypress="semEspaco(event)" onkeyup="verificarConfSenhaAlterarMP()" required><br>
                <!--Div para verificação da condição existente em algumas inputs-->
                <div class="div_condicao" id="verificar_senhaAlterarMP">
                </div>
                <!--E-mail-->
                <input id="caixa_emailCadastroAlterarMP" value="<?php echo($email); ?>" class="input_texto" type="email" name="txt_email" onkeypress="semEspaco(event)" onkeyup="verificarEmailAlterarMP()" placeholder="E-mail"><br>
                <!--Celular-->
                <input value="<?php echo($celular); ?>" class="input_texto" id="celular" maxlength="15" type="text" name="txt_celular" placeholder="Celular"><br>
                <!--Telefone-->
                <input value="<?php echo($telefone); ?>" class="input_texto" id="telefone" type="text" name="txt_telefone" placeholder="Telefone"><br>
                <!--Caixa de seleção dos Estados-->
                <select id="selectEstado" class="select" name="selectEstado" onchange="pegarId()">
                    <option selected disabled>Selecione um Estado</option>
                    <?php
					//Seleciona tudo da tabela estado
                    $sql = "select * from tbl_estado";

				    $select = mysql_query($sql) or die(mysql_error());

                    while($rs=mysql_fetch_array($select)){
                        $idEstado=$rs['id_estado'];
                        $nomeEstado=$rs['nome'];
                        
                        //Se o id que é pego no select do alterar for igual
                        //Um dos selects encotrados aqui, ele automaticamente
                        //Adiciona o value "selected" para esse ID
                        if($seletorDoEstado == $idEstado){
                            $optionSelecionado = "selected";
                        }else{
                            $optionSelecionado = "";
                        }
                    ?>
                    <option <?php echo($optionSelecionado); ?> value="<?php echo($idEstado); ?>"><?php echo($nomeEstado); ?></option>
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
                    
                    //Verifica se a senha digitada no "confirmar senha" tem semelhança com a senha que o usuário digitou inicialmente
                    function verificarConfSenhaAlterarMP(){
                        //Coloca na variavel o value que está na caixa
                        var dadosSenhaAjax = $("#texto_senhaAlterarMP").val();
                        var dadosConfSenhaAjax = $("#texto_confirmarSenhaAlterarMP").val();
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
                                $("#verificar_senhaAlterarMP").html(dados);
                            }

                        });
                    }
                    
                    //Verifica o input de login fazendo uma busca em tempo real no banco para compara se o login ja existe
                    function verificarEmailAlterarMP(){
                        //Coloca na variavel o value que está na caixa
                        var dadosEmailAjax = $("#caixa_emailCadastroAlterarMP").val();
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

                    //Verifica o input de login fazendo uma busca em tempo real no banco para compara se o login ja existe
                    function verificarLoginAlterarMP(){
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
                                $(".div_condicao[name='verificar_login']").html(dados);
                            }

                        });

                    }
                </script>
				<!--Caixa de seleção de Cidades-->
                <select class="select" name="selectCidade">
                    <option disabled>Selecione uma Cidade</option>
                    <?php
                    
                        //Seleciona tudo da tabela estado
                        $sql = "select * from tbl_cidade where id_cidade = ".$seletorDaCidade;
                        echo($sql);

                        $select = mysql_query($sql) or die(mysql_error());

                        while($rs=mysql_fetch_array($select)){
                            $idCidade=$rs['id_cidade'];
                            $nomeCidade=$rs['nome'];

                            //Se o id que é pego no select do alterar for igual
                            //Um dos selects encotrados aqui, ele automaticamente
                            //Adiciona o value "selected" para esse ID
                            if($seletorDaCidade == $idCidade){
                                $optionSelecionado = "selected";
                            }else{
                                $optionSelecionado = "";
                            }
                    ?>
                    <option <?php echo($optionSelecionado); ?> value="<?php echo($idCidade); ?>"><?php echo($nomeCidade); ?></option>
                    
                    <?php
                        }
                    ?>
                </select><br>
                <!--Logradouro-->
                <input value="<?php echo($logradouro); ?>" class="input_texto" type="text" name="txt_logradouro" placeholder="Logradouro"><br>
                <!--Rua-->
                <input value="<?php echo($rua); ?>" class="input_texto" type="text" name="txt_rua" placeholder="Rua"><br>
                <!--Bairro-->
                <input value="<?php echo($bairro); ?>" class="input_texto_lateral" type="text" name="txt_bairro" placeholder="Bairro">
                <!--Número-->
                <input value="<?php echo($numeroResidencia); ?>" class="input_texto_lateral" type="text" maxlength="4" name="txt_numeroResidencia" onkeypress="semEspaco(event)"  placeholder="Número"><br>
                <!--Bloco-->
                <input value="<?php echo($partes[1]); ?>" class="input_texto_lateral" type="text" maxlength="3" name="txt_bloco" onkeypress="semEspaco(event)" placeholder="Bloco">
                <!--Apartamento-->
                <input value="<?php echo($partes[0]); ?>" class="input_texto_lateral" type="text" maxlength="3" name="txt_apartamento" onkeypress="semEspaco(event)" placeholder="Apartamento"><br>
                <!--Caixa de seleção de Bandeiras de Cartões-->
                <select class="select" name="selectBandeiraDoCartao" onchange="desbloquearCampos()">
                    <option selected value="0">Selecione uma Bandeira</option>
                    <?php
					//Seleciona tudo da tabela estado
                    $sql = "select * from tbl_banco";

				    $select = mysql_query($sql) or die(mysql_error());

                    while($rs=mysql_fetch_array($select)){
                        $idBanco=$rs['id_banco'];
                        $nomeBanco=$rs['nome'];
                        
                        //Se o id que é pego no select do alterar for igual
                        //Um dos selects encotrados aqui, ele automaticamente
                        //Adiciona o value "selected" para esse ID
                        if($seletorBandeiraDoCartao == $idBanco){
                            $optionSelecionado = "selected";
                        }else{
                            $optionSelecionado = "";
                        }
                    ?>
                    <option <?php echo($optionSelecionado); ?> value="<?php echo($idBanco); ?>"><?php echo($nomeBanco); ?></option>
                    <?php
                        }
                    ?>
                </select><br>
                <!--Num de cartão-->
                <input value="<?php echo($numCartao); ?>" class="input_textoC" id="cartao_de_credito" maxlength="19" type="text" name="txt_numCartao" placeholder="Número do Cartão de Crédito"><br>
                <!--Nome registrado no Cartão-->
                <input value="<?php echo($nomeRegistradoCartao); ?>" class="input_textoC" type="text" name="txt_nomeNoCartao" placeholder="Nome registrado no cartão"><br>
                <!--Data de Validade-->
                <input value="<?php echo($dataValidade); ?>" class="input_texto_lateralC" id="data_validade" maxlength="7" type="text" name="txt_dataValidade" placeholder="mm/aaaa">
                <!--Div Informativa-->
                <div class="div_informativa">
                    <img src="../img/cvv.png" alt="">
                </div>
                <!--Ícone para abrir janela explicativa-->
                <div class="icone_explicativo" onmouseover="abrirJanelaInformativa()" onmouseout="fecharJanelaInformativa()">
                    <img src="../img/duvida.ico" alt="">
                </div>
                <!--CVV-->
                <input value="<?php echo($CVV); ?>" class="input_texto_lateralC" maxlength="3" type="text" name="txt_cvv" onkeypress="semEspaco(event)" placeholder="CVV"><br>
                <!--Botão Cadastrar-->
                <button class="botao_formulario" type="submit" name="btnAlterar" style="background-color:<?php echo($corPrimaria); ?>;">
                    <span style="color:<?php echo($corSecundaria); ?>;">Alterar</span>
                </button>
            </form>
        </div>
    </div>
</div>
<?php

        }
    }
?>
