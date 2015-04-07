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
						<img src="<?=$data[$key]->img_path?>">
					</div>
					<div class="card-content right">
						<h6 class="blue-grey-text text-lighten-2">
							<?=$data[$key]->last_name.$data[$key]->first_name?>님이 작성
						</h6>
						<!-- <a href="#">수정</a> -->
					</div>
					<!-- <div class="card-action">
						
					</div> -->
				</div>	
			<?php
			}
			?>
			</div>
		<?php
		}
		?>
		<div class="col s3">

		</div>
		<div class="col s3">
		</div>
		<div class="col s3">
		</div>
	</div>
</div>