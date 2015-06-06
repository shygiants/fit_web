<div class="container">
	<div class="section">
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
	</div>
	<div class="row section">
		<div class="col s4">
			<div class="center">
				<i class="large mdi-social-person light-green-text text-darken-4"></i>
				<p class="header"><h5>취향에 맞는 스타일 추천</h5></p>
				<p class="light center">
					당신의 취향을 분석해서 그것에 맞는 스타일을 추천해드립니다. 
					당신과 취향이 비슷한 사람들은 어떤 패션을 좋아할까요?
					무엇인진 몰라도 아마 당신도 그것을 좋아할겁니다.
					<br>
				</p>
			</div>
		</div>
		<div class="col s4">
			<div class="center promo promo-example">
				<i class="large mdi-action-dashboard light-green-text text-darken-4"></i>
				<p class="header"><h5>다양한 필터링 제공</h5></p>
				<p class="light center">
					옷은 많은데 어떤 걸 고를지 잘 모르시겠다고요?
					가지고 계신 갈색 워커를 어떤 아이템과 매치를 해야 할지 잘 모르시겠다고요?
					걱정 마십시오! fit이 도와드립니다.<br>
				</p>
			</div>
		</div>
		<div class="col s4">
			<div class="center promo promo-example">
				<i class="large mdi-content-inbox light-green-text text-darken-4"></i>
				<p class="header"><h5>저장을 쉽게</h5></p>
				<p class="light center">
					힘들게 잡지를 카메라로 찍어 참고할 패션들을 저장하셨나요?
					힘들게 인터넷 서핑을 하면서 일일이 사진들을 저장하셨나요?
					이제 한 번의 클릭으로 쉽게 저장하세요! <br>
				</p>
			</div>
		</div>
	</div>
</div>
<div class="parallax-container">
	<div class="parallax"><img src="<?=base_url('resource/images/parallax.jpg')?>"></div>
</div>
<div id="modal_register" class="modal">
	<form action="<?=base_url('graphic/register')?>" method="post">
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
	<form action="<?=base_url('graphic/login')?>" method="post">
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
			<button class="modal-action modal-close btn waves-effect waves-light green" type="submit">로그인
				<i class="mdi-content-send right"></i>
			</button>
		</div>
	</form>
</div>