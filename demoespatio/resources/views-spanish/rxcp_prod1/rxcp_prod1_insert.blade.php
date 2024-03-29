<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Productos.Ingresar</title>

    <link href="{{url('/')}}/panel/lib/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
		<link href="{{url('/')}}/panel/lib/highlightjs/styles/github.css" rel="stylesheet">
    <link rel="stylesheet" href="{{url('/')}}/panel/css/bracket.css">
    <script src="https://use.fontawesome.com/4ce3a16048.js"></script>

  </head>

  <body>

    @include('includes.menuizq')

    @include('includes.header')

    <div class="br-mainpanel">

        @include('rxcp_prod1.rxcp_prod1_menu')

      <div class="br-pagebody">
        <div class="br-section-wrapper">
          <h6 class="br-section-label">Agregar un Producto</h6>
          <p class="br-section-text">Ingresar un producto nuevo a la home.</p>

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

          <form method="POST" action="{{route('rxcp-prod1-insert-pro')}}" enctype="multipart/form-data"> {{ csrf_field() }}        

          <div class="form-layout form-layout-6">

            <div class="row no-gutters">
              <div class="col-5 col-sm-4">
                Categorias:
              </div>
              <div class="col-7 col-sm-8">
                <select class="form-control select2" name="rxcp_prod1_cate1_id" data-placeholder="Publicar">                  
                  @foreach ($categories as $key => $reg)
                  <option value="{{$reg->rxcp_cate1_id}}" >{{$reg->rxcp_cate1_category}}</option>  
                  @endforeach   
                </select>
              </div>
            </div>   

            <div class="row no-gutters">
              <div class="col-5 col-sm-4">
                Código:
              </div>
              <div class="col-7 col-sm-8"> <input class="form-control" type="text" name="rxcp_prod1_code" maxlength="60" placeholder="Código Producto" required></div>
            </div>   

             <div class="row no-gutters">
              <div class="col-5 col-sm-4">
                Precio €:
              </div>
              <div class="col-7 col-sm-8"> <input class="form-control" type="number" name="rxcp_prod1_price1" maxlength="10" placeholder="Precio Producto" required></div>
            </div>     

            <div class="row no-gutters">
              <div class="col-5 col-sm-4">
                Nombre Producto:
              </div>
              <div class="col-7 col-sm-8"> <input class="form-control" type="text" name="rxcp_prod1_product" maxlength="255" placeholder="Nombre Producto" required></div>
            </div>

            <div class="row no-gutters">
              <div class="col-5 col-sm-4">
                Titulo 1:
              </div>
              <div class="col-7 col-sm-8"> <input class="form-control" type="text" name="rxcp_prod1_title1" maxlength="255" placeholder="Titulo Producto" required></div>
            </div>

            <div class="row no-gutters">
              <div class="col-5 col-sm-4">
                Titulo 2:
              </div>
              <div class="col-7 col-sm-8"> <input class="form-control" type="text" name="rxcp_prod1_title2" maxlength="255" placeholder="Titulo Producto" required></div>
            </div>

            <div class="row no-gutters">
              <div class="col-5 col-sm-4">
                Titulo 3:
              </div>
              <div class="col-7 col-sm-8"> <input class="form-control" type="text" name="rxcp_prod1_title3" maxlength="255" placeholder="Titulo Producto" required></div>
            </div>            


                             

            <div class="row no-gutters">
              <div class="col-5 col-sm-4">
                Publicar:
              </div>
              <div class="col-7 col-sm-8">
                <select class="form-control select2" name="rxcp_prod1_enable" data-placeholder="Publicar">
                  <option value="0" selected>Suspender</option>                 
                  <option value="1">Publicar</option>
                </select>
              </div>
            </div>

            <div class="row no-gutters">
              <div class="col-5 col-sm-4">
                Image Producto1:
              </div>
              <div class="col-7 col-sm-8"> <input class="form-control-file" type="file" name="rxcp_prod1_photo[]" placeholder="Imagen"></div>
            </div> 

            <div class="row no-gutters">
              <div class="col-5 col-sm-4">
                Image Producto1:
              </div>
              <div class="col-7 col-sm-8"> <input class="form-control-file" type="file" name="rxcp_prod1_photo[]" placeholder="Imagen"></div>
            </div>  
            
            <div class="row no-gutters">
              <div class="col-5 col-sm-4">
               <button type="button" class="btn btn-primary" onclick="submit();"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</button>
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
