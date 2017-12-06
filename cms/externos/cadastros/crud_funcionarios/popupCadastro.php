<!--Div de Cadastro-->
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
                <span class="asterisco">*</span><input id="caixa_loginCadastro" class="input_texto" type="text" name="txt_login" placeholder="Login" onkeypress="semEspaco(event)" onkeyup="verificarLogin()" required><br>
                <!--Div para verificação da condição existente em algumas inputs-->
                <div class="div_condicao" name="verificar_login">
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
                <input id="texto_confirmarSenha" class="input_texto" type="password" name="txt_confirmarSenha" placeholder="Confirmar senha" onkeypress="semEspaco(event)" onkeyup="verificarConfSenha()" required><br>
                <!--Div para verificação da condição existente em algumas inputs-->
                <div class="div_condicao" name="verificar_senha">
                </div>
                <!--Nome funcionário-->
                <span class="asterisco">*</span><input class="input_texto" type="text" name="txt_nomeFuncionario" placeholder="Nome Completo" required><br>
                <!--Email funcionário-->
                <span class="asterisco">*</span><input id="caixa_emailCadastro" onkeypress="semEspaco(event)" onkeyup="verificarEmail()" class="input_texto" type="text" name="txt_email" placeholder="Email" required><br>
                <!--Div para verificação da condição existente em algumas inputs-->
                <div class="div_condicao" name="verificar_email">
                </div>
                <!--Caixa com titulo-->
                <div class="titulo_popCadastro">
                    Foto de Perfil (.jpg), (.png), (.jpeg)
                </div>
                <!--Selecionar imagem-->
                <input class="botao_tipoFile" type="file" name="filesimagemperfil" id="btn_img" required><br>
                <!--Número de Registro-->
                <span class="asterisco">*</span><input id="numero_registro" class="input_texto_lateral" type="text" name="txt_numRegistro" placeholder="Número de Registro" required>
                <!--Data de Nascimento-->
                <span class="asterisco">*</span><input class="input_texto_lateral" id="input_dtNasc" type="text" name="txt_dtNasc" placeholder="dd/mm/aaaa" required><br>
                <!--Select Cargo-->
                <span class="asterisco">*</span><select class="select" id="selectCargo" name="selectCargo" onchange="verificarCargo()" required>
                    <option selected disabled>Selecione um Cargo</option>
                    <?php

                        //Comando SQL
                        $sql = "select * from tbl_cargo";

                        $select = mysql_query($sql) or die(mysql_error());

                        while($rs=mysql_fetch_array($select)){
                    ?>
                    <option value="<?php echo($rs['id_cargo']);?>"><?php echo($rs['nome']); ?></option>
                    <?php
                        }
                    ?>
                </select><br>
                <!--Comissão-->
                <input value="" class="input_texto" id="input_comissao" type="text" name="txt_comissao" maxlength="4" placeholder="Comissão em porcentagem">
                <!--Select Restaurante-->
                <span class="asterisco">*</span><select class="select" name="selectRestaurante" required>
                    <option selected disabled>Selecione um Restaurante</option>
                    <?php

                        //Comando SQL
                        $sql = "select * from tbl_restaurante";

                        $select = mysql_query($sql) or die(mysql_error());

                        while($rs=mysql_fetch_array($select)){
                    ?>
                    <option value="<?php echo($rs['id_restaurante']);?>"><?php echo($rs['nome']); ?></option>
                    <?php
                        }
                    ?>
                </select><br>
                <!--Salário-->
                <span class="asterisco">*</span><input value="" id="salario" maxlength="13" class="input_texto_lateral" type="text" name="txt_salario" placeholder="Salário" required>
                <!--Dia de pagamento-->
                <span class="asterisco">*</span><input value="" class="input_texto_lateral" type="text" name="txt_diapagamento" maxlength="2" placeholder="Dia de pagamento" onkeypress="semEspaco(event)" required><br>
                <!--CPF-->
                <span class="asterisco">*</span><input value="" class="input_texto" id="input_cpf" maxlength="14" type="text" name="txt_cpf" placeholder="CPF" required><br>
                <!--Caixa de seleção de Bandeiras de Cartões-->
                <span class="asterisco">*</span>
                <select class="select" name="selectBandeiraDoCartao">
                    <option selected value="0">Selecione uma Bandeira</option>
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
                <!--Agencia-->
                <span class="asterisco">*</span>
                <input value="" onkeypress="semEspaco(event)" class="input_texto_lateral" maxlength="4" type="text" name="txt_agencia" placeholder="Número da Agência">
                <!--Conta Corrente-->
                <span class="asterisco">*</span>
                <input value="" class="input_texto_lateral" id="conta_corrente" type="text" maxlength="11" onkeypress="semEspaco(event)" name="txt_contaCorrente" placeholder="Conta Corrente"><br>
                <!--Sexo-->
                <div class="titulo_popCadastro">
                    Sexo
                </div>
                <div class="div_radio">
                    <input class="radio_button" type="radio" name="sexo" value="M" checked><span class="texto_radio">Masculino</span>
                    <input class="radio_button" type="radio" name="sexo" value="F"><span class="texto_radio">Feminino</span>
                </div>
                <!--Telefone-->
                <input class="input_texto" id="input_telefone" type="text" name="txt_telefone" placeholder="Telefone"><br>
                <!--Celular-->
                <span class="asterisco">*</span><input value="<?php echo($celular); ?>" class="input_texto" id="input_celular" type="text" name="txt_celular" placeholder="Celular" required><br>
                <!--Caixa de seleção dos Estados-->
                <span class="asterisco">*</span>
                <select id="selectEstado" class="select" name="selectEstado" onchange="pegarId()" required>
                    <option selected disabled>Selecione um Estado</option>
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
                <!--Caixa de seleção de Cidades-->
                <span class="asterisco">*</span>
                <select class="select" name="selectCidade" required>
                    <option selected disabled>Selecione uma Cidade</option>
                </select><br>
                <!--Logradouro-->
                <input class="input_texto" type="text" name="txt_logradouro" placeholder="Logradouro"><br>
                <!--Rua-->
                <span class="asterisco">*</span>
                <input class="input_texto" type="text" name="txt_rua" placeholder="Rua" required><br>
                <!--Bairro-->
                <span class="asterisco">*</span>
                <input class="input_texto_lateral" type="text" name="txt_bairro" placeholder="Bairro" required>
                <!--Número-->
                <span class="asterisco">*</span>
                <input class="input_texto_lateral" type="text" maxlength="3" name="txt_numeroResidencia" placeholder="Número" required><br>
                <!--Bloco-->
                <input class="input_texto_lateral" type="text" maxlength="3" name="txt_bloco" placeholder="Bloco">
                <!--Apartamento-->
                <input class="input_texto_lateral" type="text" maxlength="3" name="txt_ap" placeholder="Apartamento"><br>

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
        <img src="" id="imagem" alt="">
    </div>
</div>
