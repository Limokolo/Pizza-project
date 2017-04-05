<?php
  $this -> load -> view('head');
  $this -> load -> view('layout_start');
?>


<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Pizza nie istnieje</h1>

        <a href="<?=base_url('admin/pizzas')?>" class="btn btn-danger">Wróć</a>
    </div>
    <!-- /.col-lg-12 -->
</div>


<?php
  $this -> load -> view('layout_end');
  $this -> load -> view('footer');
?>
