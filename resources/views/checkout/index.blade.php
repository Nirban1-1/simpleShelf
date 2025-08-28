@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/checkout.css') }}">

<style>
    body {
        background: url('{{ asset("images/bg-images/checkout-bg.jpg") }}') no-repeat center center fixed;
        background-size: cover;
    }

    body::before {
        content: "";
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(255, 255, 255, 0.20);
        z-index: -1;
    }

    .payment-logo {
        height: 25px;
        margin-right: 8px;
    }

    .dropdown-option {
        display: flex;
        align-items: center;
    }
</style>

<div class="checkout-wrapper">
    <div class="container my-5">
        <div class="row">
            <!-- Delivery Details Form -->
            <div class="col-md-7">
                <div class="card shadow-sm p-4 mb-4">
                    <h4 class="mb-3">Delivery Details</h4>
                    <form action="{{ route('book.order.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label">Delivery Address</label>
                            <textarea name="address" id="address" class="form-control" rows="3" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="contact" class="form-label">Contact Number</label>
                            <input type="text" name="contact" id="contact" class="form-control" required>
                        </div>

                        <!-- ============================= -->
                        <!-- Payment Options -->
                        <!-- ============================= -->
                        <div class="mb-3">
                            <label class="form-label">Payment Method</label>

                            <!-- COD -->
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="payment_method" id="cod" value="cod" checked>
                                <label class="form-check-label" for="cod">Cash on Delivery</label>
                            </div>

                            <!-- Online Transaction -->
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="payment_method" id="online" value="online">
                                <label class="form-check-label" for="online">Online Transaction</label>
                            </div>
                            <div id="online-dropdown" class="ms-3 d-none">
                                <select class="form-select mt-2" name="online_option">
                                    <option disabled selected>-- Select Online Method --</option>
                                    <option value="bkash">📱 bKash</option>
                                    <option value="nagad">💳 Nagad</option>
                                    <option value="rocket">🚀 Rocket</option>
                                </select>
                            </div>

                            <!-- Card Payment -->
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="payment_method" id="card" value="card">
                                <label class="form-check-label" for="card">Card Payment</label>
                            </div>
                            <div id="card-dropdown" class="ms-3 d-none">
                                <select class="form-select mt-2" name="card_option">
                                    <option disabled selected>-- Select Card Type --</option>
                                    <option value="visa">💳 Visa</option>
                                    <option value="mastercard">💳 MasterCard</option>
                                    <option value="debit">💳 Debit Card</option>
                                    <option value="credit">💳 Credit Card</option>
                                    <option value="amex">💳 American Express</option>
                                </select>
                            </div>
                        </div>
                        <div class="mt-2 d-flex gap-2"> 
                            <img src="{{ asset('images/cards/debit.png') }}" alt="Debit" style="height:30px;"> 
                            <img src="{{ asset('images/cards/visa.png') }}" alt="Visa" style="height:30px;"> 
                            <img src="{{ asset('images/cards/mastercard.png') }}" alt="MasterCard" style="height:30px;"> 
                            <img src="{{ asset('images/cards/credit.png') }}" alt="Credit" style="height:30px;"> </div>

                        <!-- ============================= -->
                        <!-- Checkout Summary -->
                        <!-- ============================= -->
                        <div class="col-md-5">
                            <div class="card shadow-sm p-4">
                                <h4 class="mb-3">Checkout Summary</h4>
                                <ul class="list-unstyled">
                                    <li>Subtotal: <strong>${{ $subtotal ?? 0 }}</strong></li>
                                    <li>Delivery: <strong>${{ $delivery ?? 0 }}</strong></li>
                                    <li>Service Charge: <strong>${{ $serviceCharge ?? 0 }}</strong></li>
                                    <li>Discount: <strong>- ${{ $discount ?? 0 }}</strong></li>
                                </ul>
                                <hr>
                                <h5>Total Payable: <strong>${{ $total ?? 0 }}</strong></h5>

                                <div class="d-grid mt-3">
                                    

                                    <button type="submit" class="btn btn-success btn-lg">Confirm & Pay</button>
   
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JS for dropdown toggle -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const onlineRadio = document.getElementById("online");
        const cardRadio = document.getElementById("card");
        const codRadio = document.getElementById("cod");

        const onlineDropdown = document.getElementById("online-dropdown");
        const cardDropdown = document.getElementById("card-dropdown");

        function toggleDropdowns() {
            onlineDropdown.classList.add("d-none");
            cardDropdown.classList.add("d-none");

            if (onlineRadio.checked) {
                onlineDropdown.classList.remove("d-none");
            }
            if (cardRadio.checked) {
                cardDropdown.classList.remove("d-none");
            }
        }

        [onlineRadio, cardRadio, codRadio].forEach(radio => {
            radio.addEventListener("change", toggleDropdowns);
        });

        toggleDropdowns(); // run on load
    });
</script>
@endsection
