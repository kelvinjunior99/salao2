<?php include_once "view/pages/includes/header.php";  ?>

<div class="app-wrapper">

	<div class="app-content pt-3 p-md-3 p-lg-4">
		<div class="container-xl">

			<div class="row g-3 mb-4 align-items-center justify-content-between">
				<div class="col-auto">
					<h1 class="app-page-title mb-0"></h1>
				</div>
				<div class="col-auto">
					<div class="page-utilities">
						<div class="row g-2 justify-content-start justify-content-md-end align-items-center">
							<div class="col-auto">
							<form class="table-search-form row gx-1 align-items-center" method="post" action="resultado-funcionario">
									<div class="col-auto">
										<input type="text" id="search-orders" name="pesquisar" required class="form-control search-orders" placeholder="Pesquisar funcionario">
									</div>
									<div class="col-auto">
										<button type="submit"  class="btn app-btn-secondary"><i class="fa fa-search" aria-hidden="true"></i></button>
									</div>
								</form>

							</div>
							<!--//col-->


						</div>
						<!--//row-->
					</div>
					<!--//table-utilities-->
				</div>
				<!--//col-auto-->
			</div>
			<!--//row-->


			<nav id="orders-table-tab" class="orders-table-tab app-nav-tabs nav shadow-sm flex-column flex-sm-row mb-4">
				<a class="flex-sm-fill nav-link active" id="orders-all-tab" data-bs-toggle="tab" role="tab" aria-controls="orders-all" aria-selected="true" style="text-align: left; cursor: normal; text-transform: uppercase;">resultado</a>

			</nav>


			<div class="tab-content" id="orders-table-tab-content">
				<div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
					<div class="app-card app-card-orders-table shadow-sm mb-5">
						<div class="app-card-body">
							<div class="table-responsive" style="background-color: #fff;">
								<?php
								
                                $pesquisar = isset($_POST["pesquisar"]) ? $_POST["pesquisar"] : "";
                                $query = $pdo->prepare("SELECT * FROM funcionarios WHERE nome LIKE '%$pesquisar%' LIMIT 3");
                                $query->execute();
                                
                                if ($pesquisar != "" || $pesquisar != "") {
                                    $dados = $query->fetchAll(PDO::FETCH_ASSOC);
                                
								?>
								<table class="table app-table-hover mb-0 text-left table-striped ">
									
                                    <?php 
                                            if ($dados) { ?>
                                            <thead>
                                            <tr>
											<th class="cell">Nome</th>
											<th class="cell">Morada</th>
											<th class="cell">Telefone</th>
											<th class="cell">Dia</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<?php foreach ($dados as $dado) { ?>

							<td class="cell"><?php echo $dado['nome']; ?></td>
							<td class="cell"><span class="truncate"><?php echo $dado['morada']; ?></span></td>
							<td class="cell"><?php echo $dado['telefone']; ?></td>
							<td class="cell"><span><?php echo date('d/m/Y', strtotime($dado['data'])); ?></span><span class="note"><?php echo date('H:i', strtotime($dado['data'])); ?></span></td>

							<td class="cell"><a href="editar-funcionario&id=<?php echo $dado['id']; ?>"><i class="fa fa-edit fa-2x" aria-hidden="true"></i></a></td>

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
											<form action="./controller/apagar/apagar-funcio.php" method="post">
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
							
                            <?php  }  } 
                                    else { ?>
                                    
                                    <div class="alert" role="alert">
                                    <strong>nenhum resultado encontrado com este nome</strong>
                                    </div>
                                    
                            <?php   } }
                                ?>

						</div>
						<!--//app-card-body-->
                        
					</div>
					<!--//app-card-->
                   

				</div>
				<!--//tab-pane-->



			</div>
			<!--//tab-content-->



		</div>
		<!--//container-fluid-->
	</div>
	<!--//app-content-->
	<?php include_once "view/pages/includes/footer.php";  ?>