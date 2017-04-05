<?php
  $this -> load -> view('head');
  $this -> load -> view('layout_start');
?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
          Lista pizz
          <a href="<?=base_url('admin/pizzas/create')?>" class="btn btn-primary pull-right">Dodaj nową</a>
        </h1>
    </div>
    <!-- /.col-lg-12 -->
</div>

<div class="row">
  <table class="table table-striped table-bordered table-hover">
      <thead>
          <tr>
              <th>Pizza</th>
              <th>Opis</th>
              <th></th>
          </tr>
      </thead>
      <tbody>
        <?php foreach($pizzas as $pizza): ?>
          <tr>
              <td><?=$pizza -> name?></td>
              <td><?=$pizza -> description?></td>
              <td>
                  <div class="pull-right">
                    <a href="<?=base_url('admin/pizzas/get/' . $pizza -> id)?>" class="btn btn-primary">Szczegóły</a>
                    <a href="<?=base_url('admin/pizzas/update/' . $pizza -> id)?>" class="btn btn-warning">Edycja</a>
                    <a href="<?=base_url('admin/pizzas/delete/' . $pizza -> id)?>" class="btn btn-danger">Skasuj</a>
                  </div>
              </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
  </table>
</div>

<?php
  $this -> load -> view('layout_end');
  $this -> load -> view('footer');
?>
