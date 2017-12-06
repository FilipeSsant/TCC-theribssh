
var app = require('express')(),
	http = require('http').createServer(app),
	io = require('socket.io')(http),
	lstSalas = [],
	lstPedidos = [],
	lstProdutos = [],
	clients = {},
	client = "",
	mysql = require('mysql'),
	con = mysql.createConnection({
	  //host: "10.107.144.13",
	  //host: "localhost",
	  host: "192.168.1.1",
	  //host: "10.107.134.26",
	  //host: "10.107.134.15",
	  user: "root",
	  user: "theribssh",
	  //password: "bcd127",
	  //password: "",
	  password: "bcd127@theribssh",
	  database: "dbtheribssh"
	});

con.connect();

app.set('view engine', 'ejs');

app.get('/', function(req, res){

	//res.sendFile( __dirname + "/index.html");
	//res.send(lstAgendas);
	res.render("index", {app_name : lstPedidos});

});

io.on("connection", function (client) {
	this.client = client;
    client.on("join", function(name){
        clients[client.id] = name;
        client.emit("update", "You have connected to the server.");
        client.broadcast.emit("update", name + " has joined the server.")
    });

    client.on("send", function(msg){
        client.broadcast.emit("chat", clients[client.id], msg);
    });

    client.on("disconnect", function(){
        io.emit("update", clients[client.id] + " has left the server.");
        delete clients[client.id];
    });

    client.on("selectPedidos", function(idrestaurante){

            var contador = 0;
            var resultado = "";
            while(contador < lstSalas.length){
                var idpedido = lstSalas[contador].id_sala,
                    /*horarioFeito = lstsalas[contador].horariofeito,*/
                    mesa = lstSalas[contador].mesa;
				
				if(typeof mesa != 'undefined'){
					
					if(mesa != ""){
				
						resultado = resultado + "<div class='div_infoReduzidaPed' onclick='abrirInformacoes("+idpedido+")' title='Ver Informações'><div class='linha_esquerda'></div> "+
												"<div class='div_mesaHorario'> " +
												"<div class='mesaHorario'>Mesa "+mesa+"</div> " +
												"<div class='mesaHorario'></div>" +
												"</div>" +
												"<div class='div_btnConcluir' onclick='status(2,"+idpedido+")'><div class='btnConcluir' title='Concluir pedido'><img src='img/pedido_completo.png' alt=''></div></div> " +
												"</div>";
												
					}else{
					}		
				}else{
				}			
                contador = contador + 1;
            }

            client.emit("resultadoPedido", resultado);

    });

    client.on("selectInfoPedido", function(id_pedido){

        var resultado = "";

		if (typeof lstSalas[id_pedido] != 'undefined'){

            var id_funcionario = lstSalas[id_pedido].id_funcionario;
            var command = "select nome_completo as 'nomegarcom' from tbl_funcionario where id_funcionario = '" + id_funcionario + "'";

            con.query(command, function(err, result, fields){

				if (err) throw err + command;

				if (result.length > 0){
	                var nomegarcom = result[0].nomegarcom,
	                    nomemesa = lstSalas[id_pedido].mesa,
						produtos = lstSalas[id_pedido].produtos;

					if(produtos.length > 0){

		                resultado = "<div class='tituloInfo'><span class='centralizar_texto'>Nome do Garçom</span></div> " +
		                                        "<div class='divisoria'> " +
		                                        "</div><div class='tituloInfoPequeno'><span class='centralizar_texto'>Mesa</span></div> " +
		                                        "<div class='conteudoInfo'><span class='centralizar_texto'>"+nomegarcom+"</span></div> " +
		                                        "<div class='divisoriaB'></div> " +
		                                        "<div class='conteudoInfoPequeno'><span class='centralizar_texto'>"+nomemesa+"</span></div>";
					}
				}

				client.emit("resultadoGarcomMesa", resultado);

				var contador = 0,
					resultado = "",
					produtos = lstSalas[id_pedido].produtos;

				if(typeof produtos != "undefined"){	
					
					while(contador < produtos.length){
						nomeproduto = produtos[contador].nome,
						idproduto = produtos[contador].id_produto;
						qntd = produtos[contador].qtd,
						idpedidoproduto = produtos[contador].id_produto_pedido,
						statusproduto = produtos[contador].status;
						

					   if(typeof nomeproduto != 'undefined'){	
						
						   var nomestatusdiv = "Em espera",
							   stylestatus = "margin-left: 0;color: #ffffff;width: 70px;height: 30px;line-height: 30px;font-size: 80%;background-color: #f3c425;",
							   mostraring = "onclick='mostrarIngrendientes("+idproduto+")'",
							   funcaoBotaoStatus = "onclick='mudarStatusProdutos(2, "+id_pedido+", "+idpedidoproduto+")'";	
						
						   if(statusproduto == 2){
							   var 	nomestatusdiv = "Feito",
									stylestatus = "margin-left: 0;color: #ffffff;width: 70px;height: 30px;line-height: 30px;font-size: 80%;background-color: #71dc62;",
									mostraring = "",
									funcaoBotaoStatus = "";
						   }   
						
						   resultado = resultado +  "<div class='tituloInfo_caixa' "+mostraring+"> " +
													"<div class='tituloInfoPequenoQntI'><span class='centralizar_texto'>Quantidade</span></div> " +
													"<div class='divisoria'></div> " +
													"<div class='tituloInfoQntI'><span class='centralizar_texto'>Nome Produto</span></div> " +
													"<div class='conteudoInfoPequeno'><span class='centralizar_texto'>"+qntd+"</span></div>" +
													"<div class='divisoriaB'></div> " +
													"<div class='conteudoInfo'><span class='centralizar_texto'>"+nomeproduto+"</span><span style='"+stylestatus+"' "+funcaoBotaoStatus+">"+nomestatusdiv+"</span></div> " +
													"</div>" +
													"<div id='titulo_ingredientes"+idproduto+"' class='tituloIng'><span class='centralizar_texto'>Ingredientes</span></div>" +
													"<div id='div_ingredientesNomes"+idproduto+"' class='div_ingredientesNomes'></div>";
					   }else{
					   }	   

						contador = contador + 1;
					}
					client.emit("resultadoProdutoQntd", resultado);
				}else{
				}		

            });
		}
    });

    client.on("selectIngredientesProdutos", function(idproduto){
        var command = "select ip.quantidade, i.nome as 'nome_ingrediente', ip.detalhe, ti.sigla from tbl_ingredienteproduto as ip " +
                       "inner join tbl_ingrediente as i on i.id_ingrediente = ip.id_ingrediente " +
                       "inner join tbl_tipounit as ti on ti.id_tipounit = ip.id_tipounit " +
                       "where id_produto = "+idproduto;

        con.query(command, function(err, result, fields){
            var contador = 0;
                resultado = "";
            while(contador < result.length){
                var quantidade = result[contador].quantidade,
                    nomeingrediente = result[contador].nome_ingrediente,
                    detalhe = result[contador].detalhe,
                    sigla = result[contador].sigla;

                resultado = resultado + "<p>"+quantidade+""+sigla+" de "+nomeingrediente+" "+detalhe+"/p Unidade</p>";

                contador = contador + 1;
            }
            client.emit("resultadoIngredienteProduto"+idproduto, resultado);
        });
    });

    client.on("mudarStatus", function(idstatus, idpedido){

        var command = "select nome from tbl_status where id_status = "+idstatus;

        con.query(command, function(err, result, fields){
			if(result.length > 0){
				var nomestatus = result[0].nome;
				lstSalas[idpedido].status = idstatus;
				lstSalas[idpedido].status_nome = nomestatus;
			}else{
			}			
        });
    });
	
	client.on("mudarStatusProduto", function(idstatus, idpedido, idpedidoproduto){

        var command = "select nome from tbl_status where id_status = "+idstatus;

        con.query(command, function(err, result, fields){
			if(result.length > 0){
				var nomestatus = result[0].nome;
				lstSalas[idpedido].produtos[idpedidoproduto].status = idstatus;
				lstSalas[idpedido].produtos[idpedidoproduto].status_nome = nomestatus;
				
				io.sockets.emit("novo_produto", {id_funcionario : lstSalas[idpedido].id_funcionario, id_cliente : lstSalas[idpedido].id_cliente});
				
			}else{
			}			
        });
    });

});

