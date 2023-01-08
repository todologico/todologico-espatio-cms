<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Products.Modify</title>

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
          <h6 class="br-section-label">Modify a product</h6>
          <p class="br-section-text">Change the characteristics of a product.</p>

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

          <form method="POST" action="{{route('rxcp-prod1-update-pro')}}" enctype="multipart/form-data"> {{ csrf_field() }} 

          <input type="hidden" name="rxcp_prod1_id" value="{{$products[0]->rxcp_prod1_id}}">       
          <input type="hidden" name="rxcp_prod1_token" value="{{$products[0]->rxcp_prod1_token}}">       

          <div class="form-layout form-layout-6">

             <div class="row no-gutters">
              <div class="col-5 col-sm-4">
                Categories:
              </div>
              <div class="col-7 col-sm-8">
                <select class="form-control select2" name="rxcp_prod1_cate1_id" data-placeholder="Publicar">                  
                  @foreach ($categories as $key => $reg)
                  <option value="{{$reg->rxcp_cate1_id}}" <?if($reg->rxcp_cate1_id==$products[0]->rxcp_prod1_cate1_id){echo "selected";}?> >{{$reg->rxcp_cate1_category}}</option>  
                  @endforeach   
                </select>
              </div>
            </div>

            <div class="row no-gutters">
              <div class="col-5 col-sm-4">
                Code:
              </div>
              <div class="col-7 col-sm-8"> <input class="form-control" type="text" name="rxcp_prod1_code" value="{{$products[0]->rxcp_prod1_code}}" maxlength="60" placeholder="Code" required></div>
            </div> 

             <div class="row no-gutters">
              <div class="col-5 col-sm-4">
                Price € - $ :
              </div>
              <div class="col-7 col-sm-8"> <input class="form-control" type="number" name="rxcp_prod1_price1" value="{{$products[0]->rxcp_prod1_price1}}" maxlength="10" placeholder="Price" required></div>
            </div>   

            <div class="row no-gutters">
              <div class="col-5 col-sm-4">
                Product Name:
              </div>
              <div class="col-7 col-sm-8"> <input class="form-control" type="text" name="rxcp_prod1_product" value="{{$products[0]->rxcp_prod1_product}}" maxlength="255" placeholder=" Product Name" required></div>
            </div>

            <div class="row no-gutters">
              <div class="col-5 col-sm-4">
              Product Title 1:
              </div>
              <div class="col-7 col-sm-8"> <input class="form-control" type="text" name="rxcp_prod1_title1" value="{{$products[0]->rxcp_prod1_title1}}" maxlength="255" placeholder="Title Product" required></div>
            </div>

            <div class="row no-gutters">
              <div class="col-5 col-sm-4">
              Product Title 2:
              </div>
              <div class="col-7 col-sm-8"> <input class="form-control" type="text" name="rxcp_prod1_title2" value="{{$products[0]->rxcp_prod1_title2}}" maxlength="255" placeholder="Title Product" required></div>
            </div>

            <div class="row no-gutters">
              <div class="col-5 col-sm-4">
              Product Title 3:
              </div>
              <div class="col-7 col-sm-8"> <input class="form-control" type="text" name="rxcp_prod1_title3" value="{{$products[0]->rxcp_prod1_title3}}" maxlength="255" placeholder="Title Product" required></div>
            </div>                               

            <div class="row no-gutters">
              <div class="col-5 col-sm-4">
                Publish:
              </div>
              <div class="col-7 col-sm-8">
                <select class="form-control select2" name="rxcp_prod1_enable" data-placeholder="Publicar">
                  <option value="0" <?if($products[0]->rxcp_prod1_enable=='0'){echo "selected";}?>>Suspended</option>                 
                  <option value="1" <?if($products[0]->rxcp_prod1_enable=='1'){echo "selected";}?>>Published</option>
                </select>
              </div>
            </div>

            <div class="row no-gutters">
              <div class="col-5 col-sm-4">
              Product Image 1:
              </div>
              <div class="col-7 col-sm-8"> <input class="form-control-file" type="file" name="rxcp_prod1_photo[]" placeholder="Imagen"></div>
            </div> 

            <div class="row no-gutters">
              <div class="col-5 col-sm-4">
              Product Image 2:
              </div>
              <div class="col-7 col-sm-8"> <input class="form-control-file" type="file" name="rxcp_prod1_photo[]" placeholder="Imagen"></div>
            </div>  


        <!--       <div class="row no-gutters">
              <div class="col-5 col-sm-4">
                Image Producto1:
              </div>
              <div class="col-7 col-sm-8">
                  <div class="custom-file">
                    <input type="file" id="file" class="custom-file-input" name="rxcp_prod1_photo[]">
                    <label class="custom-file-label custom-file-label-primary" for="customFile2">Choose file</label>
                  </div>
              </div>
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
