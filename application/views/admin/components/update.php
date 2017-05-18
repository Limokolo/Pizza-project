<?php
  $this -> load -> view('admin/head');
  $this -> load -> view('admin/layout_start');

?>
<form method="post" action="<?=base_url('admin/components/update/' . $component -> id)?>">
  <input type="hidden" name="id" value="<?=$component -> id?>" />
  <div class="page-header">
    <div class="row">
      <?php if(isset($errors)){ ?>
      <div class="alert alert-danger" role="alert">Nie udało się zaktualizować składnika. Spróbuj ponownie</div>
      <?php } else if(isset($success)){ ?>
      <div class="alert alert-success" role="alert">Składnik został zaktualizowany</div>
      <?php } ?>
      <div class="col-md-10">
        <input type="text" class="form-control" name="name" value="<?=$component -> name?>" />
      </div>
      <div class="col-md-2">
        <button type="submit" class="btn btn-primary btn-block">Zapisz</button>
        <a style="margin-top: 10px;" href="<?=base_url('admin/components/get/' . $component -> id)?>" class="btn btn-default btn-block">Anuluj</a>
        <a style="margin-top: 10px;" href="<?=base_url('admin/components/delete/' . $component -> id)?>" class="btn btn-danger btn-block">Skasuj</a>
      </div>
    </div>
  </div>

</form>

<?php
  $this -> load -> view('admin/layout_end');
  $this -> load -> view('admin/footer');
?>
