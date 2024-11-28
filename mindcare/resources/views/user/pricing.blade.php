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
            <!-- Pricing Card -->
            @foreach(['Adults' => 49, 'Children' => 79, 'Business' => 109] as $plan => $price)
                <div class="col-md-4 ftco-animate d-flex">
                    <div class="block-7 w-100">
                        <div class="text-center">
                            <span class="price"><sup>$</sup> <span class="number" id="price-{{ $plan }}">{{ $price }}</span> <sub>/mo</sub></span>
                            <span class="excerpt d-block">For {{ $plan }}</span>
                            <ul class="pricing-text mb-5">
                                @if($plan == 'Adults')
                                    <li><span class="fa fa-check mr-2"></span>Individual Counseling</li>
                                    <li><span class="fa fa-check mr-2"></span>Couples Therapy</li>
                                    <li><span class="fa fa-check mr-2"></span>Family Therapy</li>
                                @elseif($plan == 'Children')
                                    <li><span class="fa fa-check mr-2"></span>Counseling for Children</li>
                                    <li><span class="fa fa-check mr-2"></span>Behavioral Management</li>
                                    <li><span class="fa fa-check mr-2"></span>Educational Counseling</li>
                                @else
                                    <li><span class="fa fa-check mr-2"></span>Consultancy Services</li>
                                    <li><span class="fa fa-check mr-2"></span>Employee Counseling</li>
                                    <li><span class="fa fa-check mr-2"></span>Psychological Assessment</li>
                                @endif
                            </ul>
                            <!-- Book Now Button -->
                            <button class="btn btn-primary d-block px-2 py-3" data-bs-toggle="modal" data-bs-target="#bookModal" 
                                data-price="{{ $price }}" data-plan="{{ $plan }}">Book Now</button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
<!-- Booking Modal -->
<div class="modal fade" id="bookModal" tabindex="-1" aria-labelledby="bookModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md"> <!-- Set to medium modal for slightly bigger size -->
        <div class="modal-content">
            <form action="{{ route('user.bookAppointment') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="bookModalLabel">Book Your Appointment</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="price">Price</label>
                        <input type="number" class="form-control" id="price" name="price" value="100" readonly>
                    </div>

                    <div class="form-group mb-3">
                        <label for="coupon_code">Coupon Code</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="coupon_code" name="coupon_code" placeholder="Enter coupon code">
                            <button type="button" class="btn btn-primary" id="apply-coupon">Apply</button> <!-- Change to btn-primary -->
                        </div>
                    </div>

                    <!-- Notification for coupon application -->
                    <div id="coupon-notification" class="alert alert-success mt-3" style="display: none;">
                        Coupon applied successfully! Discount: $<span id="discount-amount"></span>
                        <button type="button" class="btn btn-danger btn-sm" id="remove-coupon">Remove Coupon</button>
                    </div>

                    <div class="form-group mb-3">
                        <label for="discount_amount">Discount Amount</label>
                        <input type="number" class="form-control" id="discount_amount" name="discount_amount" readonly>
                    </div>

                    <div class="form-group mb-3">
                        <label for="appointment_date">Appointment Date</label>
                        <input type="datetime-local" class="form-control" id="appointment_date" name="appointment_date" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="notes">Notes</label>
                        <textarea class="form-control" id="notes" name="notes" rows="3"></textarea>
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary w-100">Book Now</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
// Populate Modal with Price Data
document.querySelectorAll('[data-bs-target="#bookModal"]').forEach(button => {
    button.addEventListener('click', event => {
        const modal = document.querySelector('#bookModal');
        const price = button.getAttribute('data-price');
        const plan = button.getAttribute('data-plan');
        
        // Set the modal input with the price and save the original price
        modal.querySelector('#price').value = price;
        modal.querySelector('#price').setAttribute('data-original-price', price);
        modal.querySelector('#discount_amount').value = 0; // Reset discount
        
        // Reset the coupon notification
        document.getElementById('coupon-notification').style.display = 'none';
        document.getElementById('apply-coupon').style.display = 'inline-block'; // Show apply button
    });
});

// Apply Coupon
document.getElementById('apply-coupon').addEventListener('click', function() {
    const couponCode = document.getElementById('coupon_code').value;
    const price = parseFloat(document.getElementById('price').value);
    const originalPrice = parseFloat(document.querySelector('#price').getAttribute('data-original-price'));

    // Make an AJAX request to check if the coupon is valid
    fetch(`/check-coupon?coupon_code=${couponCode}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Coupon is valid, apply discount
                const discountPercentage = data.discount_percentage / 100; // Convert to decimal
                const discountAmount = originalPrice * discountPercentage; // Use original price to calculate discount
                const finalPrice = originalPrice - discountAmount;

                // Update the discount and price
                document.getElementById('discount_amount').value = discountAmount.toFixed(2);
                document.getElementById('price').value = finalPrice.toFixed(2); // Show final price after discount

                // SweetAlert Success
                Swal.fire({
                    icon: 'success',
                    title: 'Coupon Applied!',
                    text: `Discount: $${discountAmount.toFixed(2)}`,
                    confirmButtonText: 'OK'
                });

                // Hide Apply Coupon button after it is applied
                document.getElementById('apply-coupon').style.display = 'none';

                // Show success notification with the applied discount
                document.getElementById('coupon-notification').style.display = 'block';
                document.getElementById('discount-amount').textContent = discountAmount.toFixed(2);
            } else {
                // SweetAlert Error
                Swal.fire({
                    icon: 'error',
                    title: 'Invalid Coupon Code!',
                    text: data.message || "Please try again.",
                    confirmButtonText: 'OK'
                });
            }
        })
        .catch(error => {
            console.error('Error verifying coupon:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: "There was an error verifying the coupon code.",
                confirmButtonText: 'OK'
            });
        });
});

// Remove Coupon
document.getElementById('remove-coupon').addEventListener('click', function() {
    // Get the original price dynamically from the modal input
    const originalPrice = parseFloat(document.querySelector('#price').getAttribute('data-original-price'));

    // Reset the price and discount
    document.getElementById('price').value = originalPrice.toFixed(2);
    document.getElementById('discount_amount').value = 0;

    // Hide coupon notification
    document.getElementById('coupon-notification').style.display = 'none';
    document.getElementById('coupon_code').value = ''; // Clear coupon code input

    // Show Apply Coupon button again
    document.getElementById('apply-coupon').style.display = 'inline-block';

    // SweetAlert Success for coupon removal
    Swal.fire({
        icon: 'success',
        title: 'Coupon Removed!',
        text: 'Your coupon has been removed and the original price is restored.',
        confirmButtonText: 'OK'
    });
});


</script>



@endsection