app.get('/selectRestaurante', function(req, res){

  var command = "select r.id_restaurante, r.nome, r.imagem, r.descricao, concat(coalesce(es.nome, ''), ', ' , coalesce(c.nome, ''), ', ' , "+
	"coalesce(e.bairro, '') , ', ' , coalesce(e.rua, '') , ', ' , coalesce(e.numero, '')) "+
	"as 'endereco' from tbl_restaurante as r "+
	"inner join tbl_endereco as e "+
	"on r.id_endereco = e.id_endereco "+
	"inner join tbl_cidade as c "+
	"on c.id_cidade = e.id_cidade "+
	"inner join tbl_estado as es "+
	"on c.id_estado = es.id_estado "+
	"order by r.id_restaurante asc";

  con.query(command, function (err, result, fields) {
    if (err) throw err;
    res.send(result);
  });


});

app.get('/filtroRestaurante', function(req, res){
	
	var texto = req.query.texto;
	
	if (typeof texto != 'undefined'){
		var command = "select r.id_restaurante, r.nome, r.imagem, r.descricao, concat(coalesce(es.nome, ''), ', ' , coalesce(c.nome, ''), ', ' , "+
			"coalesce(e.bairro, '') , ', ' , coalesce(e.rua, '') , ', ' , coalesce(e.numero, '')) "+
			"as 'endereco' from tbl_restaurante as r "+
			"inner join tbl_endereco as e "+
			"on r.id_endereco = e.id_endereco "+
			"inner join tbl_cidade as c "+
			"on c.id_cidade = e.id_cidade "+
			"inner join tbl_estado as es "+
			"on c.id_estado = es.id_estado "+
			"where r.nome like '%" + texto + "%' or "+
			"es.nome like '%" + texto + "%' or "+
			"c.nome like '%" + texto + "%' or "+
			"e.logradouro like '%" + texto + "%' or "+
			"e.bairro like '%" + texto + "%' or "+
			"e.rua like '%" + texto + "%' or "+
			"r.descricao like '%" + texto + "%' "+
			"order by r.id_restaurante asc";

		con.query(command, function (err, result, fields) {
			if (err) throw err;
			res.send(result);
		});
	}else{
		var command = "select r.id_restaurante, r.nome, r.imagem, r.descricao, concat(coalesce(es.nome, ''), ', ' , coalesce(c.nome, ''), ', ' , "+
			"coalesce(e.bairro, '') , ', ' , coalesce(e.rua, '') , ', ' , coalesce(e.numero, '')) "+
			"as 'endereco' from tbl_restaurante as r "+
			"inner join tbl_endereco as e "+
			"on r.id_endereco = e.id_endereco "+
			"inner join tbl_cidade as c "+
			"on c.id_cidade = e.id_cidade "+
			"inner join tbl_estado as es "+
			"on c.id_estado = es.id_estado "+
			"order by r.id_restaurante asc";

		con.query(command, function (err, result, fields) {
			if (err) throw err;
			res.send(result);
		});
	}

});

app.get('/selectPeriodo', function(req, res){

  var command = "select * from tbl_periodo";

  con.query(command, function (err, result, fields) {
    if (err) throw err;
    res.send(result);
  });


});

app.get('/feedbacks', function(req, res){

  var command = "select * from tbl_avaliacao";

  con.query(command, function (err, result, fields) {
    if (err) throw err;
    res.send(result);
  });


});

app.get('/avaliar', function(req, res){
	
	var id_pedido = req.query.id_pedido,
		id_avaliacao = req.query.id_avaliacao;
	
	if (typeof id_pedido != 'undefined' && typeof id_avaliacao != 'undefined'){
		
		command = "insert into tbl_feedback(id_pedido, id_avaliacao) "+
			"values('" + id_pedido + "', '" + id_avaliacao + "')";
		con.query(command, function (err, result, fields) {
			if (err) throw err + command;
			res.send({mensagem : "Feedback foi feito com êxito."});
		});
	}else{
		res.send({mensagem : "Informações insuficientes."});
	}

});

app.get('/inserirFaleconosco', function(req, res){

	var nome = req.query.nome,
		email = req.query.email,
		celular = req.query.celular,
		telefone = req.query.telefone,
		obs = req.query.obs,
		id_restaurante = req.query.id_unidade,
		id_periodo = req.query.id_periodo,
		id_tipoinfo = req.query.id_tipoinfo;

	if (nome == "" || email == "" || celular == ""){
		res.send({mensagem : "Verifique todos os campos com * e preencha-os."});
	}else{
		var command = "insert into tbl_faleconosco(id_restaurante, id_tipoinfo, nome_completo, email, obs, celular, telefone) "+
			"values('" + id_restaurante + "', '" + id_tipoinfo + "', '" + nome + "', '" + email + "', '" + obs + "', '" + celular + "', '" + telefone + "')";

		con.query(command, function (err, result, fields) {
			if (err) throw err;
			res.send({mensagem : "Obrigado pelo contado. Sua informação foi enviada com sucesso."});
		});

	}

});

