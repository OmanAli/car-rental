<!-- RentNow Popup -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Booking Form</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="booking-box">
                    <div class="booking-inner clearfix">
                        @auth
                            <form method="POST" action="{{ route('myRequests.store') }}"
                                class="form1 contact__form clearfix booking-form">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6 col-md-12">
                                        <div class="select1_wrapper">
                                            <label>Choose Car</label>
                                            <div class="select1_inner">
                                                <select class="select2 select rent-modal-car" name="car_id"
                                                    style="width: 100%" required>
                                                    <option value="">Choose Car</option>
                                                    @foreach (($rentModalCars ?? collect()) as $modalCar)
                                                        <option value="{{ $modalCar->id }}">
                                                            {{ $modalCar->make }} {{ $modalCar->model }}
                                                            ({{ $modalCar->registration_number }})
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <div class="select1_wrapper">
                                            <label>Delivery Type</label>
                                            <div class="select1_inner">
                                                <select
                                                    class="select2 select delivery-type-select"
                                                    name="delivery_type" style="width: 100%" required>
                                                    <option value="">Choose Delivery Type</option>
                                                    <option value="pickup">Pickup</option>
                                                    <option value="delivery">Delivery</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 delivery-location-wrapper" style="display: none;">
                                        <div class="input1_wrapper">
                                            <label>Delivery Location (for Delivery only)</label>
                                            <div class="input1_inner">
                                                <input type="text" name="delivery_location"
                                                    class="form-control input delivery-location-input"
                                                    placeholder="Delivery Location">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <div class="input1_wrapper">
                                            <label>Pick Up Date</label>
                                            <div class="input1_inner">
                                                <input type="text" name="pickup_date"
                                                    class="form-control input datepicker"
                                                    placeholder="Pick Up Date" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <div class="input1_wrapper">
                                            <label>Drop Date</label>
                                            <div class="input1_inner">
                                                <input type="text" name="drop_date"
                                                    class="form-control input datepicker"
                                                    placeholder="Drop Date" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <button type="submit" class="booking-button mt-15">Rent Now</button>
                                    </div>
                                </div>
                            </form>
                        @endauth

                        @guest
                            <div class="text-center p-3">
                                <div class="alert alert-warning d-inline-block">
                                    Please <a href="{{ route('login') }}" class="alert-link">login</a> to book a car.
                                </div>
                            </div>
                        @endguest
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .delivery-location-wrapper .input1_inner::before,
    .delivery-location-wrapper .input1_inner::after,
    .delivery-location-wrapper .input1_wrapper::before,
    .delivery-location-wrapper .input1_wrapper::after {
        content: none !important;
        display: none !important;
        background: none !important;
    }
    .delivery-location-wrapper .input1_inner {
        background-image: none !important;
    }
    .delivery-location-wrapper .delivery-location-input {
        background-image: none !important;
        padding-right: 15px !important;
    }
</style>

<script>
    window.addEventListener('load', function () {
        // Toggle delivery-location field on any booking form
        document.querySelectorAll('.booking-form').forEach(function (form) {
            var typeSelect = form.querySelector('.delivery-type-select');
            var wrapper    = form.querySelector('.delivery-location-wrapper');
            var locInput   = form.querySelector('.delivery-location-input');
            if (!typeSelect || !wrapper || !locInput) return;

            function toggleLocation() {
                if (typeSelect.value === 'delivery') {
                    wrapper.style.display = '';
                    locInput.required = true;
                } else {
                    wrapper.style.display = 'none';
                    locInput.required = false;
                    locInput.value = '';
                }
            }
            typeSelect.addEventListener('change', toggleLocation);
            if (window.jQuery) { jQuery(typeSelect).on('change', toggleLocation); }
            toggleLocation();
        });

        // Auto-scroll to booking section after submit
        var bookingSection = document.getElementById('booking');
        if (bookingSection && bookingSection.querySelector('.alert')) {
            setTimeout(function () {
                bookingSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }, 150);
        }

        // Preselect car when modal opened from a "Rent Now" button that has data-car-id
        var modal = document.getElementById('exampleModal');
        if (modal) {
            modal.addEventListener('show.bs.modal', function (event) {
                var trigger = event.relatedTarget;
                if (!trigger) return;
                var carId = trigger.getAttribute('data-car-id');
                if (!carId) return;
                var select = modal.querySelector('.rent-modal-car');
                if (!select) return;
                select.value = carId;
                if (window.jQuery && jQuery(select).hasClass('select2-hidden-accessible')) {
                    jQuery(select).trigger('change');
                }
            });
        }
    });
</script>
