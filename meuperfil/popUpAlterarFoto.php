<!--Div de Cadastro-->
<div id="div_foraAlterarFoto" style="background-color:<?php echo($corPrimaria); ?>;">
    <!--Botão fechar-->
    <div class="botao_fecharPopUp" onClick="fecharPopUpCadastroFoto()" style="background-color:<?php echo($corQuartenaria); ?>;">
        <img src="../img/fecharPopUp.png" alt="">
    </div>
    <!--Div de Login-->
    <div id="div_alternarFoto">
        <!--Título div Cadastro-->
        <div class="titulo_loginCadastro">
            <!--Linha atras do Titulo-->
            <div class="linha_atrasDoTitulo" style="background-color:<?php echo($corQuartenaria); ?>;">
            </div>
            <!--Texto do Título-->
            <div class="divTexto_loginCadastro" style="background-color:<?php echo($corPrimaria); ?>;">
                <span style="color:<?php echo($corSecundaria); ?>;">Altere sua foto</span>
            </div>
        </div>
        <!--Formulário de preenchimento para Login-->
        <div class="formulario_cadastro">
            <form name="formAlterarFoto" method="post" action="meuperfil.php" enctype="multipart/form-data">
                <!--Caixa com titulo-->
                <div class="titulo_popCadastro" style="background-color:<?php echo($corPrimaria); ?>;">
                    Selecione uma imagem
                </div>
                <!--Selecionar imagem-->
                <input class="botao_tipoFile" type="file" name="filesimagem" required><br>
                <!--Botão Cadastrar-->
                <button class="botao_formulario" type="submit" name="btnMudarFoto" style="background-color:<?php echo($corPrimaria); ?>;">
                    <span style="color:<?php echo($corSecundaria); ?>;">Alterar</span>
                </button>
            </form>
        </div>
    </div>
</div>
