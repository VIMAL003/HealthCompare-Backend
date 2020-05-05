<div class="slick-slider {{$slider_class}}">
  @hasSection('slides')
    @yield('slides')
  @else
    @foreach($header2Columns['col3']['cards'] as $card)
      {{-- <div class="card h-100 mb-2 mb-lg-3 mx-1 mx-lg-3"> --}}
      <div class="card h-100 mb-3 p-3">
        <div class="row">
          <div class="col-12 col-lg-3">
        <img src="{{\App\Helpers\Utils::convertAssetBaseUrl($card['imgUrl'])}}" class="mx-auto pb-2" alt="">

          </div>
          <div class="col-12 col-lg-9">
          <h4 class="text-brandColor1">{{$card['heading']}}</h4>
          <p>{{$card['subtitle']}}</p>
          <span>{!! $card['ctaText'] !!}</span>

          </div>
        </div>
      </div>
    @endforeach
  @endif
</div>