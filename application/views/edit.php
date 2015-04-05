<div class="edit_container">
	<div class="row">
	</div>
	<div class="row">
		<div class="col s8">
			<form action="#" method="post">
				<div class="row">
					<div class="input-field col s10">
						<input id="src_link" type="url" class="validate">
						<label for="src_link">이미지 출처 링크</label>
					</div>
				</div>
				<div class="row">
					<div class="col s2">
						<h5 class="section">성별</h5>
						<div class="row">
							<div>
								<input name="gender" id="gender_man" type="radio" class="validate" value="남성">
								<label for="gender_man">남성</label>
							</div>
							<div>
								<input name="gender" id="gender_woman" type="radio" class="validate" value="여성">
								<label for="gender_woman">여성</label>
							</div>
						</div>
					</div>
					<?php
					for ($iter = 0; $iter < count($attributes); $iter++) {
					?>
						<div class="col s2">
							<h5 class="section"><?=$attributes[$iter]->label?></h5>
							<div class="row">		
							<?php
							foreach ($attributes[$iter]->table as $row)
							{
							?>
								<div>
									<input name="<?=$attributes[$iter]->label?>" type="radio" id="<?=$attributes[$iter]->label.$row->id?>" value="<?=$row->id?>"/>
									<label for="<?=$attributes[$iter]->label.$row->id?>"><?=$row->label?></label>
								</div>
							<?php
							}
							?>
							</div>
						</div>
						<?php
						if ($iter == 4 || (($iter - 4) % 6) == 0)
						{
						?>
							</div>
							<div class="row">
						<?php
						}
						?>
					<?php
					}
					?>
				</div>
			</form>
		</div>
		<div class="col s4">
			<img src="#">
		</div>
	</div>
</div>