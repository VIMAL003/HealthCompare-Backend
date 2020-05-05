<div class="container_fluid home-hero pt-3">
  <div class="container">
    <div class="row">

      @hasSection('main-content')
        @yield('main-content')
      @else
        <div class="col-12 col-lg-6 main-content d-lg-none order-1 order-lg-1">
          <h4>{!!  $homeHero['slogan'] !!}</h4>
          {{-- <img src="../images/your-health-your-choice-footer-blue.svg" width="200" alt=""> --}}
          <h2>{!! $homeHero['heading'] !!}</h2>
          <p>{{$homeHero['subtitle']}}</p>
        </div>
      @endif


      @hasSection('home-search')
        @yield('home-search')
      @else
        <div class="col-12 col-lg-12 home-search order-2 order-lg-3">
          {{-- @include('ui.component.search_form') --}}
        </div>
      @endif

      @hasSection('did-you-know')
        @yield('did-you-know')
      @else
      <div class="col-12 col-lg-6 did-you-know d-lg-none order-3 order-lg-2">
        <h3 class="mt-2">Did you know:</h3>
        @foreach( $homeHero['didYouKnowList'] as $item)
          <img src="{{ \App\Helpers\Utils::convertAssetBaseUrl('../images/tick.svg') }}" alt="" style="float:left;">
          <p>{{$item}}</p>
        @endforeach
      </div>
      @endif

      @hasSection('desktop-main-content')
        @yield('desktop-main-content')
      @else
      <div class="col-6 desktop-main-content d-none d-lg-block order-lg-1">
        <div class="main-content pt-5">
          {{-- <h4>{{{$homeHero['slogan']}}}</h4> --}}
          <h2>{!! $homeHero['heading'] !!}</h2>
          <p>{{$homeHero['subtitle']}}</p>
        </div>
        <div class="did-you-know py-3">
          <h3>Did you know:</h3>
          @foreach( $homeHero['didYouKnowList'] as $item)
          <img src="{{ \App\Helpers\Utils::convertAssetBaseUrl('../images/tick.svg') }}" alt="" style="float:left;">
          <p>{{$item}}</p>
        @endforeach
        </div>
      </div>
      @endif

      @hasSection('desktop-secondary-content')
        @yield('desktop-secondary-content')
      @else
      <div class="col-12 col-lg-6 desktop-secondary-content order-4 d-none d-lg-block order-lg-2">
        <img src="{{ \App\Helpers\Utils::convertAssetBaseUrl('../images/your-health-your-choice.svg') }}" alt="" class="white-circular-logo">
        <img class="img-fluid" src="{{ \App\Helpers\Utils::convertAssetBaseUrl('../images/runners.png') }}" alt="">
      </div>
      @endif
    </div>
  </div>
</div>