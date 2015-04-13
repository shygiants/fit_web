<div class="container">
	<div class="row">
		<?php
		for ($iter = 0; $iter < 4; $iter++)
		{
		?>
			<div class="col s3">
			<?php
			for ($key = $iter; $key < count($data); $key += 4)
			{
			?>
				<div class="card">
					<div class="card-image">
						<a class="modal-trigger" href="<?=base_url('graphic/fashion/'.$data[$key]->id)?>">
							<img src="<?=$data[$key]->img_path?>"/>
						</a>
					</div>
					<div class="card-content right">
						<p class="grey-text">
							<?=$data[$key]->last_name.$data[$key]->first_name?>님이 작성
						</p>
					</div>
				</div>	
			<?php
			}
			?>
			</div>
		<?php
		}
		?>
	</div>
</div>