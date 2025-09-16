@props([
    'companyName' => 'Abad Raho',
    'companyDescription' => 'Abad Raho stands for quality, trust, and authenticity in the real estate industry that deals in marketing and sales of residential and commercial projects.',
    'email' => 'info@markproperties.pk',
    'phone' => '+92 316-703-1554',
    'address' => 'Plot Number B-354, Ground Floor, Block 7-8 Kathiawaar C.H.S Karachi.',
    'website' => 'https://markproperties.pk',
    'showSocialIcons' => true,
    'showQuickLinks' => true,
    'showContactInfo' => true,
    'showAboutUs' => true,
    'customQuickLinks' => null,
    'customSocialLinks' => null
])

<!-- Our Footer -->
<section class="footer_one">
    <div class="container">
        <div class="row">
            @if($showAboutUs)
            <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3 pr0 pl0">
                <div class="footer_about_widget">
                    <h4>About Us</h4>
                    <p>{{ $companyDescription }}</p>
                </div>
            </div>
            @endif

            @if($showQuickLinks)
            <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3">
                <div class="footer_qlink_widget">
                    <h4>Quick Links</h4>
                    <ul class="list-unstyled">
                        @if($customQuickLinks)
                            @foreach($customQuickLinks as $link)
                                <li><a href="{{ $link['url'] }}">{{ $link['text'] }}</a></li>
                            @endforeach
                        @else
                            <li><a href="/about-us">About Us</a></li>
                            <li><a href="/terms-conditions">Terms & Conditions</a></li>
                            <li><a href="/contact-us">Contact Us</a></li>
                        @endif
                    </ul>
                </div>
            </div>
            @endif

            @if($showContactInfo)
            <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3">
                <div class="footer_contact_widget">
                    <h4>Contact Us</h4>
                    <ul class="list-unstyled">
                        <li><a href="mailto://{{ $email }}">{{ $email }}</a></li>
                        <li>{{ $address }}</li>
                        <li><a href="tel:{{ $phone }}">{{ $phone }}</a></li>
                    </ul>
                </div>
            </div>
            @endif

            @if($showSocialIcons)
            <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3">
                <div class="footer_social_widget">
                    <h4>Follow us</h4>
                    <ul class="mb30">
                        @if($customSocialLinks)
                            @foreach($customSocialLinks as $social)
                                <li class="list-inline-item">
                                    <a href="{{ $social['url'] }}" target="_blank">
                                        <i class="{{ $social['icon'] }}"></i>
                                    </a>
                                </li>
                            @endforeach
                        @else
                            <li class="list-inline-item"><a href="https://www.facebook.com/markpropertiespk" target="_blank"><i
                                        class="fab fa-facebook"></i></a></li>
                            <li class="list-inline-item"><a href="https://www.instagram.com/markproperties.pk" target="_blank"><i
                                        class="fab fa-instagram"></i></a></li>
                            <li class="list-inline-item"><a
                                    href="https://www.linkedin.com/company/markpropertiespk" target="_blank"><i
                                        class="fab fa-linkedin"></i></a></li>
                        @endif
                    </ul>
                </div>
            </div>
            @endif
        </div>
    </div>

    <div class="container pt40">
        <div class="row">
            <div class="col-lg-12 col-xl-12">
                <div class="copyright-widget text-center">
                    <p>
                        Copyright © {{ date('Y') }} | Powered by <a class="footer_company_name"
                                                                    href="{{ $website }}"
                                                                    target="_blank">{{ $companyName }}</a>.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
