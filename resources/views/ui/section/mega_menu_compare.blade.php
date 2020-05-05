<a id="megamenu" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Compare</a>
<div aria-labelledby="megamenu" class="dropdown-menu mega-menu-compare border-0 p-0 m-0">
  <div class="container_fluid bg-white">
    <div class="container px-0 px-lg-3">
      <div class="row py-0 py-lg-5">
        <div class="col-12 col-lg-3 d-none d-lg-block context-image">
          <img src="{{ asset( \App\Helpers\Utils::convertAssetBaseUrl($megaMenuCompare['imgUrl']) ) }}" alt="" class="img-fluid">
        </div>
        <div class="col-12 col-lg-3 d-none d-lg-block context-content">
          <h4>{{$megaMenuCompare['slogan']}}</h4>
          <h3>{{$megaMenuCompare['heading']}}</h3>
          <a href="{{$megaMenuCompare['ctaPermalink']}}">{{$megaMenuCompare['ctaText']}}</a>
        </div>
        <div class="col-12 col-lg-3 list-1">
          <ul class="list">
            @foreach ($megaMenuCompare['lists'][0] as $listItem)
              <li>
                <img src="{{ asset( \App\Helpers\Utils::convertAssetBaseUrl($listItem['iconUrl']) ) }}" alt="">
                <a href="{{$listItem['permalink']}}">{{$listItem['heading']}}</a>
              </li>
            @endforeach
          </ul>
        </div>
        <div class="col-12 col-lg-3 list-2">
          <ul class="list">
            @foreach ($megaMenuCompare['lists'][1] as $listItem)
            <li>
              <img src="{{ \App\Helpers\Utils::convertAssetBaseUrl($listItem['iconUrl'] ) }}" alt="">
              <a href="{{$listItem['permalink']}}">{{$listItem['heading']}}</a>
            </li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>