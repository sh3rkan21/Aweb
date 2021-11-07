

<?php echo validation_errors(); ?>

<?php echo form_open_multipart('news/create'); ?>

<label for="title">Denumire</label>
<input type="text" name="title" /><br />

<label for="descriere">Descriere</label>
<textarea name="descriere"></textarea><br />

<label for="Data">Data</label>
<input type="text" name="data"><br />

<input type="file" name="image" id="image">

<input type="submit" name="submit" value="Create news item" />

</form>
