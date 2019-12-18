<div class="compare-hospitals-bar_mobile {{ !empty($position) && $position == 'static' ? 'position-static' : ''  }}">
    <div class="compare-hospitals-header d-flex justify-content-between">
        <div class="container-fluid px-0 position-relative d-flex justify-content-between align-items-end h-100">
            <div id="compare_button_title" class="compare-button-title d-flex align-items-center h-100 w-50 pl-3">
                @svg('compare-heart', 'compare-heart')
                <p class="font-12">Compare&nbsp;(<span id="compare_number">0</span>)<span class="compare-arrow ml-3"></span>
                </p>
            </div>
            @if(!empty($data['special_offers']))
                <ul class="solutions-menu align-items-end d-md-flex mb-0 ml-auto w-50">
                    <li class="d-block h-100 w-100">
                        {{--Special offers tabs in solutions bar --}}
                        <div class="special-offer-tab pink__offer pink w-100 rounded-0">
                            <div class="special-offer-header d-flex align-items-center font-12">
                                Lowest waiting time
                                <span class="toggle-special-offer d-inline-flex align-items-center">
                                    @svg('chevron-up')
                                </span>
                            </div>
                            <div class="special-offer-body">
                                <div class="inner-body d-flex flex-column justify-content-between h-100">
                                    Body
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            @endif
        </div>
    </div>
    <div class="compare-hospitals-content">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="col-inner">
                        <div class="col-header pr-3">
{{--                            <p class="SofiaPro-SemiBold mb-1">You are comparing:</p>--}}
{{--                            <p class="mb-3"><span id="nhs-hospital-count">0</span>&nbsp;NHS hospital(s) &<br><span id="private-hospital-count">0</span>&nbsp;Private hospital(s)</p>--}}
                            <div class="form-wrapper pt-3 grey-border-top">
                                @include('components.basic.modalbutton', [
                                    'htmlButton'        => true,
                                    'buttonText'        => 'Make an enquiry to all your chosen hospitals',
                                    'classTitle'        => 'btn btn-squared btn-blue btn-enquire-all font-12 w-100',
                                    'id'                => 'multiple_enquiries_button',
                                    'svg'               => 'circle-check',
                                    'svgClass'          => 'circle-check',
                                    'modalTarget'       => '#hc_modal_enquire_private',
                                    'disabled'          => true,
                                    'hospitalTitle'     => 'your selected hospitals',
                                    'hospitalIds'       => ''
                                ])
                            </div>
                        </div>
                    </div>
                </div>
{{--                <div class="col col-2" id="no_items_added">--}}
{{--                    <div class="col-inner pr-3">--}}
{{--                        <div class="col-header_small">--}}
{{--                            <p class="font-16 SofiaPro-SemiBold pb-4 grey-border-bottom">You haven’t added any--}}
{{--                                hospitals to compare yet. </p>--}}
{{--                            <p>Click the the&nbsp;<img width="14" height="12" src="/images/icons/heart.svg"--}}
{{--                                                       alt="Heart icon">&nbsp;next to the hospital to add the chosen--}}
{{--                                hospital into the comparison dashboard.</p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
                <div id="compare_hospitals_headings" class="col col-2 d-none">
                    <div class="col-inner h-100">

                        <div class=""></div>
                        <div class="cell">
                            <span class="position-relative">Hospital Type&nbsp&nbsp;
                                <span tabindex="0" data-offset="0 5px"
                                      class="help-link"
                                    @include('components.basic.popover', [
                                    'dismissible'   => true,
                                    'placement'      => 'top',
                                    'html'           => 'true',
                                    'size'           => 'comparison',
                                    'trigger'        => 'hover',
                                    'content'        => '
                                                 <span>
                                                     NHS or Private Hospital
                                                 </span>
                                                 '])
                                >@svg('question')</span>
                            </span>
                        </div>
                        <div class="cell">
                            <span class="position-relative">Average Waiting Time&nbsp;&nbsp;
                                <span tabindex="0" data-offset="0 5px"
                                      class="help-link"
                                    @include('components.basic.popover', [
                                    'dismissible'   => true,
                                    'placement'      => 'top',
                                    'html'           => 'true',
                                    'size'           => 'comparison',
                                    'trigger'        => 'hover',
                                    'content'        => '
                                                    <span>
                                                        Our waiting time data is based on NHS data, specifically the number of weeks that 92 out or 100 people wait for their treatment to start.
                                                    </span>'])
                                >@svg('question')</span>
                            </span>
                        </div>
                        <div class="cell">
                            <span class="position-relative">NHS User Rating&nbsp;&nbsp;
                                <span tabindex="0" data-offset="0 5px"
                                      class="help-link"
                                    @include('components.basic.popover', [
                                    'dismissible'   => true,
                                    'placement'      => 'top',
                                    'html'           => 'true',
                                    'size'           => 'comparison',
                                    'trigger'        => 'hover',
                                    'content'        => '
                                                 <span>
                                                     The average waiting time for procedures at this hospital
                                                 </span>
                                                 '])
                                >@svg('question')</span>
                            </span>
                        </div>
                        <div class="cell">
                            <span class="position-relative">% Operations cancelled&nbsp;&nbsp;
                                <span tabindex="0" data-offset="0 5px"
                                      class="help-link"
                                    @include('components.basic.popover', [
                                    'dismissible'   => true,
                                    'placement'      => 'top',
                                    'html'           => 'true',
                                    'size'           => 'comparison',
                                    'trigger'        => 'hover',
                                    'content'        => '
                                                 <span>
                                                    The percentage of operations cancelled during the last reporting period. Data only available for NHS hospitals at this time.
                                                 </span>'])
                                >@svg('question')</span>
                            </span>
                        </div>
                        <div class="cell">
                            <span class="position-relative">Care Quality Rating&nbsp;&nbsp;
                                <span tabindex="0"
                                      class="help-link"
                                    @include('components.basic.popover', [
                                    'placement' => 'top',
                                    'trigger'   => 'hover',
                                    'html'      => 'true',
                                    'size'      => 'comparison',
                                    'content'   => '<span>
                                                        The Quality Care Commission evaluates all hospitals and rates them as Outstanding, Good, Requires Improvement or Inadequate. Some hospitals have not been reviewed yet.
                                                    </span>'])>@svg('question')</span>
                            </span>
                        </div>
                        <div class="cell">
                            <span class="position-relative">Friends & Family Rating&nbsp;&nbsp;
                                <span tabindex="0"
                                      class="help-link"
                                    @include('components.basic.popover', [
                                    'placement' => 'top',
                                    'trigger'   => 'hover',
                                    'html'      => 'true',
                                    'size'      => 'comparison',
                                    'content'   => '<span>
                                                        The percentage of people who would recommend this hospital to family and friends.
                                                    </span>'])>@svg('question')</span>
                            </span>
                        </div>
                        <div class="cell">
                            <span class="position-relative">NHS Funded Work&nbsp;&nbsp;
                                <span tabindex="0"
                                      class="help-link"
                                    @include('components.basic.popover', [
                                    'placement' => 'top',
                                    'trigger'   => 'hover',
                                    'html'      => 'true',
                                    'size'      => 'comparison',
                                    'content'   => '<span>
                                                        This hospital provides treatments funded by the NHS. Remember you can have an NHS treatment at most private hospitals.
                                                    </span>'])>@svg('question')</span>
                            </span>
                        </div>
                        <div class="cell">
                            <span class="position-relative">Private Self Pay&nbsp;&nbsp;
                                <span tabindex="0"
                                      class="help-link"
                                    @include('components.basic.popover', [
                                    'placement' => 'top',
                                    'trigger'   => 'hover',
                                    'html'      => 'true',
                                    'size'      => 'comparison',
                                    'content'   => '<span>
                                                        Indicates whether a hospital location provides Private, Self Pay services. In many instances, your local NHS hospital will also offer private treatment.
                                                    </span>'])>@svg('question')</span>
                            </span>
                        </div>
                        <div class="cell column-break SofiaPro-SemiBold">Care Quality Rating</div>
                        <div class="cell">
                            <span class="position-relative">Safe&nbsp;&nbsp;
                                <span tabindex="0"
                                      class="help-link"
                                    @include('components.basic.popover', [
                                    'placement' => 'top',
                                    'trigger'   => 'hover',
                                    'html'      => 'true',
                                    'size'      => 'comparison',
                                    'content'   => '<span>
                                                        Info here
                                                    </span>'])>@svg('question')</span>
                            </span>
                        </div>
                        <div class="cell">
                            <span class="position-relative">Effective&nbsp;&nbsp;
                                <span tabindex="0"
                                      class="help-link"
                                @include('components.basic.popover', [
                                'placement' => 'top',
                                'trigger'   => 'hover',
                                'html'      => 'true',
                                'size'      => 'comparison',
                                'content'   => '<span>
                                                    Info here
                                                </span>'])>@svg('question')</span>
                            </span>
                        </div>
                        <div class="cell">
                            <span class="position-relative">Caring&nbsp;&nbsp;
                                <span tabindex="0"
                                      class="help-link"
                                    @include('components.basic.popover', [
                                    'placement' => 'top',
                                    'trigger'   => 'hover',
                                    'html'      => 'true',
                                    'size'      => 'comparison',
                                    'content'   => '<span>
                                                        Info here
                                                    </span>'])>@svg('question')</span>
                            </span>
                        </div>
                        <div class="cell">
                            <span class="position-relative">Responsive&nbsp;&nbsp;
                                <span tabindex="0"
                                      class="help-link"
                                    @include('components.basic.popover', [
                                    'placement' => 'top',
                                    'trigger'   => 'hover',
                                    'html'      => 'true',
                                    'size'      => 'comparison',
                                    'content'   => '<span>
                                                        Info here
                                                    </span>'])>@svg('question')</span>
                            </span>
                        </div>
                        <div class="cell">
                            <span class="position-relative">Well Led&nbsp;&nbsp;
                                <span tabindex="0"
                                      class="help-link"
                                    @include('components.basic.popover', [
                                    'placement' => 'top',
                                    'trigger'   => 'hover',
                                    'html'      => 'true',
                                    'size'      => 'comparison',
                                    'content'   => '<span>
                                                        Info here
                                                    </span>'])>@svg('question')</span>
                            </span>
                        </div>
                        <div class="cell column-break SofiaPro-SemiBold">NHS User Rating</div>
                        <div class="cell">
                            <span class="position-relative">Cleanliness&nbsp;&nbsp;
                                <span tabindex="0"
                                      class="help-link"
                                    @include('components.basic.popover', [
                                    'placement' => 'top',
                                    'trigger'   => 'hover',
                                    'html'      => 'true',
                                    'size'      => 'comparison',
                                    'content'   => '<span>
                                                        Info here
                                                    </span>'])>@svg('question')</span>
                            </span>
                        </div>
                        <div class="cell">
                            <span class="position-relative">Food & Hygiene&nbsp;&nbsp;
                                <span tabindex="0"
                                      class="help-link"
                                    @include('components.basic.popover', [
                                    'placement' => 'top',
                                    'trigger'   => 'hover',
                                    'html'      => 'true',
                                    'size'      => 'comparison',
                                    'content'   => '<span>
                                                        Info here
                                                    </span>'])>@svg('question')</span>
                            </span>
                        </div>
                        <div class="cell">
                            <span class="position-relative">Privacy, Dignity & Wellbeing&nbsp;&nbsp;
                                <span tabindex="0"
                                      class="help-link"
                                    @include('components.basic.popover', [
                                    'placement' => 'top',
                                    'trigger'   => 'hover',
                                    'html'      => 'true',
                                    'size'      => 'comparison',
                                    'content'   => '<span>
                                                        Info here
                                                    </span>'])>@svg('question')</span>
                            </span>
                        </div>
                        <div class="cell">
                            <span class="position-relative">Dementia Domain&nbsp;&nbsp;
                                <span tabindex="0"
                                      class="help-link"
                                    @include('components.basic.popover', [
                                    'placement' => 'top',
                                    'trigger'   => 'hover',
                                    'html'      => 'true',
                                    'size'      => 'comparison',
                                    'content'   => '<span>
                                                        Info here
                                                    </span>'])>@svg('question')</span>
                            </span>
                        </div>
                        <div class="cell">
                            <span class="position-relative">Disability Domain&nbsp;&nbsp;
                                <span tabindex="0"
                                      class="help-link"
                                    @include('components.basic.popover', [
                                    'placement' => 'top',
                                    'trigger'   => 'hover',
                                    'html'      => 'true',
                                    'size'      => 'comparison',
                                    'content'   => '<span>
                                                        Info here
                                                    </span>'])>@svg('question')</span>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col col-10 mt-0 border-right-0">
                    <div class="row" id="compare_hospitals_grid">
                        <!-- Items added here -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
