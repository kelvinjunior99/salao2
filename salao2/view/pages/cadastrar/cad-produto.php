<?php include_once "view/pages/includes/header.php";  ?>

<div class="app-wrapper">
	<div class="app-content pt-3 p-md-3 p-lg-4">
		<div class="container-xl">
			<div class="row g-3 mb-4 align-items-center justify-content-between">
				<div class="col-auto">
					<h1 class="app-page-title mb-0">Cadastrar postiço</h1>
				</div>
				
				<!--//col-auto-->
			</div>
			<?php

			if (isset($_SESSION['msg'])) :

				if ($_SESSION['msg'] == "cadastrado com sucesso") { ?>

					<div class="alert alert-success" role="alert">
						<strong><i class="fa fa-check" aria-hidden="true"></i> <?php echo $_SESSION['msg']; ?> </strong>
					</div>


				<?php  } else { ?>

					<div class="alert alert-danger" role="alert">
						<strong><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> <?php echo $_SESSION['msg']; ?></strong> Tente novamente
					</div>


			<?php    }

			endif;
			session_unset();
			?>

			<?php
			if (isset($_GET['erro_nome'])) {   ?>

				<div class="alert alert-danger alert-dismissible fade show" role="alert">
					<strong>Não foi possivel cadastrar o produto</strong> <?php echo "já existe produto com este nome!";  ?>
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>

			<?php   } else {
			}

			?>



			<form method="post" action="./controller/cadastrar/pro-postico.php">
				<div class="form-floating mb-3">
					<input type="text" class="form-control" name="nome" id="nome" placeholder="name@example.com">
					<label for="floatingInput">Nome</label>
				</div>
				<div class="form-floating mb-3">
					<input type="text" class="form-control" name="preco"  id="preco" placeholder="Password">
					<label for="floatingPassword">Preço</label>
				</div>

				<div class="form-floating mb-3">
					<input type="number" min="0" id="qnt" name="quantidade" class="form-control" placeholder="name@example.com">
					<label for="floatingInput">Quantidade</label>
				</div>


				<div class="form-floating">
					<button type="submit" name="btn" class="btn btn-success" id="btn_usuario">Cadastrar</button>&nbsp;
					<button type="reset" class="btn btn-danger">Recomeçar</button>
				</div>
			</form>

		</div>
	</div>
</div>


<?php include_once "view/pages/includes/footer.php";  ?>

<script>
	$('#btn_usuario').click(function() {
        var campo_vazio = false;

        if ($('#nome').val() == '') {
            $('#nome').css('border-color', '#A94442');
            campo_vazio = true;
            $('#texto').html("preencha todos os campos");
        } else {
            $('#nome').css('border-color', '#ccc');
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
        if (campo_vazio)
            return false;

    })
</script>