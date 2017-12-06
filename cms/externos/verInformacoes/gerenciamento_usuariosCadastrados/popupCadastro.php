<!--Div de Cadastro-->
<div id="div_foraCadastro">
    <!--Botão fechar-->
    <a href="gerenciamento_usuariosCadastrados.php">
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
                <span>Informações do Usuário</span>
            </div>
        </div>   
        <!--Nome Completo-->
        <div class="titulo_popCadastro">
            Foto
        </div>
        <!--Caixa com conteúdo-->
        <div class="conteudo_popCadastroImagem">
            <img src="../<?php echo($foto); ?>" alt="">
        </div>
        <div id="div_agrupadorainfo">
            <!--Formulário de preenchimento para Login-->
            <div class="div_informacoes" name="basico">          
                <!--Nome Completo-->
                <div class="titulo_popCadastro">
                    Nome Completo
                </div>
                <!--Caixa com conteúdo-->
                <div class="conteudo_popCadastro">
                    <?php echo($nome);?> <?php echo($sobrenome);?>
                </div>
                <!--Login-->
                <div class="titulo_popCadastro">
                    Login
                </div>
                <!--Caixa com conteúdo-->
                <div class="conteudo_popCadastro">
                    <?php echo($login);?>
                </div>
                <!--Senha-->
                <div class="titulo_popCadastro">
                    Senha
                </div>
                <!--Caixa com conteúdo-->
                <div class="conteudo_popCadastro">
                    <?php echo($senha);?>
                </div>
                <!--Celular-->
                <div class="titulo_popCadastro">
                    Celular
                </div>
                <!--Caixa com conteúdo-->
                <div class="conteudo_popCadastro">
                    <?php echo($celular);?>
                </div>
                <!--Telefone-->
                <div class="titulo_popCadastro">
                    Telefone
                </div>
                <!--Caixa com conteúdo-->
                <div class="conteudo_popCadastro">
                    <?php echo($telefone);?>
                </div>
                <!--E-mail-->
                <div class="titulo_popCadastro">
                    E-mail
                </div>
                <!--Caixa com conteúdo-->
                <div class="conteudo_popCadastro">
                    <?php echo($email);?>
                </div>   
            </div>  

            <div class="div_informacoes" name="endereco"> 
                <!--Estado-->
                <div class="titulo_popCadastro">
                    Estado
                </div>
                <!--Caixa com conteúdo-->
                <div class="conteudo_popCadastro">
                    <?php echo($estado);?>
                </div>
                <!--Cidade-->
                <div class="titulo_popCadastro">
                    Cidade
                </div>
                <!--Caixa com conteúdo-->
                <div class="conteudo_popCadastro">
                    <?php echo($cidade);?>
                </div>
                <!--Logradouro-->
                <div class="titulo_popCadastro">
                    Logradouro
                </div>
                <!--Caixa com conteúdo-->
                <div class="conteudo_popCadastro">
                    <?php echo($logradouro);?>
                </div>
                <!--Bairro-->
                <div class="titulo_popCadastro">
                    Bairro
                </div>
                <!--Caixa com conteúdo-->
                <div class="conteudo_popCadastro">
                    <?php echo($bairro);?>
                </div>
                <!--Rua-->
                <div class="titulo_popCadastro">
                    Rua
                </div>
                <!--Caixa com conteúdo-->
                <div class="conteudo_popCadastro">
                    <?php echo($rua);?>
                </div>
                <div class="div_agrupa2elementos">
                    <div class="elemento_dupla">
                        <!--Apartamento e Bloco-->
                        <div class="titulo_popCadastroPoucosCampos">
                            Apt e Bloco
                        </div>
                        <!--Caixa com conteúdo-->
                        <div class="conteudo_popCadastroPoucosCampos">
                            <?php echo($aptBloco);?>
                        </div>
                    </div>   
                    <div class="elemento_dupla">
                        <!--Número-->
                        <div class="titulo_popCadastroPoucosCampos">
                            Número
                        </div>
                        <!--Caixa com conteúdo-->
                        <div class="conteudo_popCadastroPoucosCampos">
                            <?php echo($numero);?>
                        </div>
                    </div>    
                </div>    
            </div> 
            
            <div class="div_informacoesCartao"> 
                <!--Banco-->
                <div class="titulo_popCadastro">
                    Banco
                </div>
                <!--Caixa com conteúdo-->
                <div class="conteudo_popCadastro">
                    <?php echo($nomeBanco);?>
                </div>
                <!--Número do Cartão-->
                <div class="titulo_popCadastro">
                    Número do Cartão
                </div>
                <!--Caixa com conteúdo-->
                <div class="conteudo_popCadastro">
                    <?php echo($numeroCartao);?>
                </div>
                <!--Nome Registrado-->
                <div class="titulo_popCadastro">
                    Nome Registrado
                </div>
                <!--Caixa com conteúdo-->
                <div class="conteudo_popCadastro">
                    <?php echo($nomeCartao);?>
                </div>
                <div class="div_agrupa2elementos">
                    <div class="elemento_dupla">
                        <!--Apartamento e Bloco-->
                        <div class="titulo_popCadastroPoucosCampos">
                            Vencimento
                        </div>
                        <!--Caixa com conteúdo-->
                        <div class="conteudo_popCadastroPoucosCampos">
                            <?php echo($dataValidade);?>
                        </div>
                    </div>   
                    <div class="elemento_dupla">
                        <!--Número-->
                        <div class="titulo_popCadastroPoucosCampos">
                            CVV
                        </div>
                        <!--Caixa com conteúdo-->
                        <div class="conteudo_popCadastroPoucosCampos">
                            <?php echo($cvv);?>
                        </div>
                    </div>    
                </div>    
            </div>
            
        </div>    
    </div>
</div>
