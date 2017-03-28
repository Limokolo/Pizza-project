<?php
  $this -> load -> view('admin/head');
  $this -> load -> view('admin/layout_start');
?>

<div class="page-header">
  <h1>Dodaj nowy składnik</h1>
</div>
<?php if(isset($errors)): ?>
<div class="alert alert-danger" role="alert">Nie udało się dodać składnika. Spróbuj ponownie</div>
<?php endif; ?>
<?php if(isset($success)): ?>
<div class="alert alert-success" role="alert">Pomyślnie dodano nowy składnik</div>
<?php else: ?>
<form class="form-horizontal" method="post" action="<?=base_url('admin/components/create')?>">
  <div class="form-group">
    <label for="nameInput" class="col-sm-2 control-label">Nazwa</label>
    <div class="col-sm-10">
      <input type="text" name="name" class="form-control" id="nameInput" placeholder="Nazwij swój składnik">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-primary pull-right">Zapisz</button>
    </div>
  </div>
<?php endif; ?>
  <div class="row">
    <div class="col-md-12">
      <a href="<?=base_url('admin/components/')?>" class="btn btn-primary">Powrót</a>
    </div>
  </div>
</form>

<?php
  $this -> load -> view('admin/layout_end');
  $this -> load -> view('admin/footer');
?>