app.get('/selectTipoInfo', function(req, res){

  var command = "select * from tbl_tipoinfo";

  con.query(command, function (err, result, fields) {
    if (err) throw err;
    res.send(result);
  });


});

app.get('/selectCardapio', function(req, res){

  var command = "select id_produto, nome as 'nome_produto', descricao as 'desc_produto', imagem as 'foto_produto', concat('R$ ', format(preco,2,'de_DE')) as 'preco_produto' from tbl_produto order by nome_produto asc;";

  con.query(command, function (err, result, fields) {
    if (err) throw err;
    res.send(result);
  });


});

app.get('/selectCardapioMain', function(req, res){

  var command = "select id_produto, nome as 'nome_produto', descricao as 'desc_produto', imagem as 'foto_produto', concat('R$ ', format(preco,2,'de_DE')) as 'preco_produto' from tbl_produto where statusAprovacao = 1 order by nome_produto asc;";

  con.query(command, function (err, result, fields) {
    if (err) throw err;
    res.send(result);
  });


});

app.get('/selectCliente', function(req, res){
	var id_cliente = req.query.id_usuario;

	if (typeof id_cliente != 'undefined'){

		var command = "select c.login as 'login', c.senha as 'senha', c.nome as 'nome', c.sobrenome as 'sobrenome', "+
		"c.celular as 'celular', c.telefone as 'telefone', c.email as 'email', c.foto as 'foto', "+
		"e.logradouro as 'logradouro', e.bairro as 'bairro', e.rua as 'rua', e.numero as 'numero', "+
		"cc.numero as 'numerocartao', cc.nome_cartao as 'nomereg', cc.cvv as 'cvv', cc.data as 'vencimento', "+
		"cc.id_cartaocredito as 'id_cartaocredito', ci.id_cidade as 'id_cidade', es.id_estado as 'id_estado', b.nome as 'bandeira' "+
		"from tbl_cliente as c "+
		"inner join tbl_endereco as e "+
		"on c.id_endereco = e.id_endereco "+
		"inner join tbl_cidade as ci "+
		"on ci.id_cidade = e.id_cidade "+
		"inner join tbl_estado as es "+
		"on ci.id_estado = es.id_estado "+
		"left join tbl_cartaocredito as cc "+
		"on cc.id_cliente = c.id_cliente "+
		"left join tbl_banco as b "+
		"on b.id_banco = cc.id_banco "+
		"where c.id_cliente = '" + id_cliente + "'";

		con.query(command, function(err, result, fields){
			if (err) throw err + command;

			res.send(result);
		});
	}else{
		res.send({mensagem : "Não logado."});
	}
});

app.get('/cadastrarUsuario', function(req, res){

  var login = req.query.login,
		senha = req.query.senha,
		nome = req.query.nome,
		sobrenome = req.query.sobrenome,
		celular = req.query.celular,
		telefone = req.query.telefone,
		email = req.query.email,
		logradouro = req.query.logradouro,
		numero = req.query.numero,
		numero_cartao = req.query.numero_cartao,
		bairro = req.query.bairro,
		rua = req.query.rua,
		nome_cartao = req.query.nome_cartao,
		cvv = req.query.cvv,
		vencimento = req.query.vencimento,
		id_banco = req.query.id_banco,
		id_cidade = req.query.id_cidade;

  if (login == "" || senha == "" || nome == "" || sobrenome == "" || celular == "" || telefone == "" || email == "" || senha == "" || logradouro == "" || numero == "" || bairro == "" || rua == ""){
		res.send({mensagem : "Verifique todos os campos com * e preencha-os"});
  }else{
		var commandVer = "select * from tbl_cliente where login = '" + login + "'";

		con.query(commandVer, function(errVer, resultVer, fieldsVer){
			if (errVer) throw errVer + commandVer;

			if (resultVer.length == 0){

				var commandVer2 = "select * from tbl_cliente where email = '" + email + "'";

				con.query(commandVer2, function(errVer2, resultVer2, fieldVer2){
					if (errVer2) throw errVer2 + commandVer2;

					if (resultVer2.length == 0){

						var command = "insert into tbl_endereco(id_cidade, logradouro, bairro, rua, numero) "+
						"values('" + id_cidade + "', '" + logradouro + "', '" + bairro + "', '" + rua + "', '" + numero + "')";

						con.query(command, function(err, result, fields){
							if (err) throw err + command;

							var command2 = "select * from tbl_endereco order by id_endereco desc limit 0,1";

							con.query(command2, function(err2, result2, fields2){
								if (err2) throw err2 + command2;

								var command3 = "insert into tbl_cliente(id_endereco, login, senha, nome, sobrenome, email, celular, telefone, foto) " +
								"values('" + result2[0].id_endereco + "', '" + login + "', '" + senha + "', '" + nome + "', '" + sobrenome + "', '" + email + "', '" + celular + "', '" + telefone + "', 'arquivos/foto_usuario/standardUser.png')";

								con.query(command3, function(err3, result3, fields3){
									if (err3) throw err3 + command3;

									if (nome_cartao == "" || cvv == "" || vencimento == "" || id_banco == ""){
										res.send({mensagem : "Conta criada com sucesso. Já é possível logar-se. (O cartão não foi cadastrado por falta de dados)"});
									}else{
										var command4 = "select * from tbl_cliente where login = '" + login + "' and senha = '" + senha + "'";

										con.query(command4, function(err4, result4, fields4){
											if (err4) throw err4 + command4;

											var command5 = "insert into tbl_cartaocredito(id_cliente, id_banco, numero, nome_cartao, data, cvv) "+
												"values('" + result4[0].id_cliente + "', '" + id_banco + "', '" + numero_cartao + "', '" + nome_cartao + "', '" + vencimento + "', '" + cvv + "')";

											con.query(command5, function(err5, result5, fields5){
												if (err5) throw err5 + command5;

												res.send({mensagem : "Conta criada com sucesso. Já é possível logar-se."});
											});
										});
									}


								});
							});
						});

					}else{
						res.send({mensagem : "E-mail já em uso."});
					}
				});
			}else{
				res.send({mensagem : "Login já em uso."});
			}
		});
	}



});

