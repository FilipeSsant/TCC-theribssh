<!--Div de Cadastro-->
<div id="div_foraCadastro">
    <!--Botão fechar-->
    <a href="gerenciamento_faleConosco.php">
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
                <span>Informações sobre o Usuário</span>
            </div>
        </div>
        <!--Formulário de preenchimento para Login-->
        <div id="div_informacoes">
            <!--Nome do cliente-->
            <div class="titulo_popCadastro">
                Nome do Cliente
            </div>
            <!--Caixa com conteúdo-->
            <div class="conteudo_popCadastro">
                <?php echo($nome); ?>
            </div>
            <!--Celular-->
            <div class="titulo_popCadastro">
                Celular
            </div>
            <!--Caixa com conteúdo-->
            <div class="conteudo_popCadastro">
                <?php echo($celular); ?>
            </div>
            <!--E-mail-->
            <div class="titulo_popCadastro">
                E-mail
            </div>
            <!--Caixa com conteúdo-->
            <div class="conteudo_popCadastro">
                <?php echo($email); ?>
            </div>
            <!--Período-->
            <div class="titulo_popCadastro">
                Tipo de Informação
            </div>
            <!--Caixa com conteúdo-->
            <div class="conteudo_popCadastro">
                <?php echo($tipodeinformacao); ?>
            </div>
            <!--Horário em que foi reservado-->
            <div class="titulo_popCadastro">
                Restaurante
            </div>
            <!--Caixa com conteúdo-->
            <div class="conteudo_popCadastro">
                <?php echo($restaurante); ?>
            </div>
            <!--Mesa-->
            <div class="titulo_popCadastroObs">
                Observação
            </div>
            <!--Caixa com conteúdo-->
            <div class="conteudo_popCadastroObs">
                <span class="centralizar_texto"><?php echo($obs); ?></span>
            </div>
        </div>
    </div>
</div>
