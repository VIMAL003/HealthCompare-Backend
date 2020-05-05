<div class="container_fluid compare-online-cards py-3">
  <div class="container">
    <div class="main-content">
      <h4 class="text-brandColor1">{{$compareOnlineCards['slogan']}}</h4>
      <h3>{{$compareOnlineCards['heading']}}</h3>
    </div>
    <div class="row row-cols-1 row-cols-lg-3 card-row">
      {{-- <div class="card-deck"> --}}
      @foreach ($compareOnlineCards['cards'] as $card)
      <div class="col mb-4">
        <div class="card h-100">
          <img src="{{\App\Helpers\Utils::convertAssetBaseUrl($card['imgUrl'])}}" class="card-img-top" alt="">
          <div class="card-body">
            <h5 class="card-title text-brandColor1">{{$card['label']}}</h5>
            <h4>{{$card['heading']}}</h4>
            @foreach ( $card['textContent'] as $textContent)
            <p>{{$textContent}}</p>
            @endforeach
            <a href="#" class="btn btn-brandRounded bg-brandColor1 text-white">{{$card['buttonText']}}</a>
          </div>
        </div>
      </div>
      @endforeach
      {{-- </div> --}}
    </div>
  </div>
</div>