<a id="megamenu" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Help &amp; Guides</a>
<div aria-labelledby="megamenu" class="dropdown-menu mega-menu-help border-0 p-0 m-0">
  <div class="container_fluid bg-white">
    <div class="container px-0 px-lg-3">
      <div class="row py-0 py-lg-5 ">
        @foreach ($megaMenuHelp['sections'] as $section)
          <div class="col-12 col-lg-3">
            <img class="" src="{{ \App\Helpers\Utils::convertAssetBaseUrl($section['iconUrl'])}}" alt="">
            <a href="{{$section['permalink']}}">{{$section['heading']}}</a>
            <p>{{$section['caption']}}</p>
          </div>
        @endforeach
      </div>
    </div>
  </div>
</div>