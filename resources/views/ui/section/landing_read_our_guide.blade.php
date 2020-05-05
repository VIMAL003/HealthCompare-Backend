<div class="container_fluid bg-brandColor1 landing-read-our-guide py-5">
  <div class="container py-4">
    <div class="row row-cols-1">
      <div class="col">
        <div class="card py-lg-3 px-lg-5">
          <div class="card-body">
            <div class="main-content mb-3 mx-auto pt-3">
              <h3>{{$landingReadOurGuide['heading']}}</h3>
              <h4>{{$landingReadOurGuide['subtitle']}}</h4>
            </div>
            <div class="row grid-row">
              <div class="col-12 col-lg-5 guide-cover-image">
                <img src="{{\App\Helpers\Utils::convertAssetBaseUrl($landingReadOurGuide['coverImgUrl'])}}" alt="">
              </div>
              <div class="col-12 col-lg-7 guide-content">
                <h4>{{$landingReadOurGuide['listHeading']}}</h4>
                <ul class="list">
                @foreach ($landingReadOurGuide['list'] as $listItem)
                  <li>{{$listItem}}</li>
                @endforeach
                </ul>
                <div class="cta-button">
                  <a href="#view-all-faq" class="btn btn-brandRounded bg-brandColor1 text-white">{{$landingReadOurGuide['buttonText']}}</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>