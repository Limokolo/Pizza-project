<?php
  $this -> load -> view('admin/head');
  $this -> load -> view('admin/layout_start');
?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
          Lista składników
          <a href="<?=base_url('admin/components/create')?>" class="btn btn-primary pull-right">Dodaj nowy</a>
        </h1>
    </div>
    <!-- /.col-lg-12 -->
</div>

<div class="row">
  <table class="table table-striped table-bordered table-hover">
      <thead>
          <tr>
              <th>Składnik</th>
              <th></th>
          </tr>
      </thead>
      <tbody>
        <?php foreach($components as $component): ?>
          <tr>
              <td><?=$component -> name?></td>
              <td>
                  <div class="pull-right">
                    <a href="<?=base_url('admin/components/get/' . $component -> id)?>" class="btn btn-primary">Szczegóły</a>
                    <a href="<?=base_url('admin/components/update/' . $component -> id)?>" class="btn btn-warning">Edycja</a>
                    <a href="<?=base_url('admin/components/delete/' . $component -> id)?>" class="btn btn-danger">Skasuj</a>
                  </div>
              </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
  </table>
</div>

<?php
  $this -> load -> view('admin/layout_end');
  $this -> load -> view('admin/footer');
?>
