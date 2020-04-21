<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <title>Mahmudul Hassan</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">

        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>



        <style type="text/css">
            .col-center-block {
                float: none;
                display: block;
                margin: 0 auto;
               
            }

            .checkbox-round {
                width: 1.3em;
                height: 1.3em;
                /*background-color: white;*/
                border-radius: 50%;
                vertical-align: middle;
                border: 1px solid #ddd;
               /* -webkit-appearance: none;
                outline: none;
                cursor: pointer;*/
            }

            .table{
                margin-bottom: 0px;
            }

            .td-checkbox{
                width: 10px;
            }


            .cross{
                text-decoration: line-through;
            }



            .count {
                display: inline-block;
                font-weight: 400;
                color: #212529;
                text-align: center;
                vertical-align: middle;
                
                -webkit-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
                user-select: none;
                background-color: transparent;
                border: 1px solid transparent;
                padding: .375rem .75rem;
                font-size: 1rem;
                line-height: 1.5;
                border-radius: .25rem;
                transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
            }

            .edit-name {
                display: none;
            }

            .edit-text {
                cursor: cell;
            }

            .hide{
                display: none;
            }


        </style>

        
    </head>
    <body>

        <div class="container">

            <h1 align="center">todos</h1> 

            <div class="card col-center-block" style="width: 40rem;">
                <table class="table">
                  
                  <thead>
                    <tr>
                      <td class="td-checkbox"><span><i class="fa fa-chevron-down" aria-hidden="true"></i></span></td>
                      <td><input type="text" id="name" name="name" class="form-control name" placeholder="What needs to be done?" autocomplete="off" maxlength="50"></td>
                      
                    </tr>
                  </thead>
                  <tbody id="todo-table">
                   
                  </tbody>

                </table>


                <table class="table">
                    <tr>
                      <td><label class="count" id="count_text">0 items left</label></td>
                      <td>
                        <button type="button" class="btn btn-light" id="all_button">All</button>
                        <button type="button" class="btn btn-light" id="active_button">Active</button>
                        <button type="button" class="btn btn-light" id="completed_button">Completed</button>
                        <button type="button" class="btn btn-light pull-right hide" id="clear_completed">Clear Completed</button>
                      </td>
                    </tr>
                </table>
            </div>
        </div>

    </body>


    <script type="text/javascript">

        var base_url = '<?php echo url('/');?>';

        $(function() {

            $("#all_button").click(function(){

                $(this).toggleClass('active').siblings().not(this).removeClass('active');

                var targetUrl = base_url + "/todos/2";
                $.ajax({
                    url: targetUrl,
                    type: "GET",
                    dataType: "json",
                    success: function (response) {

                        $('#todo-table').html(response.content);
                        $('#count_text').html(response.count_text);

                        if(response.completed > 0)
                        {
                            $('#clear_completed').show();
                        }
                        
                    }, error: function (jqXHR) {
                        
                    }
                });
            });

            $("#all_button").click();
            $( "#name" ).focus();


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }

            });


            $( ".name" ).on( "keydown", function(event) {
              if(event.which == 13) {

                var name = $.trim($(this).val());
                if( !name ) {
                    return ;
                }
               
                var sendData = {
                    'name' : name,
                    'status' : 0,
                };

                
                var targetUrl = base_url + "/todos";
                $.ajax({
                    url: targetUrl,
                    type: "POST",
                    data: sendData,
                    dataType: "json",
                    success: function (response) {
                        
                        $('#name').val('');

                        $('#todo-table').html(response.content);
                        $('#count_text').html(response.count_text);

                        if(response.completed > 0)
                        {
                            $('#clear_completed').show();
                        }
                        
                    }, error: function (jqXHR) {
                        
                    }
                });

                 
              }
            });

            $("#active_button").click(function(){

                $(this).toggleClass('active').siblings().not(this).removeClass('active');
        
                var targetUrl = base_url + "/todos/0";
                $.ajax({
                    url: targetUrl,
                    type: "GET",
                    dataType: "json",
                    success: function (response) {

                        $('#todo-table').html(response.content);
                        $('#count_text').html(response.count_text);

                        if(response.completed > 0)
                        {
                            $('#clear_completed').show();
                        }
                        
                    }, error: function (jqXHR) {
                        
                    }
                });
            });

            $("#completed_button").click(function(){

                $(this).toggleClass('active').siblings().not(this).removeClass('active');
        
                var targetUrl = base_url + "/todos/1";
                $.ajax({
                    url: targetUrl,
                    type: "GET",
                    dataType: "json",
                    success: function (response) {

                        $('#todo-table').html(response.content);
                        $('#count_text').html(response.count_text);

                        if(response.completed > 0)
                        {
                            $('#clear_completed').show();
                        }
                        
                    }, error: function (jqXHR) {
                        
                    }
                });
            });



             $("#clear_completed").click(function(){

                $(this).siblings().not(this).removeClass('active');

                var targetUrl = base_url + "/todos/1";
                $.ajax({
                    url: targetUrl,
                    type: "DELETE",
                    dataType: "json",
                    success: function (response) {

                        $('#todo-table').html(response.content);
                        $('#count_text').html(response.count_text);

                       
                        $('#clear_completed').hide();
                        $("#all_button").addClass('active');
                        
                        
                    }, error: function (jqXHR) {
                        
                    }
                });
            });

        });


        function checkboxEvent(id)
        {
            $('#checkbox-'+ id).prop("disabled", true);
            $('#todo_show-'+ id).addClass('cross');
            $('#todo_show-'+ id).removeClass('edit-text');

            var sendData = {
                'status' : 1,
            };
            
            var targetUrl = base_url + "/todos/"+ id;
            $.ajax({
                url: targetUrl,
                type: "PUT",
                data: sendData,
                dataType: "json",
                success: function (response) {
                    $('#clear_completed').show();

                    $('.btn-light').removeClass('active');
                    $("#all_button").addClass('active');
                    
                }, error: function (jqXHR) {
                    
                }
            });

        }

        function openEdit(id)
        {

            if($('#checkbox-'+ id).prop("checked") == false){

                $('#checkbox-'+ id).prop("disabled", true);
                $('#todo_show-'+ id).hide();
                $('#name-'+ id).show();
                $('#name-'+ id).focusTextToEnd();;
            }
        }

        function editName(event,id)
        {
            if(event.which == 13) {
                
                var name = $.trim($('#name-'+ id).val());

                if( !name ) {
                    return ;
                }

                $('#name-'+ id).hide();
                $('#todo_show-'+ id).html(name);
                $('#todo_show-'+ id).show();
                $('#checkbox-'+ id).prop("disabled", false);

                var sendData = {
                    'name' : name,
                };
                
                var targetUrl = base_url + "/todos/"+ id;
                $.ajax({
                    url: targetUrl,
                    type: "PUT",
                    data: sendData,
                    dataType: "json",
                    success: function (response) {
                        
                    }, error: function (jqXHR) {
                        
                    }
                });
            }

        }

        (function($){
            $.fn.focusTextToEnd = function(){
                this.focus();
                var $thisVal = this.val();
                this.val('').val($thisVal);
                return this;
            }
        }(jQuery));

    </script>


</html>
