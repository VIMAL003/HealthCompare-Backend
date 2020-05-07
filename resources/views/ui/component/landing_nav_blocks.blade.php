<div class="row row-cols-1 row-cols-lg-3 mx-n2 white-text">
  @foreach ($cards as $card )
  <div class="col mb-4 px-2 {{$card['cardClass']}}">
    <a href="{{url($card['permalink'])}}" target="{{ $card['cardClass'] == 'open-in-new-tab' ? '_blank' : ''}}" @if($card['cardClass'] == "open-in-new-tab") target="_blank" @endif class="card h-100 mb-lg-3 p-3">
      <img src="{{ \App\Helpers\Utils::convertAssetBaseUrl($card['imgUrl'])}}" class="mx-auto" alt="">
      <div class="card-body p-0">
        <h5 class="text-brandColor1">{{$card['heading']}}</h5>
        <p class="mb-0">{{$card['subtitle']}}</p>
      </div>
    </a>
  </div>
  @endforeach
</div>