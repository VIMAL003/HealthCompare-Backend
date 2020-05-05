<!-- _partials/header.blade.php -->

<header>
  <nav class="navbar navbar-expand-lg navbar-light bg-white py-3 shadow-sm">
    <div class="container">
      <div class="d-flex flex-grow-1 mobile-header-nav">
        <div class="w-100 text-right align-self-center d-lg-none">
            @include('ui.component.menu_icon')
          {{-- {{#embed "ui/component/menu-icon"}}
          {{/embed}} --}}
        </div>
        <a class="navbar-brand mx-0 py-0" href="{{url('/')}}">
          <img src="{{ URL::asset('/images/rcd/health-compare-logo.svg') }}" width="200" alt="">
        </a>
        <div class="w-100 text-right  align-self-center d-lg-none">
          <button class="mobile-search" type="button">
            <img src="{{ URL::asset('/images/rcd/search-icon.svg') }}" alt="">
          </button>
        </div>
      </div>
      <div id="navbarContent" class="collapse navbar-collapse closed-sidebar">
        <ul class="navbar-nav ml-auto h-100">
          <!-- Megamenu-->
          <li class="nav-item {{ Request::is('') ? 'active' : '' }}">
            <a href="/" class="nav-link d-lg-none">Home</a>
          </li>
          <li class="nav-item dropdown megamenu">
              @include('ui.section.mega_menu_compare')
          </li>
          <li class="nav-item {{ Request::is('your-rights') ? 'active' : '' }}">
            <a href="{{url('/your-rights')}}" class="nav-link">Your Rights</a>
          </li>
          <li class="nav-item {{ Request::is('news') ? 'active' : '' }}">
            <a href="{{url('/blog')}}" class="nav-link">News</a>
          </li>
          <li class="nav-item dropdown megamenu">
              @include('ui.section.mega_menu_help')
          </li>
        </ul>
      </div>
    </div>
  </nav>
</header>








{{-- <div id="top" class="header-wrapper">
    <header class="header" >
        <div class="container d-flex align-items-center justify-content-center justify-content-lg-between">
            <div id="menu_toggle" class="d-lg-none mr-auto"><img width="20px" height="20px"
                                                                 src="{{URL::asset('/images/icons/icon-menu.svg')}}"
                                                                 alt="Menu icon"></div>
            @include('components.logo', [
                'titleParent'   => 'header-logo-parent',
                'logoImg'       => 'header-logo-image',
                'logoTitle'     => 'headerLogoTitle'])
            <nav id="main_nav" class="main-nav" role="navigation">
                <ul class="main-menu">
                    <li>
                        <a href="/">Home</a>
                        @svg('chevron-right-grey', 'd-lg-none')
                    </li>
                    <li>
                        <a {{ Request::is( 'about-us') ? 'class=active' : '' }} href="/about-us">About Us
                            @svg('chevron-right-grey', 'd-lg-none')
                        </a>
                    </li>
                    <li>
                        <a {{ Request::is( 'your-rights') ? 'class=active' : '' }} href="/your-rights">Your Rights
                            @svg('chevron-right-grey', 'd-lg-none')
                        </a>
                    </li>
                    <li>
                        <a {{ Request::is( 'how-to-use') ? 'class=active' : '' }} href="/how-to-use">How To Use
                            @svg('chevron-right-grey', 'd-lg-none')
                        </a>
                    </li>
                    <li>
                        <a {{ Request::is( 'faqs') ? 'class=active' : '' }} href="/faqs">FAQs
                            @svg('chevron-right-grey', 'd-lg-none')
                        </a>
                    </li>
                    <li>
                        <a {{ Request::is( 'blogs') ? 'class=active' : '' }} href="/blogs">Blog
                            @svg('chevron-right-grey', 'd-lg-none')
                        </a>
                    </li>
                    <li class="d-none d-lg-inline-block">
                        <a class="cursor-pointer" data-toggle="modal" data-target="#hc_modal_tour">
                            Help
                        </a>
                    </li>
{{--                    @if(env('APP_ENV') === 'local')--}}
{{--                        <li>--}}
{{--                            <a {{ Request::is( 'results-page') ? 'class=active' : '' }} href="/results-page">Results--}}
{{--                                page--}}
{{--                                @svg('chevron-right-grey', 'd-lg-none')--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <a {{ Request::is( 'test-page') ? 'class=active' : '' }} href="/test-page">Test page--}}
{{--                                @svg('chevron-right-grey', 'd-lg-none')--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    @endif--}}
                {{-- </ul>
            </nav>
            @include('components.basic.modalbutton', [
                'id'            => 'search_toggle',
                'classTitle'    => 'd-lg-none ml-auto',
                'modalTarget'   => '#hc_modal_mobile_search',
                'svg'           => 'icon-search',
                'buttonText'    => ''
            ])

        </div>
    </header>
</div> --}}



