<?php
  $this -> load -> view('admin/head');
  $this -> load -> view('admin/layout_start');
?>
  <div class="page-header">
    <form method="post" action="<?=base_url('admin/pizzas/update/' . $pizza -> id)?>">
      <div class="row">
        <?php if(isset($errors) && !empty($errors)){ ?>
        <div class="alert alert-danger" role="alert">Nie udało się zaktualizować pizzy. Spróbuj ponownie</div>
        <?php } else if(isset($success) && !empty($success)){ ?>
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
    </form>
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
                    <td style="width: 100px;">
                        <a href="<?=base_url('admin/pizzas/removeComponent/' . $pizza -> id . '/' . $component -> id)?>" class="btn btn-danger">Usuń</a>
                    </td>
                </tr>
              <?php endforeach; ?>
          </tbody>
          <?php if(isset($components) && !empty($components)):
            ?>
            <tfoot>
              <form method="post" action="<?=base_url('admin/pizzas/addComponent/' . $pizza -> id)?>">
                <tr>
                  <td colspan="2">
                    <select name="component_id" class="form-control" name="component">
                      <?php foreach($components as $component): ?>
                        <option value="<?=$component -> id?>"><?=$component -> name?></option>
                      <?php endforeach; ?>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td>
                    <button type="submit" class="btn btn-primary btn-block">Dodaj składnik</button>
                  </td>
                </tr>
              </form>
            </tfoot>
          <?php endif; ?>
      </table>
    </div>
  </div>

<?php
  $this -> load -> view('admin/layout_end');
  $this -> load -> view('admin/footer');
?>
