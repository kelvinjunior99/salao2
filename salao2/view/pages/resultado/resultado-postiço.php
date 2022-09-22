<?php 
include_once "view/pages/includes/header.php";
?>
    
    <div class="app-wrapper">
	    
	    <div class="app-content pt-3 p-md-3 p-lg-4">
		    <div class="container-xl">
			
            <div class="tab-content" id="orders-table-tab-content">
				<div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
					<div class="app-card app-card-orders-table shadow-sm mb-5">
						<div class="app-card-body">
                        <div class="table-responsive" style="background-color: #fff;">
								<?php

								$pesquisar = isset($_POST["pesquisar"]) ? $_POST["pesquisar"] : "";
                                $query = $pdo->prepare("SELECT * FROM produtos WHERE nome LIKE '%$pesquisar%' LIMIT 3");
                                $query->execute();
                                
                                if ($pesquisar != "" || $pesquisar != "") {
                                    $dados = $query->fetchAll(PDO::FETCH_ASSOC);
                                
								?>
								<table class="table app-table-hover mb-0 text-left table-striped ">
									
                                    <?php 
                                            if ($dados) { ?>
                                            <thead>
                                            <tr >
                                                <th class="cell">Nome</th>
                                                <th class="cell">Preço</th>
                                                <th class="cell">Quantidade</th>
                                                <th class="cell">Dia</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                            <?php  
                                             
                                            foreach ($dados as $dado) 
                                            { ?>

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

												<td class="cell"><a href="cad-venda&id=<?php echo $dado['id']; ?>" class="text-danger"><i class="fa fa-shopping-bag fa-2x" aria-hidden="true"></i></a></td>

										</tr>			
									</tbody>
								</table>
                                
							</div>

						</div>
						
					</div>
                    
                    <?php  }  } 
                                    else { ?>
                                    
                                    <div class="alert" role="alert">
                                    <strong>nenhum postiço encontrado com este nome</strong>
                                    </div>
                                    
                            <?php   }
                                } ?>
                    
					<!--//app-pagination-->

				</div>
				<!--//tab-pane-->
			</div>
     
		    </div><!--//container-fluid-->

            
	    </div><!--//app-content-->
	
    </div><!--//app-wrapper-->    					

 
      <?php include_once "view/pages/includes/footer.php";  ?>


     