app.get('/updateUsuario', function(req, res){

	var login = req.query.login,
		senha = req.query.senha,
		senhaatual = req.query.senhaatual,
		nome = req.query.nome,
		sobrenome = req.query.sobrenome,
		celular = req.query.celular,
		telefone = req.query.telefone,
		email = req.query.email,
		logradouro = req.query.logradouro,
		numero = req.query.numero,
		numero_cartao = req.query.numero_cartao,
		bairro = req.query.bairro,
		rua = req.query.rua,
		nome_cartao = req.query.nome_cartao,
		cvv = req.query.cvv,
		vencimento = req.query.vencimento,
		id_banco = req.query.id_banco,
		id_cliente = req.query.id_cliente,
		id_cidade = req.query.id_cidade;

	if (login == "" || senha == "" || nome == "" || sobrenome == "" || celular == "" || telefone == "" || email == "" || senha == "" || logradouro == "" || numero == "" ||
	bairro == "" || rua == ""){
		res.send({mensagem : "Verifique todos os campos com * e preencha-os"});
	}else{

		var commandVer = "select * from tbl_cliente where id_cliente = '" + id_cliente + "'";

		con.query(commandVer, function(errVer, resultVer, fieldsVer){

			if(senhaatual == resultVer[0].senha){

				var command = "update tbl_cliente set login = '" + login + "', senha = '" + senha + "', nome = '" + nome + "', sobrenome = '" + sobrenome + "', email = '" + email + "', celular = '" + celular + "', telefone = '" + telefone + "' where id_cliente = '" + id_cliente + "'";

				con.query(command, function(err, result, fields){
					if (err) throw err + command;

					var command2 = "update tbl_endereco set id_cidade = '" + id_cidade + "', logradouro = '" + logradouro + "', bairro = '" + bairro + "', rua = '" + rua + "', numero = '" + numero + "'";

					con.query(command2, function(err2, result2, fields2){
						if (err2) throw err2 + command2;

						var command3 = "select * from tbl_cartaocredito where id_cliente = '" + id_cliente + "'";

						con.query(command3, function(err3, result3, fields3){
							if (err3) throw err3 + command3;

							if (result3.length > 0){
								if (nome_cartao == "" || cvv == "" || vencimento == "" || id_banco == ""){
									var command4 = "delete from tbl_cartaocredito where id_cliente = '" + id_cliente + "'";

									con.query(command4, function(err4, result4, fields4){
										if (err4) throw err4 + command4;

										res.send({mensagem : "Atualizado com sucesso."});
									});
								}else{
									var command4 = "update tbl_cartaocredito set id_banco = '" + id_banco + "', numero = '" + numero_cartao + "', nome_cartao = '" + nome_cartao + "', data = '" + vencimento + "', cvv = '" + cvv + "' where id_cliente = '" + id_cliente + "'";

									con.query(command4, function(err4, result4, fields4){
										if (err4) throw err4 + command4;

										res.send({mensagem : "Atualizado com sucesso."});
									});
								}
							}else{
								if (nome_cartao == "" || cvv == "" || vencimento == "" || id_banco == ""){
									res.send({mensagem : "Atualizado com sucesso. (O cartão não foi cadastrado por falta de dados)"});
								}else{
									var command4 = "insert into tbl_cartaocredito(id_cliente, id_banco, numero, nome_cartao, data, cvv) "+
										"values('" + id_cliente + "', '" + id_banco + "', '" + numero_cartao + "', '" + nome_cartao + "', '" + vencimento + "', '" + cvv + "')";

									con.query(command4, function(err4, result4, fields4){
										if (err4) throw err4 + command4;

										res.send({mensagem : "Atualizado com sucesso."});
									});

								}
							}
						});
					});
				});
			}else{
				res.send({mensagem : "Senha atual incorreta."});
			}
		});

	}

});

app.get('/selectHistoricoPedidos', function(req, res){

  var command = "select p.id_pedido as 'idpedido', r.nome as 'restaurante', p.data as 'data' from tbl_pedido as p " +
                  "inner join tbl_funcionario as f on f.id_funcionario = p.id_funcionario INNER JOIN tbl_restaurante as r on f.id_restaurante = r.id_restaurante";

  con.query(command, function (err, result, fields) {
    if (err) throw err + command;

      var result2;

      for (var i = 0; i < result.length; i++) {

          var id_pedido = result[i].idpedido;

          var command2 = "select count(*) from tbl_pedidoproduto where id_pedido = " + id_pedido;

          con.query(command2, function (err2, result2, fields2) {
              if (err2) throw err2;

              result2 = result2 + result2;
          });
      }

      res.send(result + result2);

  });
});

app.get('/historicoPedidos', function(req, res){

  var command = "select p.id_pedido, DATE_FORMAT(p.data, '%d/%m/%Y')as 'data', r.nome as 'restaurante', "+
		"(select count(*) from tbl_pedidoproduto as pp where pp.id_pedido = p.id_pedido) as 'qtd' "+
		"from tbl_pedido as p "+
		"inner join tbl_mesa as m "+
		"on p.id_mesa = m.id_mesa "+
		"inner join tbl_restaurante as r "+
		"on r.id_restaurante = m.id_restaurante "+
		"where p.id_cliente = '" + req.query.id_cliente + "' order by p.data desc";

  con.query(command, function (err, result, fields) {
    if (err) throw err + command;
	
	res.send(result);

  });
});

app.get('/perfilFuncionario', function(req, res){

  var command = "select id_funcionario, nome_completo, cpf, email, telefone, celular, num_registro, r.nome as 'restaurante' from tbl_funcionario as f "+
	"inner join tbl_restaurante as r "+
	"on r.id_restaurante = f.id_restaurante where id_funcionario = '" + req.query.id_funcionario + "'";
	
  con.query(command, function (err, result, fields) {
    if (err) throw err + command;
	
	res.send(result);

  });
});

app.get('/disconnect', function(req, res){

	res.send(disconnect,1);

});

app.get('/inserir', function(req, res){

	var _id = lstPedidos.length,
		_endereco = req.query.endereco,
		_titulo = req.query.titulo,
		_descricao = req.query.descricao,
		_telefone = req.query.telefone,
		_foto = req.query.caminhoFoto,
		p = { id_restaurante : _id, endereco_restaurante : _endereco , nome_restaurante : _titulo , desc_restaurante: _descricao, telefone_restaurante: _telefone, foto_restaurante: _foto};

	lstPedidos.push(p);

	res.send({ mensagem : "Inserido com sucesso"});
	io.sockets.emit("novo_usuario", p);

});

