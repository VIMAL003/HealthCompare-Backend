<div class="container_fluid cta-banner-overflowing-image">
  <div class="container">
    <div class="row row-cols-1 row-cols-lg-2">
      <div class="col main-content text-white py-3">
        <h3>{{$ctaBannerOverflowingImage['heading']}}</h3>
        @foreach ($ctaBannerOverflowingImage['textContent'] as $textContent)
        <p>{{$textContent}}</p>
        @endforeach
        <button type="button" class="btn  btn-brandRounded bg-brandColor6 text-white">{{$ctaBannerOverflowingImage['buttonText']}}</button>
      </div>
      <div class="col overflowing-image">
        <img class="img-fluid mx-auto d-block" src="{{\App\Helpers\Utils::convertAssetBaseUrl($ctaBannerOverflowingImage['imgUrl'])}}" alt="">
      </div>
    </div>
  </div>
</div>