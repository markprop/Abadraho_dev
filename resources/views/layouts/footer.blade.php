<!-- Our Footer -->
<section class="footer_one">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3 pr0 pl0">
                <div class="footer_about_widget">
                    <h4>About Us</h4>
                    <p>Abad Raho stands for quality, trust, and authenticity in the real estate industry
                        that deals in marketing and sales of residential and commercial projects.</p>
                </div>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3">
                <div class="footer_qlink_widget">
                    <h4>Quick Links</h4>
                    <ul class="list-unstyled">
                        <li><a href="/about-us">About Us</a></li>
                        <li><a href="/terms-conditions">Terms & Conditions</a></li>
                        <li><a href="/contact-us">Contact Us</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3">
                <div class="footer_contact_widget">
                    <h4>Contact Us</h4>
                    <ul class="list-unstyled">
                        <li><a href="mailto://info@markproperties.pk">info@markproperties.pk</a></li>
                        <li>Plot Number B-354, Ground Floor</li>
                        <li>Block 7-8 Kathiawaar C.H.S Karachi.</li>
                        <li><a href="tel:+923167031554">+92 316-703-1554</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3">
                <div class="footer_social_widget">
                    <h4>Follow us</h4>
                    <ul class="mb30">
                        <li class="list-inline-item"><a href="https://www.facebook.com/markpropertiespk" target="_blank"><i
                                    class="fab fa-facebook"></i></a></li>
                        <li class="list-inline-item"><a href="https://www.instagram.com/markproperties.pk" target="_blank"><i
                                    class="fab fa-instagram"></i></a></li>
                        <li class="list-inline-item"><a
                                href="https://www.linkedin.com/company/markpropertiespk" target="_blank"><i
                                    class="fab fa-linkedin"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="container pt40">
        <div class="row">
            <div class="col-lg-12 col-xl-12">
                <div class="copyright-widget text-center">
                    <p>
                        Copyright © {{ date('Y') }} | Powered by <a class="footer_company_name"
                                                                    href="https://markproperties.pk"
                                                                    target="_blank">Mark Properties</a>.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
<a class="scrollToHome" href="#"><i class="flaticon-arrows"></i></a>
</div>
<!-- Wrapper End -->
<script type="text/javascript" src="/assets/js/jquery-3.3.1.js"></script>
<script type="text/javascript" src="/assets/js/jquery-migrate-3.0.0.min.js"></script>
<script type="text/javascript" src="/assets/js/popper.min.js"></script>
<script type="text/javascript" src="/assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/assets/js/jquery.mmenu.all.js"></script>
<script type="text/javascript" src="/assets/js/ace-responsive-menu.js"></script>
<script type="text/javascript" src="/assets/js/chart.min.js"></script>
<script type="text/javascript" src="/assets/js/chart-custome.js"></script>
<script type="text/javascript" src="/assets/js/isotop.js"></script>
<script type="text/javascript" src="/assets/js/snackbar.min.js"></script>
<script type="text/javascript" src="/assets/js/simplebar.js"></script>
<script type="text/javascript" src="/assets/js/parallax.js"></script>
<script type="text/javascript" src="/assets/js/scrollto.js"></script>
{{-- <script type="text/javascript" src="/assets/js/jquery-scrolltofixed-min.js"></script> --}}
<script type="text/javascript" src="/assets/js/jquery.counterup.js"></script>
<script type="text/javascript" src="/assets/js/wow.min.js"></script>
<script type="text/javascript" src="/assets/js/progressbar.js"></script>
<script type="text/javascript" src="/assets/js/wow.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAAz77U5XQuEME6TpftaMdX0bBelQxXRlM&callback=initMap"
        type="text/javascript"></script>
<script type="text/javascript" src="/assets/js/googlemaps1.js"></script>
<!-- Custom script for all pages -->
<script type="text/javascript" src="/assets/js/script.js"></script>
<script>
    $('#myTab a,#myTab2 a').on('click', function (e) {
        e.preventDefault()
        $(this).tab('show')
    });

    var div = $('.project-title');
    var charater_count = div.find('small').text().length;
    if (charater_count > 19) {
        div.find('small').css('font-size', 16)
    }
    console.log(charater_count);
</script>

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-X05W5DLNKD"></script>
<script>
window.dataLayer = window.dataLayer || [];
function gtag(){dataLayer.push(arguments);}
gtag('js', new Date());

gtag('config', 'G-X05W5DLNKD');
</script>

</body>
</html>
