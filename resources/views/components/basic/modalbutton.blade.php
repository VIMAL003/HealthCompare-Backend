<{{ !empty($htmlButton) && ($htmlButton) ? 'button' : 'span' }} id="{{ empty($id) ? '' : $id }}"
    {{ !empty($disabled) && ($disabled) ? 'disabled' : ''}}
   id="{{ empty($id) ? '' : $id }}"
   style="display: inline-block; {{ empty($style) ? '' : $style }}"
   class="{{$classTitle}} "
   role="button"
   data-toggle="modal"
   @if($modalTarget == '#hc_modal_video')
        data-video-url="{{ $videoUrl }}"
   @endif
   @if($modalTarget == '#hc_modal_map')
        data-longitude="{{ $longitude ?? '' }}"
        data-latitude="{{ $latitude ?? '' }}"
   @endif
   @if(!empty($telNumbers))
        data-hospital-tel="{{ $telNumbers }}"
   @endif
@if(!empty($hrefValue))
        data-hospital-url="{{ $hrefValue }}"
   @endif
    @if(!empty($dismiss) && ($dismiss))
        data-dismiss="modal"
   @endif
   @if($modalTarget == '#hc_modal_enquire_private' || '#hc_modal_mobile_tooltip')
        data-modal-text="{{ $modalText ?? 'This is the default text for an enquiry to a private hospital' }}"
   @endif
   @if($modalTarget == '#hc_modal_enquire_private')
        data-hospital-id="{{ $hospitalIds }}"
   @endif
   data-hospital-title="{{ $hospitalTitle ?? '' }}"
   data-target="{{ $modalTarget }}"
   data-image="{{ $image ?? '' }}"
   data-address="{{ $address ?? '' }}">
    <span>{!! $buttonText !!}</span>
    @if(!empty($svg) && empty($svgClass))
        @svg($svg)
    @elseif(!empty($svg) && !empty($svgClass))
        @svg($svg, $svgClass)
    @endif
</{{ !empty($htmlButton) && ($htmlButton) ? 'button' : 'span' }}>
