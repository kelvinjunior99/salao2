<?php 

	function routesURL()
	{
		
		if(isset($_GET['url']))
		{	

			$url = $_GET['url'] ? $_GET['url'] : "home";
		}
		else 
		{
			$url = "home";
		}

		switch ($url) {
			case 'home':
				include_once "view/pages/home.php";
				break;
			
			case 'cad-funcionario':
				include_once "view/pages/cadastrar/cad-funcionario.php";
				break;

			case 'cad-produto':
				include_once "view/pages/cadastrar/cad-produto.php";
				break;

			case 'cad-venda':
				include_once "view/pages/cadastrar/cad-venda.php";
				break;

			case 'lista-funcionarios':
				include_once "view/pages/lista/lista-funcionarios.php";
				break;

			case 'lista-postiços':
				include_once "view/pages/lista/lista-postiços.php";
				break;

			case 'stock':
				include_once "view/pages/lista/stock.php";
				break;

			case 'lista-venda':
				include_once "view/pages/lista/lista-venda.php";
				break;
			
			case 'venda-anulada':
				include_once "view/pages/lista/venda-anulada.php";
				break;

			case 'editar-funcionario':
				include_once "view/pages/editar/editar-funcionario.php";
				break;

			case 'editar-postico':
				include_once "view/pages/editar/editar-postico.php";
				break;
			
			case 'editar-venda':
				include_once "view/pages/editar/editar-venda.php";
				break;

			case 'resultado-funcionario':
				include_once "view/pages/resultado/resultado-funcionario.php";
				break;

			case 'resultado-postiço':
				include_once "view/pages/resultado/resultado-postiço.php";
				break;

			case 'resultado-stock':
				include_once "view/pages/resultado/resultado-stock.php";
				break;
			
			case 'resultado-venda':
					include_once "view/pages/resultado/resultado-venda.php";
					break;

			
			case 'sobre':
				include_once "view/pages/sobre.php";
				break;

			case 'teste':
				include_once "view/pages/teste.php";
				break;

			case 'account':
				include_once "view/pages/account.php";
				break;


			
			default:
				include_once "view/pages/404.php";
				break; 
		}
		



	}

 ?>