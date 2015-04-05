<div class="container">
	<br>
	<br>
	<h1 class="header center blue-grey-text text-darken-4">Welcome!</h1>
	<div class="row center">
		<h5 class="header center blue-grey-text text-darken-4">fit 에디터 페이지에 오신 것을 환영합니다</h5>
	</div>
	<br>
	<br>
</div>
<div class="container" style="min-height:547px">
	<div class="row">
		<h4 class="header blue-grey-text text-darken-4">Sign in</h4>

		<form class="col s12" action="<?=site_url('graphic/login')?>" method="post">
			<div class="row">
				<div class="input-field col s12">
					<input id="email" name="email" type="email" class="validate">
					<label for="email">Email</label>
				</div>
			</div>
			<div class="row">
				<div class="input-field col s12">
					<input id="password" name="password" type="password" class="validate">
					<label for="password">Password</label>
				</div>
			</div>
			<div class="row">
				<div class="col s2 offset-s10 grid-example">
					<button class="btn waves-effect waves-light green" type="submit" name="action">Sign in
						<i class="mdi-content-send right"></i>
					</button>
				</div>
			</div>
		</form>
	</div>
	<div class="section"></div>
</div>