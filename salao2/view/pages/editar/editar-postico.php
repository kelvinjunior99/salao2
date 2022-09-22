<?php include_once "view/pages/includes/header.php";  ?>

<div class="app-wrapper">
	<div class="app-content pt-3 p-md-3 p-lg-4">
		<div class="container-xl">
			<div class="row g-3 mb-4 align-items-center justify-content-between">
				<div class="col-auto">
					<h1 class="app-page-title mb-0">Editar postiço</h1>
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
			

			<form method="post" action="./controller/editar/produto-editar.php">
            <input type="hidden" name="id" value="<?php if(isset($dado['id'])){ echo $dado['id']; } ?>">

				<div class="form-floating mb-3">
					<input type="text" class="form-control" name="nome" id="nome" placeholder="name@example.com" value="<?php if(isset($dado['nome'])){ echo $dado['nome']; } else { echo " "; } ?>">
					<label for="floatingInput">Nome</label>
				</div>
				<div class="form-floating mb-3">
					<input type="text" class="form-control" name="preco"  id="preco" placeholder="Password" value="<?php if(isset($dado['preco'])){ echo $dado['preco']; } else { echo " "; } ?>">
					<label for="floatingPassword">Preço</label>
				</div>

				<div class="form-floating mb-3">
					<input type="number" min="0" id="qnt" name="quantidade" class="form-control" placeholder="name@example.com" value="<?php if(isset($dado['quantidade'])){ echo $dado['quantidade']; } else { echo " "; } ?>">
					<label for="floatingInput">Quantidade</label>
				</div>


				<div class="form-floating">
					<button type="submit" name="btn" class="btn btn-success" id="btn_usuario">Editar</button>
				</div>
			</form>

            <div class="tab-content mt-5" id="orders-table-tab-content">
				<div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
					<div class="app-card app-card-orders-table shadow-sm mb-5">
						<div class="app-card-body">
							<div class="table-responsive" style="background-color: #fff;">
								<?php
								

								$query = $pdo->prepare("SELECT * FROM produtos WHERE id = :id ");
                                $query->bindParam(":id", $id);
								$query->execute();
								$dados = $query->fetchAll(PDO::FETCH_ASSOC);

								?>
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
											<?php foreach ($dados as $dado) { ?>

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
									<?php  } ?>

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
