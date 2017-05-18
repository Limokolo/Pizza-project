<?php
  $this -> load -> view('head');
  $this -> load -> view('admin/layout_start');
?>
<form method="post" action="<?=base_url('admin/pizzas/update/' . $pizza -> id)?>">
  <input type="hidden" name="id" value="<?=$pizza -> id?>" />
  <div class="page-header">
    <div class="row">
      <?php if(isset($errors)){ ?>
      <div class="alert alert-danger" role="alert">Nie udało się zaktualizować pizzy. Spróbuj ponownie</div>
      <?php } else if(isset($success)){ ?>
      <div class="alert alert-success" role="alert">Pizza została zaktualizowana</div>
      <?php } ?>
      <div class="col-md-10">
        <input type="text" class="form-control" name="name" value="<?=$pizza -> name?>" />
        <textarea style="margin-top: 10px;" class="form-control" name="description"><?=$pizza -> description?></textarea>
      </div>
      <div class="col-md-2">
        <button type="submit" class="btn btn-primary btn-block">Zapisz</button>
        <a style="margin-top: 10px;" href="<?=base_url('admin/pizzas/get/' . $pizza -> id)?>" class="btn btn-default btn-block">Anuluj</a>
        <a style="margin-top: 10px;" href="<?=base_url('admin/pizzas/delete/' . $pizza -> id)?>" class="btn btn-danger btn-block">Skasuj</a>
      </div>
    </div>

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
</form>

<?php
  $this -> load -> view('layout_end');
  $this -> load -> view('footer');
?>
