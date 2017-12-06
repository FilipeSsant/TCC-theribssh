<!--Div de Cadastro-->
<div id="div_foraCadastro">
    <!--Botão fechar-->
    <a href="crud_faq.php">
    <div class="botao_fecharPopUp" onClick="fecharPopUp()">
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
                <span><?php echo($tituloPopUp); ?> Pergunta e Resposta</span>
            </div>
        </div>
        <!--Formulário de preenchimento para Login-->
        <div id="formulario_cadastro">
            <form name="formCadastroFaq" method="post" action="crud_faq.php">
                <!--Pergunta-->
                <input class="input_texto" value="<?php echo($pergunta); ?>" type="text" name="txt_pergunta" placeholder="Pergunta" required><br>
                <!--Caixa com titulo-->
                <div class="titulo_popCadastro">
                    Resposta
                </div>
                <!--Resposta-->
                <textarea name="txt_resposta" class="textArea" required><?php echo($resposta); ?></textarea><br>
                <!--Botão Cadastrar-->
                <button id="botao_cadastrar" value="<?php echo($valueBotao); ?>" type="submit" name="btnCadastrar_faq">
                    <?php echo($valueBotao); ?>
                </button>
            </form>
        </div>
    </div>
</div>
