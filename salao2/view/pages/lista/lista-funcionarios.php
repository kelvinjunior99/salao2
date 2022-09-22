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
				<a class="flex-sm-fill nav-link active" id="orders-all-tab" data-bs-toggle="tab" role="tab" aria-controls="orders-all" aria-selected="true" style="text-align: left; cursor: normal; text-transform: uppercase;">Lista de Funcionarios</a>

			</nav>


			<div class="tab-content" id="orders-table-tab-content">
				<div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
					<div class="app-card app-card-orders-table shadow-sm mb-5">
						<div class="app-card-body">
							<div class="table-responsive" style="background-color: #fff;">
								<?php
								//Receber o número da página
								$pagina_atual = filter_input(INPUT_GET, 'pagina', FILTER_SANITIZE_NUMBER_INT);
								$pagina = (!empty($pagina_atual)) ? $pagina_atual : 1;

								//Setar a quantidade de itens por pagina
								$qnt_result_pg = 7;

								//calcular o inicio visualização
								$inicio = ($qnt_result_pg * $pagina) - $qnt_result_pg;

								$query = $pdo->prepare("SELECT * FROM funcionarios LIMIT $inicio, $qnt_result_pg");
								$query->execute();
								$dados = $query->fetchAll(PDO::FETCH_ASSOC);

								?>
								<table class="table app-table-hover mb-0 text-left table-striped ">
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
									<?php  } ?>

									</tbody>
								</table>
							</div>
							<!--//table-responsive-->

						</div>
						<!--//app-card-body-->
					</div>
					<!--//app-card-->
					<?php
					//Paginção - Somar a quantidade de usuários
					$resultado_pg = $pdo->prepare("SELECT COUNT(id) AS num_result FROM funcionarios");
					$resultado_pg->execute();
					$row_pg = $resultado_pg->fetch(PDO::FETCH_ASSOC);

					//echo $row_pg['num_result'];
					//Quantidade de pagina 
					$quantidade_pg = ceil($row_pg['num_result'] / $qnt_result_pg);

					//Limitar os link antes depois
					$max_links = 2;

					echo "<nav class='app-pagination'>
                <ul class='pagination justify-content-center'>";
					echo " ";

					for ($pag_ant = $pagina - $max_links; $pag_ant <= $pagina - 1; $pag_ant++) {
						if ($pag_ant >= 1) {
							echo " 
                    
                    <li class='page-item'>
                    <a class='page-link' href='lista-funcionarios&pagina=$pag_ant' tabindex='-1'>$pag_ant</a></li>";
						}
					}

					echo "<li class='page-item'><a class='page-link'>$pagina</a></li>";

					for ($pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_links; $pag_dep++) {
						if ($pag_dep <= $quantidade_pg) {
							echo "<li class='page-item'> 
  
                    <a class='page-link' href='lista-funcionarios&pagina=$pag_dep'>$pag_dep</a> </li>
                    ";
						}
					}

					echo "<li class='page-item'><a class='page-link' href='lista-funcionarios&pagina=$quantidade_pg'>Ultima</a></li>";
					echo "
                </ul>
                </nav>";

					?>

				</div>
				<!--//tab-pane-->



			</div>
			<!--//tab-content-->



		</div>
		<!--//container-fluid-->
	</div>
	<!--//app-content-->
	<?php include_once "view/pages/includes/footer.php";  ?>