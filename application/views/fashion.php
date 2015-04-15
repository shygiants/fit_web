<div class="edit_container">
	<div class="row"></div>
	<div class="row">
		<div class="col s5">
			<div class="row">
				<div class="col s12">
					<ul class="collection z-depth-1">
						<li class="collection-item avatar">
							<i class="mdi-social-person circle light-green"></i>
							<span class="title"><?=$fashion->last_name.$fashion->first_name?></span>
							<p class="truncate">출처 - <a href="<?=$fashion->src_link?>" target="_blank"><?=$fashion->src_link?></a></p>
							 <?=$fashion->created_date?>에 작성
						</li>
					</ul>
				</div>
			</div>
			<div class="row">
				<div class="col s12">
					<h3>아이템</h3>
				</div>
			<?php
			foreach ($items as $key => $item) 
			{
			?>
				<div class="col s4">
					<ul class="collection with-header z-depth-1">
						<li class="collection-header"><h4><?=$item->class_label?></h4></li>
						<li class="collection-item"><div><?=$item->pattern_label?><a href="#!" class="secondary-content"><i class="mdi-content-send"></i></a></div></li>
						<li class="collection-item"><div><?=$item->color_label?><a href="#!" class="secondary-content"><i class="mdi-content-send"></i></a></div></li>
						<li class="collection-item"><div><?=$item->type_label?><a href="#!" class="secondary-content"><i class="mdi-content-send"></i></a></div></li>
					</ul>
				</div>
			<?php
			}
			?>
			</div>
		</div>
		<div class="col s5 center">
			<img class="responsive-img card" src="<?=$fashion->img_path?>">
		</div>
		<div class="col s2">
			<ul class="collection z-depth-1">
				<li class="collection-item avatar">
					<i class="mdi-action-accessibility circle <?=($fashion->gender_label == '남성')? 'blue' : 'red'?>"></i>
					<span class="title">성별</span>
					<p>
						<?=$fashion->gender_label?>
					</p>
				</li>
				<li class="collection-item avatar">
					<i class="mdi-file-cloud-queue circle brown"></i>
					<span class="title">시즌</span>
					<p>
						<?=$fashion->season_label?>
					</p>
				</li>
				<li class="collection-item avatar">
					<i class="mdi-action-loyalty circle blue-grey"></i>
					<span class="title">스타일</span>
					<p>
						<?=$fashion->style_label?>
					</p>
				</li>
				<li class="collection-item avatar">
					<i class="mdi-social-cake circle deep-orange"></i>
					<span class="title">나이</span>
					<p>
						<?=$fashion->age_label?>
					</p>
				</li>
			</ul>
		</div>
	</div>
</div>