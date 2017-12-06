<!--Menu-->
<div id="menu_cms">
    <div id="titulo_menuCms">
        Menu
    </div>
    <!--Recuo nos itens-->
    <div id="div_menuRecua">
    </div>
    <?php
    
        $sql = "select * from tbl_cargopermissao where id_cargo = ".$_SESSION['idCargoFuncionarioU'];
        $select = mysql_query($sql) or die(mysql_error());

        while($rs=mysql_fetch_array($select)){
            $idPermissao = $rs['id_permissao'];
            
            if($idPermissao == 1){
    ?>
                <!--Fechamento de Pedido (Somente com o garçom)-->
                <!-- opa<a href="fechamentoPedido.php">
                    <div class="div_icone_pagina" style="<?php echo($displayFechamentoPedido); ?>">
                        <div class="icone_pagina">
                            <img src="img/fecharPedidoIcon.png" alt="">
                        </div>
                        <div class="texto_icone">
                            Fechamento do Pedido
                        </div>
                    </div>
                </a>-->
    <?php
            }elseif($idPermissao == 2){
    
    ?>
                <!--Aprovação de Produtos (Somente com o gerente)-->
                <a href="paginaAprovacao_produtos.php">
                    <div class="div_icone_pagina" style="<?php echo($displayFechamentoPedido); ?>">
                        <!--Icone-->
                        <div class="icone_pagina">
                            <img src="img/aprovarProdutosIcon.png" alt="">
                        </div>
                        <!--Texto-->
                        <div class="texto_icone">
                            Aprovação de Produtos
                        </div>
                    </div>
                </a>
    <?php
            }elseif($idPermissao == 3){
    
    ?>
                <!--Paleta de Cores-->
                <a href="crud_paletaDeCores.php">
                    <div class="div_icone_pagina">
                        <!--Icone-->
                        <div class="icone_pagina">
                            <img src="img/paletaIcon.png" alt="">
                        </div>
                        <!--Texto-->
                        <div class="texto_icone">
                            Paleta de Cores
                        </div>
                    </div>
                </a>
    <?php
            }elseif($idPermissao == 4){
    ?>
                <!--Cardápio-->
                <a href="crud_cardapio.php">
                    <div class="div_icone_pagina">
                        <!--Icone-->
                        <div class="icone_pagina">
                            <img src="img/cardapioIcon.png" alt="">
                        </div>
                        <!--Texto-->
                        <div class="texto_icone">
                            Cardápio
                        </div>
                    </div>
                </a>
    <?php
            }elseif($idPermissao == 5){
    ?>
                <!--Home-->
                <a href="crud_home.php">
                    <div class="div_icone_pagina">
                        <!--Icone-->
                        <div class="icone_pagina">
                            <img src="img/homeIcon.png" alt="">
                        </div>
                        <!--Texto-->
                        <div class="texto_icone">
                            Home
                        </div>
                    </div>
                </a>
    <?php
            }elseif($idPermissao == 6){
    ?>
                <!--Produtos-->
                <a href="crud_produtos.php">
                    <div class="div_icone_pagina">
                        <!--Icone-->
                        <div class="icone_pagina">
                            <img src="img/produtoIcon.png" alt="">
                        </div>
                        <!--Texto-->
                        <div class="texto_icone">
                            Produtos
                        </div>
                    </div>
                </a>
    <?php
            }elseif($idPermissao == 7){
    ?>
                <!--Categorias-->
                <a href="crud_categoria.php">
                    <div class="div_icone_pagina">
                        <!--Icone-->
                        <div class="icone_pagina">
                            <img src="img/categoriasIcon.png" alt="">
                        </div>
                        <!--Texto-->
                        <div class="texto_icone">
                            Categorias
                        </div>
                    </div>
                </a>
    <?php
            }elseif($idPermissao == 8){
    ?>
                <!--Funcionários-->
                <a href="crud_funcionarios.php">
                    <div class="div_icone_pagina">
                        <!--Icone-->
                        <div class="icone_pagina">
                            <img src="img/funcionariosIcon.png" alt="">
                        </div>
                        <!--Texto-->
                        <div class="texto_icone">
                            Funcionários
                        </div>
                    </div>
                </a>
    <?php
            }elseif($idPermissao == 9){
    ?>
                <!--Cargos-->
                <a href="crud_cargos.php">
                    <div class="div_icone_pagina">
                        <!--Icone-->
                        <div class="icone_pagina">
                            <img src="img/cargosNiveisIcon.png" alt="">
                        </div>
                        <!--Texto-->
                        <div class="texto_icone">
                            Cargos
                        </div>
                    </div>
                </a>
    <?php
            }elseif($idPermissao == 10){
    ?>
                <!--Usuários Cadastrados-->
                <a href="gerenciamento_usuariosCadastrados.php">
                    <div class="div_icone_pagina">
                        <!--Icone-->
                        <div class="icone_pagina">
                            <img src="img/usuariosCadaIcon.png" alt="">
                        </div>
                        <!--Texto-->
                        <div class="texto_icone">
                            Usuários Cadastrados
                        </div>
                    </div>
                </a>
    <?php
            }elseif($idPermissao == 11){
    ?>
                <!--Mesas-->
                <a href="crud_mesa.php">
                    <div class="div_icone_pagina">
                        <!--Icone-->
                        <div class="icone_pagina">
                            <img src="img/mesaIcon.png" alt="">
                        </div>
                        <!--Texto-->
                        <div class="texto_icone">
                            Mesas
                        </div>
                    </div>
                </a>
    <?php
            }elseif($idPermissao == 12){
    ?>
                <!--Acompanhamento de Reservas-->
                <a href="gerenciamento_reservas.php">
                    <div class="div_icone_pagina">
                        <!--Icone-->
                        <div class="icone_pagina">
                            <img src="img/acompanhamentoRIcon.png" alt="">
                        </div>
                        <!--Texto-->
                        <div class="texto_icone">
                            Reservas
                        </div>
                    </div>
                </a>
    <?php
            }elseif($idPermissao == 13){
    ?>
                <!--Enquetes-->
                <a href="paginaAgrupadora_enquetes.php">
                    <div class="div_icone_pagina">
                        <!--Icone-->
                        <div class="icone_pagina">
                            <img src="img/enquetesIcon.png" alt="">
                        </div>
                        <!--Texto-->
                        <div class="texto_icone">
                            Enquetes
                        </div>
                    </div>
                </a>
    <?php
            }elseif($idPermissao == 14){
    ?>
                <!--Sobre Nós-->
                <a href="crud_sobreNos.php">
                    <div class="div_icone_pagina">
                        <!--Icone-->
                        <div class="icone_pagina">
                            <img src="img/sobreNosIcon.png" alt="">
                        </div>
                        <!--Texto-->
                        <div class="texto_icone">
                            Sobre Nós
                        </div>
                    </div>
                </a>
    <?php
            }elseif($idPermissao == 15){
    ?>
                <!--Fale Conosco-->
                <a href="gerenciamento_faleConosco.php">
                    <div class="div_icone_pagina">
                        <!--Icone-->
                        <div class="icone_pagina">
                            <img src="img/faleConoscoIcon.png" alt="">
                        </div>
                        <!--Texto-->
                        <div class="texto_icone">
                            Fale Conosco
                        </div>
                    </div>
                </a>
    <?php
            }elseif($idPermissao == 16){
    ?>
                <!--FAQ-->
                <a href="crud_faq.php">
                    <div class="div_icone_pagina">
                        <!--Icone-->
                        <div class="icone_pagina">
                            <img src="img/faqIcon.png" alt="">
                        </div>
                        <!--Texto-->
                        <div class="texto_icone">
                           FAQ
                        </div>
                    </div>
                </a>
    <?php
            }elseif($idPermissao == 17){
    ?>
                <!--Redes Sociais-->
                <a href="crud_redesSociais.php">
                    <div class="div_icone_pagina">
                        <!--Icone-->
                        <div class="icone_pagina">
                            <img src="img/redesSociaisIcon.png" alt="">
                        </div>
                        <!--Texto-->
                        <div class="texto_icone">
                           Redes Sociais
                        </div>
                    </div>
                </a>
    <?php
            }elseif($idPermissao == 18){
    ?>
                <!--Redes Sociais-->
                <a href="crud_ingredientes.php">
                    <div class="div_icone_pagina">
                        <!--Icone-->
                        <div class="icone_pagina">
                            <img src="img/crud_ingredientes.png" alt="">
                        </div>
                        <!--Texto-->
                        <div class="texto_icone">
                           Ingredientes
                        </div>
                    </div>
                </a>
    <?php
            }
        }
    ?>
</div>
