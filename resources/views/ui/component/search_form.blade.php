{{-- <div class="banner-form-wrapper">
  <form id="search_form" method="get" action="/results-page" class="search-form p-lg-0">
  <div class="form-row">
    <div class="form-group col-lg-4 mb-1 mb-lg-0 p-lg-0 treatment-group treatment-parent">
      <label for="treatment" class="sr-only">Select a treatment (if known)</label>
      <select name="treatment" class="custom-select mb-0">
        <option selected disabled>Select a treatment (if known)</option>
        <option value="1">One</option>
        <option value="2">Two</option>
        <option value="3">Three</option>
      </select>
    </div>
    <div class="form-group col-lg-4 mb-1 mb-lg-0 p-lg-0 postcode-group postcode-parent">
      <label class="sr-only" for="postcode">Enter Postcode</label>
      <input type="text" name="postcode" class="form-control mb-0 mr-sm-2" id="postcode" placeholder="Enter Postcode">
    </div>
    <div class="form-group col-lg-4 mb-1 mb-lg-0 p-lg-0 d-none distance-group radius-parent">
      <label for="distance" class="sr-only">Distance</label>
      <select name="distance" class="custom-select mb-0">
        <option selected disabled>Distance</option>
        <option value="1">One</option>
        <option value="2">Two</option>
        <option value="3">Three</option>
      </select>
    </div>
    <div class="form-group col-lg-4 mb-1 mb-lg-0 p-lg-0 submit-group">
      <button type="submit" id="submit_search" class="btn btn-block bg-brandColor1 text-white mb-0">Search</button>
    </div>
  </div>
</form>
</div> --}}


<div class="">
  <form id="search_form" method="get" action="/results-page" class="search-form p-lg-0">
  <div class="form-row">
    <div class="form-group col-lg-4 mb-1 mb-lg-0 p-lg-0 treatment-group treatment-parent">
      @include('components.basic.select', [
        'selectPicker'          => 'true',
        'selectClass'           => 'big select-picker',
        'options'               => $data['procedures'],
        'group'                 => true,
        'groupName'             => 'procedures',
        'suboptionClass'        => 'subprocedures',
        'svg'                   => 'chevron-down',
        'name'                  => 'procedure_id',
        'selectId'              => 'choose_procedure',
    ])
    </div>
    <div class="form-group col-lg-4 mb-1 mb-lg-0 p-lg-0 postcode-group postcode-parent">
      <label for="fake_postcode" class="d-none"></label>
      <input name="fake_postcode" id="fake_postcode" type="text" style="display:none">

      <div class="input-wrapper position-relative">
          @include('components.basic.input', [
              'placeholder'       => 'Enter postcode',
              'inputClassName'    => 'postcode-text-box big input-postcode',
              'value'             => '',
              'name'              => 'postcode',
              'validation'        => 'maxlength=8 autocomplete="off"',
              'id'                => 'input_postcode'
          ])
      </div>
      <div class="postcode-results-container">
          <div class="ajax-box"></div>
      </div>
    </div>
    <div class="form-group col-lg-4 mb-1 mb-lg-0 p-lg-0 d-none distance-group radius-parent">
      @include('components.basic.select', [
        'selectClass'           =>  'distance-dropdown big select-picker',
        'selectWrapperClass'    =>  'w-100',
        'selectParentClass'     =>  'd-md-flex w-100',
        'options'               =>  \App\Helpers\Utils::radius,
        'placeholderOption'     =>  'Select Distance',
        'selectedPlaceholder'   =>  true,
        'name'                  =>  'radius',
        'svg'                   =>  'chevron-down'
      ])
    </div>
    <div class="form-group col-lg-4 mb-1 mb-lg-0 p-lg-0 submit-group">
      <button type="submit" id="submit_search" class="btn btn-block bg-brandColor1 text-white mb-0">Search</button>
    </div>
  </div>
</form>
</div>



{{--
<div class="banner-form-wrapper">
  <form id="search_form"
  class="form-element"
  method="get"
  action="/results-page"
  style="">
  <div class="form-child treatment-parent position-relative">
    @include('components.basic.select', [
      'selectPicker'          => 'true',
      'selectClass'           => 'big select-picker',
      'options'               => $data['procedures'],
      'group'                 => true,
      'groupName'             => 'procedures',
      'suboptionClass'        => 'subprocedures',
      'svg'                   => 'chevron-down',
      'name'                  => 'procedure_id',
      'selectId'              => 'choose_procedure',
      ])
    </div>
    <div class="form-child postcode-parent position-relative">
      <label for="fake_postcode" class="d-none"></label>
      <input name="fake_postcode" id="fake_postcode" type="text" style="display:none">

      <div class="input-wrapper position-relative">
        @include('components.basic.input', [
          'placeholder'       => 'Enter postcode',
          'inputClassName'    => 'postcode-text-box big input-postcode',
          'value'             => '',
          'name'              => 'postcode',
          'validation'        => 'maxlength=8 autocomplete="off"',
          'id'                => 'input_postcode'
          ])
        </div>
        <div class="postcode-results-container">
          <div class="ajax-box"></div>
        </div>
      </div>
      <div class="form-child radius-parent full-left column-layout position-relative" data-reveal-direction="down" >
        @include('components.basic.select', [
          'selectClass'           =>  'distance-dropdown big select-picker',
          'selectWrapperClass'    =>  'w-100',
          'selectParentClass'     =>  'd-md-flex w-100',
          'options'               =>  \App\Helpers\Utils::radius,
          'placeholderOption'     =>  'Select Distance',
          'selectedPlaceholder'   =>  true,
          'name'                  =>  'radius',
          'svg'                   =>  'chevron-down'])
    </div>
    @include('components.basic.button', [
      'classTitle'    => 'btn btn-squared btn-block text-center btn-brand-primary-1 mb-3 font-18',
      'buttonText'    => 'Search Now',
      'htmlButton'    => true,
      'id'            => 'submit_search',
      ])
    <div class='browse-button text-left text-lg-center'>
      @include('components.basic.button', [
        'classTitle'    => 'col-grey pl-0 btn-plain btn-icon-arrow w-100 d-flex align-items-center justify-content-lg-center',
        'buttonText'    => 'Browse all hospitals',
            'htmlButton'    => true,
            'svg'           => 'icon-arrow',
            'hrefValue'     => '/results-page'
            ])
    </div>
  </form>
</div> --}}