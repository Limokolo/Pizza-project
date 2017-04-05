<?php
  $this -> load -> view('head');
  $this -> load -> view('layout_start');
?>

<div class="page-header">
  <h1>Pomyślnie dodano nową pizzę</h1>
</div>

<div class="row">
  <div class="col-md-12">
    <a href="<?=base_url('admin/pizzas/')?>" class="btn btn-primary">Powrót</a>
  </div>
</div>

<?php
  $this -> load -> view('layout_end');
  $this -> load -> view('footer');
?>
