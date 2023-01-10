<!DOCTYPE html>
<html lang="en" ng-app="AAB_Bann1App">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Banners.Order</title>

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

   <body ng-controller="AAB_Bann1Controller" ng-cloak>

    @include('includes.menuizq')

    @include('includes.header')

    <div class="br-mainpanel">
      
      @include('aab_bann1.aab_bann1_menu')

      <div class="br-pagebody">
        <div class="br-section-wrapper">
          <h6 class="br-section-label">Sort Banners</h6>
          <p class="br-section-text">Allows numerical sorting banners.  <span style="color: #ff0000;" ng-cloak ng-show="orderok"><b><i class="fa fa-check-square" aria-hidden="true"></i> Done, the order has been updated! Press F5 to see results</b></span></p>


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
                <tr>
                  <th>Delete</th>
                  <th>ID</th>
                  <th>Banner</th>
                  <th>Image</th>                  
                  <th>Published</th>                  
                  <th>Order</th>                  
                  <th>Sort</th>                 
                </tr>
              </thead>
              <tbody>

                @foreach ($banners as $key => $reg)

                <? if($reg->aab_bann1_enable=='1'){$bgcolor='background-color: #EEFBE7;';} else {$bgcolor=' background-color: #FFEAE7';}?>

                <tr>

                 <td style="<?=$bgcolor;?>">
                      <a href="{{route('aab-bann1-delete-pro',[$reg->aab_bann1_id,$reg->aab_bann1_token])}}"><button type="button" class="btn btn-danger btn-sm">Del</button></a></td>
                  
                  <td style="<?=$bgcolor;?>">{{$reg->aab_bann1_id}}</td>
                 
                  <td style="<?=$bgcolor;?>">{{$reg->aab_bann1_banner}}</td>                  
                  
                  <td style="<?=$bgcolor;?>"><?if(isset($reg->aab_bann1_image1)){?><img src="{{url('/')}}/storage/uploaddir/{{$reg->aab_bann1_image1}}" style="height:80px;" /><?}?></td>
                  
                  <td style="<?=$bgcolor;?>">

                    <?if($reg->aab_bann1_enable=='1'){?>

                        <button type="button" class="btn btn-success btn-sm">ON</button>

                      <?} else {?>                       

                        <button type="button" class="btn btn-success btn-sm">OFF</button>

                    <?}?>

                  </td>

                  <td style="<?=$bgcolor;?>">{{$reg->aab_bann1_order}}</td> 
                  
                  <td style="<?=$bgcolor;?>">                     

                        <select name="order" ng-model="order{{$reg->aab_bann1_id}}" ng-change="OrderBannersAR('{{$reg->aab_bann1_id}}','{{$reg->aab_bann1_token}}',this.order{{$reg->aab_bann1_id}})" data-placeholder="Ordenar">
                        <?for ($i = 1; $i <= count($banners); $i++) {?>
                            <option value="{{$i}}">{{$i}}</option>
                        <?}?>
                      </select>

                  </td>
                 
                </tr>

                  @if($loop->last)

                  <tr><td colspan="10">Total: {{$loop->count}}</td></tr>

                  @endif

                @endforeach               
                
              </tbody>
            </table>
          </div>


          <!-- <div class="ht-80 bd d-flex align-items-center justify-content-center">
            <nav aria-label="Page navigation">
              <ul class="pagination pagination-basic mg-b-0">

              
               
              </ul>
            </nav>
          </div>   -->        

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
    <script src="{{url('/')}}/angular/aab_bann1.js"></script>


  </body>
</html>
