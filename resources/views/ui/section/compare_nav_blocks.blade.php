<div class="container_fluid compare-nav-blocks py-3">
  <div class="container px-2 pb-5">
    {{-- <h3>{{$compareNavBlocks['heading']}}</h3> --}}
    <div class="row row-cols-3 row-cols-lg-4 mx-n2">
      {{-- <div class="card-deck"> --}}
      @foreach ( $compareNavBlocks['cards'] as $card)
      <div class="col mb-3 px-2 {{ !empty($card['cardClass']) ? $card['cardClass'] : ''}}">
        <div class="card">
          <img src="{{ \App\Helpers\Utils::convertAssetBaseUrl($card['iconUrl'])}}" class="mx-auto" alt="">
          <div class="card-body">
            <a href="{{$card['permalink']}}" class="card-title">{{$card['heading']}}</a>
          </div>
        </div>
      </div>
      @endforeach
      {{-- </div> --}}
    </div>
  </div>
</div>