app.get('/autenticarUsuario', function(req, res){

	var _email = req.query.email,
		_senha = req.query.senha,
    resultadoFinal = {};

  var contador = 0;
  var command = "select * from tbl_cliente where email = '" + _email + "' or login='" + _email + "' and senha = '" + _senha + "'";

  con.query(command, function(err, result, fields) {
      if (err) throw err + command;

      // Verificação das linhas no select
      if (contador < result.length) {

          var foto = result[contador].foto;
          var id = result[contador].id_cliente;
          var nome = result[contador].nome;

          var permissao = 1;

          resultadoFinal = {id_usuario : id, permissao : permissao, foto : foto, nome : nome, mensagem : 'Login efetuado com sucesso.'};

          contador = contador + 1;

      }else{
          var contador2 = 0;
          var command2 = "select * from tbl_funcionario where email = '" + _email + "' or login = '" + _email + "' and senha = '" + _senha + "'";

          con.query(command2, function(err, result, fields) {
              if (err) throw err + command2;

              // Verificação das linhas no select
              if (contador2 < result.length) {

                  var foto = result[contador2].foto;
                  var id = result[contador2].id_funcionario;
                  var nome = result[contador2].nome_completo;

                  var permissao = 2;

                  resultadoFinal = {id_usuario : id, permissao : permissao, foto : foto, nome : nome, mensagem : 'Login efetuado com sucesso.'};

                  contador2 = contador2 + 1;

              }else{
                  resultadoFinal = {permissao : 0, mensagem : 'Usuário ou senha incorretos. Verifique e tente novamente.'};
              }

              res.send(resultadoFinal);
          });
      }

      if (contador != 0){
          res.send(resultadoFinal);
      }

  });
});

app.get('/autenticarUsuarioSala', function(req, res){

	var _email = req.query.email,
		_senha = req.query.senha,
		_id_pedido = req.query.id_pedido,
    resultadoFinal = {};

  var contador = 0;
  var command = "select * from tbl_cliente where email = '" + _email + "' or login='" + _email + "' and senha = '" + _senha + "'";

  con.query(command, function(err, result, fields) {
	    if (err) throw err + command;

		  // Verificação das linhas no select
		if (contador < result.length) {
			var id = result[contador].id_cliente;
			var nome = result[contador].nome;
			lstSalas[_id_pedido].id_cliente = id;
			lstSalas[_id_pedido].nome_cliente = nome;
			resultadoFinal = {id_usuario : id, nome : nome, mensagem : 'Login efetuado com sucesso.'};
			contador = contador + 1;
		 }

		if (contador != 0){
			res.send(resultadoFinal);
		}else{
			res.send({mensagem : "Usuário ou senha incorretos. Verifique e tente novamente."});
		}

  });
});

app.get('/autenticarUsuarioSalaCadastro', function(req, res){

	var _email = req.query.email,
		_nome = req.query.nome,
		_sobrenome = req.query.sobrenome,
		_id_pedido = req.query.id_pedido,
		resultadoFinal = {};

	if (typeof _nome != 'undefined' && typeof _sobrenome != 'undefined' && typeof _email != 'undefined'){

		var command = "insert into tbl_cliente(email,nome,sobrenome) values('" + _email + "', '" + _nome + "', '" + _sobrenome + "')";

		con.query(command, function(err, result, fields) {
			if (err) throw err + command;

			var command2 = "select * from tbl_cliente order by id_cliente desc limit 0,1";

			con.query(command2, function(err2, result2, fields2){

				var id = result2[0].id_cliente;
				var nome = result2[0].nome;

				lstSalas[_id_pedido].id_cliente = id;
				lstSalas[_id_pedido].nome_cliente = nome;

				resultadoFinal = {id_usuario : id, nome : nome, mensagem : 'Login efetuado com sucesso.'};

				res.send(resultadoFinal);

			});
		});
	}else{
		res.send({mensagem : "Dados incorretos. Verifique e tente novamente."});
	}
});

app.get('/infSala', function(req, res){
	var _id_sala = req.query.id_sala;

	res.send(lstSalas[_id_sala]);
});

app.get('/listarDetalhesPedido', function(req, res){
	var _id_sala = req.query.id_sala,
			contador = 0,
			verificador = 0;

	while(contador < lstSalas.length){

		if(lstSalas[contador].id_sala == _id_sala){

			res.send(lstSalas[contador]);

			verificador = 1;
			break;
		}

		contador = contador + 1;
	}

	if(verificador == 0){
		res.send({mensagem : "Este pedido não foi encontrado."});
	}

});

app.get('/autenticarSala', function(req, res){
	var _qr_code = req.query.qr;
	var _id_cliente = req.query.id_cliente;

	var contador = 0,
			verificador = 0,
			_id_funcionario = 0,
			_id_sala = 0,
			_nome = "";

	while (contador < lstSalas.length){

		if(lstSalas[contador].qr_code == _qr_code){
			verificador = 1;
			_id_funcionario = lstSalas[contador].id_funcionario;
			_id_sala = lstSalas[contador].id_sala;
			lstSalas[contador].id_cliente = _id_cliente;
			lstSalas[contador].nome_cliente = _nome;

			var command = "select nome from tbl_cliente where id_cliente = '" + _id_cliente + "'";

			con.query(command, function(err, result, fields){
				if (err) throw err + command;

				_nome = result[0].nome;

				lstSalas[contador].nome_cliente = _nome;

				res.send({ mensagem : "Autenticado com sucesso.", id_sala : _id_sala });
			});

			break;

		}

		contador = contador + 1;
	}

	if (verificador != 1){
		res.send({ mensagem : "Código QR inválido."});
	}else{

		io.sockets.emit("novo_pedido_autenticado", {id_funcionario : _id_funcionario, id_sala : _id_sala, id_cliente : _id_cliente});
	}
});

app.get('/mesaSala', function(req, res){
	var _id_mesa = req.query.id_mesa;

	var contador = 0, verificador = 0;

	while (contador < lstSalas.length){

		if(lstSalas[contador].qr_code == _qr_code){
			verificador = 1;
			res.send({ mensagem : "Autenticado com sucesso.", id_sala : lstSalas[contador].id_sala });
		}

		contador = contador + 1;
	}

	if (verificador != 1){
		res.send({ mensagem : "Código QR inválido."});
	}
});

