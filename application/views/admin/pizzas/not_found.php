<?php
  $this -> load -> view('admin/head');
  $this -> load -> view('admin/layout_start');
?>

<div class="page-header">
  <h1>Nie znaleziono pizzy</h1>
</div>

<div class="row">
  <div class="col-md-12">
    <a href="<?=base_url('admin/pizzas/')?>" class="btn btn-primary">Powrót</a>
  </div>
</div>

<?php
  $this -> load -> view('admin/layout_end');
  $this -> load -> view('admin/footer');
?>
