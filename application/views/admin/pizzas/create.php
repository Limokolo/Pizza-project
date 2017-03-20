<?php
  $this -> load -> view('head');
  $this -> load -> view('layout_start');
?>

<div class="page-header">
  <h1>Dodaj nową pizzę</h1>
</div>
<?php if(isset($errors)){ ?>
<div class="alert alert-danger" role="alert">Nie udało się dodać pizzy. Spróbuj ponownie</div>
<?php } ?>

<form class="form-horizontal" method="post" action="<?=base_url('admin/pizzas/create')?>">
  <div class="form-group">
    <label for="nameInput" class="col-sm-2 control-label">Nazwa</label>
    <div class="col-sm-10">
      <input type="text" name="name" class="form-control" id="nameInput" placeholder="Nazwij swoją pizzę">
    </div>
  </div>
  <div class="form-group">
    <label for="descriptionInput" class="col-sm-2 control-label">Opis</label>
    <div class="col-sm-10">
      <textarea name="description" class="form-control" id="descriptionInput" placeholder="Opisz swoją pizzę"></textarea>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-primary pull-right">Zapisz</button>
    </div>
  </div>
</form>

<?php
  $this -> load -> view('layout_end');
  $this -> load -> view('footer');
?>
