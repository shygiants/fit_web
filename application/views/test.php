<!DOCTYPE html>
	<html>
		<head>
			<meta charset='utf-8'/>
			<!--Import materialize.css-->
			<link type="text/css" rel="stylesheet" href="<?=base_url('library/materialize/css/materialize.min.css')?>"  media="screen,projection"/>
			<!--Let browser know website is optimized for mobile-->
			<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
		</head>
		<body>
			<nav>
				<div class="nav-wrapper">
					<a href="#" class="brand-logo center">fit</a>
					<ul id="nav-mobile" class="right hide-on-med-and-down">
						<li><a class="modal-trigger" href="#modal1">Sign in</a></li>
					</ul>
				</div>
			</nav>

			<!-- Modal Structure -->
			<div id="modal1" class="modal">
						<div class="modal-content">
							<h4>Modal Header</h4>
							<p>A bunch of text</p>
						</div>
						<div class="modal-footer">
							<a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Agree</a>
						</div>
					</div>


			<div class="container">

				<h1>Hello world!</h1>


				<!--Import jQuery before materialize.js-->
				<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
				<script type="text/javascript" src="<?=base_url('library/materialize/js/materialize.min.js')?>"></script>
			</div>
		</body>
	</html>