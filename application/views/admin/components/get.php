<?php
  $this -> load -> view('admin/head');
  $this -> load -> view('admin/layout_start');
?>

<div class="page-header">
  <h1>
    <?=$component -> name?>
    <a href="<?=base_url('admin/components/update/' . $component -> id )?>" class="btn btn-primary pull-right">Edycja</a>
  </h1>
</div>

<?php
  $this -> load -> view('admin/layout_end');
  $this -> load -> view('admin/footer');
?>
