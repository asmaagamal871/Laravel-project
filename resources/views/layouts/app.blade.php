<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>
  @vite('resources/sass/app.scss')


  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">

  <!-- AdminLTE CSS -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
  <!-- Include AdminLTE icons CSS -->
  <link rel="stylesheet" href="{{ asset('dist/css/all.min.css') }}">
  <!-- select2 tags -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-5-theme/1.3.0/select2-bootstrap-5-theme.min.css" integrity="sha512-z/90a5SWiu4MWVelb5+ny7sAayYUfMmdXKEAbpj27PfdkamNdyI3hcjxPxkOPbrXoKIm7r9V2mElt5f1OtVhqA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- Scripts -->
</head>

<body>

  <div id="app">

    <div class="wrapper">

      <!-- Navbar -->
      @include('partials.navbar')

      <!-- /.navbar -->

      <!-- Main Sidebar Container -->
      @include('partials.sidebar')


      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="m-0">Starter Page</h1>
              </div><!-- /.col -->
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">Starter Page</li>
                </ol>
              </div><!-- /.col -->
            </div><!-- /.row -->
          </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
          @yield('content')

        </div>
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
        <div class="p-3">
          <h5>Title</h5>
          <p>Sidebar content</p>
        </div>
      </aside>
      <!-- /.control-sidebar -->

      <!-- Main Footer -->

    </div>
    @include('partials.footer')
    {{-- -------------------------------------------------------------------------------------------------------------------------------- --}}

    {{-- @include('partials.navbar')
        @include('partials.sidebar') --}}
    <main class="py-4">
      {{-- @yield('content') --}}
    </main>
  </div>
  @vite('resources/js/app.js')
  <!-- @stack('scripts')-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

  <script>
    $(document).ready(function() {
      $('.select2').select2({
        tags: true,
        theme: "bootstrap-5"
      })
      $(".select2").on("select2:select", function(evt) {
        var element = evt.params.data.element;
        const inputContainer = $('#input-container');
        // const edit = $('#editQuantity')
        var $element = $(element);
        $element.detach();
        $(this).append($element);
        $(this).trigger("change");

        inputContainer.empty();


        const numSelected = ($(this).find('option:selected')).length;
        console.log($element)
        const numInputs = 0;
        if (numInputs > numSelected) {
          inputContainer.find('input:gt(' + (numSelected - 1) + ')').remove();
        }
        for (let i = numInputs + 1; i <= numSelected; i++) {
          const input = $('<input id="quantity" type="text" name="quantity[]" class="form-control" placeholder="please enter quantity of medicine ">');
          inputContainer.append(input);
        }

        edit.empty();

        // edit
        const editSelected = $(this).find('option:selected').length;
        const editInputs = 0;
        if (editInputs > editSelected) {
          inputContainer.find('input:gt(' + (editSelected - 1) + ')').remove();
        }
        for (let i = editInputs + 1; i <= editSelected; i++) {
          const input = $('<input id="quantityedit" type="text" name="quantity[]" class="form-control" placeholder="Multiple Input in Input Group">');
          edit.append(input);
        }
      });
    });
  </script>
</body>

</html>