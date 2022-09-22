<?php 
include_once "view/pages/includes/header.php"; 
include_once "view/pages/includes/soma.php";
?>
    
    <div class="app-wrapper">
	    
	    <div class="app-content pt-3 p-md-3 p-lg-4">
		    <div class="container-xl">
			    
			  <!--  <h1 class="app-page-title"></h1> -->
			    
			  
				    
			    <div class="row g-4 mb-4">
				    <div class="col-6 col-lg-3">
					    <div class="app-card app-card-stat shadow-sm h-100" >
						    <div class="app-card-body p-3 p-lg-4">
							    <h4 class="stats-type mb-1">Funcionarios</h4>
							    <div class="stats-figure"><?php echo $func['total']; ?></div>
						    </div><!--//app-card-body-->
						    <a class="app-card-link-mask" href="lista-funcionarios"></a>
					    </div><!--//app-card-->
				    </div><!--//col-->
				    
				    <div class="col-6 col-lg-3">
					    <div class="app-card app-card-stat shadow-sm h-100">
						    <div class="app-card-body p-3 p-lg-4">
							    <h4 class="stats-type mb-1">Stock/Postiços disponivel</h4>
							    <div class="stats-figure"><?php echo $pr['total']; ?></div>
						    </div><!--//app-card-body-->
						    <a class="app-card-link-mask" href="stock"></a>
					    </div><!--//app-card-->
				    </div><!--//col-->
				    <div class="col-6 col-lg-3">
					    <div class="app-card app-card-stat shadow-sm h-100">
						    <div class="app-card-body p-3 p-lg-4">
							    <h4 class="stats-type mb-1">Venda</h4>
							    <div class="stats-figure"><?php echo $vd['total']; ?></div>
							    
						    </div><!--//app-card-body-->
						    <a class="app-card-link-mask" href="lista-venda"></a>
					    </div><!--//app-card-->
				    </div><!--//col-->
				    
			    </div><!--//row-->
			    
			    <div class="row g-4 mb-4">
				    
				    <div class="col-12 col-lg-4">
					    
				    </div><!--//col-->
				    
			    </div><!--//row-->
			    
		    </div><!--//container-fluid-->
	    </div><!--//app-content-->
	    
	    
	    
    </div><!--//app-wrapper-->    					

 
      <?php include_once "view/pages/includes/footer.php";  ?>