app.get('/criacaoSala', function(req, res){

	var _id_sala = lstSalas.length,
      _id_funcionario = req.query.id_funcionario,
      _qr_code = "",
			_tamanho = 0;

	var command = "select e.uf as 'uf', r.id_restaurante as 'id_rest' from tbl_funcionario as f "+
									"inner join tbl_restaurante as r "+
									"on f.id_restaurante = r.id_restaurante "+
									"inner join tbl_endereco as en "+
									"on r.id_endereco = en.id_endereco "+
									"inner join tbl_cidade as c "+
									"on c.id_cidade = en.id_cidade "+
									"inner join tbl_estado as e "+
									"on e.id_estado = c.id_estado "+
									"where f.id_funcionario = '" + _id_funcionario + "'";

	con.query(command, function(err, result, fields){
		if (err) throw err + command;

		if (result.length > 0){

			var contador = 0;

			//Número utilizado para o qrcode
			var numero = 0;
			//Verificador de local para o armazenamento no qrcode
			while (contador < _id_sala){
				if (typeof lstSalas[contador].qr_code != 'undefined'){
					var qr = lstSalas[contador].qr_code.slice(0,2);

					if (qr == result[0].uf){
						numero = numero + 1;
					}
				}
				contador = contador + 1;
			};
			//Formata o número de acordo com um padrão
			var formattedNumber = ("00000" + numero).slice(-5);

			_qr_code = result[0].uf;
			_qr_code = _qr_code + formattedNumber;

			var _id_restaurante = result[0].id_rest;

			var s = {id_sala : _id_sala, id_restaurante : _id_restaurante, id_cliente : 0, id_mesa : 0, produtos : [], nome_cliente : "", status_nome : "Em espera", id_funcionario : _id_funcionario, mesa : "", qr_code : _qr_code, status : 0, mensagem : "Sala criada com sucesso."};

			lstSalas.push(s);

			//res.send({id_sala : _id_sala, id_funcionario : _id_funcionario, produtos : lstProdutos[_id_sala], tamanho : lstProdutos[_id_sala].length});
			
			io.sockets.emit("novo_pedido", lstSalas[_id_sala]);
			
			res.send(lstSalas[_id_sala]);
		}else{
			res.send({mensagem : "Ocorreu um erro durante a conexão. Tente novamente mais tarde."});
		}

	});

});

app.get('/selectBancos',function(req,res){

	var command = "select * from tbl_banco"
		verificador = 0;

	con.query(command, function(err, result, fields){
		if (err) throw err + command;

		if (result.length > 0){
			res.send(result);
		}else{
			res.send({mensagem : "Ocorreu um erro de conexão. Tente novamente mais tarde."});
		}


	});

});

app.get('/selectEstados',function(req,res){

	var command = "select * from tbl_estado";

	con.query(command, function(err, result, fields){
		if (err) throw err + command;

		if (result.length > 0){
			res.send(result);
		}else{
			res.send({mensagem : "Ocorreu um erro de conexão. Tente novamente mais tarde."});
		}


	});

});

app.get('/selectCidades',function(req,res){

	var command = "select * from tbl_cidade where id_estado = " + req.query.id_estado;

	con.query(command, function(err, result, fields){
		if (err) throw err + command;

		if (result.length > 0){
			res.send(result);
		}else{
			res.send({mensagem : "Ocorreu um erro de conexão. Tente novamente mais tarde."});
		}

	});

});

app.get('/historicoReservas',function(req,res){

	var command = "select DATE_FORMAT(r.dataMarcada, '%d/%m/%Y')as 'data', r.id_restaurante, re.nome, "+
		"re.imagem as 'foto', re.descricao as 'desc', p.nome as 'periodo', s.nome as 'status' from tbl_reserva as r "+
		"inner join tbl_restaurante as re "+
		"on r.id_restaurante = re.id_restaurante "+
		"inner join tbl_periodo as p "+
		"on p.id_periodo = r.id_periodo "+
		"inner join tbl_status as s "+
		"on s.id_status = r.id_status "+
		"where r.id_cliente = '" + req.query.id_cliente + "'";
	
	con.query(command, function(err, result, fields){
		if (err) throw err + command;

		if (result.length > 0){
			res.send(result);
		}else{
			res.send({mensagem : "Não há reservas."});
		}

	});

});

app.get('/finalizarPedidoFisico', function(req, res){
	var _id_sala = req.query.id_sala;
	var _id_cliente = lstSalas[_id_sala].id_cliente;

	if (lstSalas[_id_sala].id_cliente == "" || lstSalas[_id_sala].id_mesa == 0 || lstSalas[_id_sala].produtos.length == 0){
		lstSalas[_id_sala] = {};
		res.send({mensagem : "O pedido não pode ser enviado por informações insuficientes. Tente novamente."});
	}else{

		var qtd_produtos = lstSalas[_id_sala].produtos;
		var command = "insert into tbl_pedido (id_funcionario, id_cliente, id_mesa, data) "+
									"values('" + lstSalas[_id_sala].id_funcionario + "','" + lstSalas[_id_sala].id_cliente + "', '" + lstSalas[_id_sala].id_mesa + "', now())";
		var id_pedido;
		con.query(command, function(err){
			if (err) throw err + command;

			var command2 = "select * from tbl_pedido order by id_pedido desc limit 0,1";

			con.query(command2, function(err2,result2,fields2){
				if (err2) throw err2 + command2;
				_id_pedido = result2[0].id_pedido;

				var produtos = lstSalas[_id_sala].produtos;
				var contador = 0;

				while (contador < produtos.length){
					
					if (typeof produtos[contador].id_produto != 'undefined'){
						var command3 = "insert into tbl_pedidoproduto(id_pedido, id_produto) "+
							"values('" + _id_pedido + "', '" + produtos[contador].id_produto + "')";

						con.query(command3, function(err3){
							if (err3) throw err3 + command3;
						});
					}

					contador = contador + 1;
				}
				
				var command4 = "select saldo from tbl_cliente where id_cliente = '" + _id_cliente + "'";

				con.query(command4, function(err4, result4, fields4){
					if (err4) throw err4 + command4;
					var saldo = result4[0].saldo;
					
					var command5 = "select sum(p.preco) as 'preco' from tbl_pedidoproduto as pp "+
						"inner join tbl_produto as p "+
						"on p.id_produto = pp.id_produto "+
						"where id_pedido = '" + _id_pedido + "';";
					
					con.query(command5, function(err5, result5, fields5){
						if (err5) throw err5 + command5;
						
						if (saldo > result5[0].preco){
							var saldoTotal = saldo - result5[0].preco;
							
							command6 = "update tbl_cliente set saldo = '" + saldoTotal + "' where id_cliente = '" + _id_cliente + "'";
							
							con.query(command6, function(err6, result6, fields6){
								if(err6) throw err6 + command6;
								
							});
						}else{
							command6 = "update tbl_cliente set saldo = '0' where id_cliente = '" + _id_cliente + "'";
							
							con.query(command6, function(err6, result6, fields6){
								if(err6) throw err6 + command6;
								
							});
						}
					});
				});

				io.sockets.emit("pedido_finalizado",  _id_cliente);
				lstSalas[_id_sala] = {};
				
				res.send({mensagem : "Finalizado com sucesso.", id_pedido : _id_pedido});
			});
		});
	}

});

