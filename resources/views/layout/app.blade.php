<!DOCTYPE html>
<html lang='en'>
    <head>
        @if(env('APP_ENV') == 'dev')
            <!-- Google Tag Manager -->
            <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
                    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
                    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
                })(window,document,'script','dataLayer','GTM-MJZJN5W');</script>
            <!-- End Google Tag Manager -->
        @endif

        <title>Hospital Compare - @yield('title')</title>
        <meta charset='utf-8'>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name='description' content='@yield('description')'>
        <meta name="viewport" content="@yield('mobile')">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- Block indexing bots from staging site -->
        @if(env('APP_ENV') == 'dev')
            <meta name="robots" content="noindex,nofollow">
        @endif

        <link href="{{ mix('css/app.css') }}" rel="stylesheet">
        <link href="{{ mix('css/common.css') }}" rel="stylesheet">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/icons/favicon/apple-touch-icon.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/icons/favicon/favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/icons/favicon/favicon-16x16.png') }}">
        <link rel="manifest" href="{{ asset('images/icons/favicon/site.webmanifest') }}">

        <meta property="og:site_name" content="Hospital Compare" />
        <meta property="og:title" content="@yield('title')" />
        <meta property="og:description" content="@yield('description')" />
        <meta property="og:type" content="website" />
        <meta property="og:url" content="{{ url()->full() }}" />
        @hasSection('featuredImage')
        <meta property="og:image" content="@yield('featuredImage')" />
        @else
        <meta property="og:image" content="{{ asset('/images/placeholder.jpg') }}" />
        @endif
        <script type="text/javascript" src="{{ asset('fonts/MyFontsWebfontsKit.js') }}"></script>
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
        @if(env('APP_ENV') === 'dev')
            <!-- Hotjar Tracking Code for http://hcstaging.co.uk/ -->
            <script>
                (function(h,o,t,j,a,r){
                    h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
                    h._hjSettings={hjid:1675978,hjsv:6};
                    a=o.getElementsByTagName('head')[0];
                    r=o.createElement('script');r.async=1;
                    r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
                    a.appendChild(r);
                })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
            </script>
        @elseif(env('APP_ENV') === 'live')
            <!-- Hotjar Tracking Code for https://www.hospitalcompare.co.uk/ -->
                <script>
                    (function(h,o,t,j,a,r){
                        h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
                        h._hjSettings={hjid:1676001,hjsv:6};
                        a=o.getElementsByTagName('head')[0];
                        r=o.createElement('script');r.async=1;
                        r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
                        a.appendChild(r);
                    })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
                </script>
        @endif

        <!-- Facebook Pixel Code -->
        <script>
            !function(f,b,e,v,n,t,s)
            {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
                n.callMethod.apply(n,arguments):n.queue.push(arguments)};
                if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
                n.queue=[];t=b.createElement(e);t.async=!0;
                t.src=v;s=b.getElementsByTagName(e)[0];
                s.parentNode.insertBefore(t,s)}(window, document,'script',
                'https://connect.facebook.net/en_US/fbevents.js');
            fbq('init', '210446956660642');
            fbq('track', 'PageView');
        </script>
        <noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=210446956660642&ev=PageView&noscript=1"/></noscript>
        <!-- End Facebook Pixel Code -->

        @yield('scripts')

    </head>
    <body class="@yield('body-class')">
        @if(env('APP_ENV') == 'dev')
            <!-- Google Tag Manager (noscript) -->
            <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MJZJN5W"
                              height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
            <!-- End Google Tag Manager (noscript) -->
        @endif
        @include('layout.header')
        @include('components.basic.specialAlert')
        @include('components.basic.alert')

        <main class="" id="app">
            @yield('content')
        </main>

        @include('layout.footer', ['page_footer' => ''])
        {{-- Stickybits is the script for handling position sticky cross browser --}}
        <script type="text/javascript" src="{{ asset('js/stickybits.js') }}"></script>
        <script src="{{ mix('js/app.js') }}"></script>
        <script src="{{ mix('js/common.js') }}"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.googleApiKey') }}"
                async defer></script>
        <script>
            window.addEventListener("load", function(){
                // https://www.osano.com/cookieconsent/download/
                window.cookieconsent.initialise({
                    "palette": {
                        "popup": {
                            "background": "#1d1d1d",
                            "text": "#fff"
                        },
                        "button": {
                            "background": "#037098",
                            "text": "#ffffff",
                        }
                    },
                    "theme": "hc-cookie",
                    "position": "top",
                    "static": true,
                    "content": {
                        "message": "We use cookies to provide a better service. By closing this window or continuing to use our website you agree with our use of cookies. <span class=\"para-block d-inline d-xl-block\">Find out how to manage cookies and view our policy </span>",
                        "dismiss": "Close",
                        "link": "here.",
                        "href": "/cookie-policy"
                    }
                })});
        </script>
        <style>
            .cc-window.cc-floating {
                max-width: 4000px !important;
            }
        </style>
        <div id="modal-container">
{{--            Global modals--}}
            @include('components.modals.modaltour')
            @include('mobile.components.modals.modalmobilesearchform')
            @include('components.modals.modalexitsurvey')
{{--            End global modals--}}
            @yield('modals')
        </div>
    <div class="hc-backdrop"></div>
    </body>

</html>
