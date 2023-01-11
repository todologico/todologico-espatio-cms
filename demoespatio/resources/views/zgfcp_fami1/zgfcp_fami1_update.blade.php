<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Family.Update</title>

    <link href="{{url('/')}}/panel/lib/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
		<link href="{{url('/')}}/panel/lib/highlightjs/styles/github.css" rel="stylesheet">
    <link rel="stylesheet" href="{{url('/')}}/panel/css/bracket.css">
    <script src="https://use.fontawesome.com/4ce3a16048.js"></script>

  </head>

  <body>

    @include('includes.menuizq')

    @include('includes.header')

    <div class="br-mainpanel">

     @include('zgfcp_fami1.zgfcp_fami1_menu')

      <div class="br-pagebody">
        <div class="br-section-wrapper">
          <h6 class="br-section-label">EDIT A FAMILY</h6>
          <p class="br-section-text">Change the characteristics of a family</p>

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

          <form method="POST" action="{{route('zgfcp-fami1.update.pro')}}" enctype="multipart/form-data"> {{ csrf_field() }} 

          <input type="hidden" name="zgfcp_fami1_id" value="{{$families[0]->zgfcp_fami1_id}}">       
          <input type="hidden" name="zgfcp_fami1_token" value="{{$families[0]->zgfcp_fami1_token}}">       

          <div class="form-layout form-layout-6">

            <div class="row no-gutters">
              <div class="col-5 col-sm-4">
                Famyly Name:
              </div>
              <div class="col-7 col-sm-8"> <input class="form-control" type="text" name="zgfcp_fami1_family" value="{{$families[0]->zgfcp_fami1_family}}" maxlength="255" placeholder="Famyly Name" required></div>
            </div>

            <div class="row no-gutters">
              <div class="col-5 col-sm-4">
                Famyly Title 1:
              </div>
              <div class="col-7 col-sm-8"> <input class="form-control" type="text" name="zgfcp_fami1_title1" value="{{$families[0]->zgfcp_fami1_title1}}" maxlength="255" placeholder="Famyly Title" required></div>
            </div>

            <div class="row no-gutters">
              <div class="col-5 col-sm-4">
                Famyly Title 2:
              </div>
              <div class="col-7 col-sm-8"> <input class="form-control" type="text" name="zgfcp_fami1_title2" value="{{$families[0]->zgfcp_fami1_title2}}" maxlength="255" placeholder="Famyly Title" required></div>
            </div>
                          

            <div class="row no-gutters">
              <div class="col-5 col-sm-4">
                Publish:
              </div>
              <div class="col-7 col-sm-8">
                <select class="form-control select2" name="zgfcp_fami1_enable" data-placeholder="Publicar">
                  <option value="0" <?if($families[0]->zgfcp_fami1_enable=='0'){echo "selected";}?>>Suspended</option>                 
                  <option value="1" <?if($families[0]->zgfcp_fami1_enable=='1'){echo "selected";}?>>Published</option>
                </select>
              </div>
            </div>

            <div class="row no-gutters">
              <div class="col-5 col-sm-4">
                Image:
              </div>
              <div class="col-7 col-sm-8"> <input class="form-control-file" type="file" name="zgfcp_fami1_photo[]" placeholder="Imagen"></div>
            </div> 

           <!--  <div class="row no-gutters">
              <div class="col-5 col-sm-4">
                Image Rubro2:
              </div>
              <div class="col-7 col-sm-8"> <input class="form-control-file" type="file" name="zgfcp_fami1_photo[]" placeholder="Imagen"></div>
            </div>  --> 
            
            <div class="row no-gutters">
              <div class="col-5 col-sm-4">
               <button type="button" class="btn btn-primary" onclick="submit();"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>
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
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

  </body>
</html>
