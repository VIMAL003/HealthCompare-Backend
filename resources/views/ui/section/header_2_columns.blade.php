<div class="container_fluid header-2-columns mt-5 {{!empty($wrapperClass) ? $wrapperClass : '' }}">
  <div class="container">
    <div class="row">
      <div class="col-12 col-lg-6 left-side py-3 order-1">
        <img src="{{\App\Helpers\Utils::convertAssetBaseUrl($header2Columns['col1']['imgUrl'])}}" class="left-side-image" alt="">
      </div>
      <div class="col-12 col-lg-8 mx-lg-auto main-content py-3 order-2 order-lg-first">
        <h3>{{ $header2Columns['col2']['heading'] }}</h3>
        @foreach( $header2Columns['col2']['textContent'] as $textContent)
          <p>{{$textContent}}</p>
        @endforeach
      </div>
      <div class="col-12 col-lg-6 right-side py-3 order-3">
        @include('ui.component.slider', ['slider_class'=>'search-works'])
      </div>
    </div>
  </div>
</div>