<div class="edit_container">
	<div class="row">
	</div>
	<div class="row">
		<div class="col s7">
			<form id="form" action="<?=base_url('graphic/add')?>" method="post">
				<input name="editor_id" type="hidden" value="<?=$editor_id?>">
				<div class="row">
					<button class="btn waves-effect waves-light green" type="submit">등록
						<i class="mdi-content-send right"></i>
					</button>
				</div> 
				<div class="row" id="fashion">
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
				<?php
				foreach ($attributes as $key => $attribute) 
				{
				?>
					<div class="input-field col s3">
						<select name="<?=$attribute->name?>">
							<option value="" disabled selected><?=$attribute->label?> 선택</option>
						<?php
						foreach ($attribute->table as $key => $row) 
						{
						?>
							<option value="<?=$row->id?>"><?=$row->label?></option>
						<?php
						}
						?>
						</select>
					</div>

				<?php
				}
				?>
				</div>
			</form>
			<div class="row">
				<div class="col s12">
					<ul class="tabs row grey lighten-4">
					<?php
					foreach ($classes as $key => $class) 
					{
					?>
						<li class="tab col s2"><a <?=($key == 0)? 'class="active"' : ''?> href="#class<?=$class->id?>"><?=$class->label?> 추가</a></li>
					<?php
					}
					?>
					</ul>
				</div>
				<?php
				foreach ($classes as $class) 
				{
				?>
					<div id="class<?=$class->id?>" class="col s12">
						<div class="col s4 input-field">
							<h5 class="section"><?=$class->label?> 타입 선택</h5>
							<div class="row">
							<?php
							foreach ($types[$class->id] as $type) 
							{
							?>
								<div>
									<input name="type<?=$class->id?>" type="radio" id="type<?=$class->id.'_'.$type->id?>" value="<?=$type->id?>"/>
									<label for="type<?=$class->id.'_'.$type->id?>"><?=$type->label?></label>
								</div>
							<?php
							}
							?>
							</div>
						</div>
						<div class="col s4 input-field">
							<h5 class="section"><?=$class->label?> 색깔 선택</h5>
							<div class="row">
							<?php
							foreach ($colors as $color) 
							{
							?>
								<div class="<?=$class->label?>">
									<input name="color<?=$class->id?>" type="radio" id="color<?=$class->id.'_'.$color->id?>" value="<?=$color->id?>"/>
									<label for="color<?=$class->id.'_'.$color->id?>"><?=$color->label?></label>
								</div>
							<?php
							}
							?>
							</div>
						</div>
						<div class="col s4 input-field">
							<h5 class="section"><?=$class->label?> 무늬 선택</h5>
							<div class="row">
							<?php
							foreach ($patterns as $pattern) 
							{
							?>
								<div class="<?=$class->label?>">
									<input name="pattern<?=$class->id?>" type="radio" id="pattern<?=$class->id.'_'.$pattern->id?>" value="<?=$pattern->id?>"/>
									<label for="pattern<?=$class->id.'_'.$pattern->id?>"><?=$pattern->label?></label>
								</div>
							<?php
							}
							?>
							</div>
						</div>
						<div class="input-field add_item" id="<?=$class->id?>">
							<a class="waves-effect waves-light green btn col offset-s10 s2">아이템 추가<i class="mdi-content-add left"></i></a>
						</div>
					</div>
				<?php
				}
				?>
			</div>
		</div>
		<div class="col s5">
			<div class="col s12 center" style="height: 900px">
				<img src="#" id="item_img" class="responsive-img card">
			</div>
		</div>
	</div>
</div>

