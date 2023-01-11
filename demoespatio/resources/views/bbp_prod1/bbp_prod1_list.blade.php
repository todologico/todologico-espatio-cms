<!DOCTYPE html>
<html lang="en" ng-app="BBP_Prod1App">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Products.List</title>

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

   <body ng-controller="BBP_Prod1Controller" ng-cloak>

    @include('includes.menuizq')

    @include('includes.header')

    <div class="br-mainpanel">
      
     @include('bbp_prod1.bbp_prod1_menu')

      <div class="br-pagebody">
        <div class="br-section-wrapper">
          <h6 class="br-section-label">Products Prod1</h6>
          <p class="br-section-text">Complete list of products.</p>

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

                 <tr> <form method="GET" action="{{route('bbp-prod1-search-list-pro')}}"> {{ csrf_field() }} 
                    <td colspan="5"><input class="form-control" type="text" name="bbp_prod1_txtsearch" maxlength="15" placeholder="Búsqueda id - cod - prod"></td>
                    <td colspan="1"><button type="button" class="btn btn-primary" onclick="submit();"><i class="fa fa-search" aria-hidden="true"></i> Search</button></td>
                    <td colspan="5"></td></form>
                </tr>   

                <tr>
                  <th>delete</th>
                  <th>ID</th>
                  <th>Product</th>
                  <th>Code</th>
                  <th>Price</th>
                  <th>Image</th>
                  <th>Image</th>
                  <th>File</th>
                  <th>Clone</th>
                  <th>Publish</th>
                  <th>Edit</th>                 
                </tr>
              </thead>
              <tbody>

                @foreach ($products as $key => $reg)

                <? if($reg->bbp_prod1_enable=='1'){$bgcolor='background-color: #EEFBE7;';} else {$bgcolor=' background-color: #FFEAE7';}?>

                <tr>

                 <td style="<?=$bgcolor;?>" ng-style="bcolor{{$reg->bbp_prod1_id}}">
                      <a href="{{route('bbp-prod1-delete-pro',[$reg->bbp_prod1_id,$reg->bbp_prod1_token])}}"><button type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i> Del</button></a></td>
                  
                  <td style="<?=$bgcolor;?>" ng-style="bcolor{{$reg->bbp_prod1_id}}">{{$reg->bbp_prod1_id}}</td>
                 
                  <td style=" max-width: 350px;<?=$bgcolor;?>" ng-style="bcolor{{$reg->bbp_prod1_id}}">{{$reg->bbp_prod1_product}}</td>                  
                  <td style=" max-width: 350px;<?=$bgcolor;?>" ng-style="bcolor{{$reg->bbp_prod1_id}}">{{$reg->bbp_prod1_code}}</td>                  
                  <td style=" max-width: 350px;<?=$bgcolor;?>" ng-style="bcolor{{$reg->bbp_prod1_id}}">€ {{$reg->bbp_prod1_price1}}</td>                  
                  
                  <td style="<?=$bgcolor;?>" ng-style="bcolor{{$reg->bbp_prod1_id}}"><?if(isset($reg->bbp_prod1_image1)){?><a href="{{url('/')}}/storage/uploaddir/{{$reg->bbp_prod1_image1}}" target="_blank"><img src="{{url('/')}}/storage/uploaddir/{{$reg->bbp_prod1_image1}}" style="height:80px;" /></a><?}?></td>                  
                  
                  <td  style="<?=$bgcolor;?>" ng-style="bcolor{{$reg->bbp_prod1_id}}"><?if(isset($reg->bbp_prod1_image2)){?><a href="{{url('/')}}/storage/uploaddir/{{$reg->bbp_prod1_image2}}" target="_blank"><img src="{{url('/')}}/storage/uploaddir/{{$reg->bbp_prod1_image2}}" style="height:80px;" /></a><?}?></td>                  
                  
                  <td style="<?=$bgcolor;?>" ng-style="bcolor{{$reg->bbp_prod1_id}}"><a href="{{route('bbp-prod1-images-update',[$reg->bbp_prod1_id,$reg->bbp_prod1_token])}}"><button type="button" class="btn btn-warning btn-sm"><i class="fa fa-file-image-o" aria-hidden="true"></i> Images</button></a></td>                  
                  
                  <td style="<?=$bgcolor;?>" ng-style="bcolor{{$reg->bbp_prod1_id}}"><a href="{{route('bbp-prod1-clone-pro',[$reg->bbp_prod1_id,$reg->bbp_prod1_token])}}"><button type="button" class="btn btn-primary btn-sm" style="background-color: #4B330B; border-color: #4B330B;"><i class="fa fa-files-o" aria-hidden="true"></i> Clone</button></a></td>
                  
                  <td style="<?=$bgcolor;?>" ng-style="bcolor{{$reg->bbp_prod1_id}}">

                    <?if($reg->bbp_prod1_enable=='1'){?>

                        <button type="button" ng-cloak ng-hide="butt1on{{$reg->bbp_prod1_id}}" ng-click="ShowHideAR({{$reg->bbp_prod1_id}},'{{$reg->bbp_prod1_token}}','1')" class="btn btn-success btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> ON</button>

                        <button type="button" ng-cloak ng-show="butt2on{{$reg->bbp_prod1_id}}" ng-click="ShowHideAR({{$reg->bbp_prod1_id}},'{{$reg->bbp_prod1_token}}','2')" class="btn btn-danger btn-sm"><i class="fa fa-power-off" aria-hidden="true"></i> OFF</button>

                      <?} else {?> 

                        <button type="button" ng-cloak ng-hide="butt3on{{$reg->bbp_prod1_id}}" ng-click="ShowHideAR({{$reg->bbp_prod1_id}},'{{$reg->bbp_prod1_token}}','3')" class="btn btn-danger btn-sm"><i class="fa fa-power-off" aria-hidden="true"></i> OFF</button>

                        <button type="button" ng-cloak ng-show="butt4on{{$reg->bbp_prod1_id}}" ng-click="ShowHideAR({{$reg->bbp_prod1_id}},'{{$reg->bbp_prod1_token}}','4')" class="btn btn-success btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> ON</button>

                    <?}?>

                  </td>
                  
                  <td style="<?=$bgcolor;?>" ng-style="bcolor{{$reg->bbp_prod1_id}}"><a href="{{route('bbp-prod1-update',[$reg->bbp_prod1_id,$reg->bbp_prod1_token])}}"><button type="button" class="btn btn-primary btn-sm"><i class="fa fa-file-text" aria-hidden="true"></i> Edit</button></a></td>
                 
                </tr>

                  @if($loop->last)

                  <tr><td colspan="11">Total: {{$loop->count}}</td></tr>

                  @endif

                @endforeach               
                
              </tbody>
            </table>
          </div>


         <div class="ht-80 bd d-flex align-items-center justify-content-center">
            <nav aria-label="Page navigation">
              <ul class="pagination pagination-basic mg-b-0">
                    
                    {{ $products->links() }}               
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

    <script src="{{url('/')}}/angular/angular.js"></script>
    <script src="{{url('/')}}/angular/bbp_prod1.js"></script>


  </body>
</html>
