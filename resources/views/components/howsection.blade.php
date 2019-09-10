<div class="how-section container">
    <div class="row">
        <h2 class="section-title col-12">{{$sectionTitle}}</h2>
        @if(!empty($howsections))
            @foreach($howsections as $howsection)
                <div class="how-section__child col-12 col-md-3">
                    <div class="col-inner h-100 d-flex flex-column">
                        <div class="icon">
                            {!! file_get_contents(asset('images/icons/' . $howsection['iconImg'] . '.svg')) !!}
                        </div>
                        <div class="icon-title">
                            {{ $howsection['title'] }}
                        </div>
                        <div class="icon-description my-auto">
                            {!! $howsection['description'] !!}
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
        <div class="col-12">
            <div class="btn-area text-center">
                @include('components.basic.button', [
                    'hrefValue'     => '/results-page',
                    'classTitle'    => 'btn btn-m btn-grad btn-teal',
                    'button'        => 'Find Hospitals'

                ])
            </div>
        </div>
    </div>
</div>
