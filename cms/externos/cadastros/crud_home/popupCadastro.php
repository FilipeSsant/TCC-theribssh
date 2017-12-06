<!--Div de Cadastro-->
<div id="div_foraCadastro">
    <!--Botão fechar-->
    <a href="crud_home.php">
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
                <span><?php echo($tituloPopUp); ?> Elementos Home</span>
            </div>
        </div>
        <!--Formulário de preenchimento para Login-->
        <div id="formulario_cadastro">
            <form name="formCadastroHome" method="post" action="crud_home.php" enctype="multipart/form-data">
				<!--Caixa com titulo-->
                <div class="titulo_popCadastro">
                    Selecione uma imagem
                </div>
                <!--Selecionar imagem-->
                <input class="botao_tipoFile" id="btn_imgsuperior" type="file" name="filesimgsuperior"><br>
                <!--Caixa com titulo-->
                <div class="titulo_popCadastro">
                    Selecione uma imagem
                </div>
                <!--Selecionar imagem-->
                <input class="botao_tipoFile" id="btn_imginferior" type="file" name="filesimginferior" <?php echo($requirido); ?>><br>
                <!--Botão Cadastrar-->
                <button id="botao_cadastrar" value="<?php echo($valueBotao); ?>" type="submit" name="btnCadastrar_home">
                    <?php echo($valueBotao); ?>
                </button>
            </form>
        </div>
    </div>
</div>

<div id="div_mostrarImagem">
    <!--Imagem 1-->
    <div class="imagemPreview">
        <img src="<?php echo($caminhoImagemSuperior); ?>" id="imagem_superior" alt="">
    </div>
    <!--Imagem 2-->
    <div class="imagemPreview">
        <img src="<?php echo($caminhoImagemInferior); ?>" id="imagem_inferior" alt="">
    </div>
</div>