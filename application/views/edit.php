<div class="edit_container">
	<div class="row">
	</div>
	<div class="row">
		<div class="col s8">
			<form action="<?=base_url('graphic/add')?>" method="post">
				<input name="editor_id" type="hidden" value="<?=$editor_id?>">
				<div class="row">
					<div class="input-field col s6">
						<input name="src_link" id="src_link" type="url" class="validate">
						<label for="src_link">출처 링크</label>
					</div>
					<div class="input-field col s6">
						<input name="img_path" id="imgsrc" type="url" class="validate">
						<label for="img_path">이미지 링크</label>
					</div>
				</div>
				<div class="row">
					<div class="col s2">
						<h5 class="section">성별</h5>
						<div class="row">
							<div>
								<input name="gender_id" id="gender_man" type="radio" class="validate" value="1">
								<label for="gender_man">남성</label>
							</div>
							<div>
								<input name="gender_id" id="gender_woman" type="radio" class="validate" value="2">
								<label for="gender_woman">여성</label>
							</div>
						</div>
					</div>
					<?php
					foreach ($attributes as $key=>$attribute) {
					?>
						<div class="col s2 hide">
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

								if (property_exists($row, 'gender_id'))
									switch ($row->gender_id) {
										case 1:
											$class = 'hide man';
											break;
										case 2:
											$class = 'hide woman';
											break;
										case 3:
											$class = 'hide both';
											break;
									}
								else
									$class = 'hide';
							?>
								<div class="<?=$class?>">
									<input name="<?=$attribute->name?>" type="radio" id="<?=$attribute->name.$row->id?>" value="<?=$row->id?>"/>
									<label for="<?=$attribute->name.$row->id?>"><?=$row->label?></label>
								</div>
							<?php
								if ($id == (count($attribute->table) - 1) && $etcExist)
								{
							?>
									<div class="<?=$class?>">
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
				<div class="row">
					<button class="btn waves-effect waves-light green" type="submit">등록
						<i class="mdi-content-send right"></i>
					</button>
				</div>
			</form>
		</div>
		<div class="col s4">
			<div class="col s12 center" style="height: 900px">
				<img src="#" id="item_img" class="responsive-img card">
			</div>
		</div>
	</div>
</div>

