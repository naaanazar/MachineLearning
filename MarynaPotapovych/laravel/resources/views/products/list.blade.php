<meta name="csrf-token" content="{{ csrf_token() }}" />
<link rel='stylesheet' href='http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
<script src='https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js'></script>
<script src='http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>

<script   src="https://code.jquery.com/jquery-3.1.0.min.js" 
          integrity="sha256-cCueBR6CsyA4/9szpPfrX3s49M9vUU5BgtiJj06wt/s=" 
crossorigin="anonymous"></script>
<script>
$.ajaxSetup({
    headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           }
   });
$(document).ready(function () {
    $('.delete').on('click', function (e) {
        e.preventDefault();
        $.post($(e.target).attr('href'), function (data) {
                               if (data.success) {
                                      $(e.target).closest('div').fadeOut();
                             }
                              });
    });
    $('.permanently-delete-button').on('click', function (e) {
        e.preventDefault();
        $.post($(e.target).attr('href'), function (data) {
            if (data.success) {
                $(e.target).closest('div').fadeOut();
            }
        });
    });
    $('.restore-button').on('click', function (e) {
        e.preventDefault();
        $.post($(e.target).attr('href'), function (data) {
            if (data.success) {
                location.reload();
            }
        });
    });
});

</script>

<div class="row">
    <div class="col-md-4">
                <a href="{{ URL::to('products/add') }}" class="btn btn-info">Add new product</a>
            </div>
</div>

@foreach ($products as $item)
 <div class="col-md-4 product-item">
           <a href="{{ URL::to('/products/'.$item->id) }}">
                   <h3>{{ $item->title }}</h3>            
               </a><br>
           <img width="" height="" src="{{ $item->img }}"><br><br>

           @unless(empty($item->deleted_at))
               <script>
                       $('div.product-item h3').css('color', 'grey');
               </script>
               <br><a href="{{ URL::to('products/restore/'.$item->id) }}" class="btn btn-info restore-button">{{ trans('main.restore') }}</a>
           @else
               <br><a href="{{ URL::to('products/delete/'.$item->id) }}" class="btn btn-danger delete">{{ trans('main.delete') }}</a>
           @endunless
               <a href="{{ URL::to('products/forcedelete/'.$item->id) }}" class="btn btn-danger permanently-delete-button">{{ trans('main.forceDelete') }}</a>
       </div>
@endforeach

