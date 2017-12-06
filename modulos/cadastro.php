<?php

    //Removendo Probabilidade de Erros Por Campos Não opcionais vazios
    $login = "";
    $senha = "";
    $confirmarSenha = "";
    $nome = "";
    $sobrenome = "";
    $email = "";
    $celular = "";
    $telefone = "-";
    $logradouro = "-";
    $rua = "";
    $bairro = "";
    $numeroResidencia = "";
    $bloco = "";
    $apartamento = "";
    $seletorDaCidade = "";
    $seletorBandeiraDoCartao = "-";
    $numCartao = "-";
    $nomeRegistradoCartao = "-";
    $dataValidade = "-";
    $cvv = "-";

    if(isset($_POST['btnCadastrar'])){
        //Resgatando valores digitados pelo usuário
        //Dados Pessoais
        $login = $_POST['txt_login'];
        $senha = $_POST['txt_senha'];
        $confirmarSenha = $_POST['txt_confirmarSenha'];
        $nome = $_POST['txt_nome'];
        $sobrenome = $_POST['txt_sobrenome'];
        $email = $_POST['txt_email'];
        $celular = $_POST['txt_celular'];
        $telefone = $_POST['txt_telefone'];
        $foto = "arquivos/foto_usuario/standardUser.png";
        //Endereço
        $logradouro = $_POST['txt_logradouro'];
        $rua = $_POST['txt_rua'];
        $bairro = $_POST['txt_bairro'];
        $numeroResidencia = $_POST['txt_numeroResidencia'];
        $bloco = $_POST['txt_bloco'];
        $apartamento = $_POST['txt_apartamento'];
        $apartamentoBloco = $apartamento."-".$bloco;
        $seletorDaCidade = $_POST['selectCidade'];
        //Cartão de crédito
        @$seletorBandeiraDoCartao = $_POST['selectBandeiraDoCartao'];
        $numCartao = $_POST['txt_numCartao'];
        $nomeRegistradoCartao = strtoupper($_POST['txt_nomeNoCartao']);
        $dataValidade = $_POST['txt_dataValidade'];
        $cvv = $_POST['txt_cvv'];


        if($senha == $confirmarSenha){

            //Insere os dados do endereço do usuário
            $sql = "insert into tbl_endereco (id_cidade, logradouro, bairro, rua, aptbloco, numero)";
            $sql = $sql."values (".$seletorDaCidade.", '".$logradouro."', '".$bairro."', '".$rua."', '".$apartamentoBloco."', '".$numeroResidencia."')";

            mysql_query($sql);

            $idEndereco = mysql_insert_id();

            //Insere os dados na tabela cliente
            $sql = "insert into tbl_cliente (id_endereco, login, senha, nome, sobrenome, celular, telefone, email, foto)";
            $sql = $sql."values (".$idEndereco.", '".$login."', '".$senha."', '".$nome."', '".$sobrenome."', '".$celular."', '".$telefone."', '".$email."', '".$foto."')";

            mysql_query($sql);

            $idCliente = mysql_insert_id();

            if($seletorBandeiraDoCartao == 0 && $numCartao == null && $cvv == null){

                if($idCliente != null){
                    ?>
                        <script>
                            swal({
                              title: "Sucesso!",
                              text: "Cadastro realizado com Sucesso!",
                              type: "success",
                              icon: "success",
                              button: {
                                         text: "Ok",
                                     },
                              closeOnEsc: true,
                          });
                        </script>
                    <?php
                }else{
                    ?>
                        <script>
                            swal({
                              title: "Erro!",
                              text: "Houve um erro no nosso Banco de Dados.",
                              type: "error",
                              icon: "error",
                              button: {
                                         text: "Ok",
                                       },
                              closeOnEsc: true,
                            });
                        </script>
                    <?php
                }
            }else{


                //Insere os dados na tabela do cartão do cliente
                $sql = "insert into tbl_cartaocredito (id_cliente, id_banco, numero, nome_cartao, data, cvv)";
                $sql = $sql."values (".$idCliente.", '".$seletorBandeiraDoCartao."', '".$numCartao."', '".$nomeRegistradoCartao."', '".$dataValidade."', '".$cvv."')";

                if(mysql_query($sql) or die(mysql_error())){
                    ?>
                        <script>
                            swal({
                              title: "Sucesso!",
                              text: "Cadastro realizado com Sucesso!",
                              type: "success",
                              icon: "success",
                              button: {
                                         text: "Ok",
                                     },
                              closeOnEsc: true,
                          });
                        </script>
                    <?php
                }else{
                    ?>
                        <script>
                            swal({
                              title: "Erro!",
                              text: "Houve um erro no nosso Banco de Dados.",
                              type: "error",
                              icon: "error",
                              button: {
                                         text: "Ok",
                                       },
                              closeOnEsc: true,
                            });
                        </script>
                    <?php
                }
            }


        }else{
            ?>
                <script>
                    swal({
                      title: "Erro!",
                      text: "As senhas não conferem".",
                      type: "error",
                      icon: "error",
                      button: {
                                 text: "Ok",
                               },
                      closeOnEsc: true,
                    });
                </script>
            <?php
        }
    }


?>
