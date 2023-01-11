<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Contacts.List</title>

    <link href="{{url('/')}}/panel/lib/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
		<link href="{{url('/')}}/panel/lib/highlightjs/styles/github.css" rel="stylesheet">
    <link rel="stylesheet" href="{{url('/')}}/panel/css/bracket.css">
    <script src="https://use.fontawesome.com/4ce3a16048.js"></script>
    <style>
    [ng\:cloak], [ng-cloak], [data-ng-cloak], [x-ng-cloak], .ng-cloak, .x-    ng-cloak {
        display: none !important;
    }
    </style>

  </head>

   <body>

    @include('includes.menuizq')

    @include('includes.header')

    <div class="br-mainpanel">
      
     @include('ccc_cont1.ccc_cont1_menu')

      <div class="br-pagebody">
        <div class="br-section-wrapper">
          <h6 class="br-section-label">Contacts Cont1</h6>
          <p class="br-section-text">Complete leads list.</p>

           @if (session('mal'))
              <div class="alert alert-danger">
                  {{ session('mal') }}
              </div>
          @endif  

          @if (session('bien'))
              <div class="alert alert-success">
                  {{ session('bien') }}
              </div>
          @endif          

          <div class="bd bd-gray-300 rounded table-responsive">
            <table class="table mg-b-0  table-colored table-dark">
              <thead>

                 <tr> <form method="GET" action="{{route('ccc-cont1-search-list-pro')}}"> {{ csrf_field() }} 
                    <td colspan="3"><input class="form-control" type="text" name="ccc_cont1_txtsearch" maxlength="25" placeholder="Search by name - name, surname - email"></td>
                    <td colspan="1"><button type="button" class="btn btn-primary" onclick="submit();"><i class="fa fa-search" aria-hidden="true"></i> Search</button></td>
                    <td colspan="2"></td></form>
                </tr>   

                <tr>
                  <th>Delete</th>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Company</th>
                  <th>Phone</th>
                  <th>Email</th>                                 
                </tr>
              </thead>
              <tbody>

                @foreach ($contacts as $key => $reg)

                <? $bgcolor1='background-color: #B0B3B8;'; $bgcolor='background-color: #D5D9DF;'; ;?>

                <tr>
                 <td style="<?=$bgcolor;?>"><a href="{{route('ccc-cont1-delete-pro',[$reg->ccc_cont1_id,$reg->ccc_cont1_token])}}"><button type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i> Del</button></a></td>                  
                  <td style="<?=$bgcolor;?>">{{$reg->ccc_cont1_id}}</td>
                  <td style="<?=$bgcolor;?>">{{$reg->ccc_cont1_name}} {{$reg->ccc_cont1_surname}}</td>                  
                  <td style="<?=$bgcolor;?>">{{$reg->ccc_cont1_company}}</td>                  
                  <td style="<?=$bgcolor;?>">{{$reg->ccc_cont1_phone}}<br>{{$reg->ccc_cont1_cellphone}}</td>                  
                  <td style="<?=$bgcolor;?>">{{$reg->ccc_cont1_email}}</td> 
                </tr>

                <tr>
                  <td style="<?=$bgcolor;?>"></td>                  
                  <td colspan="5" style="<?=$bgcolor1;?>">{{$reg->ccc_cont1_text1}}</td> 
                </tr>

                  @if($loop->last)

                  <tr><td colspan="7">Total: {{$loop->count}}</td></tr>

                  @endif

                @endforeach               
                
              </tbody>
            </table>
          </div>


         <div class="ht-80 bd d-flex align-items-center justify-content-center">
            <nav aria-label="Page navigation">
              <ul class="pagination pagination-basic mg-b-0">
                    
                    {{ $contacts->links() }}               
              </ul>
            </nav>
          </div>         

        </div><!-- br-section-wrapper -->
      </div><!-- br-pagebody -->
       @include('includes.footer')
    </div><!-- br-mainpanel -->

    <script src="{{url('/')}}/panel/lib/jquery/jquery.min.js"></script>
    <script src="{{url('/')}}/panel/lib/jquery-ui/ui/widgets/datepicker.js"></script>
    <script src="{{url('/')}}/panel/lib/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{url('/')}}/panel/lib/moment/min/moment.min.js"></script>
    <script src="{{url('/')}}/panel/lib/peity/jquery.peity.min.js"></script>
    <script src="{{url('/')}}/panel/lib/highlightjs/highlight.pack.min.js"></script>

    <script src="{{url('/')}}/panel/js/bracket.js"></script>



  </body>
</html>
