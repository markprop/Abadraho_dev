<!-- Our Footer -->
<section class="footer_one">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3 pr0 pl0">
                <div class="footer_about_widget">
                    <h4>About Site</h4>
                    <p>We’re reimagining how you buy, sell and rent. It’s now easier to get into a place you love.
                        So let’s do this, together.</p>
                </div>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3">
                <div class="footer_qlink_widget">
                    <h4>Quick Links</h4>
                    <ul class="list-unstyled">
                        <li><a href="/about">About Us</a></li>
                        <li><a href="#">Terms & Conditions</a></li>
                        <li><a href="#">User’s Guide</a></li>
                        <li><a href="#">Support Center</a></li>
                        <li><a href="#">Press Info</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3">
                <div class="footer_contact_widget">
                    <h4>Contact Us</h4>
                    <ul class="list-unstyled">
                        <li><a href="#">info@findhouse.com</a></li>
                        <li><a href="#">Collins Street West, Victoria</a></li>
                        <li><a href="#">8007, Australia.</a></li>
                        <li><a href="#">+1 246-345-0699</a></li>
                        <li><a href="#">+1 246-345-0695</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3">
                <div class="footer_social_widget">
                    <h4>Follow us</h4>
                    <ul class="mb30">
                        <li class="list-inline-item"><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li class="list-inline-item"><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li class="list-inline-item"><a href="#"><i class="fa fa-instagram"></i></a></li>
                        <li class="list-inline-item"><a href="#"><i class="fa fa-pinterest"></i></a></li>
                        <li class="list-inline-item"><a href="#"><i class="fa fa-dribbble"></i></a></li>
                        <li class="list-inline-item"><a href="#"><i class="fa fa-google"></i></a></li>
                    </ul>
                    <h4>Subscribe</h4>
                    <form class="footer_mailchimp_form">
                        <div class="form-row align-items-center">
                            <div class="col-auto">
                                <input type="email" class="form-control mb-2" id="inlineFormInput"
                                       placeholder="Your email">
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-primary mb-2"><i class="fa fa-angle-right"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Our Footer Bottom Area -->
<section class="footer_middle_area pt40 pb40">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-xl-6">
                <div class="footer_menu_widget">
                    <ul>
                        <li class="list-inline-item"><a href="#">Home</a></li>
                        <li class="list-inline-item"><a href="#">Listing</a></li>
                        <li class="list-inline-item"><a href="#">Property</a></li>
                        <li class="list-inline-item"><a href="#">Pages</a></li>
                        <li class="list-inline-item"><a href="#">Blog</a></li>
                        <li class="list-inline-item"><a href="#">Contact</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-6 col-xl-6">
                <div class="copyright-widget text-right">
                    <p>© 2020 Find House. Made with love.</p>
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
<script type="text/javascript" src="/assets/js/bootstrap-select.min.js"></script>
<script type="text/javascript" src="/assets/js/isotop.js"></script>
<script type="text/javascript" src="/assets/js/snackbar.min.js"></script>
<script type="text/javascript" src="/assets/js/simplebar.js"></script>
<script type="text/javascript" src="/assets/js/parallax.js"></script>
<script type="text/javascript" src="/assets/js/scrollto.js"></script>
<script type="text/javascript" src="/assets/js/jquery-scrolltofixed-min.js"></script>
<script type="text/javascript" src="/assets/js/jquery.counterup.js"></script>
<script type="text/javascript" src="/assets/js/wow.min.js"></script>
<script type="text/javascript" src="/assets/js/progressbar.js"></script>
<script type="text/javascript" src="/assets/js/slider.js"></script>
<script type="text/javascript" src="/assets/js/pricing-slider.js"></script>
<script type="text/javascript" src="/assets/js/timepicker.js"></script>
<script type="text/javascript" src="/assets/js/wow.min.js"></script>
<script src="{{Config::get('app.url')}}/node_modules/select2/dist/js/select2.min.js"></script>
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
<script>
 
          $('#select2_id').select2();
    
</script>
</body>
</html>
