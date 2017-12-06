<!--Div de Cadastro-->
<div id="div_foraCadastro">
    <!--Botão fechar-->
    <a href="crud_sobreNos.php">
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
                <span><?php echo($tituloPopUp); ?> Sobre Nós</span>
            </div>
        </div>
        <!--Formulário de preenchimento para Login-->
        <div id="formulario_cadastro">
            <form name="formCadastroSobreNos" method="post" action="crud_sobreNos.php" enctype="multipart/form-data">
                <!--Titulo-->
                <input value="<?php echo($titulo); ?>" class="input_texto" type="text" name="txt_tituloArtigo" placeholder="Título" required><br>
                <!--Caixa com titulo-->
                <div class="titulo_popCadastro">
                    Conteúdo do Artigo
                </div>
                <!--Artigo-->
                <textarea name="txt_conteudoArtigo" class="textArea" required><?php echo($textoArtigo); ?></textarea><br>
				<!--Imagem Sobre Nós-->
				<div class="titulo_popCadastro">
                    Selecione uma imagem
                </div>
                <!--Selecionar imagem-->
                <input class="botao_tipoFile" type="file" name="filesimagemsobrenos" id="btn_img" <?php echo($requirido); ?>><br>
                <!--Botão Cadastrar-->
                <button id="botao_cadastrar" value="<?php echo($valueBotao); ?>" type="submit" name="btnCadastrar_sobreNos">
                    <?php echo($valueBotao); ?>
                </button>
            </form>
        </div>
    </div>
</div>

<div id="div_mostrarImagem">
    <div class="imagemPreview">
        <img src="<?php echo($caminho_imagem); ?>" id="imagem" alt="">
    </div>
</div>