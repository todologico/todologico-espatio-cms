<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Banners.Imagees</title>

    <link href="{{url('/')}}/panel/lib/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
		<link href="{{url('/')}}/panel/lib/highlightjs/styles/github.css" rel="stylesheet">
    <link rel="stylesheet" href="{{url('/')}}/panel/css/bracket.css">
    <script src="https://use.fontawesome.com/4ce3a16048.js"></script>

  </head>

  <body>

    @include('includes.menuizq')

    @include('includes.header')

    <div class="br-mainpanel">

       @include('aab_bann1.aab_bann1_menu')

      <div class="br-pagebody">
        <div class="br-section-wrapper">
          <h6 class="br-section-label">Image modifications</h6>
          <p class="br-section-text">Enter new images. Check the size before uploading your image.</p>

          @if ($errors->any())
              <div class="alert alert-danger">
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
          @endif


          @if (session('mal'))
              <div class="alert alert-danger">
                  {{ session('mal') }}
              </div>
          @endif   

          <form method="POST" action="{{route('aab-bann1-images-update-pro')}}" enctype="multipart/form-data"> {{ csrf_field() }} 

          <input type="hidden" name="aab_bann1_id" value="{{$banners[0]->aab_bann1_id}}">       
          <input type="hidden" name="aab_bann1_token" value="{{$banners[0]->aab_bann1_token}}">       

          <div class="form-layout form-layout-6">

            <div class="row no-gutters">
              <div class="col-5 col-sm-4">
                Options:
              </div>
              <div class="col-7 col-sm-8"> {{$banners[0]->aab_bann1_banner}}</div>
            </div>

            <div class="row no-gutters">
              <div class="col-5 col-sm-4">
               <?if(isset($banners[0]->aab_bann1_image1)){?><a href="{{route('aab-bann1-images-delete-pro',[$banners[0]->aab_bann1_id,$banners[0]->aab_bann1_token,1])}}"><button type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i> Del</button></a><?}?>
              </div>
              
              <div class="col-3 col-sm-4"> <?if(isset($banners[0]->aab_bann1_image1)){?><img src="{{url('/')}}/storage/uploaddir/{{$banners[0]->aab_bann1_image1}}" style="height:80px;" /><?}?>
              </div>

              <div class="col-4 col-sm-4"> <input class="form-control-file" type="file" name="aab_bann1_photo[]" placeholder="Imagen">
              </div>

            </div> 


          <!--   <div class="row no-gutters">
              <div class="col-5 col-sm-4">
                 <?if(isset($banners[0]->aab_bann1_image2)){?><a href="{{route('aab-bann1-images-delete-pro',[$banners[0]->aab_bann1_id,$banners[0]->aab_bann1_token,2])}}"><button type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i> Elim</button></a><?}?>
              </div>
              
              <div class="col-3 col-sm-4"> <?if(isset($banners[0]->aab_bann1_image2)){?><img src="{{url('/')}}/storage/uploaddir/{{$banners[0]->aab_bann1_image2}}" style="height:80px;" /><?}?>
              </div>

              <div class="col-4 col-sm-4"> <input class="form-control-file" type="file" name="aab_bann1_photo[]" placeholder="Imagen">
              </div>

            </div> -->

            
            <div class="row no-gutters">
              <div class="col-5 col-sm-4">
               <button type="button" class="btn btn-primary" onclick="submit();"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save Image</button>
              </div>
              <div class="col-7 col-sm-8">           
              </div>
            </div>


          </div><!-- form-layout -->        

        </form>

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


    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>

  </body>
</html>
