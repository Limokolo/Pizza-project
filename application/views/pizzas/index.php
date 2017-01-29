<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Component</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script>
      var base_path = "<?=base_url()?>";
    </script>

  </head>
  <body>

    <div class="col-md-10 col-md-offset-1" style="margin-top: 40px;">

      <?php if(sizeof($pizzas) > 0): ?>

        <table class="table">
            <thead>
                <tr>
                  <th>Nazwa</th>
                  <th>Cena</th>
                  <th style="width: 100px;">Szczegóły</th>
                </tr>
            </thead>
            <tbody id="components_list_table">
        <?php foreach($pizzas as $pizza): ?>
              <tr>
                  <td><?=$pizza -> name?></td>
                  <td><?=$pizza -> price?> zł</td>
                  <td><button class="btn btn-info info-button" data-id="<?=$pizza -> id?>">Pokaż</button></td>
              </tr>
        <?php endforeach; ?>
            </tbody>
          </table>

      <?php else: ?>
          <div class="alert alert-danger">Brak pizz!</div>
      <?php endif; ?>

      <div class="alert alert-info">
        Nowa pizza
        <button class="btn btn-primary btn-xs pull-right" id="add-component-button">Dodaj</button>
      </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="detailsModal">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Szczegóły</h4>
          </div>
          <div class="modal-body">
            <p class="component-name">
                Nazwa pizzy: <strong></strong>
            </p>
            <p class="component-notes">
                Opis pizzy: <strong></strong>
            </p>
            <p class="component-price">
                Cena pizzy: <strong></strong> zł
            </p>

            <table class="table">
                <thead>
                    <tr>
                      <th style="width: 100px;">Ilość</th>
                      <th>Nazwa</th>
                      <th>Cena</th>
                      <th></th>
                    </tr>
                </thead>
                <tbody class="pizza-components">
                </tbody>
                <tfoot>
                  <tr>
                      <form id="add_component_form">
                        <td><input type="number" class="component_count form-control" name="count" min="1" max="20" value="1" /></td>
                        <td><select class="components_list form-control" name="component_id"></select></td>
                        <td><span class="component_price"></span></td>
                        <td><input type="button" class="btn btn-success" id="add_component_button" value="Dodaj" /></td>
                        <input type="hidden" class="pizza_id" name="pizza_id" />
                      </form>
                  </tr>
                </tfoot>
            </table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Zamknij</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div class="modal fade" tabindex="-1" role="dialog" id="newModal">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Dodaj pizzę</h4>
          </div>
          <div class="modal-body">

            <div class="alert alert-danger" role="alert" id="cannot_add_alert" style="display: none;">
                <strong>Uwaga!</strong> Nie udało się dodać pizzy.
            </div>

            <div class="alert alert-warning" role="alert" id="empty_fields_alert" style="display: none;">
                <strong>Uwaga!</strong> Proszę upewnij się, że wypełniłeś wszystkie pola.
            </div>

            <div class="alert alert-warning" role="alert" id="component_exists_alert" style="display: none;">
                <strong>Uwaga!</strong> Pizza została już wcześniej dodana.
            </div>

            <form class="form-horizontal" id="add_component_form">
              <div class="form-group">
                <label for="name_input" class="col-sm-3 control-label">Nazwa pizzy:</label>
                <div class="col-sm-9">
                  <input type="text" name="name" placeholder="Nazwa" class="form-control" id="name_input" />
                </div>
              </div>
            </form>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="new-component-button">Dodaj</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Analuj</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <script>
      var components_loaded = false;
      var components_list = [];

      $(document).on('click', '.info-button', function(){
        var id = $(this).data('id');
        var url = base_path + '/pizzas/get/' + id + '?format=json';

        $.ajax({
            url: url,
            dataType: 'json',
            success: function(response){
              for(var i in response){
                $('#detailsModal').find('.modal-body').find('.component-' + i).find('strong').first().text(response[i]);
              }

              var components_table = $('#detailsModal').find('.modal-body').find('.pizza-components');
              $(components_table).html('');

              for(var i in response.components){
                var component = response.components[i];

                var tr = document.createElement('tr');

                var count = document.createElement('td');
                $(count).text(component.count);
                $(tr).append(count);

                var name = document.createElement('td');
                $(name).text(component.name);
                $(tr).append(name);

                var price = document.createElement('td');
                $(price).text(component.price);
                $(price).attr('colspan', 2);
                $(tr).append(price);

                $(components_table).append(tr);

              }

              if(!components_loaded){
                $.ajax({
                  url: base_path + '/components/getAll?format=json',
                  dataType: 'json',
                  success: function(data){
                    components_list = data;
                    for(var i in data){
                      var component = data[i];

                      var component_option = document.createElement('option');
                      $(component_option).val(component.id);
                      $(component_option).text(component.name);

                      $('#detailsModal').find('.components_list').append(component_option);
                    }
                    updateComponentsPrice();
                    components_loaded = true;
                  }
                })
              }

              $('#detailsModal').find('.pizza_id').val(id);
              $('#detailsModal').find('.component_count').val(1);

              $('#detailsModal').modal('show');
            }
        });
      });

      function updateComponentsPrice(){
        var id = $('#detailsModal').find('.components_list').val();
        for(var i in components_list){
          var component = components_list[i];
          if(id === component.id){
            var count = $('#detailsModal').find('.component_count').val();
            var price = component.price * count;
            $('#detailsModal').find('.component_price').text(price + " zł");
            break;
          }
        }
      }

      $(document).on('change', '.component_count', updateComponentsPrice);
      $(document).on('change', '.components_list', updateComponentsPrice);

      $(document).on('click', '#add-component-button', function(){
        $('#newModal').modal('show');
      });

      $(document).on('click', '#new-component-button', function(){
        var component_data = $('#add_component_form').serialize();

        var name = $('#add_component_form').find('input[name="name"]').val();
        var price = $('#add_component_form').find('input[name="price"]').val();

        if(name.length === 0){
          $('#empty_fields_alert').show();
        }


        $.ajax({
            url: base_path + '/pizzas/add/?format=json',
            dataType: 'json',
            method: 'post',
            data: component_data,
            statusCode: {
              400: function(){
                $('#cannot_add_alert').show();
              },
              302: function(){
                $('#component_exists_alert').show();
              }
            },
            success: function(response){
                $('#newModal').modal('hide');
                $('#detailsModal').modal('show');
                for(var i in response){
                  $('#detailsModal').find('.modal-body').find('.component-' + i).find('strong').first().text(response[i]);
                }

                var tr = document.createElement('tr');
                var name = document.createElement('td');
                $(name).text(response.name);
                $(tr).append(name);

                var price = document.createElement('td');
                $(price).text(response.price + ' zł');
                $(tr).append(price);

                var button_td = document.createElement('td');
                var button = document.createElement('button');
                $(button).addClass('btn btn-info info-button');
                $(button).data('id', response.id);
                $(button).text('Pokaż');
                $(button_td).append(button);
                $(tr).append(button_td);

                $('#components_list_table').append(tr);
            }
        });
      });
    </script>
  </body>
</html>
