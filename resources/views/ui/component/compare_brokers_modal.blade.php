<div class="modal fade" id="compareBrokersModal" tabindex="-1" role="dialog" aria-labelledby="compareBrokersModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h3>{{$compareBrokersModal['heading']}}</h3>
        <p>{{$compareBrokersModal['subtitle']}}</p>

        <h4>{{$compareBrokersModal['providersHeading']}}</h4>
        <ul class="provider-list">
          @foreach ($compareBrokersModal['providers'] as $provider)
          <li>
            <div class="row py-3 align-items-center">
              <div class="col-12 col-lg-2 provider-logo my-3 my-lg-0 text-center">
                <img src="{{\App\Helpers\Utils::convertAssetBaseUrl($provider['logoImgUrl'])}}" class="mx-auto img-fluid" alt="">
              </div>
              <div class="col-12 col-lg-2 provider-rating my-2 my-lg-0 text-center">
                <img src="{{\App\Helpers\Utils::convertAssetBaseUrl($provider['ratingImgUrl'])}}" class="mx-auto img-fluid" alt="">
              </div>
              <div class="col-12 col-lg-5 provider-description my-1 my-lg-0 text-center text-lg-left">
                <p class="mb-0">{{$provider['description']}}</p>
              </div>
              <div class="col-12 col-lg-3 provider-actions">
                <div class="row row-cols-2">
                  <div class="col-12 mb-1">
                    <a href="{{$provider['cta']['enquiryPermalink']}}" class="btn btn-brandRounded text-white bg-brandColor10 w-100">Make enquiry</a>
                  </div>
                  <div class="col pr-0">
                    <a href="{{$provider['cta']['websitePermalink']}}" class="btn btn-brandRounded rounded-right text-white bg-brandColor9 w-100">
                      <i class="fas fa-phone"></i>
                      Web
                    </a>
                  </div>
                  <div class="col pl-1">
                    <a href="{{$provider['cta']['phonePermalink']}}" class="btn btn-brandRounded rounded-left text-white bg-brandColor9 w-100">
                      <i class="fas fa-phone"></i>
                      Call
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </li>
          @endforeach
        </ul>
      </div>
    </div>
  </div>
</div>