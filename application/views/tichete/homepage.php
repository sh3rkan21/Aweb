<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<?php if($this->session->flashdata('status')) : ?>
				<div class="alert alert-succes">
					<?= $this->session->flashdata('status')?>
				</div>
				<?php endif; ?>
			<div class="card mt-3">
				<div class="card-header">
					<h4>
					TICHETE
					<a href="<?= base_url('index.php/tichete/add')?>" class="float-end btn btn-primary">Adauga Tichet</a>
					</h4>
				</div>
				<div class="card-body">
					<table class="table table-bordered" style="table-layout: fixed; width: 100%">
						<thead>
							<tr>
								<th>ID Ticket</th>
								<th>Tichet Parinte</th>
								<th>Poza</th>
								<th>Denumire Tichet</th>
								<th>Descriere</th>
								<th>Data</th>
								<th>Actiuni</th>
							</tr>
						</thead>
						<tbody>
						<tr>
							<?php foreach ($tichete as $item): ?>

							<td>
								<?= $item->id; ?>
							</td>
							<td>
								<?php
								if($item->parent_id == 0)
								{
									echo "Fara parinte";
								}
								else
								{
									echo $item->parentName;
								}
								?>
							</td>
							<td>
								<img src="<?=base_url('images/' . $item->poza)?>" height="50px" width="50px" alt="Tichet Poza">
							</td>
							<td><?=$item->denumire?></td>
							<td style="word-wrap: break-word"><?=$item->descriere?></td>
							<td><?=$item->data?></td>
							<td>
								<span><a href="<?= base_url('index.php/tichete/delete/'.$item->id)?>" class="btn btn-danger btn-sm float-end">Delete</a></span>
								<span><a href="<?= base_url('index.php/tichete/edit/'.$item->id )?>" class="btn btn-success btn-sm float-end">Edit</a></span>
							</td>
						</tr>
						<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
