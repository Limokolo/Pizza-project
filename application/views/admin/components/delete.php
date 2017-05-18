<?php
  $this -> load -> view('admin/head');
  $this -> load -> view('admin/layout_start');
?>

<div class="page-header">
  <h1>Potwierdź usunięcie składnika</h1>
</div>

<div class="content">
  <?php if(isset($errors)): ?>
  <div class="alert alert-danger" role="alert">Nie udało się usunąć składnika. Spróbuj ponownie</div>
  <?php endif; ?>
  <?php if(isset($success)): ?>
    <div class="alert alert-success" role="alert">Pomyślnie usunięto składnik</div>
  <?php else: ?>
    <p>Czy na pewno chcesz usunąć składnik <?=$component -> name?>?</p>

    <div class="col-md-6">
      <a href="<?=base_url('admin/components/')?>" class="btn btn-default btn-block">Anuluj</a>
    </div>
    <div class="col-md-6">
      <form method="post" action="<?=base_url('admin/components/delete/' . $component -> id)?>">
        <input type="hidden" name="id" value="<?=$component -> id?>" />
        <button type="submit" class="btn btn-danger btn-block">Usuń</button>
      </form>
    </div>
  <?php endif; ?>
</div>

<?php
  $this -> load -> view('admin/layout_end');
  $this -> load -> view('admin/footer');
?>
