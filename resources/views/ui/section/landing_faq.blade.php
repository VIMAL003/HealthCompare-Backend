<div class="container_fluid landing-faq py-5">
  <div class="container">
    <div class="row row-cols-1">
      <div class="col">
        <div class="card">
          <div class="card-body">
            <div class="faq-list">
            @foreach ($faq['list'] as $faqItem)
              <div class="faq-item">
                <h4>{{$faqItem['question']}}</h4>
                @foreach ($faqItem['responseContent'] as $responseContent)
                  <p>{!! $responseContent!!}</p>
                @endforeach
                <hr class="text-brandColor17">
              </div>
            @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
    <img class="footer-blue-slogan mx-auto d-block py-5" src="{{ \App\Helpers\Utils::convertAssetBaseUrl('../images/your-health-your-choice-footer-blue.svg')}}" alt="">
  </div>
</div>