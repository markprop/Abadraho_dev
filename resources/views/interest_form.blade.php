@extends('layouts.master')
@section('meta_keywords', 'property interest, real estate, Dubai')
@section('meta_description', 'Understand your property interest in Dubai')
@section('meta_title', 'Property Interest Form')
@section('content')
    <section class="our-log-reg bgc-f7">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="breadcrumb_content style2 mb0-991">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item active text-thm" aria-current="page">Property Interest</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="login_form inner_page">
                        <div class="heading">
                            <h3 class="text-center">Let's find your ideal property in Dubai</h3>
                        </div>
                        <form action="/submit-interest" method="POST" id="interest-form" class="mt-4">
                            @csrf
                            <div class="form-group">
                                <label>What is your primary goal for this property?</label>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="goal-rental" name="goal" value="rental" class="custom-control-input" required>
                                            <label class="custom-control-label" for="goal-rental">
                                                <img src="/assets/images/rental-icon.jpg" alt="Rental" class="img-fluid mb-2">
                                                Seeking long-term rental income
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="goal-capital" name="goal" value="capital" class="custom-control-input" required>
                                            <label class="custom-control-label" for="goal-capital">
                                                <img src="/assets/images/capital-icon.jpg" alt="Capital" class="img-fluid mb-2">
                                                Capital appreciation and resale potential
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="goal-vacation" name="goal" value="vacation" class="custom-control-input" required>
                                            <label class="custom-control-label" for="goal-vacation">
                                                <img src="/assets/images/vacation-icon.jpg" alt="Vacation" class="img-fluid mb-2">
                                                Personal use as a vacation home or residence
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-log btn-block btn-thm2">Next</button>
                        </form>
                    </div>
                </div>
                <div class="col-md-3"></div>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            // Check if user has already filled the form (using session or cookie)
            let hasFilledForm = localStorage.getItem('hasFilledForm');
            let auth = <?php echo json_encode(Auth::user()); ?>;

            if (!hasFilledForm && !auth) {
                setTimeout(() => {
                    $('#interest-form').modal('show');
                }, 5000);
            } else {
                window.location.href = '/login';
            }

            $('#interest-form').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url: '/submit-interest',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response.success) {
                            localStorage.setItem('hasFilledForm', 'true');
                            window.location.href = '/login';
                        }
                    },
                    error: function() {
                        alert('Error submitting form. Please try again.');
                    }
                });
            });
        });
    </script>
@endsection