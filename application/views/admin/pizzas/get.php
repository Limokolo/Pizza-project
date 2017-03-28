<?php
  $this -> load -> view('admin/head');
  $this -> load -> view('admin/layout_start');
?>

<div class="page-header">
  <h1>
    <?=$pizza -> name?>
    <a href="<?=base_url('admin/pizzas/update/' . $pizza -> id )?>" class="btn btn-primary pull-right">Edycja</a>
  </h1>
  <p class="lead"><?=$pizza -> description?></p>
</div>

<div class="row">
  <div class="col-md-6">
    <table class="table">
        <thead>
            <tr>
                <th>Rozmiar</th>
                <th>Cena</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($pizza -> sizes as $size): ?>
              <tr>
                  <td><?=$size -> name?></td>
                  <td><?=$size -> price?></td>
              </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
  </div>
  <div class="col-md-6">
    <table class="table">
        <thead>
            <tr>
                <th>Składnik</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($pizza -> components as $component): ?>
              <tr>
                  <td><?=$component -> name?></td>
              </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
  </div>
</div>

<?php
  $this -> load -> view('admin/layout_end');
  $this -> load -> view('admin/footer');
?>
