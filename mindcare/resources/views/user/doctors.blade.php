@extends('layouts.usermain')
@section('content')
    <section class="hero-wrap hero-wrap-2" style="background-image: url('{{ asset('images/bg_5.jpg') }}');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text align-items-end justify-content-center">
          <div class="col-md-9 ftco-animate mb-5 text-center">
          	<p class="breadcrumbs mb-0"><span class="mr-2"><a href="index.html">Home <i class="fa fa-chevron-right"></i></a></span> <span>Counselor <i class="fa fa-chevron-right"></i></span></p>
            <h1 class="mb-0 bread">Qualified Counselor</h1>
          </div>
        </div>
      </div>
    </section>
    <section class="ftco-section bg-light py-5">
    <div class="container">
        <div class="row g-4">
            @foreach ($doctors as $doctor)
                <div class="col-md-6 col-lg-3">
                    <div class="doctor-card h-100">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="img-wrapper">
                                <div class="doctor-image" 
                                    style="background-image: url('{{ asset('images/' . $doctor->image) }}')" 
                                    data-id="{{ $doctor->id }}" 
                                    data-name="{{ $doctor->name }}"
                                    data-specialization="{{ $doctor->specialization }}"
                                    data-image="{{ asset('images/' . $doctor->image) }}">
                                </div>
                            </div>
                            <div class="card-body text-center">
                                <h3 class="card-title mb-2">{{ $doctor->name }}</h3>
                                <span class="position d-block mb-3">{{ $doctor->specialization }}</span>
                                <div class="faded">
                                    <p class="card-text bio-text">{{ $doctor->bio }}</p>
                                    <div class="social-icons mt-3">
                                        <a href="#" class="social-icon"><i class="fa fa-twitter"></i></a>
                                        <a href="#" class="social-icon"><i class="fa fa-facebook"></i></a>
                                        <a href="#" class="social-icon"><i class="fa fa-google"></i></a>
                                        <a href="#" class="social-icon"><i class="fa fa-instagram"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="doctorModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-bottom-0">
                    <h5 class="modal-title" id="doctorName"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                <div class="modal-body">
                    <div class="doctor-profile mb-4">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <img id="doctorImage" src="" alt="Doctor" class="doctor-modal-image">
                            </div>
                            <div class="col">
                                <p id="doctorSpecialization" class="position mb-0"></p>
                            </div>
                        </div>
                    </div>
                    <h5 class="reviews-title mb-3">Reviews</h5>
                    <div id="doctorReviews" class="reviews-container">
                        <!-- Reviews will be loaded here -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
/* Custom styling with original colors */
.doctor-card {
    transition: transform 0.3s ease;
}

.doctor-card:hover {
    transform: translateY(-10px);
}

.img-wrapper {
    height: 280px;
    overflow: hidden;
    border-radius: 8px 8px 0 0;
}

.doctor-image {
    width: 100%;
    height: 100%;
    background-size: cover;
    background-position: center;
    transition: transform 0.5s ease;
    cursor: pointer;
}

.doctor-image:hover {
    transform: scale(1.1);
}

.card {
    border-radius: 8px;
    overflow: hidden;
}

.card-title {
    font-size: 1.25rem;
    font-weight: 600;
}

.position {
    color: #01d28e;
    font-weight: 500;
    font-size: 0.95rem;
}

.bio-text {
    color: #808080;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
    font-size: 0.9rem;
}

.social-icons {
    display: flex;
    justify-content: center;
    gap: 15px;
}

.social-icon {
    width: 35px;
    height: 35px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background-color: rgba(1, 210, 142, 0.1);
    border-radius: 50%;
    color: #01d28e;
    text-decoration: none;
    transition: all 0.3s ease;
}

.social-icon:hover {
    background-color: #01d28e;
    color: white;
    transform: translateY(-3px);
}

/* Modal styling */
.modal-content {
    border: none;
    border-radius: 12px;
}

.modal-header {
    padding: 1.5rem;
}

.modal-title {
    font-weight: 600;
}

.doctor-modal-image {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    object-fit: cover;
    border: 4px solid rgba(1, 210, 142, 0.1);
}

.reviews-title {
    font-weight: 600;
}

.reviews-container {
    max-height: 400px;
    overflow-y: auto;
}

.review-item {
    background-color: #f8f9fa;
    border-radius: 8px;
    padding: 1rem;
    margin-bottom: 1rem;
    transition: all 0.3s ease;
}

.review-item:hover {
    box-shadow: 0 3px 10px rgba(0,0,0,0.1);
}

.star-rating {
    color: #FFD700;
    font-size: 1rem;
}

.star-empty {
    color: #e9ecef;
}

/* Loading animation */
.loading-spinner {
    text-align: center;
    padding: 2rem;
    color: #01d28e;
}

.spinner-border {
    color: #01d28e !important;
}

/* Faded effect for bio */
.faded {
    opacity: 0.8;
    transition: opacity 0.3s ease;
}

.doctor-card:hover .faded {
    opacity: 1;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .img-wrapper {
        height: 240px;
    }
    
    .modal-dialog {
        margin: 1rem;
    }
}
</style>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const doctorImages = document.querySelectorAll('.doctor-image');
    const modal = new bootstrap.Modal(document.getElementById('doctorModal'));

    function createStarRating(rating) {
        let stars = '';
        for (let i = 1; i <= 5; i++) {
            if (i <= rating) {
                stars += '<i class="fas fa-star star-rating"></i>';
            } else {
                stars += '<i class="fas fa-star star-empty"></i>';
            }
        }
        return stars;
    }

    doctorImages.forEach(image => {
        image.addEventListener('click', async function() {
            const doctorId = this.getAttribute('data-id');
            const doctorName = this.getAttribute('data-name');
            const doctorSpecialization = this.getAttribute('data-specialization');
            const doctorImage = this.getAttribute('data-image');

            // Update modal content
            document.getElementById('doctorName').textContent = doctorName;
            document.getElementById('doctorSpecialization').textContent = doctorSpecialization;
            document.getElementById('doctorImage').src = doctorImage;

            // Show modal
            modal.show();

            // Load reviews
            const reviewsContainer = document.getElementById('doctorReviews');
            reviewsContainer.innerHTML = `
                <div class="loading-spinner">
                    <div class="spinner-border" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            `;

            try {
                const response = await fetch(`/api/doctors/${doctorId}/reviews`);
                const data = await response.json();
                
                if (data.reviews.length > 0) {
                    reviewsContainer.innerHTML = data.reviews.map(review => `
                        <div class="review-item">
                            <div class="d-flex align-items-center mb-2">
                                <div class="star-rating-container me-2">
                                    ${createStarRating(review.rating)}
                                </div>
                                <span class="text-muted">(${review.rating}/5)</span>
                            </div>
                            <p class="mb-0">${review.comments}</p>
                        </div>
                    `).join('');
                } else {
                    reviewsContainer.innerHTML = `
                        <div class="text-center text-muted py-4">
                            No reviews yet for this doctor.
                        </div>
                    `;
                }
            } catch (error) {
                console.error('Error fetching reviews:', error);
                reviewsContainer.innerHTML = `
                    <div class="alert alert-danger" role="alert">
                        Failed to load reviews. Please try again later.
                    </div>
                `;
            }
        });
    });
});
</script>