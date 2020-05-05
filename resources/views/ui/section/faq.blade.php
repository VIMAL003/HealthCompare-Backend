<div class="container_fluid faq py-5">
  <div class="container pt-4">
    <div class="row row-cols-1 mb-4">
      <div class="col">
        <div class="card">
          <div class="card-body">
            <div class="main-content mb-3 mx-auto py-3">
              <h3>{{$faq['heading']}}</h3>
              <h4>{{$faq['subtitle']}}</h4>
            </div>
            <div class="faq-list">
            @foreach ( $faq['list'] as $faqItem)
              <div class="faq-item">
                <h4>{{$faqItem['question']}}</h4>
                @foreach ( $faqItem['responseContent'] as $responseContent)
                <p>{!! $responseContent !!}</p>
                @endforeach
                <hr class="text-brandColor17">
              </div>
            @endforeach
            </div>
            <div class="cta-button">
              <a href="#view-all-faq" class="btn btn-brandRounded bg-brandColor1 text-white">{{$faq['buttonText']}}</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <img class="footer-white-slogan mx-auto d-block py-5" src="{{ \App\Helpers\Utils::convertAssetBaseUrl('../images/your-health-your-choice-footer-white.svg') }}" alt="">
  </div>
</div>