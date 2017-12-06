<!--Div de Cadastro-->
<div id="div_foraCadastro">
    <!--Botão fechar-->
    <a href="crud_categoria.php">
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
                <span><?php echo($tituloPopUp); ?> Categoria</span>
            </div>
        </div>
        <!--Formulário de preenchimento para Login-->
        <div id="formulario_cadastro">
            <form name="formCadastroCategoria" method="post" action="crud_categoria.php" enctype="multipart/form-data">
                <!--Titulo-->
                <input value="<?php echo($nome); ?>" class="input_texto" type="text" name="txt_nomeCategoria" placeholder="Nome da Categoria" required><br>
				<!--Imagem Sobre Nós-->
				<div class="titulo_popCadastro">
                    Selecione o icone
                </div>
                <!--Selecionar imagem-->
                <input class="botao_tipoFile" type="file" name="filesimagemicone" id="btn_img" <?php echo($requirido); ?>><br>
                <!--Botão Cadastrar-->
                <button id="botao_cadastrar" value="<?php echo($valueBotao); ?>" type="submit" name="btnCadastrar_categoria">
                    <?php echo($valueBotao); ?>
                </button>
            </form>
        </div>
    </div>
</div>

<div id="div_mostrarImagem">
    <div class="imagemPreview">
        <img src="<?php echo($icone); ?>" id="imagem" alt="">
    </div>
</div>
