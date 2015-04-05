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
					foreach ($attributes as $key=>$attribute) {
					?>
						<div class="col s2">
							<h5 class="section"><?=$attribute->label?></h5>
							<div class="row">
							<?php
							$etcExist = false;
							foreach ($attribute->table as $id=>$row)
							{
								if ($row->id == 0)
								{
									$etcExist = true;
									continue;
								}
							?>
								<div>
									<input name="<?=$attribute->name?>" type="radio" id="<?=$attribute->name.$row->id?>" value="<?=$row->id?>"/>
									<label for="<?=$attribute->name.$row->id?>"><?=$row->label?></label>
								</div>
							<?php
								if ($id == (count($attribute->table) - 1) && $etcExist)
								{
							?>
									<div>
										<input name="<?=$attribute->name?>" type="radio" id="<?=$attribute->name.$attribute->table[0]->id?>" value="<?=$attribute->table[0]->id?>"/>
										<label for="<?=$attribute->name.$attribute->table[0]->id?>"><?=$attribute->table[0]->label?></label>
									</div>
							<?php
								}
							}
							?>
							</div>
						</div>
						<?php
						if ($key == 4 || (($key - 4) % 6) == 0)
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