@extends('layouts.usermain')

@section('content')
<div class="hero-wrap" style="background-image: url('{{ asset('images/bg_1.jpg') }}');" data-stellar-background-ratio="0.5">
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text align-items-center">
      <div class="col-md-6 ftco-animate d-flex align-items-end">
        <div class="text w-100">
          <h1 class="mb-4">Online Therapy & Appointments</h1>
          <p class="mb-4">Book a consultation with one of our expert therapists, anytime, anywhere. Our online platform makes it easy for you to schedule appointments and receive personalized care through video sessions.</p>
          
          <!-- Conditional check to display the appropriate button based on login status -->
          @if(Auth::check())  <!-- If the user is logged in -->
            <p>
              <a href="{{ route('user.pricing') }}" class="btn btn-primary py-3 px-4">Get Started</a>
            </p>
          @else  <!-- If the user is not logged in -->
            <p>
              <a href="{{ route('login') }}" class="btn btn-primary py-3 px-4">Login</a> 
              <a href="#" class="btn btn-white py-3 px-4">Read more</a>
            </p>
          @endif

        </div>
      </div>
    </div>
  </div>
</div>

<section class="ftco-intro">
  <div class="container">
    <div class="row no-gutters">
      <div class="col-md-4 d-flex">
        <div class="intro aside-stretch d-lg-flex w-100">
          <div class="icon">
            <span class="flaticon-checklist"></span>
          </div>
          <div class="text">
            <h2>Book Appointments Easily</h2>
            <p>Schedule your therapy sessions with just a few clicks. Our platform allows you to book, reschedule, or cancel appointments at your convenience.</p>
          </div>
        </div>
      </div>
      <div class="col-md-4 d-flex">
        <div class="intro color-1 d-lg-flex w-100">
          <div class="icon">
            <span class="flaticon-employee"></span>
          </div>
          <div class="text">
            <h2>Expert Therapists</h2>
            <p>Connect with licensed professionals who are experienced in helping with a range of mental health concerns. We provide a safe and confidential environment for your therapy sessions.</p>
          </div>
        </div>
      </div>
      <div class="col-md-4 d-flex">
        <div class="intro color-2 d-lg-flex w-100">
          <div class="icon">
            <span class="flaticon-umbrella"></span>
          </div>
          <div class="text">
            <h2>Accessible & Flexible</h2>
            <p>Enjoy the flexibility of online therapy, available on your schedule. No need to leave your home – receive support in a comfortable and familiar environment.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>



	<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center pb-5">
            <div class="col-md-7 heading-section text-center ftco-animate">
                <span class="subheading">How It Works</span>
                <h2>Our Process</h2>
            </div>
        </div>
        <div class="row">
            <!-- Step 1: Book an Appointment -->
            <div class="col-md-4 d-flex align-items-stretch ftco-animate">
                <div class="services-2 text-center">
                    <div class="icon-wrap">
                        <div class="number d-flex align-items-center justify-content-center"><span>01</span></div>
                        <div class="icon d-flex align-items-center justify-content-center">
                            <span class="flaticon-calendar"></span>
                        </div>
                    </div>
                    <h2>Book an Appointment</h2>
                    <p>Select your preferred date and time to book an appointment with one of our experienced doctors. You can do this easily through our online booking system.</p>
                </div>
            </div>
            <!-- Step 2: Zoom Meeting -->
            <div class="col-md-4 d-flex align-items-stretch ftco-animate">
                <div class="services-2 text-center">
                    <div class="icon-wrap">
                        <div class="number d-flex align-items-center justify-content-center"><span>02</span></div>
                        <div class="icon d-flex align-items-center justify-content-center">
                            <span class="flaticon-qa"></span>
                        </div>
                    </div>
                    <h2>Zoom Meeting</h2>
                    <p>Join your scheduled Zoom meeting with the doctor at the agreed time. Our online consultation is secure, easy to use, and helps you connect with professionals from the comfort of your home.</p>
                </div>
            </div>
            <!-- Step 3: Review & Packages -->
            <div class="col-md-4 d-flex align-items-stretch ftco-animate">
                <div class="services-2 text-center">
                    <div class="icon-wrap">
                        <div class="number d-flex align-items-center justify-content-center"><span>03</span></div>
                        <div class="icon d-flex align-items-center justify-content-center">
                            <span class="flaticon-checklist"></span>
                        </div>
                    </div>
                    <h2>Review & Packages</h2>
                    <p>After your consultation, you can review your treatment plan and opt for one of our service packages. Choose a package that best suits your needs for follow-up sessions or ongoing support.</p>
                </div>
            </div>
        </div>
    </div>
