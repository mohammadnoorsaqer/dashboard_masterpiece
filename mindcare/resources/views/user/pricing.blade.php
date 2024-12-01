@extends('layouts.usermain')

@section('content')
<section class="ftco-section bg-light">
    <div class="container">
        <div class="row justify-content-center pb-5 mb-3">
            <div class="col-md-7 heading-section text-center ftco-animate">
                <span class="subheading">Price &amp; Plans</span>
                <h2>Affordable Packages</h2>
            </div>
        </div>
        <div class="row">
            <!-- Loop through the packages -->
            @foreach($packages as $package)
                <div class="col-md-4 ftco-animate d-flex">
                    <div class="block-7 w-100">
                        <div class="text-center">
                            <span class="price"><sup>$</sup> <span class="number" id="price-{{ $package->id }}">{{ $package->price }}</span> <sub>/mo</sub></span>
                            <span class="excerpt d-block">For {{ $package->category }}</span>
                            <ul class="pricing-text mb-5">
                                @foreach(explode(',', $package->description) as $service)
                                    <li><span class="fa fa-check mr-2"></span>{{ $service }}</li>
                                @endforeach
                            </ul>
                            <!-- Book Now Button -->
                            <button class="btn btn-primary d-block px-2 py-3 btn-book-now" 
                                data-bs-toggle="modal" data-bs-target="#bookModal" 
                                data-price="{{ $package->price }}" data-package-id="{{ $package->id }}"
                                data-plan="{{ $package->name }}" data-category="{{ $package->category }}">Book Now</button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
<!-- Booking Modal -->
<div class="modal fade" id="bookModal" tabindex="-1" aria-labelledby="bookModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content shadow-lg border-0">
            <div class="modal-header bg-primary text-white py-3">
                <h5 class="modal-title fs-6" id="bookModalLabel">Book Your Appointment</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <form action="{{ route('appointments.store') }}" method="POST" id="bookingForm" class="needs-validation" novalidate>
                <div class="modal-body p-3">
                    @csrf
                    <!-- Hidden inputs for necessary data -->
                    <input type="hidden" id="user_id" name="user_id" value="{{ auth()->user()->id }}">
                    <input type="hidden" id="package_id" name="package_id">

                    <div class="row g-2">
                        <!-- Doctor Selection -->
                        <div class="col-12 mb-2">
                            <label for="doctor_id" class="form-label small">Select Doctor</label>
                            <select class="form-select form-select-sm" id="doctor_id" name="doctor_id" required>
                                <option value="" disabled selected>Choose a Doctor</option>
                                @foreach ($doctors as $doctor)
                                    <option value="{{ $doctor->id }}">
                                        {{ $doctor->name }} ({{ $doctor->specialization }})
                                    </option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback small">Please select a doctor</div>
                        </div>

                        <!-- Price -->
                        <div class="col-12 mb-2">
                            <label for="price" class="form-label small">Price</label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-text">$</span>
                                <input type="number" class="form-control form-control-sm" id="price" name="price" value="100" readonly>
                            </div>
                        </div>

                        <!-- Appointment Date -->
                        <div class="col-12 mb-2">
                            <label for="appointment_date" class="form-label small">Appointment Date</label>
                            <input type="datetime-local" class="form-control form-control-sm" id="appointment_date" name="appointment_date" required>
                            <div class="invalid-feedback small">Please select an appointment date</div>
                        </div>

                        <!-- Notes -->
                        <div class="col-12 mb-2">
                            <label for="notes" class="form-label small">Additional Notes</label>
                            <textarea class="form-control form-control-sm" id="notes" name="notes" rows="2" placeholder="Optional notes"></textarea>
                        </div>

                        <!-- Coupon Code -->
                        <div class="col-12 mb-2">
                            <label for="coupon_code" class="form-label small">Coupon Code</label>
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control form-control-sm" id="coupon_code" name="coupon_code" placeholder="Enter coupon code">
                                <button type="button" class="btn btn-outline-primary btn-sm" id="apply-coupon">Apply</button>
                            </div>
                        </div>

                        <!-- Coupon Notification -->
                        <div id="coupon-notification" class="col-12 mb-2" style="display: none;">
                            <div class="alert alert-success alert-sm d-flex justify-content-between align-items-center p-2">
                                <span class="small">
                                    Coupon applied! Discount: $<span id="discount-amount"></span>
                                </span>
                                <button type="button" class="btn btn-danger btn-sm" id="remove-coupon">Remove</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer py-2">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary btn-sm" id="confirmBookingBtn">Confirm</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // Store the original price when the modal opens
    let originalPrice = 0;

    document.querySelectorAll('.btn-book-now').forEach(button => {
        button.addEventListener('click', function() {
            const packagePrice = this.getAttribute('data-price');
            const packageName = this.getAttribute('data-plan');
            const packageCategory = this.getAttribute('data-category');

            // Set the hidden input fields
            document.getElementById('price').value = packagePrice;
            document.getElementById('package_id').value = this.getAttribute('data-package-id');
            originalPrice = parseFloat(packagePrice); // Store the original price
        });
    });

    // Confirm Booking on button click
    document.getElementById('confirmBookingBtn').addEventListener('click', function(e) {
        e.preventDefault(); // Prevent form submission

        // Show SweetAlert confirmation dialog
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to confirm this booking?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, confirm it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                // If confirmed, show a success message
                Swal.fire({
                    title: 'Booking Confirmed!',
                    text: "Your appointment has been successfully booked.",
                    icon: 'success',
                    confirmButtonText: 'Okay'
                }).then(() => {
                    // After "Okay" is clicked, submit the form
                    document.getElementById('bookingForm').submit();
                });
            }
        });
    });

    // Apply Coupon Functionality with SweetAlert confirmation
    document.getElementById('apply-coupon').addEventListener('click', function() {
        const couponCode = document.getElementById('coupon_code').value;
        if (couponCode === "") {
            Swal.fire("Error", "Please enter a coupon code.", "error");
            return;
        }

        // Show SweetAlert confirmation before applying the coupon
        Swal.fire({
            title: 'Apply Coupon?',
            text: "Are you sure you want to apply this coupon code?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, apply it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                // Make an AJAX request to validate the coupon
                fetch(`/check-coupon?coupon_code=${couponCode}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Apply the discount to the price
                            const discountAmount = data.discount_percentage; // Assuming this is the discount percentage
                            const newPrice = originalPrice - (originalPrice * (discountAmount / 100));

                            document.getElementById('price').value = newPrice.toFixed(2);
                            document.getElementById('discount-amount').textContent = (originalPrice - newPrice).toFixed(2);

                            // Show coupon notification
                            document.getElementById('coupon-notification').style.display = 'block';

                            // Disable the apply button and show "Remove Coupon" button
                            document.getElementById('apply-coupon').style.display = 'none';
                            document.getElementById('remove-coupon').style.display = 'inline-block';
                        } else {
                            Swal.fire("Invalid Coupon", "The coupon code is invalid or expired.", "error");
                        }
                    });
            }
        });
    });

    // Remove Coupon Functionality
    document.getElementById('remove-coupon').addEventListener('click', function() {
        // Show SweetAlert for removal confirmation
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to remove this coupon?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, remove it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                // Reset the price back to the original value
                document.getElementById('price').value = originalPrice.toFixed(2);

                // Hide the coupon notification and show the "Apply" button again
                document.getElementById('coupon-notification').style.display = 'none';
                document.getElementById('apply-coupon').style.display = 'inline-block';
                document.getElementById('remove-coupon').style.display = 'none';
            }
        });
    });
</script>

@endsection
