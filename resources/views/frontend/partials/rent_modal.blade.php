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
                                <input type="hidden" name="booking_source" value="modal">
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
                                        <div class="select1_wrapper">
                                            <label>Rental Type</label>
                                            <div class="select1_inner">
                                                <select class="select2 select rental-type-select"
                                                    name="rental_type" style="width: 100%" required>
                                                    <option value="daily" selected>Daily</option>
                                                    <option value="weekly">Weekly</option>
                                                    <option value="uber_lyft_weekly" class="uber-lyft-option" disabled>Uber/Lyft Weekly</option>
                                                </select>
                                            </div>
                                            @error('rental_type')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <div class="input1_wrapper">
                                            <label>Coupon Code</label>
                                            <div class="input1_inner">
                                                <input type="text" name="coupon_code"
                                                    class="form-control input discount-input @error('coupon_code') is-invalid @enderror"
                                                    placeholder="Coupon Code" style="text-transform: uppercase;"
                                                    value="{{ old('coupon_code') }}">
                                            </div>
                                            @error('coupon_code')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <div class="input1_wrapper">
                                            <label>Veteran ID</label>
                                            <div class="input1_inner">
                                                <input type="text" name="veteran_id"
                                                    class="form-control input discount-input @error('veteran_id') is-invalid @enderror"
                                                    placeholder="Veteran ID" value="{{ old('veteran_id') }}">
                                            </div>
                                            @error('veteran_id')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                            @enderror
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

<!-- Booking Confirmation Popup -->
<div class="modal fade" id="bookingConfirmModal" tabindex="-1" aria-labelledby="bookingConfirmModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bookingConfirmModalLabel">Confirm Your Booking</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-borderless mb-0">
                    <tbody>
                        <tr><td>Car</td><td class="text-end" id="bcCar"></td></tr>
                        <tr><td>Pick Up Date</td><td class="text-end" id="bcPickup"></td></tr>
                        <tr><td>Drop Date</td><td class="text-end" id="bcDrop"></td></tr>
                        <tr><td>Delivery</td><td class="text-end" id="bcDelivery"></td></tr>
                        <tr><td>Rental Type</td><td class="text-end" id="bcType"></td></tr>
                        <tr><td>Estimated Rent</td><td class="text-end" id="bcAmount"></td></tr>
                        <tr id="bcDiscountRow" style="display: none;">
                            <td>Estimated Discounted Rent</td>
                            <td class="text-end text-success" id="bcDiscountAmount"></td>
                        </tr>
                    </tbody>
                </table>
                <div id="bcDiscountNote" class="alert alert-warning mt-3 mb-0" style="display: none; font-size: 13px;"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Edit Details</button>
                <button type="button" class="btn btn-success" id="bcConfirmSubmit">Confirm Booking</button>
            </div>
        </div>
    </div>
</div>

@php
    $carRatesForJs = [];
    foreach (($rentModalCars ?? collect()) as $modalCar) {
        $carRatesForJs[$modalCar->id] = [
            'name' => trim($modalCar->make . ' ' . $modalCar->model),
            'daily' => (float) $modalCar->rental_price_per_day,
            'weekly' => $modalCar->weekly_rate !== null ? (float) $modalCar->weekly_rate : null,
            'uberLyft' => $modalCar->uber_lyft_weekly_rate !== null ? (float) $modalCar->uber_lyft_weekly_rate : null,
        ];
    }
@endphp
<script>
    window.CAR_RATES = @json($carRatesForJs);
