<div class="container_fluid landing-stats-banner bg-brandColor1 text-white py-3">
  <div class="container">
    <div class="row row-cols-1 row-cols-lg-3">
      @foreach ( $landingStatsBanner['stats'] as $stat )
      <div class="col">
        <div class="row">
          <div class="left-side col-3">
            @if ( $stat['left']['custom'] )
              {!! $stat['left']['custom'] !!}
            @else
              <img src="{{\App\Helpers\Utils::convertAssetBaseUrl($stat['left']['imgUrl'])}}" class="img-fluid" alt="">
            @endif
            </div>
            <div class="right-side col-9">
              <h5>{{$stat['right']['heading']}}</h5>
              <p>{!! $stat['right']['caption'] !!}</p>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</div>