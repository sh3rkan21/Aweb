<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8 mt-5">
			<?php if($this->session->flashdata('status')) : ?>
				<div class="alert alert-succes">
					<?= $this->session->flashdata('status')?>
				</div>
			<?php endif; ?>
			<div class="card">
				<div class="card-header">
					<h4>
						Editeaza Tichet
						<a href="<?= base_url('index.php/tichete/home')?>" class="float-end btn btn-danger">
							BACK
						</a>
					</h4>
				</div>
				<div class="card-body">
					<form action="<?= base_url('index.php/tichete/update/'. $tichet->id) ?>" method="POST" enctype="multipart/form-data">
						<div class="form-group">
							<label for="denumire">Denumire</label>
							<input type="text" name="denumire" value="<?= $tichet->denumire; ?>" class="form-control" placeholder="Adauga o denumire">
							<small><?php echo form_error('denumire');?></small>
						</div>
						<div class="form-group">
							<label for="descriere">Descriere</label>
							<textarea name="descriere" class="form-control" placeholder="Adauga o descriere"><?= $tichet->descriere; ?></textarea>
							<small><?php echo form_error('descriere');?></small>
						</div>
						<div class="form-group">
							<label for="data">Data</label>
							<input type="text" name="data" value="<?= $tichet->data; ?>" class="form-control" placeholder="Adauga o data">
							<small><?php echo form_error('data');?></small>
						</div>
						<div class="form-group">
							<label>Parinte: </label>
							<select name="parent_id">
								<option value="0">-</option>
								<?php for($i=0; $i < count($tichete);$i++) : ?>
									<option value="<?= $tichete[$i]->id;?>"> <?= $tichete[$i]->denumire; ?></option>
								<?php endfor;?>
							</select>
						</div>
						<div class="form-group">
							<label for="upload_poza">Upload poza</label>
							<input type="hidden" name="old_image" value="<?=$tichet->poza; ?>">
							<input type="file" name="upload_poza" class="form-control">
							<small><?php if (isset($imageError)) {echo $imageError;} ?></small>
						</div>
						<div class="form-group">
							<button type="submit" name="update" class="btn btn-info px-5">Update</button>
						</div>
					</form>
				</div>
			</div>
			<div class="col-md-4">
				<img src="<?=base_url('images/' . $tichet->poza)?>" class="w-100" alt="Poza">
			</div>
		</div>
	</div>
</div>
