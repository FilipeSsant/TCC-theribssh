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
                <span>Cadastro de Permissão</span>
            </div>
        </div>
        <!--Formulário de preenchimento para Login-->
        <div id="formulario_cadastro">
            <form name="formCadastroPermissoes" method="post" action="crud_permissoes.php">
                <!--Nome permissão-->
                <input class="input_texto" type="text" name="txt_nomePermissao" placeholder="Nome da Permissão" required><br>
                <!--Caixa com titulo-->
                <div class="titulo_popCadastro">
                    Páginas
                </div>
                <!--CheckBox para Páginas relacionadas-->
                <div class="div_checkbox">
                    <?php
                        $h = 1;
                        while($h < 11){
                    ?>
                    <input class="checkbox_cadastro" type="checkbox" name="chk_paginaPermissao" value="<?php echo($h); ?>">Página <?php echo($h);?><br>
                    <?php
                            $h++;
                        }
                    ?>
                </div>
                <!--Botão Cadastrar-->
                <button id="botao_cadastrar" type="submit" name="btnCadastrar_permissao">
                    Cadastrar
                </button>
            </form>
        </div>
    </div>
</div>
