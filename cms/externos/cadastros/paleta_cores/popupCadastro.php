<!--Div de Cadastro-->
<div id="div_foraCadastro">
    <!--Botão fechar-->
    <a href="crud_paletaDeCores.php">
        <div class="botao_fecharPopUp">
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
                <span><?php echo($tituloPopUp); ?> Paleta de Cor</span>
            </div>
        </div>
        <!--Formulário de preenchimento para Login-->
        <div id="formulario_cadastro">
            <form name="formCadastroPaletaCores" method="post" action="crud_paletaDeCores.php">
                <input class="input_texto" type="text" name="txt_tituloPaleta" placeholder="Título da Paleta" value="<?php echo($tituloPaleta); ?>" required><br>
                <input class="input_cor" type="color" name="input_corPrimaria" title="Cor Primária" value="<?php echo($corPrimaria); ?>" required>
                <input class="input_cor" type="color" name="input_corTerciaria" title="Cor Terciária" value="<?php echo($corTerciaria); ?>" required>
                <input class="input_cor" type="color" name="input_corQuartenaria" title="Cor Quartenária" value="<?php echo($corQuartenaria); ?>" required><br>
                <!--Botão Cadastrar-->
                <button id="botao_cadastrar" value="<?php echo($valueBotao); ?>" type="submit" name="btnCadastrar_paleta">
                    <?php echo($valueBotao); ?>
                </button>
            </form>
        </div>
    </div>
</div>
