@extends('layouts.master')

@section('content')

<section class="our-contact pb0 bgc-f7">
		<div class="container">
       <div class="row">
                <div class="col-lg-6">
                    <div class="breadcrumb_content style2 mb0-991">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item active text-thm" aria-current="page">Contact us</li>
                        </ol>
                        <h2 class="breadcrumb_title">Contact us</h2>
                    </div>
                </div>
            </div>
          <div class="row">
	  			<div class="col-sm-12 col-md-12 col-lg-12 offset-lg-12 mb30">
                    <div class="utf-section-headline-item centered text-center mb20">
                    <!-- <h3 class="headline"><span>Ask Any Queries</span>Get In Touch With Us</h3> -->
                    <h3 class="headline">Get In <span class="head-red">Touch</span> With Us</h3>
                    <div class="utf-headline-display-inner-item">Get In Touch With Us</div>
                   </div>
                   <p class="utf-slogan-text">We only work with the best companies around the globe</p>
                </div>
      </div>
		<div class="container">
			<div class="row">
				<div class="col-lg-7 col-xl-8">
					<div class="form_grid">
						<h4 class="mb5">Send Us An Email</h4>


						@if(Session::has('success'))
						<div class="alert alert-success">
							{{ Session::get('success') }}
						</div>
						@endif

			            <form class="contact_form" id="contact_form" name="contact_form" action="/contact" method="POST">
						@csrf
							<div class="row">
				                <div class="col-md-6">
				                    <div class="form-group">
										<input id="form_name" name="name" class="form-control required name" required="required" type="text" value="" placeholder="Name">
									</div>
				                </div>
				                <div class="col-md-6">
				                    <div class="form-group">
				                    	<input id="form_email" name="email" class="form-control required email" required="required" value="" type="" placeholder="Email">
				                    </div>
				                </div>
				                <div class="col-md-6">
				                    <div class="form-group">
				                    	<input id="form_phone" name="phone" class="form-control required phone" required="required" min="0" value="" type="number" placeholder="Phone">
				                    </div>
				                </div>
				                <div class="col-md-6">
				                    <div class="form-group">
					                    <input id="form_subject" name="subject" class="form-control required" required="required" value="" type="text" placeholder="Subject">
									</div>
				                </div>
				                <div class="col-sm-12">
		                            <div class="form-group">
		                                <textarea id="form_message" name="message" class="form-control required" rows="8" type="text" required="required" value="message" placeholder="Your Message"></textarea>
		                            </div>
									<div class="form-group">
		                                <div class="g-recaptcha" data-sitekey="{{env('CAPTCHA_KEY')}}"></div>
										@if($errors->has('g-recaptcha-response'))
										<span class="invalid-feedback" style="display: block;">
										<strong>{{$errors->first('g-recaptcha-response')}}</strong>
										</span>
										@endif
		                            </div>
				                    <div class="form-group mb0">
					                    <button type="submit" class="btn btn-lg btn-thm" value="submit">Send Message</button>
				                    </div>
				                </div>
			                </div>
			            </form>
					</div>
				</div>


				<div class="col-lg-5 col-xl-4">
					<div class="contact_localtion">
						<h4>Contact Us</h4>
						<p>Get in Touch WIth Us. We are Here to help you.</p>
						<div class="content_list">
							<h5>Address</h5>
							<p>Plot Number B-354, Ground Floor Block 7-8 Kathiawaar C.H.S Karachi.</p>
						</div>
						<div class="content_list">
							<h5>Phone</h5>
							<p>+92 316-703-1554</p>
						</div>
						<div class="content_list">
							<h5>Mail</h5>
							<p>info@markproperties.pk</p>
						</div>
                           
                        <div class="folow">
                        	<h5>Follow Us</h5>
					       <ul class="utf-social-icons rounded">
                                <li><a class="facebook" href="#"><i class="fa fa-facebook-f"></i></a></li>
                                <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a class="linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>
                                <li><a class="instagram" href="#"><i class="fa fa-instagram"></i></a></li>
                                <li><a class="gplus" href="#"><i class="fa fa-youtube"></i></a></li>
                            </ul>
                        </div>   
					</div>
				</div>
			</div>
		</div>

		<div class="container-fluid p0 mt50">

			<div class="row">
				<div class="col-lg-12">
					<iframe src="https://www.google.com/maps/embed?pb=!1m22!1m8!1m3!1d3619.444973644728!2d67.08118461500327!3d24.88279918404341!3m2!1i1024!2i768!4f13.1!4m11!3e6!4m3!3m2!1d24.884019199999997!2d67.0826496!4m5!1s0x3eb33ea1e2933201%3A0x9574de52a76f6550!2smark%20360!3m2!1d24.8814897!2d67.0840159!5e0!3m2!1sen!2s!4v1626506880328!5m2!1sen!2s" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
						<p><br><br></p>

					</div>
			</div>
		</div>
	</section>



	@endsection
