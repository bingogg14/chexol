<!DOCTYPE html>
<html lang="en">
<head>
  @include('landings.military.includes.head')
  @yield('scripts')
</head>

<body>
<div class="wrapper">
  <div class="container-fluid">
    <div class="row">
      <div class="main">
        <!-- Main -->
        <main role="main">
          <!-- Section -->
          <section id="block__1" class="section__block section__block__1 section__block_bg__img section__block__home">
              @include('landings.military.includes.header')

              @yield('article')
          </section><!-- #End Section -->
        </main> <!-- #main semantic -->
      </div><!-- #main -->
    </div><!-- #row -->
  </div><!-- #container-fluid class -->
</div><!-- #wrapper class -->
@include('landings.military.includes.footer')
</body>
</html>