app.get('/finalizarPedidoVirtual', function(req, res){
	var _id_sala = req.query.id_sala;
	var _id_cliente = lstSalas[_id_sala].id_cliente;

	if (lstSalas[_id_sala].id_cliente == "" || lstSalas[_id_sala].id_mesa == 0 || lstSalas[_id_sala].produtos.length == 0){
		lstSalas[_id_sala] = {};
		res.send({mensagem : "O pedido não pode ser enviado por informações insuficientes. Tente novamente."});
	}else{
		
		var commandVer = "select * from tbl_cartaocredito where id_cliente = '" + _id_cliente + "'";
		
		con.query(commandVer, function(err, result, fields){
			
			if (result.length > 0){
				var qtd_produtos = lstSalas[_id_sala].produtos;
				var command = "insert into tbl_pedido (id_funcionario, id_cliente, id_mesa, data) "+
											"values('" + lstSalas[_id_sala].id_funcionario + "','" + lstSalas[_id_sala].id_cliente + "', '" + lstSalas[_id_sala].id_mesa + "', now())";
				var id_pedido;
				con.query(command, function(err){
					if (err) throw err + command;

					var command2 = "select * from tbl_pedido order by id_pedido desc limit 0,1";

					con.query(command2, function(err2,result2,fields2){
						if (err2) throw err2 + command2;
						_id_pedido = result2[0].id_pedido;

						var produtos = lstSalas[_id_sala].produtos;
						var contador = 0;

						while (contador < produtos.length){
							
							if (typeof produtos[contador].id_produto != 'undefined'){
								var command3 = "insert into tbl_pedidoproduto(id_pedido, id_produto) "+
									"values('" + _id_pedido + "', '" + produtos[contador].id_produto + "')";

								con.query(command3, function(err3){
									if (err3) throw err3 + command3;
								});
							}

							contador = contador + 1;
						}
						
						var command4 = "select saldo from tbl_cliente where id_cliente = '" + _id_cliente + "'";

						con.query(command4, function(err4, result4, fields4){
							if (err4) throw err4 + command4;
							var saldo = result4[0].saldo;
							
							var command5 = "select sum(p.preco) as 'preco' from tbl_pedidoproduto as pp "+
								"inner join tbl_produto as p "+
								"on p.id_produto = pp.id_produto "+
								"where id_pedido = '" + _id_pedido + "';";
							
							con.query(command5, function(err5, result5, fields5){
								if (err5) throw err5 + command5;
								
								if (saldo > result5[0].preco){
									var saldoTotal = saldo - result5[0].preco;
									
									command6 = "update tbl_cliente set saldo = '" + saldoTotal + "' where id_cliente = '" + _id_cliente + "'";
									
									con.query(command6, function(err6, result6, fields6){
										if(err6) throw err6 + command6;
										
									});
								}else{
									command6 = "update tbl_cliente set saldo = '0' where id_cliente = '" + _id_cliente + "'";
									
									con.query(command6, function(err6, result6, fields6){
										if(err6) throw err6 + command6;
										
									});
								}
							});
						});

						io.sockets.emit("pedido_finalizado",  _id_cliente);
						lstSalas[_id_sala] = {};
						
						res.send({mensagem : "Finalizado com sucesso.", id_pedido : _id_pedido});
					});
				});
			}else{
				res.send({mensagem : "Esta opção não é possível a este usuário."});
			}			
		});
		
	}

});

app.get('/chamarGarcom', function(req,res){
	var _id_sala = req.query.sala;
	
	if (typeof _id_sala != 'undefined'){
		var _mesa = lstSalas[_id_sala].mesa;
		var _id_funcionario = lstSalas[_id_sala].id_funcionario;
		
		io.sockets.emit("chamarGarcom", {id_funcionario : _id_funcionario, mesa : _mesa});
		res.send({mensagem : "O garçom foi chamado com sucesso."});
	}else{
		res.send({mensagem : "Não foi possível chamar o garçom. Tente novamente mais tarde"});
	}
});

app.get('/selectSobrenos', function(req,res){
	
	var command = "select * from tbl_sobrenos where status = 1";
	
	con.query(command, function(err, result, fields){
		res.send({mensagem : result[0].texto});
	});
	
	
});

app.get('/excluirProduto', function(req,res){
	var _id_produto_pedido = req.query.id_produto_pedido,
		_id_pedido = req.query.id_pedido;
		
	if (typeof _id_produto_pedido != 'undefined' && typeof _id_pedido != 'undefined'){
		lstSalas[_id_pedido].produtos[_id_produto_pedido] = {};
		
		io.sockets.emit("novo_produto", {id_funcionario : lstSalas[_id_pedido].id_funcionario, id_cliente : lstSalas[_id_pedido].id_cliente});
		
		res.send({mensagem : "Excluído com sucesso."});
	}
});

app.get('/adicionarProduto', function(req, res){
	var _id_produto = req.query.id_produto,
		_qtd = req.query.qtd,
		id_pedido = req.query.id_pedido;

	var _produtos = lstSalas[id_pedido].produtos;
	
	var command = "select nome, preco, descricao, imagem from tbl_produto where id_produto = '" + _id_produto + "'";
	con.query(command, function(err, result, fields){
		if (err) throw err + command;

		if (result.length > 0){
			_produtos.push({id_produto_pedido : _produtos.length,id_produto : _id_produto, qtd : _qtd, nome : result[0].nome, obs : result[0].descricao, preco : result[0].preco, imagem : result[0].imagem, status : 0, nome_status : "Em espera"});
			
			var command2 = "select e.uf as 'uf', r.id_restaurante as 'id_rest' from tbl_funcionario as f "+
											"inner join tbl_restaurante as r "+
											"on f.id_restaurante = r.id_restaurante "+
											"inner join tbl_endereco as en "+
											"on r.id_endereco = en.id_endereco "+
											"inner join tbl_cidade as c "+
											"on c.id_cidade = en.id_cidade "+
											"inner join tbl_estado as e "+
											"on e.id_estado = c.id_estado "+
											"where f.id_funcionario = '" + lstSalas[id_pedido].id_funcionario + "'";

			con.query(command2, function(err2, result2, fields2){
				if (err2) throw err2 + command2;


				io.sockets.emit("novo_produto", {id_funcionario : lstSalas[id_pedido].id_funcionario, id_cliente : lstSalas[id_pedido].id_cliente});
				
				res.send({mensagem : "Sucesso."});

			});
		}else{
			res.send({mensagem : "Produto Inválido."});
		}
	});
});

