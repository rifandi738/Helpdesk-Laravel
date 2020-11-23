<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Sistem Helpdesk</title>

  @include('layouts.includes.style')
  
</head>
<body>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      @include('layouts.includes.navbar')
      
      @include('layouts.includes.sidebar')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>@yield('title')</h1>
          </div>
          <div class="section-body">
            @yield('content')
          </div>
        </section>
      </div>
      @include('layouts.includes.footer')
    </div>
  </div>

  @include('layouts.includes.script')

  @include('sweetalert::alert')
 

  @yield('script')
</body>
</html>