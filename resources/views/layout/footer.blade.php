<footer class="footer position-relative">
    {{-- <div class="back-top-wrapper mt-4 position-absolute">
        <div class="container back-top-content d-flex justify-content-end">
            @include('components.basic.button', [
            'id'            => 'back-to-top',
            'classTitle'    => 'btn btn-icon btn-back-to-top',
            'buttonText'    => '<span>Back to top</span>',
            'hrefValue'     => '#top',
            'svg'           => 'chevron-up'])
        </div>
    </div> --}}
    <div class="footer-upper">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-6 mb-60">
                    <nav class="footer-upper__nav mb-25" role="navigation">
                        <ul class="footer-upper__menu">
                            <li><a href="/">Home</a></li>
{{--                            <li><a href="/about-us">About Us</a></li>--}}
{{--                            <li><a href="/your-rights">Your rights</a></li>--}}
{{--                            <li><a href="/patient-choice">Patient choice</a></li>--}}
                            {{--                <li><a href="/our-blogs">Our blogs</a></li>--}}
                            <li><a href="mailto:hello@hospitalcompare.co.uk">Contact us</a></li>
                        </ul>
                    </nav>
                    <nav>
                        <ul class="footer-upper__secondary-menu mb-0">
                            <li class="d-inline-block mb-3"><a href="/terms-of-use">Terms of Use</a></li>
                            <li class="d-inline-block mb-3"><a href="/privacy-policy">Privacy Policy</a></li>
                            <li class="d-inline-block mb-3"><a href="/cookie-policy">Cookie Policy</a></li>
                            <li class="d-inline-block mb-3"><a href="/attributions">Attributions</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="social text-left text-lg-right">
                        <ul class="social-list d-flex justify-content-lg-end">
                            <li class="facebook-social">
                                <a href="https://www.facebook.com/hospitalcompare" target="_blank">@svg('facebook')
                                    <span class="sr-only">Facebook link</span>
                                </a>
                            </li>
                            <li class="twitter-social">
                                <a href="https://www.twitter.com/HospCompare" target="_blank">@svg('twitter')
                                    <span class="sr-only">Twitter link</span>
                                </a>
                            </li>
                            <li class="instagram-social">
                                <a href="https://www.instagram.com/hospitalcompare/" target="_blank">@svg('instagram')
                                    <span class="sr-only">Instagram link</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>


    </div>

    <div class="footer-lower">
        <div class="svg-wrapper animated mb-4" data-animation="draw">
            @svg('footer-heart')
        </div>

        <div class="container">
            <p class="mb-4">
            *Your legal right to choose or qualify for NHS treatment may be restricted in some circumstances.
                For more
                information see <a
                    class="text-link"
                    href="/your-rights">Your Rights.</a>
            </p>
            <p><time>{{ date('Y') }}</time><a href="/"> Hospital Compare<sup>TM</sup></a>. All rights reserved.</p>
          </div>
    </div>
</footer>
