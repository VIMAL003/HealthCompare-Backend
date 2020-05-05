<div class="container_fluid landing-hero pt-3">
  <div class="container">
    <div class="row">

      @hasSection('main-content')
        @yield('main-content')
      @else
        <div class="col-12 col-lg-6 main-content d-lg-none order-1 order-lg-1">
          <h4>{!! $landingHero['slogan']!!}</h4>
          <h2>{!! $landingHero['heading']!!}</h2>
        </div>
      @endif


      @hasSection('landing-nav-blocks')
        @yield('landing-nav-blocks')
      @else
        <div class="col-12 col-lg-12 landing-nav-blocks order-2 order-lg-3">
          @include('ui.component.landing_nav_blocks', ['cards'=>$landingHero['cards']])
        </div>
      @endif

      @hasSection('checklist')
        @yield('checklist')
      @else
      <div class="col-12 col-lg-6 checklist d-lg-none order-3 order-lg-2">
        @foreach ($landingHero['checklist'] as $checklistItem)
          <img src="{{ \App\Helpers\Utils::convertAssetBaseUrl('../images/tick.svg') }}" alt="" style="float:left;">
          <p>{{$checklistItem}}</p>
        @endforeach
      </div>
      @endif

      @hasSection('bottom-text-cta')
        @yield('bottom-text-cta')
      @else
        <div class="col-12 col-lg-4 bottom-text-cta order-4 order-lg-last py-3">
          <a href="#blank">Already got a health insurance policy? Use our hospital search to select the right hospital.</a>
        </div>
      @endif

      @hasSection('desktop-main-content')
        @yield('desktop-main-content')
      @else
      <div class="col-6 desktop-main-content d-none d-lg-block order-lg-1">
        <div class="main-content pt-5">
          <h2>{!! $landingHero['heading']!!}</h2>
        </div>
        <div class="checklist py-3">
          @foreach ($landingHero['checklist'] as $checklistItem)
            <img src="{{ \App\Helpers\Utils::convertAssetBaseUrl('../images/tick.svg') }}" alt="" style="float:left;">
            <p>{{$checklistItem}}</p>
          @endforeach
        </div>
      </div>
      @endif

      @hasSection('desktop-secondary-content')
        @yield('desktop-secondary-content')
      @else
      <div class="col-12 col-lg-6 desktop-secondary-content d-none d-lg-block order-lg-2">
        <img src="{{ \App\Helpers\Utils::convertAssetBaseUrl('../images/your-health-your-choice.svg') }}" alt="" class="white-circular-logo">
      </div>
      @endif
    </div>
  </div>
</div>