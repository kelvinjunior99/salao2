<?php include_once "view/pages/includes/header.php";  ?>

<div class="app-wrapper">
    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">
            <div class="row g-3 mb-4 align-items-center justify-content-between">
                <div class="col-auto">
                    <h1 class="app-page-title mb-0">Cadastrar venda/pagamento</h1>
                </div>

                <!--//col-auto-->
            </div>
            <?php

            $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
            $sql = $pdo->prepare("SELECT * FROM produtos WHERE id = :id");
            $sql->bindValue(":id", $id);
            $sql->execute();
            $dado = $sql->fetch(PDO::FETCH_ASSOC);

            ?>

            <script>
                function calc_total() {
                    var qtq = parseInt(document.getElementById('qnt').value);
                    tot = qtq * <?php echo $dado['preco']; ?>;
                    document.getElementById('preco').value = tot;

                    var valor_pago = parseInt(document.getElementById('valor_pago').value);

                    soma = valor_pago - tot;
                    document.getElementById('troco').value = soma;

                }
            </script>


            <form method="post" action="./controller/cadastrar/pro-venda.php" oninput="calc_total()";>
            <input type="hidden" name="id" value="<?php echo $dado['id']; ?>">

                <div class="form-floating mb-3">
                    <input type="text" class="form-control" name="produto" id="nome" placeholder="dd" value="<?php if(isset($dado['nome'])){ echo $dado['nome']; } else { echo " "; } ?>" readonly>
                    <label for="floatingInput">Nome do postiço</label>
                </div>

                <div class="row justify-content-start">
                <div class="col-4">
                        
                        <div class="form-floating mb-2">
                        <?php if($dado['quantidade'] >0){ ?>
                            <input type="number" min="1" max="<?php echo $dado['quantidade']; ?>" class="form-control numero" name="quantidade" id="qnt" placeholder="name@example.com" >
                            <label for="qnt">Quantidade</label>

                        <?php } 
                        else { ?>

                            <input type="number" min="1" max="" value="0" class="form-control numero" name="quantidade" id="qnt" placeholder="name@example.com" disabled >
                            <label for="qnt">Quantidade (Vazia) </label>
  

                            <!-- Full screen modal -->
                            <!-- Button trigger modal -->
                            <a href="editar-postico&id=<?php echo $dado['id']; ?>" type="button" class="btn btn-primary btn-sm badge">
                             <strong>adicionar</strong> 
                        </a>

                            
                        <?php }
                        ?>
                        
                    </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control" name="preco_total" placeholder="preco-total" id="preco" readonly>
                            <label for="floatingPassword">Preço Total</label>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-floating mb-3">
                            <input type="text" id="qnt" name="preco" class="form-control" placeholder="name@example.com" readonly value="<?php if(isset($dado['preco'])){ echo $dado['preco']." kz"; } else { echo " "; } ?>">
                            <label for="floatingInput">Preço do Postiço</label>
                        </div>
                    </div>

                </div>
                <div class="row justify-content-start">
                    <div class="col-md-4">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="valor_pago" id="valor_pago" placeholder="preco-total">
                            <label for="floatingPassword">Valor Pagar</label>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control" name="troco" id="troco" placeholder="preco-total" readonly>
                            <label for="floatingPassword">Troco</label>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="cliente" id="cliente" placeholder="preco-total">
                        <label for="floatingPassword">Cliente</label>
                    </div>
                </div>



                <div class="form-floating">
                    <button type="submit" name="btn" class="btn btn-success" id="btn_usuario">Cadastrar</button>&nbsp;
                    <button type="reset" class="btn btn-danger">Recomeçar</button>
                </div>
            </form>

            <div class="tab-content mt-5" id="orders-table-tab-content">
				<div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
					<div class="app-card app-card-orders-table shadow-sm mb-5">
						<div class="app-card-body">
							<div class="table-responsive" style="background-color: #fff;">
							
								<table class="table app-table-hover mb-0 text-left table-striped ">
									<thead>
										<tr>
											<th class="cell">Nome</th>
											<th class="cell">Preço</th>
											<th class="cell">Quantidade</th>
											<th class="cell">Dia</th>
										</tr>
									</thead>
									<tbody>
										<tr>
										<tr>											
                                <td class="cell"><span class="truncate"><?php echo $dado['nome']; ?></span></td>
                                <td class="cell"><span class="truncate"><?php echo $dado['preco']; ?></span></td>

                                <?php if ($dado['quantidade'] <= 5) { ?>

                                    <td class="spinner-grow" role="status">
                                        <strong>
                                            <h4 class="text-danger"><?php echo $dado['quantidade']; ?></h4>
                                        </strong>
                                    </td>


                            <?php
                            } else if ($dado['quantidade'] >= 5) {  ?>

                                <td> <strong><?php echo $dado['quantidade']; ?></strong> </td>


                            <?php   }
                            ?>
                            <td class="cell"><span class="truncate"><?php echo date('d/m/Y H:i', strtotime($dado['data'])); ?></span> </td>

											
										

							<td class="cell"><a href="editar-postiço&id=<?php echo $dado['id']; ?>"><i class="fa fa-edit fa-2x" aria-hidden="true"></i></a></td>

							<td class="cell"><a href="#modal?id=<?php echo $dado['id']; ?>" data-bs-toggle="modal" data-bs-target="#modal<?php echo $dado['id']; ?>" class="text-danger"><i class="fa fa-times fa-2x" aria-hidden="true"></i></a></td>

							<!-- Modal -->
                            <div class="modal fade" id="modal<?php echo $dado['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title" id="exampleModalLabel">Desejas excluir <strong class="text-success"> <?php echo $dado['nome']; ?></strong> ?</h5>
														<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
													</div>
													
													<div class="modal-footer">
														<form action="./controller/apagar/apagar-postico.php" method="post">
															<input type="hidden" name="id" value="<?php echo $dado['id']; ?>">

															<button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancelar</button>

															<button type="submit" name="btn" class="btn btn-danger">Excluir</button>
														</form>
													</div>
												</div>
											</div>
										</div>

										</tr>
									

									</tbody>
								</table>
							</div>
							<!--//table-responsive-->

						</div>
						<!--//app-card-body-->
					</div>
					<!--//app-card-->
					

				</div>
				<!--//tab-pane-->



			</div>

        </div>
    </div>
</div>


<?php include_once "view/pages/includes/footer.php";  ?>

<script>
    $('#btn_usuario').click(function() {
        var campo_vazio = false;

        if ($('#valor_pago').val() == '') {
            $('#valor_pago').css('border-color', '#A94442');
            campo_vazio = true;
            $('#texto').html("preencha todos os campos");
        } else {
            $('#valor_pago').css('border-color', '#ccc');
            $('#texto').html("");
        }

        if ($('#preco').val() == '') {
            $('#preco').css('border-color', '#A94442');
            campo_vazio = true;
            $('#texto').html("preencha todos os campos");
        } else {
            $('#preco').css('border-color', '#ccc');
            $('#texto').html("");
        }

        if ($('#qnt').val() == '') {
            $('#qnt').css('border-color', '#A94442');
            campo_vazio = true;
            $('#texto').html("preencha todos os campos");
        } else {
            $('#qnt').css('border-color', '#ccc');
            $('#texto').html("");
        }

        if ($('#cliente').val() == '') {
            $('#cliente').css('border-color', '#A94442');
            campo_vazio = true;
            $('#texto').html("preencha todos os campos");
        } else {
            $('#cliente').css('border-color', '#ccc');
            $('#texto').html("");
        }
        if (campo_vazio)
            return false;

    })
</script>