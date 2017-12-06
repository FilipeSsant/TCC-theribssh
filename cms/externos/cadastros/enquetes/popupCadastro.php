<!--Div de Cadastro-->
<div id="div_foraCadastro">
    <!--Botão fechar-->
    <div class="botao_fecharPopUp" onClick="fecharPopUp()">
        <img src="img/fecharPopUp.png" alt="">
    </div>
    <!--Div de Login-->
    <div id="div_cadastro">
        <!--Título div Cadastro-->
        <div class="titulo_loginCadastro">
            <!--Linha atras do Titulo-->
            <div class="linha_atrasDoTitulo">
            </div>
            <!--Texto do Título-->
            <div class="div_tituloCadastro">
                <span><?php echo($tituloPopUp); ?> Titulo da Enquete</span>
            </div>
        </div>
        <!--Formulário de preenchimento para Login-->
        <div id="formulario_cadastro">
            <form name="formCadastroTituloEnquete" method="post" action="crud_tituloEnquetes.php">
                <!--Nome-->
                <input class="input_texto" value="<?php echo($tituloEnquete); ?>" type="text" name="txt_nomeEnquete" maxlength="29" placeholder="Nome da Enquete" required><br>
                <!--Botão Cadastrar-->
                <button id="botao_cadastrar" value="<?php echo($valueBotao); ?>" type="submit" name="btnCadastrar_tituloEnquete">
                    <?php echo($valueBotao); ?>
                </button>
            </form>
        </div>
    </div>
</div>
