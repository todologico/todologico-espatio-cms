<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Banners.Listado</title>

    <link href="{{url('/')}}/panel/lib/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
		<link href="{{url('/')}}/panel/lib/highlightjs/styles/github.css" rel="stylesheet">
    <link rel="stylesheet" href="{{url('/')}}/panel/css/bracket.css">
    <script src="https://use.fontawesome.com/4ce3a16048.js"></script>


    <script src="https://unpkg.com/vue@3.2.47/dist/vue.global.prod.js"></script>
   

 
  </head>

   <body>

    @include('includes.menuizq')

    @include('includes.header')

    <div class="br-mainpanel">
      
      @include('aab_bann1.aab_bann1_menu')

      <div class="br-pagebody">
        <div class="br-section-wrapper">
          <h6 class="br-section-label">Advertising banners</h6>
          <p class="br-section-text">Full list of Banners</p>

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

              <div id="app">
              <h1>@{{ message }}</h1>
            </div>

             </tr>


                
                <tr>
                  <th>Delete</th>
                  <th>ID</th>
                  <th>Banner</th>
                  <th>Image</th>
                  <th>File</th>
                  <th>Clone</th>
                  <th>Publish</th>
                  <th>Edit</th>                 
                </tr>
              </thead>
              <tbody>

                @foreach ($banners as $key => $reg)

                <? if($reg->aab_bann1_enable=='1'){$bgcolor='background-color: #EEFBE7;';} else {$bgcolor=' background-color: #FFEAE7';}?>

                <tr>

                 <td style="<?=$bgcolor;?>" ng-style="bcolor{{$reg->aab_bann1_id}}">
                      <a href="{{route('aab-bann1-delete-pro',[$reg->aab_bann1_id,$reg->aab_bann1_token])}}"><button type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i> Del</button></a></td>
                  
                  <td style="<?=$bgcolor;?>" ng-style="bcolor{{$reg->aab_bann1_id}}">{{$reg->aab_bann1_id}}</td>
                 
                  <td style=" max-width: 350px;<?=$bgcolor;?>" ng-style="bcolor{{$reg->aab_bann1_id}}">{{$reg->aab_bann1_banner}}</td>                  
                  
                  <td style="<?=$bgcolor;?>" ng-style="bcolor{{$reg->aab_bann1_id}}"><?if(isset($reg->aab_bann1_image1)){?><a href="{{url('/')}}/storage/uploaddir/{{$reg->aab_bann1_image1}}" target="_blank"><img src="{{url('/')}}/storage/uploaddir/{{$reg->aab_bann1_image1}}" style="height:80px;" /></a><?}?></td>                  
                  
                  <!-- <td  style="<?=$bgcolor;?>" ng-style="bcolor{{$reg->aab_bann1_id}}"><?if(isset($reg->aab_bann1_image2)){?><a href="{{url('/')}}/storage/uploaddir/{{$reg->aab_bann1_image2}}" target="_blank"><img src="{{url('/')}}/storage/uploaddir/{{$reg->aab_bann1_image2}}" style="height:80px;" /></a><?}?></td>   -->                
                  
                  <td style="<?=$bgcolor;?>" ng-style="bcolor{{$reg->aab_bann1_id}}"><a href="{{route('aab-bann1-images-update',[$reg->aab_bann1_id,$reg->aab_bann1_token])}}"><button type="button" class="btn btn-warning btn-sm"><i class="fa fa-file-image-o" aria-hidden="true"></i> Image</button></a></td>                  
                  
                  <td style="<?=$bgcolor;?>" ng-style="bcolor{{$reg->aab_bann1_id}}"><a href="{{route('aab-bann1-clone-pro',[$reg->aab_bann1_id,$reg->aab_bann1_token])}}"><button type="button" class="btn btn-primary btn-sm" style="background-color: #4B330B; border-color: #4B330B;"><i class="fa fa-files-o" aria-hidden="true"></i> Clone</button></a></td>
                  
                  <td style="<?=$bgcolor;?>" ng-style="bcolor{{$reg->aab_bann1_id}}">

                    <?if($reg->aab_bann1_enable=='1'){?>

                        <button type="button"  class="btn btn-success btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> ON</button>

                        <button type="button"  class="btn btn-danger btn-sm"><i class="fa fa-power-off" aria-hidden="true"></i> OFF</button>

                      <?} else {?> 

                        <button type="button"  class="btn btn-danger btn-sm"><i class="fa fa-power-off" aria-hidden="true"></i> OFF</button>

                        <button type="button"  class="btn btn-success btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> ON</button>

                    <?}?>

                  </td>
                  
                  <td style="<?=$bgcolor;?>" ng-style="bcolor{{$reg->aab_bann1_id}}"><a href="{{route('aab-bann1-update',[$reg->aab_bann1_id,$reg->aab_bann1_token])}}"><button type="button" class="btn btn-primary btn-sm"><i class="fa fa-file-text" aria-hidden="true"></i> Edit</button></a></td>
                 
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

    <script type="module" src="{{url('/')}}/vuejs/vue_bbp_prod1.js"></script> 

     <!-- <script>
        const { createApp } = Vue

        createApp({
          data() {
            return {
              message: 'Hello Vue!'
            }
          }
        }).mount('#app')
      </script>  -->

  </body>
</html>
