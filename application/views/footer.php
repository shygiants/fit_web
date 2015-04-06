		</main>
		<footer class="page-footer light-green darken-4" style="margin-top:0px">
			<div class="container">
				<h5 class="white-text">Contact</h5>
				<p class="grey-text text-lighten-3">
					Email: shygiants@nate.com
				</p>
			</div>
			<div class="footer-copyright">
				<div class="container">
					Made by SHYGiants
				</div>
			</div>
		</footer>
		<div id="modal_register" class="modal">
			<form action="<?=site_url('graphic/register')?>" method="post">
				<div class="modal-content">
					<h4>회원가입</h4>
					<p>
						<div class="row">
							<div class="input-field col s12">
								<input name="email" id="email" type="email" class="validate">
								<label for="email">이메일</label>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s6">
								<input name="password" id="password" type="password" class="validate">
								<label for="password">비밀번호</label>
							</div>
							<div class="input-field col s6">
								<input name="rePassword" id="rePassword" type="password" class="validate">
								<label for="rePassword">비밀번호 확인</label>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s6">
								<input name="lastName" id="lastName" type="text" class="validate">
								<label for="lastName">성</label>
							</div>
							<div class="input-field col s6">
								<input name="firstName" id="firstName" type="text" class="validate">
								<label for="firstName">이름</label>
							</div>
						</div>
					</p>
				</div>
				<div class="modal-footer">
					<button class="modal-action modal-close btn waves-effect waves-light green" type="submit" name="action">제출
						<i class="mdi-content-send right"></i>
					</button>
				</div>
			</form>
		</div>
		<div id="modal_login" class="modal">
			<form action="<?=site_url('graphic/login')?>" method="post">
				<div class="modal-content">
					<h4>로그인</h4>
					<p>
						<div class="row">
							<div class="input-field col s12">
								<input name="email" id="email" type="email" class="validate">
								<label for="email">이메일</label>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s12">
								<input name="password" id="password" type="password" class="validate">
								<label for="password">비밀번호</label>
							</div>
						</div>
					</p>
				</div>
				<div class="modal-footer">
					<button class="modal-action modal-close btn waves-effect waves-light green" type="submit" name="action">로그인
						<i class="mdi-content-send right"></i>
					</button>
				</div>
			</form>
		</div>
		<script type="text/javascript" src="<?=base_url('library/materialize/js/materialize.min.js')?>"></script>	
	</body>
</html>