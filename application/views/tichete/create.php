<div class="container">
	<div class="row">
		<div class="col-md-9">
			<?php if($this->session->flashdata('status')) : ?>
				<div class="alert alert-succes">
					<?= $this->session->flashdata('status')?>
				</div>
			<?php endif; ?>
			<div class="card">
				<div class="card-header">
					<h4>
						Adauga Tichet
						<a href="<?= base_url('index.php/tichete/home')?>" class="float-end btn btn-danger">
							BACK
						</a>
					</h4>
				</div>
				<div class="card-body">
					<form action="<?= base_url('index.php/tichete/add') ?>" method="POST" enctype="multipart/form-data">
						<div class="form-group">
							<label for="denumire">Denumire</label>
							<input type="text" name="denumire" class="form-control" placeholder="Adauga o denumire">
							<small><?php echo form_error('denumire');?></small>
						</div>
						<div class="form-group">
							<label for="descriere">Descriere</label>
							<textarea name="descriere" class="form-control" placeholder="Adauga o descriere"></textarea>
							<small><?php echo form_error('descriere');?></small>
						</div>
						<div class="form-group">
							<label for="data">Data</label>
							<input type="text" name="data" class="form-control" placeholder="Adauga o data">
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
							<input type="file" name="upload_poza" class="form-control">
							<small><?php if (isset($imageError)) {echo $imageError;} ?></small>
						</div>
						<div class="form-group">
							<button type="submit" name="salveaza" class="btn btn-primary px-5">Salveaza</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
