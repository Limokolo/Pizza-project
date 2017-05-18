<?php
  $this -> load -> view('head');
  $this -> load -> view('admin/layout_start');
?>

<div class="page-header">
  <h1>Potwierdź usunięcie pizzy</h1>
</div>

<div class="content">
  <?php if(isset($errors)){ ?>
  <div class="alert alert-danger" role="alert">Nie udało się usunąć pizzy. Spróbuj ponownie</div>
  <?php } ?>
  <?php if(isset($success)): ?>
    <div class="alert alert-success" role="alert">Pomyślnie usunięto pizzę</div>
  <?php else: ?>

    <p>Czy na pewno chcesz usunąć pizzę <?=$pizza -> name?>?</p>

    <div class="col-md-6">
      <a href="<?=base_url('admin/pizzas/get/' . $pizza -> id)?>" class="btn btn-default btn-block">Anuluj</a>
    </div>
    <div class="col-md-6">
      <form method="post" action="<?=base_url('admin/pizzas/delete/' . $pizza -> id)?>">
        <input type="hidden" name="id" value="<?=$pizza -> id?>" />
        <button type="submit" class="btn btn-danger btn-block">Usuń</button>
      </form>
    </div>
  <?php endif; ?>
</div>

<?php
  $this -> load -> view('layout_end');
  $this -> load -> view('footer');
?>
