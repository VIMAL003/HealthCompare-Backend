<div class="container_fluid landing-compare-online-cards py-5 mt-3">
  <div class="container">
    <div class="main-content py-3">
      <h3 class="mb-5">{{$landingCompareOnlineCards['heading']}}</h3>
    </div>
    <div class="row justify-content-lg-center card-row">
      @foreach ($landingCompareOnlineCards['cards'] as $card)
      <div class="col-12 col-lg-5 mb-4">
        <div class="card h-100">
          <img src="{{\App\Helpers\Utils::convertAssetBaseUrl($card['imgUrl'])}}" class="card-img-top mx-auto" alt="">
          <div class="card-body">
            <h4 class="card-title text-brandColor1 mb-4">{{$card['label']}}</h4>
            <h4>{{$card['heading']}}</h4>
            @foreach ($card['textContent'] as $textContent)
            <p class="mb-4">{{$textContent}}</p>
            @endforeach
            <a href="#" class="btn btn-brandRounded bg-brandColor1 text-white">{{$card['buttonText']}}</a>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</div>