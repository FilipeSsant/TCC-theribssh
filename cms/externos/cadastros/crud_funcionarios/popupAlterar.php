<!--Div de Alterar-->
<div id="div_foraCadastro">
    <!--Botão fechar-->
    <a href="crud_funcionarios.php">
        <div class="botao_fecharPopUp" onClick="fecharPopUp(), normalizarFooter()">
            <img src="img/fecharPopUp.png" alt="">
        </div>
    </a>
    <!--Div de Login-->
    <div id="div_cadastro">
        <!--Título div Cadastro-->
        <div class="titulo_loginCadastro">
            <!--Linha atras do Titulo-->
            <div class="linha_atrasDoTitulo">
            </div>
            <!--Texto do Título-->
            <div class="div_tituloCadastro">
                <span><?php echo($tituloPopUp); ?> Funcionário</span>
            </div>
        </div>
        <!--Alerta para preenchimento-->
        <div id="alerta_preenchimento">
            Os campos com * são obrigatórios o preenchimento
        </div>
        <!--Formulário de preenchimento para Login-->
        <div id="formulario_cadastro">
            <form name="formCadastroFuncionario" method="post" action="crud_funcionarios.php" enctype="multipart/form-data">
                <!--Login-->
                <input value="<?php echo($login); ?>" id="caixa_loginCadastro" class="input_texto" type="text" name="txt_login" placeholder="Login" onkeypress="semEspaco(event)" onkeyup="verificarLogin()"><br>
                <!--Div para verificação da condição existente em algumas inputs-->
                <div class="div_condicao" name="verificar_login">
                </div>
                <!--Senha-->
                <input id="texto_senha" value="<?php echo($senha); ?>" class="input_texto" type="password" name="txt_senha" placeholder="Senha" onkeypress="semEspaco(event)"><br>
                <!--Imagem para ao clique revelar a senha
                    No qual o onmousedown serve para no clique revelar e onmouseup ao soltar do clique
                    a senha voltar ao formato password
                -->
                <div class="ver_senha" onmousedown="textSenha()" onmouseup="passwordSenha()">
                    <img src="../img/revelarSenha.png" alt="">
                </div>
                <!--Confirmar a Senha-->
                <input id="texto_confirmarSenha" value="<?php echo($senha); ?>" class="input_texto" type="password" name="txt_confirmarSenha" placeholder="Confirmar senha" onkeypress="semEspaco(event)" onkeyup="verificarConfSenha()"><br>
                <!--Div para verificação da condição existente em algumas inputs-->
                <div class="div_condicao" name="verificar_senha">
                </div>
                <!--Nome funcionário-->
                <input value="<?php echo($nome); ?>" class="input_texto" type="text" name="txt_nomeFuncionario" placeholder="Nome Completo"><br>
                <!--Email funcionário-->
                <span class="asterisco">*</span><input value="<?php echo($email); ?>" id="caixa_emailCadastro" onkeypress="semEspaco(event)" onkeyup="verificarEmail()" class="input_texto" type="text" name="txt_email" placeholder="Email" required><br>
                <!--Div para verificação da condição existente em algumas inputs-->
                <div class="div_condicao" name="verificar_email">
                </div>
                <!--Caixa com titulo-->
                <div class="titulo_popCadastro">
                    Foto de Perfil (.jpg), (.png), (.jpeg)
                </div>
                <!--Selecionar imagem-->
                <input class="botao_tipoFile" type="file" name="filesimagemperfil" id="btn_img"><br>
                <!--Número de Registro-->
                <input value="<?php echo($numeroRegistro); ?>" id="numero_registro" class="input_texto_lateral" type="text" name="txt_numRegistro" placeholder="Número de Registro">
                <!--Data de Nascimento-->
                <input value="<?php echo($dtNascOriginal); ?>" class="input_texto_lateral" id="input_dtNasc" type="text" name="txt_dtNasc" placeholder="dd/mm/aaaa"><br>
                <!--Select Cargo-->
                <select class="select" id="selectCargo" name="selectCargo" onchange="verificarCargo()">
                    <option selected disabled>Selecione um Cargo</option>
                    <?php

                        //Comando SQL
                        $sql = "select * from tbl_cargo";

                        $select = mysql_query($sql) or die(mysql_error());

                        while($rs=mysql_fetch_array($select)){

                            //Se o id que é pego no select do alterar for igual
                            //Um dos selects encotrados aqui, ele automaticamente
                            //Adiciona o value "selected" para esse ID
                            if($selectCargo == $rs['id_cargo']){
                                $optionSelecionado = "selected";
                                if($rs['nome'] == 'Garçom'){
                                    $aparecerCaixa = 'block';
                                    ?>
                                        <script>
                                            $("#div_cadastro").css({"height":"1600px"});
                                            $("#div_foraCadastro").css({"height":"1650px"});
                                        </script>
                                    <?php
                                }
                            }else{
                                $optionSelecionado = "";
                            }

                    ?>
                    <option <?php echo($optionSelecionado); ?> value="<?php echo($rs['id_cargo']);?>"><?php echo($rs['nome']); ?></option>
                    <?php
                        }
                    ?>
                </select><br>
                <!--Comissão-->
                <input value="<?php echo($comissaoGarcom); ?>%" class="input_texto" id="input_comissao" type="text" name="txt_comissao" maxlength="4" placeholder="Comissão em porcentagem" style="display:<?php echo($aparecerCaixa); ?>">
                <!--Select Restaurante-->
                <select class="select" name="selectRestaurante">
                    <option selected disabled>Selecione um Restaurante</option>
                    <?php

                        //Comando SQL
                        $sql = "select * from tbl_restaurante";

                        $select = mysql_query($sql) or die(mysql_error());

                        while($rs=mysql_fetch_array($select)){

                            //Se o id que é pego no select do alterar for igual
                            //Um dos selects encotrados aqui, ele automaticamente
                            //Adiciona o value "selected" para esse ID
                            if($selectRestaurante == $rs['id_restaurante']){
                                $optionSelecionado = "selected";
                            }else{
                                $optionSelecionado = "";
                            }
                    ?>
                    <option <?php echo($optionSelecionado); ?> value="<?php echo($rs['id_restaurante']);?>"><?php echo($rs['nome']); ?></option>
                    <?php
                        }
                    ?>
                </select><br>
                <!--Salário-->
                <input value="<?php echo($salario); ?>" id="salario" maxlength="13" class="input_texto_lateral" type="text" name="txt_salario" placeholder="Salário">
                <!--Dia de pagamento-->
                <input value="<?php echo($diaPagamento); ?>" class="input_texto_lateral" type="text" name="txt_diapagamento" maxlength="2" placeholder="Dia de pagamento" onkeypress="semEspaco(event)"><br>
                <!--CPF-->
                <input value="<?php echo($cpf); ?>" class="input_texto" id="input_cpf" maxlength="14" type="text" name="txt_cpf" placeholder="CPF"><br>
                <!--Caixa de seleção de Bandeiras de Cartões-->
                <select class="select" name="selectBandeiraDoCartao">
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
                        if($selectBandeiraCartao == $idBanco){
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
                <!--Agencia-->
                <input value="<?php echo($agencia); ?>" onkeypress="semEspaco(event)" class="input_texto_lateral" maxlength="4" type="text" name="txt_agencia" placeholder="Número da Agência">
                <!--Conta Corrente-->
                <input value="<?php echo($contaCorrente); ?>" class="input_texto_lateral" id="conta_corrente" type="text" maxlength="11" onkeypress="semEspaco(event)" name="txt_contaCorrente" placeholder="Conta Corrente"><br>
                <!--Sexo-->
                <div class="titulo_popCadastro">
                    Sexo
                </div>
                <div class="div_radio">
                    <?php

                        $checkedMasc = "checked";
                        $checkedFem = "";

                        if($sexo == 'M'){
                            $checkedMasc = "checked";
                        }if($sexo == 'F'){
                            $checkedFem = "checked";
                        }

                    ?>
                    <input class="radio_button" type="radio" name="sexo" value="M" <?php echo($checkedMasc); ?>><span class="texto_radio">Masculino</span>
                    <input class="radio_button" type="radio" name="sexo" value="F" <?php echo($checkedFem); ?>><span class="texto_radio">Feminino</span>
                </div>
                <!--Telefone-->
                <input value="<?php echo($telefone); ?>" class="input_texto" id="input_telefone" type="text" name="txt_telefone" placeholder="Telefone"><br>
                <!--Celular-->
                <input value="<?php echo($celular); ?>" class="input_texto" id="input_celular" type="text" name="txt_celular" placeholder="Celular"><br>
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
                <!--Caixa de seleção de Cidades-->
                <select class="select" name="selectCidade" required>
                    <option disabled>Selecione uma Cidade</option>
                    <?php

                        //Seleciona tudo da tabela estado
                        $sql = "select * from tbl_cidade where id_cidade = ".$selectCidade;

                        $select = mysql_query($sql) or die(mysql_error());

                        while($rs=mysql_fetch_array($select)){
                            $idCidade=$rs['id_cidade'];
                            $nomeCidade=$rs['nome'];

                            //Se o id que é pego no select do alterar for igual
                            //Um dos selects encotrados aqui, ele automaticamente
                            //Adiciona o value "selected" para esse ID
                            if($selectCidade == $idCidade){
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
                <input value="<?php echo($numeroResidencia); ?>" class="input_texto_lateral" type="text" maxlength="3" name="txt_numeroResidencia" placeholder="Número"><br>
                <!--Bloco-->
                <input value="<?php echo($bloco); ?>" class="input_texto_lateral" type="text" maxlength="3" name="txt_bloco" placeholder="Bloco">
                <!--Apartamento-->
                <input value="<?php echo($apartamento); ?>" class="input_texto_lateral" type="text" maxlength="3" name="txt_ap" placeholder="Apartamento"><br>
                <!--Botão Cadastrar-->
                <button id="botao_cadastrar" value="<?php echo($valueBotao); ?>" type="submit" name="btnCadastrar_funcionario">
                    <?php echo($valueBotao); ?>
                </button>
            </form>
        </div>
    </div>
</div>

<div id="div_mostrarImagem">
    <div class="imagemPreview">
        <img src="<?php echo($fotoUser); ?>" id="imagem" alt="">
    </div>
</div>
