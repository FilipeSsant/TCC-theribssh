<!--Div de Cadastro-->
<div id="div_foraCadastro">
    <!--Botão fechar-->
    <a href="paginaAprovacao_produtos.php">
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
                <span><?php echo($nomeProduto); ?></span>
            </div>
        </div>
        <!--Formulário de preenchimento para Login-->
        <div id="div_informacoes">
            <!--Nome do Produto-->
            <div class="titulo_popCadastro">
                Nome do Produto
            </div>
            <!--Caixa com conteúdo-->
            <div class="conteudo_popCadastro">
                <?php echo($nomeProduto); ?>
            </div>
            <!--Imagem do Produto-->
            <div class="titulo_popCadastro">
                Imagem do Produto
            </div>
            <!--Caixa com conteúdo-->
            <div class="conteudo_popCadastroImagem">
                <img src="<?php echo($imagemProduto); ?>" alt="">
            </div>
            <!--Preço do Produto-->
            <div class="titulo_popCadastro">
                Preço do Produto
            </div>
            <!--Caixa com conteúdo-->
            <div class="conteudo_popCadastro">
                R$ <?php echo($preco); ?>
            </div>
            <!--Categoria-->
            <div class="titulo_popCadastro">
                Categoria
            </div>
            <!--Caixa com conteúdo-->
            <div class="conteudo_popCadastro">
                <?php echo($nomeCategoria); ?>
            </div>
        </div>
    </div>
</div>
