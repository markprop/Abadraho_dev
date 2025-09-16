{{-- 
    Footer Component Usage Examples
    
    This file demonstrates how to use the footer components in your Laravel Blade templates.
    Copy the examples below and paste them into your views as needed.
--}}

{{-- Basic Footer Usage (Default) --}}
<x-footer />

{{-- Advanced Footer with Custom Parameters --}}
<x-footer-advanced 
    company-name="Your Company Name"
    company-description="Your custom company description here..."
    email="your-email@example.com"
    phone="+1-234-567-8900"
    address="Your custom address here"
    website="https://yourwebsite.com"
    :show-social-icons="true"
    :show-quick-links="true"
    :show-contact-info="true"
    :show-about-us="true"
/>

{{-- Footer with Custom Quick Links --}}
<x-footer-advanced 
    :custom-quick-links="[
        ['text' => 'Home', 'url' => '/'],
        ['text' => 'About', 'url' => '/about'],
        ['text' => 'Services', 'url' => '/services'],
        ['text' => 'Contact', 'url' => '/contact']
    ]"
/>

{{-- Footer with Custom Social Media Links --}}
<x-footer-advanced 
    :custom-social-links="[
        ['url' => 'https://facebook.com/yourpage', 'icon' => 'fab fa-facebook'],
        ['url' => 'https://twitter.com/yourhandle', 'icon' => 'fab fa-twitter'],
        ['url' => 'https://instagram.com/yourhandle', 'icon' => 'fab fa-instagram'],
        ['url' => 'https://linkedin.com/company/yourcompany', 'icon' => 'fab fa-linkedin']
    ]"
/>

{{-- Minimal Footer (Only Social Icons) --}}
<x-footer-advanced 
    :show-about-us="false"
    :show-quick-links="false"
    :show-contact-info="false"
    :show-social-icons="true"
/>

{{-- Footer with All Custom Content --}}
<x-footer-advanced 
    company-name="Custom Company"
    company-description="This is a custom company description that will appear in the About Us section."
    email="custom@company.com"
    phone="+1-555-123-4567"
    address="123 Custom Street, City, State 12345"
    website="https://customcompany.com"
    :custom-quick-links="[
        ['text' => 'Privacy Policy', 'url' => '/privacy'],
        ['text' => 'Terms of Service', 'url' => '/terms'],
        ['text' => 'Support', 'url' => '/support']
    ]"
    :custom-social-links="[
        ['url' => 'https://facebook.com/customcompany', 'icon' => 'fab fa-facebook'],
        ['url' => 'https://twitter.com/customcompany', 'icon' => 'fab fa-twitter']
    ]"
/>
