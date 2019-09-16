@extends('layout.app')

@section('title', 'Results Page')

@section('description', 'this is the meta description')

@section('keywords', 'this is the meta keywords')

@section('mobile', 'width=device-width, initial-scale=1')

@section('body-class', 'results-page')

@section('content')
    <form class="form-element" id="resultspage_form">
        <div class="filter-parent">
            <div class="filter container">
                <div class="postcode-proximity">
                    <div class="postcode-proximity-child">
                        @include('components.basic.input', ['placeholder' => 'Enter your postcode', 'validation' => 'maxlength=8', 'inputClassName' => 'inputClass', 'value' => !empty(Request::input('postcode')) ? Request::input('postcode') : '' , 'name' => 'postcode', 'id' => 'input_postcode'])
                    </div>
                    <div class="postcode-proximity-child">
                        @include('components.basic.range', ['label' => 'Within radius of:', 'min' => 10, 'max' => 600, 'value' => !empty(Request::input('radius')) ? Request::input('radius') : '', 'name' => 'radius', 'step' => 10])
                    </div>
                </div>
                <div class="select-proximity">
                    <div class="filter-section">
                        <div class="filter-section-child">
                            @include('components.basic.select', [
                                'showLabel' => true,
                                'selectPicker' => 'true',
                                'options' => $data['filters']['procedures'],
                                'chevronFAClassName' => 'fa-chevron-down black-chevron',
                                'selectClass' => 'select-picker highlight-search-dropdown',
                                'placeholder'=>'Surgery Type',
                                'name'=>'procedure_id',
                                'resultsLabel' => 'resultsLabel'])
                            <a tabindex="0" data-offset="30px, 40px"
                               class="help-link"
                                @include('components.basic.popover', [
                                'dismissible'   => true,
                                'placement'      => 'top',
                                'size'           => 'large',
                                'html'           => 'true',
                                'trigger'        => 'focus',
                                'content'        => '<p class="bold mb-0">
                                                 Surgery Type
                                             </p>
                                             <p>
                                                 Please enter your procedure (if known)
                                             </p>
                                             <p>
                                                 <a  class="btn btn-close btn-close__small btn-teal btn-icon" >Close</a>
                                             </p>'])
                            >?</a>
                        </div>
                        <div class="filter-section-child">
                            {{--                            @include('components.basic.select', ['options' => [['id'=>1, 'name'=>'Choose your treatment'], ['id'=>2, 'name'=>'Choose your treatment']], 'selectClass' => 'results-page-select', 'chevronFAClassName' => 'fa-chevron-down black-chevron', 'placeholder' => 'Waiting time', 'resultsLabel' => 'resultsLabel'])--}}
                            @include('components.basic.select', ['showLabel' => true, 'options' => $data['filters']['waitingTimes'], 'chevronFAClassName' => 'fa-chevron-down black-chevron', 'selectClass' => 'results-page-select highlight', 'placeholder'=>'Waiting time', 'name'=>'waiting_time', 'resultsLabel' => 'resultsLabel'])
                            <a tabindex="0" data-offset="30px, 40px"
                               class="help-link"
                                @include('components.basic.popover', [
                                'dismissible'   => true,
                                'placement'      => 'top',
                                'size'           => 'large',
                                'html'           => 'true',
                                'trigger'        => 'focus',
                                'content'        => '<p class="bold mb-0">
                                                 Waiting Time
                                             </p>
                                             <p>
                                                 Filter by Waiting Times
                                             </p>
                                             <p>
                                                 <a  class="btn btn-close btn-close__small btn-teal btn-icon" >Close</a>
                                             </p>'])
                            >?</a>
                        </div>
                        <div class="filter-section-child">
                            {{--                            @include('components.basic.select', ['options' => [['id'=>1, 'name'=>'Choose your treatment'], ['id'=>2, 'name'=>'Choose your treatment']], 'selectClass' => 'results-page-select', 'chevronFAClassName' => 'fa-chevron-down black-chevron', 'placeholder' => 'NHS choices user rating', 'resultsLabel' => 'resultsLabel'])--}}
                            @include('components.basic.select', ['showLabel' => true, 'options' => $data['filters']['userRatings'], 'chevronFAClassName' => 'fa-chevron-down black-chevron', 'selectClass' => 'results-page-select highlight', 'placeholder'=>'NHS Choices User Rating', 'name'=>'user_rating', 'resultsLabel' => 'resultsLabel'])
                            <a tabindex="0" data-offset="30px, 40px"
                               class="help-link"
                                @include('components.basic.popover', [
                                'dismissible'   => true,
                                'placement'      => 'top',
                                'size'           => 'large',
                                'html'           => 'true',
                                'trigger'        => 'focus',
                                'content'        => '<p class="bold mb-0">
                                                 NHS Choice User Rating
                                             </p>
                                             <p>
                                                 Filter by NHS Choice User Rating
                                             </p>
                                             <p>
                                                 <a  class="btn btn-close btn-close__small btn-teal btn-icon" >Close</a>
                                             </p>'])
                            >?</a>
                        </div>
                        <div class="filter-section-child">
                            @include('components.basic.select', ['showLabel' => true, 'options' => $data['filters']['qualityRatings'], 'chevronFAClassName' => 'fa-chevron-down black-chevron', 'selectClass' => 'results-page-select highlight', 'placeholder'=>'Care Quality Rating', 'name'=>'quality_rating', 'resultsLabel' => 'resultsLabel'])
                            <a tabindex="0" data-offset="30px, 40px"
                               class="help-link"
                                @include('components.basic.popover', [
                                'dismissible'   => true,
                                'placement'      => 'top',
                                'size'           => 'large',
                                'html'           => 'true',
                                'trigger'        => 'focus',
                                'content'        => '<p class="bold mb-0">
                                                 Care Quality Rating
                                             </p>
                                             <p>
                                                 Filter by Care Quality Rating
                                             </p>
                                             <p>
                                                 <a  class="btn btn-close btn-close__small btn-teal btn-icon" >Close</a>
                                             </p>'])
                            >?</a>
                        </div>
                        <div class="filter-section-child">
                            @include('components.basic.select', ['showLabel' => true, 'options' => $data['filters']['hospitalTypes'], 'chevronFAClassName' => 'fa-chevron-down black-chevron', 'selectClass' => 'results-page-select highlight', 'placeholder'=>'Hospital Type', 'name'=>'hospital_type', 'resultsLabel' => 'resultsLabel'])
                            <a tabindex="0" data-offset="30px, 40px"
                               class="help-link"
                                @include('components.basic.popover', [
                                'dismissible'   => true,
                                'placement'      => 'top',
                                'size'           => 'large',
                                'html'           => 'true',
                                'trigger'        => 'focus',
                                'content'        => '<p class="bold mb-0">
                                                 NHS or Private Hospitals
                                             </p>
                                             <p>
                                                 Filter by NHS or Private Hospitals
                                             </p>
                                             <p>
                                                 <a  class="btn btn-close btn-close__small btn-teal btn-icon" >Close</a>
                                             </p>'])
                            >?</a>
                        </div>
                    </div>
                    <div class="submit-section">
                        <div class="submit-section-child">
                            @include('components.basic.submit', ['classTitle' => 'btn btn-grad btn-teal btn-s d-block btn-submit-results', 'button' => 'Update Results'])
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="sort-parent">
            <div class="container">
                <div class="sort-bar">
                    <div class="show-section">
                        Showing {{count($data['hospitals'])}} out of {{$data['hospitals']->total()}} provider(s)
                    </div>
                    <div class="sort-section">
                        @include('components.basic.select', [
                            'showLabel' => true,
                            'options' => $data['sortBy'],
                            'chevronFAClassName' => 'fa-chevron-down black-chevron',
                            'selectClass' => 'results-page-select select-sort-by',
                            'placeholder'=>'Sort by:',
                            'name'=>'sort_by',
                            'resultsLabel' => 'sortLabel'])
                    </div>
                </div>
            </div>
        </div>
    </form>

    <div id="sort_categories_parent" class="sort-categories-parent" >
        <div class="sort-categories-header container">
            <div class="sort-categories-section-1"></div>
            <nav class="sort-categories-section-2">
                <ul class="sort-categories-menu">
                    <li>
                        <p tabindex="0" data-offset="30px, 40px"
                            @include('components.basic.popover', [
                            'size'      => 'large',
                            'placement' => 'top',
                            'trigger'   => 'hover',
                            'html'      => 'true',
                            'content'   => '<p class="bold mb-0">
                                                Care Quality Rating
                                            </p>
                                            <p>
                                                The Care Quality Commission evaluates every registered healthcare location as Outstanding, Good, Requires Improvement or Inadequate. If the location hasn’t been reviewed yet, it will be marked ‘Not Yet Rated’.
                                            </p>'])>Care Quality<br>Rating</p>
                        <span title="Sort by this column"
                              class="sort-arrow sort-care-quality-rating {{Request::input('sort_by') == 10 ? 'desc':'asc' }}"></span>
                    </li>
                    <li>
                        <p tabindex="0" data-offset="30px, 40px"
                                @include('components.basic.popover', [
                                'size'      => 'large',
                                'placement' => 'top',
                                'trigger'   => 'hover',
                                'html'      => 'true',
                                'content'   => '<p class="bold mb-0">
                                                    Waiting Time (NHS Funded)
                                                </p>
                                                <p>
                                                    The number of weeks that 92 out of 100 people are waiting before their treatment starts. This is the NHS standard measure of waiting times.
                                                </p>'])>Waiting time <br>(NHS Funded)</p>
                        <span title="Sort by this column"
                              class="sort-arrow sort-waiting-time {{Request::input('sort_by') == 4 ? 'desc':'asc' }}"></span>
                    </li>
                    <li>
                        <p tabindex="0" data-offset="30px, 40px"
                                @include('components.basic.popover', [
                                'size'      => 'large',
                                'placement' => 'top',
                                'trigger'   => 'hover',
                                'html'      => 'true',
                                'content'   => '<p class="bold mb-0">
                                                    NHS Choices User Rating
                                                </p>
                                                <p>
                                                    The user rating for the location as recorded on <a class="text-link" target="_blank" href="https://www.nhs.uk">www.nhs.uk</a>, from 1-5 in 0.5 increments, where available. If the location doesn’t exist on <a class="text-link" target="_blank" href="https://www.nhs.uk">www.nhs.uk</a> then it is marked ‘No Data’, if it exists but there are no ratings, it’s marked as ‘Not Yet Rated’.
                                                </p>'])>NHS Choices <br> User Rating&nbsp;<br></p>
                        <span title="Sort by this column"
                              class="sort-arrow sort-user-rating {{Request::input('sort_by') == 6 ? 'desc':'asc' }}"></span>
                    </li>
                    <li>
                        <p tabindex="0" data-offset="30px, 40px"
                                @include('components.basic.popover', [
                                'size'      => 'large',
                                'placement' => 'top',
                                'trigger'   => 'hover',
                                'html'      => 'true',
                                'content'   => '<p class="bold mb-0">
                                                    % of Operations Cancelled
                                                </p>
                                                <p>
                                                    The percentage of cancelled elective operations, compared to the NHS Average. Currently available for NHS hospitals Only.
                                                </p>'])>% Operations<br>Cancelled</p>
                        <span title="Sort by this column"
                              class="sort-arrow sort-op-cancelled {{Request::input('sort_by') == 8 ? 'desc':'asc' }}"></span>
                    </li>
                    <li>
                        <p tabindex="0" data-offset="30px, 40px"
                                @include('components.basic.popover', [
                                'size'      => 'large',
                                'placement' => 'top',
                                'trigger'   => 'hover',
                                'html'      => 'true',
                                'content'   => '<p class="bold mb-0">
                                                    Friends & Family Rating
                                                </p>
                                                <p>
                                                    This is the % of patients who would recommend the location to the friends or family if they required similar treatment.
                                                </p>'])>Friends &<br>Family Rating</p>
                        <span title="Sort by this column"
                              class="sort-arrow sort-ff-rating {{Request::input('sort_by') == 12 ? 'desc':'asc' }}"></span>
                    </li>
                    <li>
                        <p tabindex="0" data-offset="30px, 40px"
                                @include('components.basic.popover', [
                                'size'      => 'large',
                                'placement' => 'top',
                                'trigger'   => 'hover',
                                'html'      => 'true',
                                'content'   => '<p class="bold mb-0">
                                                    NHS Funded Work
                                                </p>
                                                <p>
                                                    Indicates whether a Private hospital provides NHS funded services – you can be referred by your GP to a Private hospital as an alternative to your local NHS.
                                                </p>'])>NHS<br>Funded Work</p>
                        <span title="Sort by this column"
                              class="sort-arrow sort-nhs-funded {{Request::input('sort_by') == 14 ? 'desc':'asc' }}"></span>
                    </li>
                    <li>
                        <p tabindex="0" data-offset="30px, 40px"
                                @include('components.basic.popover', [
                                'size'      => 'large',
                                'placement' => 'top',
                                'trigger'   => 'hover',
                                'html'      => 'true',
                                'content'   => '<p class="bold mb-0">
                                                    Private Self Pay
                                                </p>
                                                <p>
                                                    Indicates whether a hospital location provides Private, Self Pay services. In many instances, your local NHS hospital will also offer private treatment.
                                                </p>'])>Private<br>Self Pay</p>
                        <span title="Sort by this column"
                              class="sort-arrow sort-self-pay {{Request::input('sort_by') == 16 ? 'desc':'asc' }}"></span>
                    </li>
                </ul>
            </nav>
            <div class="sort-categories-section-3 p-0">
                <ul class="sort-categories-menu p-0 h-100">
                    <li class="align-items-end">
                        <p class="text-center">
                            Add to<br>Shortlist
                            <a tabindex="0" data-offset="30px, 40px" class="mx-auto mt-1 help-link position-static d-block"
                                @include('components.basic.popover', [
                                'size'      => 'large',
                                'placement' => 'top',
                                'trigger'   => 'hover',
                                'html'      => 'true',
                                'content'   => '<p class="bold mb-0">
                                                    Add to Shortlist
                                                <p class="">
                                                    <a id="1" class="float-left btn btn-green-outline compare mt-0 mr-1" target="" href="javascript:void(0);" role="button"><i class=""></i></a>
                                                    When you have performed a search for hospitals on your results page you can click the
                                                    blue “compare” icon
                                                </p>
                                                </p>'])>?</a>
                        </p>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="sortCategoriesResults">
        @if(!empty($data['hospitals']))
            @foreach($data['hospitals'] as $d)
                @include('components.item', [
                    'id'                => $d['id'],
                    'itemImg'           => 'images/alder-1.png',
                    'title'             => $d['name'],
                    'location'          => (!empty($d['address']['address_1']) ? $d['address']['address_1']: '').(!empty($d['radius']) ? ', '.number_format($d['radius'], 1 ). ' miles from postcode': ''),
                    'latitude'          => $d['address']['latitude'],
                    'longitude'         => $d['address']['longitude'],
                    'findLink'          => 'Find on map',
                    'waitTime'          => !empty($d['waitingTime'][0]['perc_waiting_weeks']) ? round($d['waitingTime'][0]['perc_waiting_weeks'], 1).'<br>Weeks' : 0,
                    'userRating'        => !empty($d['rating']['avg_user_rating']) ? $d['rating']['avg_user_rating'] : 0,
                    'stars'             => !empty($d['rating']['avg_user_rating']) ? \App\Helpers\Utils::getHtmlStars($d['rating']['avg_user_rating']) : "<img src='images/icons/dash-black.svg' alt='Dash icon'>",
                    'opCancelled'       => !empty($d['cancelledOp']['perc_cancelled_ops'])? $d['cancelledOp']['perc_cancelled_ops'].'%': 0,
                    'qualityRating'     => !empty($d['rating']['latest_rating']) ? $d['rating']['latest_rating'] : 0,
                    'FFRating'          => !empty($d['rating']['friends_family_rating']) ? $d['rating']['friends_family_rating'].'%' : 0,
                    'NHSFunded'         => ($d['hospitalType']['name'] === 'Independent' && !empty($d['waitingTime'][0]['perc_waiting_weeks'])) ? 1 : 0,
                    'privateSelfPay'    => $d['hospitalType']['name'] === 'Independent' ? 1 : 0,
                    'specialOffers'     => $d['special_offers'],
                    'btnText'           => 'Make an enquiry',
                    'NHSClass'          => $d['hospitalType']['name'] == 'NHS' ? 'nhs-hospital' : 'private-hospital',
                    'fundedText'        => ($d['hospitalType']['name'] == 'NHS') ? 'NHS Hospital': 'Private Hospital',
                    'url'               => $d['url']])
            @endforeach
        @endif
    </div>

    <div class="pagination-wrap">
        @if(!empty($data['hospitals']))
            {{
                $data['hospitals']->appends([
                    'postcode'          => Request::input('postcode'),
                    'radius'            => Request::input('radius'),
                    'procedure_id'      => Request::input('procedure_id'),
                    'waiting_time'      => Request::input('waiting_time'),
                    'user_rating'       => Request::input('user_rating'),
                    'quality_rating'    => Request::input('quality_rating'),
                    'hospital_type'     => Request::input('hospital_type'),
                    'sort_by'           => Request::input('sort_by')
                ])->links()
            }}
        @endif
    </div>

    {{--  Compare bar  --}}
{{--    @include('components.compare')--}}
    {{-- New comparebar - solutions bar --}}
    @include('components.solutionsbar')
    {{--  Modal for 'make an enquiry'  --}}
    @include('components.modals.modalenquirenhs')
    {{--  Modal for special offers  --}}
    @include('components.modals.modalspecial')
    {{--  Modal for special offers  --}}
    @include('components.modals.modalenquireprivate', [
        'procedures' => $data['filters']['procedures']])
    {{--  Maps modal  --}}
    @include('components.modals.modalmaps')


@endsection
