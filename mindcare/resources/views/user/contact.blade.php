@extends('layouts.usermain')
@section('content')
    <section class="hero-wrap hero-wrap-2" style="background-image: url('images/bg_5.jpg');" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text align-items-end justify-content-center">
                <div class="col-md-9 ftco-animate mb-5 text-center">
                    <p class="breadcrumbs mb-0">
                        <span class="mr-2"><a href="index.html">Home <i class="fa fa-chevron-right"></i></a></span>
                        <span>Contact Us <i class="fa fa-chevron-right"></i></span>
                    </p>
                    <h1 class="mb-0 bread">Contact Us</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="wrapper px-md-4">
                        <div class="row mb-5">
                            <div class="col-md-3">
                                <div class="dbox w-100 text-center">
                                    <div class="icon d-flex align-items-center justify-content-center">
                                        <span class="fa fa-map-marker"></span>
                                    </div>
                                    <div class="text">
                                        <p><span>Address:</span> Orange Digital Village, Amman, Jordan</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="dbox w-100 text-center">
                                    <div class="icon d-flex align-items-center justify-content-center">
                                        <span class="fa fa-phone"></span>
                                    </div>
                                    <div class="text">
                                        <p><span>Phone:</span> <a href="tel:+962779394950">+962 77 939 4950</a></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="dbox w-100 text-center">
                                    <div class="icon d-flex align-items-center justify-content-center">
                                        <span class="fa fa-paper-plane"></span>
                                    </div>
                                    <div class="text">
                                        <p><span>Email:</span> <a href="mailto:mnoorsaqer@gmail.com">mnoorsaqer@gmail.com</a></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="dbox w-100 text-center">
                                    <div class="icon d-flex align-items-center justify-content-center">
                                        <span class="fa fa-globe"></span>
                                    </div>
                                    <div class="text">
                                        <p><span>Website:</span> <a href="home">mindcare.com</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row no-gutters">
                            <div class="col-md-7">
                                <div class="contact-wrap w-100 p-md-5 p-4">
                                    <h3 class="mb-4">Contact Us</h3>
									<form id="contactForm" method="POST" action="{{ route('contact.store') }}" class="contactForm">
    @csrf
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="label" for="name">Full Name</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Name" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="label" for="email">Email Address</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label class="label" for="subject">Subject</label>
                <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label class="label" for="#">Message</label>
                <textarea name="message" class="form-control" id="message" cols="30" rows="4" placeholder="Message" required></textarea>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <input type="submit" value="Send Message" class="btn btn-primary">
                <div class="submitting"></div>
            </div>
        </div>
    </div>
</form>

                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="map">
                                    <iframe 
                                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3381.740496251236!2d35.92396231512324!3d31.963158981244695!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x151ca070d2a6df67%3A0x123456789abcdef!2sOrange%20Digital%20Village%2C%20Amman%2C%20Jordan!5e0!3m2!1sen!2sjo!4v1234567890" 
                                        width="100%" 
                                        height="400" 
                                        style="border:0;" 
                                        allowfullscreen="" 
                                        loading="lazy">
                                    </iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Success',
        text: '{{ session("success") }}',
        timer: 3000,
        showConfirmButton: false
    });
</script>
@endif
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        $('#contactForm').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                type: 'POST',
                url: '{{ route('contact.store') }}',
                data: $(this).serialize(),  // Serialize the form data
                success: function(response) {
                    // Show the SweetAlert on success
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Your message has been sent!',
                        timer: 3000,
						showConfirmButton: true,
                         confirmButtonText: 'OK',

						
                    });
                    
                    // Clear the form fields
                    $('#contactForm')[0].reset();
                },
                error: function(xhr, status, error) {
                    // Handle any errors
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops!',
                        text: 'Something went wrong, please try again later.',
                    });
                }
            });
        });
    });
</script>