app.get('/adicionarMesa', function(req,res){
	var _id_mesa = req.query.id_mesa,
			_nome = req.query.nome,
			_id_pedido = req.query.id_pedido;

	var contador = 0,
			verificador = 0;

	while (contador < lstSalas.length){

		if (_id_pedido == lstSalas[contador].id_sala){

				lstSalas[contador].id_mesa = _id_mesa;
				lstSalas[contador].mesa = _nome;

				verificador = 1;

				res.send({id_mesa : _id_mesa, nome : "Selecionado com sucesso."});
				io.sockets.emit("novo_pedido", lstSalas[contador]);
				break;
		}

		contador = contador + 1;
	}

	if (verificador == 0){
		res.send({id_mesa : _id_mesa,nome : "Ocorreu um erro. Tente novamente mais tarde."});
	}
});

app.get('/mesas', function(req, res){

	var _id_funcionario = req.query.id_funcionario;

	var command = "select r.id_restaurante as 'id_rest' from tbl_funcionario as f "+
									"inner join tbl_restaurante as r "+
									"on f.id_restaurante = r.id_restaurante "+
									"where f.id_funcionario = '" + _id_funcionario + "'";

	con.query(command, function(err, result, fields){
		if (err) throw err + command;

		if (result.length > 0){

			var _id_restaurante = result[0].id_rest;

			var command2 = "select m.id_mesa as 'id_mesa', m.nome as 'nome' from tbl_mesa as m "+
										 "where id_restaurante = '" + _id_restaurante +"'";

			con.query(command2, function(err2, result2, fields2){

				var contador = 0,
						lstMesas = [];

				while (contador < result2.length){

					var m = {id_mesa : result2[contador].id_mesa, nome : result2[contador].nome};

					lstMesas.push(m);

					contador = contador + 1;
				}

				res.send(lstMesas);

			});
		}else{
			res.send({mensagem : "Ocorreu um erro durante a conexão. Tente novamente mais tarde."});
		}

	});

});

app.get('/salas', function(req, res){
	var _id_funcionario = req.query.id_funcionario,
			lstTempSalas = [],
			contador = 0,
			contador2 = 0;

	if(typeof _id_funcionario != "undefined"){
		while (contador < lstSalas.length){

			var id_funcionario = lstSalas[contador].id_funcionario;

			if(id_funcionario == _id_funcionario){

				lstTempSalas[contador2] = lstSalas[contador];

				contador2 = contador2 + 1;

			}

			contador = contador + 1;
		}
		res.send(lstTempSalas);
	}else{
		res.send(lstSalas);
	}

});

app.get('/saldoCliente', function(req, res){
	var _id_pedido = req.query.id_sala;

	if(typeof _id_pedido != "undefined"){
		
		var _id_cliente = lstSalas[_id_pedido].id_cliente;
		
		var command = "select saldo from tbl_cliente where id_cliente = '" + _id_cliente + "'";
		
		con.query(command, function(err, result, fields){
			if (err) throw err + command;
			
			res.send({mensagem : "Saldo de brindes: R$ " + result[0].saldo.toFixed(2)});
		});
	}else{
		res.send("Nada");
	}

});

app.get('/brinde', function(req, res){
	var _id_pedido = req.query.id_pedido;
	
	if (typeof _id_pedido != 'undefined'){
		
		var command = "select * from tbl_pedido where id_pedido = '" + _id_pedido + "'";
		
		con.query(command, function(err, result, fields){
			if (err) throw err + command;
			
			var _id_cliente = result[0].id_cliente;
			
			var command2 = "select * from tbl_pedido where id_cliente = '" + _id_cliente + "'";
			
			con.query(command2, function(err2, result2, fields2){
				if (err2) throw err2 + command2;
				
				if (result2.length % 5 == 0){
					
					var command3 = "select * from tbl_pedido where id_cliente = '" + _id_cliente + "' order by id_pedido desc limit 0,5";
					
					con.query(command3, function(err3, result3, fields3){
						if (err3) throw err3 + command3;
						
						var contador = 0;
						var totalGasto = 0;
						var brinde = 0;
						
						while (contador < result3.length){
							
							var command4 = "select sum(p.preco) as 'preco' from tbl_pedidoproduto as pp "+
								"inner join tbl_produto as p "+
								"on p.id_produto = pp.id_produto "+
								"where id_pedido = '" + result3[contador].id_pedido + "' ";
							
							con.query(command4, function(err4, result4, fields4){
								if (err4) throw err4 + command4;
								
								totalGasto = totalGasto + result4[0].preco;
								
								brinde = (totalGasto / 100) * 18;
							});
							
							contador = contador + 1;
							
							if (contador == result3.length){
								setTimeout(function(){
									var command5 = "select saldo from tbl_cliente where id_cliente = '" + _id_cliente + "'";
										
									con.query(command5, function(err5, result5, fields5){
										if (err5) throw err5 + command5;
										
										var novoSaldo = result5[0].saldo + brinde;
										
										var command6 = "update tbl_cliente set saldo = '" + novoSaldo.toFixed(2) + "' where id_cliente = '" + _id_cliente + "'";
																				
										con.query(command6, function(err6, result6, fields6){
											if(err6) throw err6 + command6;
											res.send({mensagem : "O cliente recebeu R$ " + brinde.toFixed(2) + " de brinde."});									
										});	
									});
								},1000);
							}
							
						}					
											
					});
					
				}else{
					res.send({mensagem : "Faltam " + ((result2.length % 5) - 5) * - 1 + " pedidos para o próximo brinde."});
				}
			});
		});
	}
});

http.listen(8100, function(){

	console.log("Servidor rodando na porta 8100");

});
