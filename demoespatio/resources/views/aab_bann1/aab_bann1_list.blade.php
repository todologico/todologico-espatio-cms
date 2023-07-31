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
    
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
   
    <style>
    [v-cloak] { display: none; }
    </style>    
 
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

          <div class="bd bd-gray-300 rounded table-responsive" id="app" v-cloak>
            <table class="table mg-b-0  table-colored table-dark">
              <thead>   

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

                 <td style="<?=$bgcolor;?>">
                      <a href="{{route('aab-bann1-delete-pro',[$reg->aab_bann1_id,$reg->aab_bann1_token])}}"><button type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i> Del</button></a></td>
                  
                  <td style="<?=$bgcolor;?>">{{$reg->aab_bann1_id}}</td>
                 
                  <td style=" max-width: 350px;<?=$bgcolor;?>">{{$reg->aab_bann1_banner}}</td>                  
                  
                  <td style="<?=$bgcolor;?>"><?if(isset($reg->aab_bann1_image1)){?><a href="{{url('/')}}/storage/uploaddir/{{$reg->aab_bann1_image1}}" target="_blank"><img src="{{url('/')}}/storage/uploaddir/{{$reg->aab_bann1_image1}}" style="height:80px;" /></a><?}?></td> 
                  
                  <td style="<?=$bgcolor;?>"><a href="{{route('aab-bann1-images-update',[$reg->aab_bann1_id,$reg->aab_bann1_token])}}"><button type="button" class="btn btn-warning btn-sm"><i class="fa fa-file-image-o" aria-hidden="true"></i> Image</button></a></td>                  
                  
                  <td style="<?=$bgcolor;?>"><a href="{{route('aab-bann1-clone-pro',[$reg->aab_bann1_id,$reg->aab_bann1_token])}}"><button type="button" class="btn btn-primary btn-sm" style="background-color: #4B330B; border-color: #4B330B;"><i class="fa fa-files-o" aria-hidden="true"></i> Clone</button></a></td>
                  
                  <td style="<?=$bgcolor;?>" v-bind:style="">

                    <?if($reg->aab_bann1_enable=='1'){?>dfdfd


                      <button type="button" v-cloak :['butt1on'+{{$reg->aab_bann1_id}}]=true  v-if="{{$reg->aab_bann1_id}}" @click="ShowHideBannersAR({{$reg->aab_bann1_id}},'{{$reg->aab_bann1_token}}','1')" class="btn btn-success btn-sm"><i class="fa fa-power-off" aria-hidden="true"></i> ON222</button>
                      
                      <button type="button" v-cloak  :['butt2on'+{{$reg->aab_bann1_id}}]=false  v-else="{{$reg->aab_bann1_id}}"  @click="ShowHideBannersAR({{$reg->aab_bann1_id}},'{{$reg->aab_bann1_token}}','2')"  class="btn btn-danger btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> OFF111</button>         
                      
                     


                      <?} else {?> 

                        <button type="button" v-cloak class="btn btn-danger btn-sm"><i class="fa fa-power-off" aria-hidden="true"></i> OFF</button>

                        <button type="button" v-cloak class="btn btn-success btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> ON</button>

                    <?}?>

                  </td>
                  
                  <td style="<?=$bgcolor;?>"><a href="{{route('aab-bann1-update',[$reg->aab_bann1_id,$reg->aab_bann1_token])}}"><button type="button" class="btn btn-primary btn-sm"><i class="fa fa-file-text" aria-hidden="true"></i> Edit</button></a></td>
                 
                </tr>

                  @if($loop->last)

                  <tr><td colspan="10">Total: {{$loop->count}}</td></tr>

                  @endif

                @endforeach               
                
              </tbody>
            </table>
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

    <script type="module" src="{{url('/')}}/vuejs/vue_bbp_prod1.js"></script> 

  </body>
</html>