</script>

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
    .delivery-location-wrapper .delivery-location-input:disabled {
        background-color: #f5f5f5 !important;
        color: #aaa !important;
        cursor: not-allowed;
    }
    .select2-results__option[aria-disabled="true"] {
        color: #aaa !important;
        text-decoration: line-through;
        cursor: not-allowed !important;
        background: #f9f9f9 !important;
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

            var staticToggle = wrapper.hasAttribute('data-static-toggle');

            function toggleLocation() {
                var isDelivery = typeSelect.value === 'delivery';
                if (staticToggle) {
                    locInput.disabled = !isDelivery;
                    locInput.required = isDelivery;
                    if (!isDelivery) { locInput.value = ''; }
                } else if (isDelivery) {
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

        // Show "Uber/Lyft Weekly" as a rental-type option only when the selected car has that rate
        document.querySelectorAll('.booking-form').forEach(function (form) {
            var carSelect = form.querySelector('select[name=car_id]');
            var typeSelect = form.querySelector('.rental-type-select');
            if (!carSelect || !typeSelect) return;

            var uberOption = typeSelect.querySelector('.uber-lyft-option');
            if (!uberOption) return;

            var uberOptionBaseLabel = uberOption.textContent;

            function refreshRentalTypeOptions() {
                var rates = window.CAR_RATES && window.CAR_RATES[carSelect.value];
                var hasUberLyft = !!(rates && rates.uberLyft !== null && rates.uberLyft !== undefined);
                uberOption.disabled = !hasUberLyft;
                uberOption.textContent = hasUberLyft
                    ? uberOptionBaseLabel
                    : uberOptionBaseLabel + ' — not available for this car';
                if (!hasUberLyft && typeSelect.value === 'uber_lyft_weekly') {
                    typeSelect.value = 'daily';
                }
                if (window.jQuery && jQuery(typeSelect).hasClass('select2-hidden-accessible')) {
                    jQuery(typeSelect).trigger('change');
                }
            }
            carSelect.addEventListener('change', refreshRentalTypeOptions);
            if (window.jQuery) { jQuery(carSelect).on('change', refreshRentalTypeOptions); }
            refreshRentalTypeOptions();
        });

        // Coupon code and Veteran ID are mutually exclusive — using one disables the other
        document.querySelectorAll('.booking-form').forEach(function (form) {
            var discountInputs = form.querySelectorAll('.discount-input');
            if (discountInputs.length < 2) return;

            function syncDiscountInputs(e) {
                var active = e.target;
                discountInputs.forEach(function (input) {
                    if (input === active) return;
                    input.disabled = active.value.trim().length > 0;
                    if (input.disabled) { input.value = ''; }
                });
            }
            discountInputs.forEach(function (input) {
                input.addEventListener('input', syncDiscountInputs);
            });
        });

        // Review-and-confirm step: intercept submit, show computed pricing, then let the
        // user confirm before the real POST goes through.
        var bcModalEl = document.getElementById('bookingConfirmModal');
        var bcModal = bcModalEl ? new bootstrap.Modal(bcModalEl) : null;
        var pendingForm = null;

        function calcBookingDays(pickup, drop) {
            var p = new Date(pickup), d = new Date(drop);
            if (isNaN(p) || isNaN(d)) return 1;
            return Math.max(1, Math.round((d - p) / 86400000));
        }

        function openBookingConfirm(form) {
            pendingForm = form;

            var carSelect = form.querySelector('select[name=car_id]');
            var rates = window.CAR_RATES && window.CAR_RATES[carSelect.value];
            var carName = rates ? rates.name : (carSelect.options[carSelect.selectedIndex] || {}).text || '';

            var pickup = form.querySelector('input[name=pickup_date]').value;
            var drop = form.querySelector('input[name=drop_date]').value;
            var deliveryType = form.querySelector('select[name=delivery_type]').value;
            var deliveryLocationInput = form.querySelector('input[name=delivery_location]');
            var rentalType = form.querySelector('.rental-type-select').value;

            var days = calcBookingDays(pickup, drop);
            var weeks = Math.ceil(days / 7);
            var amount = 0;
            var typeLabel = 'Daily';
            if (rentalType === 'weekly') {
                amount = ((rates && rates.weekly) || 0) * weeks;
                typeLabel = 'Weekly (' + weeks + ' week' + (weeks > 1 ? 's' : '') + ')';
            } else if (rentalType === 'uber_lyft_weekly') {
                amount = ((rates && rates.uberLyft) || 0) * weeks;
                typeLabel = 'Uber/Lyft Weekly (' + weeks + ' week' + (weeks > 1 ? 's' : '') + ')';
            } else {
                amount = ((rates && rates.daily) || 0) * days;
                typeLabel = 'Daily (' + days + ' day' + (days > 1 ? 's' : '') + ')';
            }

            document.getElementById('bcCar').textContent = carName;
            document.getElementById('bcPickup').textContent = pickup;
            document.getElementById('bcDrop').textContent = drop;
            document.getElementById('bcDelivery').textContent = deliveryType === 'delivery'
                ? ('Delivery — ' + (deliveryLocationInput && !deliveryLocationInput.disabled ? deliveryLocationInput.value : ''))
                : 'Self Pickup';
            document.getElementById('bcType').textContent = typeLabel;
            document.getElementById('bcAmount').textContent = '$' + amount.toFixed(2);

            var discountRow = document.getElementById('bcDiscountRow');
            var discountNote = document.getElementById('bcDiscountNote');
            discountRow.style.display = 'none';
            discountNote.style.display = 'none';

            var couponInput = form.querySelector('input[name=coupon_code]');
            var veteranInput = form.querySelector('input[name=veteran_id]');
            var couponVal = couponInput && !couponInput.disabled ? couponInput.value.trim() : '';
            var veteranVal = veteranInput && !veteranInput.disabled ? veteranInput.value.trim() : '';

            if (couponVal || veteranVal) {
                var params = couponVal
                    ? ('coupon_code=' + encodeURIComponent(couponVal))
                    : ('veteran_id=' + encodeURIComponent(veteranVal));

                fetch('{{ route("myRequests.previewDiscount") }}?' + params)
                    .then(function (r) { return r.json(); })
                    .then(function (data) {
                        if (data.valid) {
                            var discounted = amount - (amount * data.percentage / 100);
                            document.getElementById('bcDiscountAmount').textContent = '$' + discounted.toFixed(2);
                            discountRow.style.display = '';
                            discountNote.textContent = 'Discounted prices are subject to the validity of the coupon/veteran ID used and will be finalized by management.';
                        } else {
                            discountNote.textContent = 'The coupon/veteran ID entered could not be pre-validated — it will be checked when your request is submitted.';
                        }
                        discountNote.style.display = '';
                        bcModal.show();
                    })
                    .catch(function () { bcModal.show(); });
            } else {
                bcModal.show();
            }
        }

        document.querySelectorAll('.booking-form').forEach(function (form) {
            form.addEventListener('submit', function (e) {
                if (form.dataset.confirmed === '1') { return; }
                if (!form.checkValidity()) { form.reportValidity(); return; }
                e.preventDefault();
                openBookingConfirm(form);
            });
        });

        var bcConfirmBtn = document.getElementById('bcConfirmSubmit');
        if (bcConfirmBtn) {
            bcConfirmBtn.addEventListener('click', function () {
                if (!pendingForm) return;
                var form = pendingForm;

                bcConfirmBtn.disabled = true;

                // The review step can leave the form open long enough for its CSRF token
                // to go stale, so fetch a fresh one right before the real submit.
                fetch('{{ route("myRequests.refreshCsrfToken") }}', { credentials: 'same-origin' })
                    .then(function (r) { return r.json(); })
                    .then(function (data) {
                        var tokenInput = form.querySelector('input[name=_token]');
                        if (tokenInput && data.token) { tokenInput.value = data.token; }
                    })
                    .catch(function () { /* fall back to the token already in the form */ })
                    .finally(function () {
                        form.dataset.confirmed = '1';
                        bcModal.hide();
                        form.submit();
                    });
            });
        }

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

        @if (old('booking_source') === 'modal' && ($errors->has('coupon_code') || $errors->has('veteran_id') || $errors->has('rental_type') || $errors->has('car_id') || $errors->has('pickup_date') || $errors->has('drop_date') || $errors->has('delivery_type') || $errors->has('delivery_location')))
            if (modal && window.bootstrap) {
                new bootstrap.Modal(modal).show();
            }
        @endif
    });
</script>
