{{--Special offers tabs in solutions bar --}}

<div class="special-offer-tab {{ $bgColor ?? '' }} ml-3">
    <div class="special-offer-header d-flex align-items-center">
        <div class="image-wrapper">
            <img class="content" width="55" height="50" alt="Image of The Christie Main Site" src="{{ asset('../images/alder-1.png') }}">
            <div class="{{ $hospitalType == "private" ? 'private-hospital' : 'nhs-hospital' }} label">
                {{--                <p>NHS Hospital</p>--}}
            </div>
        </div>
        <div class="offer-text">
            <div class="closed-text">
                <p class="offer-title mb-0">{{ $headerText['closed']['title'] }}</p>
                <p class="offer-subtitle mb-0">{{ $headerText['closed']['subtitle'] }}</p>
            </div>
            <div class="open-text">
                <p class="hospital-name mb-0">{{ $headerText['open']['title'] }}</p>
                <p class="distance mb-0">{{ $headerText['open']['subtitle'] }}</p>
            </div>
        </div>
        <span class="fa fa-chevron-up toggle-special-offer"></span>
    </div>
    <div class="special-offer-body">
        <div class="bullets mb-4">
            <ul>
                @foreach($bulletPoints as $bulletPoint)
                    <li>{{ $bulletPoint }}</li>
                @endforeach
            </ul>
            @if($hospitalType == 'private-hospital')
                <div class="offer-price">Total cost <strong>£{{ $offerPrice }}</strong></div>
            @endif
        </div>
        <div class="btn-area text-right">
            @includeWhen($hospitalType == 'private-hospital' ,'components.basic.modalbutton', [
                'hospitalType'      => $hospitalType,
                'hospitalTitle'     => $headerText['open']['title'],
                'modalTarget'       => '#hc_modal_enquire_private',
                'classTitle'        => 'btn btn-icon btn-enquire-now enquiry',
                'target'            => 'blank',
                'button'            => 'Enquire now'
                ])
            @includeWhen($hospitalType == 'nhs-hospital' ,'components.basic.modalbutton', [
                'hospitalType'      => $hospitalType,
                'hospitalTitle'     => $headerText['open']['title'],
                'hrefValue'         => $hospitalUrl,
                'modalTarget'       => '#hc_modal_enquire_nhs',
                'classTitle'        => 'btn btn-icon btn-enquire-now enquiry',
                'target'            => 'blank',
                'button'            => 'Enquire now',
                ])
        </div>
    </div>
</div>