</section>


    <section class="ftco-section ftco-no-pb ftco-no-pt">
			<div class="container">
				<div class="row">
                <div class="col-md-6 img img-3 d-flex justify-content-center align-items-center" style="background-image: url('{{ asset('images/about-1.jpg') }}');">
                </div>
					<div class="col-md-6 wrap-about px-md-5 ftco-animate py-5 bg-light">
	          <div class="heading-section">
	          	<span class="subheading">Welcome to Counselor</span>
	            <h2 class="mb-4">Best Counseling Funding Network Worldwide.</h2>

	            <p>A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.</p>
	            <p>On her way she met a copy. The copy warned the Little Blind Text, that where it came from it would have been rewritten a thousand times and everything that was left from its origin would be the word "and" and the Little Blind Text should turn around and return to its own, safe country.</p>

	          </div>

					</div>
				</div>
			</div>
		</section>

		<section class="ftco-section">
  <div class="container">
    <div class="row justify-content-center mb-5">
      <div class="col-md-8 text-center heading-section ftco-animate">
        <span class="subheading">Our Services</span>
        <h2 class="mb-3">We Can Help You With This Situation</h2>
      </div>
    </div>
    <div class="row tabulation mt-4 ftco-animate">
      <div class="col-md-4">
        <ul class="nav nav-pills nav-fill d-md-flex d-block flex-column">
          <li class="nav-item text-left">
            <a class="nav-link active py-4" data-toggle="tab" href="#services-1">Relation Problem</a>
          </li>
          <li class="nav-item text-left">
            <a class="nav-link py-4" data-toggle="tab" href="#services-2">Couples Counseling</a>
          </li>
          <li class="nav-item text-left">
            <a class="nav-link py-4" data-toggle="tab" href="#services-3">Depression Treatment</a>
          </li>
          <li class="nav-item text-left">
            <a class="nav-link py-4" data-toggle="tab" href="#services-4">Family Problem</a>
          </li>
          <li class="nav-item text-left">
            <a class="nav-link py-4" data-toggle="tab" href="#services-5">Personal Problem</a>
          </li>
          <li class="nav-item text-left">
            <a class="nav-link py-4" data-toggle="tab" href="#services-6">Business Problem</a>
          </li>
        </ul>
      </div>
      <div class="col-md-8">
        <div class="tab-content">
          <div class="tab-pane container p-0 active" id="services-1">
            <div class="img" style="background-image: url('{{ asset('images/services-1.jpg') }}');"></div>
            <h3><a href="{{ route('user.pricing', ['service' => 'relation-problem']) }}">Relation Problem</a></h3>
            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
            <!-- Add a button -->
            <a href="{{ route('user.pricing', ['service' => 'relation-problem']) }}" class="btn btn-primary">Book Now</a>
          </div>
          <div class="tab-pane container p-0 fade" id="services-2">
            <div class="img" style="background-image: url('{{ asset('images/services-2.jpg') }}');"></div>
            <h3><a href="{{ route('user.pricing', ['service' => 'couples-counseling']) }}">Couples Counseling</a></h3>
            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
            <!-- Add a button -->
            <a href="{{ route('user.pricing', ['service' => 'couples-counseling']) }}" class="btn btn-primary">Book Now</a>
          </div>
          <div class="tab-pane container p-0 fade" id="services-3">
            <div class="img" style="background-image: url('{{ asset('images/services-3.jpg') }}');"></div>
            <h3><a href="{{ route('user.pricing', ['service' => 'depression-treatment']) }}">Depression Treatment</a></h3>
            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
            <!-- Add a button -->
            <a href="{{ route('user.pricing', ['service' => 'depression-treatment']) }}" class="btn btn-primary">Book Now</a>
          </div>
          <div class="tab-pane container p-0 fade" id="services-4">
            <div class="img" style="background-image: url('{{ asset('images/services-4.jpg') }}');"></div>
            <h3><a href="{{ route('user.pricing', ['service' => 'family-problem']) }}">Family Problem</a></h3>
            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
            <!-- Add a button -->
            <a href="{{ route('user.pricing', ['service' => 'family-problem']) }}" class="btn btn-primary">Book Now</a>
          </div>
          <div class="tab-pane container p-0 fade" id="services-5">
            <div class="img" style="background-image: url('{{ asset('images/services-5.jpg') }}');"></div>
            <h3><a href="{{ route('user.pricing', ['service' => 'personal-problem']) }}">Personal Problem</a></h3>
            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
            <!-- Add a button -->
            <a href="{{ route('user.pricing', ['service' => 'personal-problem']) }}" class="btn btn-primary">Book Now</a>
          </div>
          <div class="tab-pane container p-0 fade" id="services-6">
            <div class="img" style="background-image: url('{{ asset('images/services-6.jpg') }}');"></div>
            <h3><a href="{{ route('user.pricing', ['service' => 'business-problem']) }}">Business Problem</a></h3>
            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
            <!-- Add a button -->
            <a href="{{ route('user.pricing', ['service' => 'business-problem']) }}" class="btn btn-primary">Book Now</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>  
<section class="ftco-section testimony-section">
    <div class="img img-bg border" style="background-image: url('{{ asset('images/bg_4.jpg') }}');"></div>

    <div class="overlay"></div>
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-md-7 text-center heading-section heading-section-white ftco-animate">
                <span class="subheading">Testimonial</span>
                <h2 class="mb-3">Happy Clients</h2>
            </div>
        </div>
        <div class="row ftco-animate">
            <div class="col-md-12">
                <div class="carousel-testimony owl-carousel ftco-owl">
                    @foreach($reviews as $review)
                        <div class="item">
                            <div class="testimony-wrap py-4">
                                <div class="icon d-flex align-items-center justify-content-center">
                                    <span class="fa fa-quote-left"></span>
                                </div>
                                <div class="text">
                                    <p class="mb-4">{{ $review->comments }}</p>
                                    <div class="d-flex align-items-center">
                                        <!-- Use a default placeholder image -->
                                        <div class="user-img" style="background-image: url('{{ asset('images/default-user.png') }}');"></div>
                                        <div class="pl-3">
                                            <p class="name">{{ $review->user_name ?? 'Anonymous' }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>



	
    @endsection