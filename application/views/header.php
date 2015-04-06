<!DOCTYPE html>
	<html>
		<head>
			<meta charset='utf-8'/>
			<!--Import materialize.css-->
			<link type="text/css" rel="stylesheet" href="<?=base_url('library/materialize/css/materialize.min.css')?>"  media="screen,projection"/>
			<!--Let browser know website is optimized for mobile-->
			<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
			<style type="text/css">
				.edit_container {
					padding-left: 16px;
					padding-right: 16px;
				}
				body {
					display: flex;
					min-height: 100vh;
					flex-direction: column;
				}

				main {
				flex: 1 0 auto;
				}
				
			</style>
			<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
		</head>
		<body class="grey lighten-4">
			<header>
				<nav>
					<div class="nav-wrapper light-green darken-3">
						<a href="<?=base_url('graphic')?>" class="brand-logo center">fit</a>
						<ul id="nav-mobile" class="right hide-on-med-and-down">
							<!-- Modal Trigger -->
							<?php
							if (!$is_login)
							{
							?>
								<li><a class="waves-effect waves-light modal-trigger" href="#modal_register">회원가입</a></li>
								<li><a class="waves-effect waves-light modal-trigger" href="#modal_login">로그인</a></li>
							<?php
							} else {
								if ($is_editor)
								{
							?>		
									<li><a class="waves-effect waves-light" href="<?=base_url('graphic/edit')?>">추가</a></li>
								<?php
								}
								?>
								<li><a class="waves-effect waves-light" href="<?=base_url('graphic/logout')?>">로그아웃</a></li>
							<?php
							}
							?>
						</ul>
					</div>
				</nav>
			</header>
			<main>