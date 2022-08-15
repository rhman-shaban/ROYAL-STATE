@extends('layouts.user.layout')
@section('title')
    <title>{{ $websiteLang->where('lang_key','payment')->first()->custom_text }}</title>
@endsection
@section('meta')
    <meta name="description" content="lorem ipsum">
@endsection

@section('user-content')

    <!--============================
          BREADCRUMB PART START
    ==============================-->
    <section id="wsus__breadcrumb" style="background-image:url({{ url($banner_image->image) }})">
        <div class="wsus_bread_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center">
                        <h4>{{ $websiteLang->where('lang_key','payment')->first()->custom_text }}</h4>
                        <nav style="--bs-breadcrumb-divider: '-';" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ $menus->where('id',1)->first()->navbar }}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ $websiteLang->where('lang_key','payment')->first()->custom_text }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================
          BREADCRUMB PART END
    ==============================-->

    <!--==========================
         CHECKOUT PART START
    ===========================-->
    <section id="wsus__checkout">
        <div class="container">
            <div class="row">
                <div class="col-xl-5 col-lg-6">
                    <div class="wsus__billing_info">
                        <h4><i class="fas fa-credit-card-front"></i> {{ $websiteLang->where('lang_key','payment_method')->first()->custom_text }}</h4>
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">

                            @if ($paymentSetting->stripe_status==1)
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">
                                    {{ $websiteLang->where('lang_key','stripe')->first()->custom_text }}
                                </button>
                            </li>
                            @endif

                            @if ($paymentSetting->paypal_status==1)
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">{{ $websiteLang->where('lang_key','paypal')->first()->custom_text }}</button>
                            </li>
                            @endif

                            @if ($razorpay->razorpay_status==1)
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="razorpay_payment_tab" data-bs-toggle="pill" data-bs-target="#razorpay_payment" type="button" role="tab" aria-controls="bank_payment" aria-selected="false">{{ $websiteLang->where('lang_key','razorpay')->first()->custom_text }}</button>
                            </li>
                            @endif

                            @if ($flutterwave->status == 1)
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="flutterwave_payment_tab" data-bs-toggle="pill" data-bs-target="#flutterwave_payment" type="button" role="tab" aria-controls="flutterwave_payment" aria-selected="false">{{ $websiteLang->where('lang_key','flutterwave')->first()->custom_text }}</button>
                            </li>
                            @endif

                            @if ($paystack->paystack_status == 1)
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="paystack_payment_tab" data-bs-toggle="pill" data-bs-target="#paystack_payment" type="button" role="tab" aria-controls="paystack_payment" aria-selected="false">{{ $websiteLang->where('lang_key','paystack')->first()->custom_text }}</button>
                            </li>
                            @endif

                            @if ($mollie->mollie_status == 1)
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="mollie_payment_tab" data-bs-toggle="pill" data-bs-target="#mollie_payment" type="button" role="tab" aria-controls="mollie_payment" aria-selected="false">{{ $websiteLang->where('lang_key','mollie')->first()->custom_text }}</button>
                            </li>
                            @endif

                            @if ($instamojo->status == 1)
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="instamojo_payment_tab" data-bs-toggle="pill" data-bs-target="#instamojo_payment" type="button" role="tab" aria-controls="instamojo_payment" aria-selected="false">{{ $websiteLang->where('lang_key','instamojo')->first()->custom_text }}</button>
                            </li>
                            @endif

                            @if ($paymongo->status == 1)
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="paymongo_payment_tab" data-bs-toggle="pill" data-bs-target="#paymongo_payment" type="button" role="tab" aria-controls="paymongo_payment" aria-selected="false">{{ $websiteLang->where('lang_key','paymongo')->first()->custom_text }}</button>
                            </li>
                            @endif







                            @if ($paymentSetting->bank_status==1)
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="bank_payment_tab" data-bs-toggle="pill" data-bs-target="#bank_payment" type="button" role="tab" aria-controls="bank_payment" aria-selected="false">{{ $websiteLang->where('lang_key','bank_payment')->first()->custom_text }}</button>
                            </li>
                            @endif

                        </ul>
                        <div class="tab-content" id="pills-tabContent">

                            @if ($paymentSetting->stripe_status==1)
                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                <div class="row">
                                    <div class="col-12">
                                        <form role="form" action="{{ route('user.stripe.payment',$package->id) }}" method="POST" class="require-validation"
                                                data-cc-on-file="false"
                                                data-stripe-publishable-key="{{ $stripe->stripe_key }}"
                                                id="payment-form">
                                                @csrf

                                            <div class="wsus__single_card">

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <label for="#">{{ $websiteLang->where('lang_key','card_number')->first()->custom_text }}</label>
                                                        <input type="text" name="card_number" class="card-number">
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="#">{{ $websiteLang->where('lang_key','cvc')->first()->custom_text }}</label>
                                                        <input type="text" name="cvc" class="card-cvc">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="#">{{ $websiteLang->where('lang_key','exp_month')->first()->custom_text }}</label>
                                                        <input type="text" name="month" class="card-expiry-month">
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label for="#">{{ $websiteLang->where('lang_key','exp_year')->first()->custom_text }}</label>
                                                        <input type="text" name="year" class="card-expiry-year">
                                                    </div>

                                                </div>

                                            </div>
                                            <div class='form-row row'>
                                                <div class='col-md-12 error d-none form-group '>
                                                    <div class='alert-danger alert '>{{ $websiteLang->where('lang_key','valid_card')->first()->custom_text }}</div>
                                                </div>
                                            </div>
                                            <button class="common_btn_2" type="submit">{{ $websiteLang->where('lang_key','payment')->first()->custom_text }}</button>
                                        </form>
                                    </div>

                                </div>
                            </div>
                            @endif

                            @if ($paymentSetting->paypal_status==1)
                            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                <div class="wsus__bank_details">
                                    <a class="common_btn_2" href="{{ route('user.paypal',$package->id) }}"> {{ $websiteLang->where('lang_key','pay_with_paypal')->first()->custom_text }}</a>
                                </div>
                            </div>
                            @endif

                            @if ($razorpay->razorpay_status==1)
                            <div class="tab-pane fade" id="razorpay_payment" role="tabpanel" aria-labelledby="razorpay_payment_tab">
                                <div class="wsus__bank_details">

                                    <form action="{{ route('user.razorpay-payment',$package->id) }}" method="POST" >
                                        @csrf
                                        @php
                                            $inr_amount=$package_price / $razorpay->currency_rate;
                                            $inr_amount = round($inr_amount, 2);

                                            $payableAmount = round($package_price * $razorpay->currency_rate,2);

                                        @endphp
                                        <script src="https://checkout.razorpay.com/v1/checkout.js"
                                                data-key="{{ $razorpay->razorpay_key }}"
                                                data-amount= "{{ $payableAmount * 100 }}"
                                                data-buttontext="{{ $websiteLang->where('lang_key','pay')->first()->custom_text }} {{ $payableAmount }} {{ $razorpay->currency_code }}"
                                                data-name="{{ $razorpay->name }}"
                                                data-description="{{ $razorpay->description }}"
                                                data-image="{{ asset($razorpay->image) }}"
                                                data-prefill.name=""
                                                data-prefill.email=""
                                                data-theme.color="{{ $razorpay->theme_color }}">
                                        </script>
                                    </form>

                                </div>
                            </div>
                            @endif

                            @php
                                $usd_amount=$package_price / $currency->currency_rate;
                            @endphp
                            @if ($flutterwave->status == 1)
                                <div class="tab-pane fade" id="flutterwave_payment" role="tabpanel" aria-labelledby="flutterwave_payment_tab">
                                    <div class="wsus__bank_details">

                                        <a class="common_btn_2" href="javascript:;" onClick="makePayment()"> {{ $websiteLang->where('lang_key','pay_with_flutterwave')->first()->custom_text }}</a>
                                    </div>
                                </div>
                            @endif

                            @if ($paystack->paystack_status == 1)
                                <div class="tab-pane fade" id="paystack_payment" role="tabpanel" aria-labelledby="paystack_payment_tab">
                                    <div class="wsus__bank_details">

                                        <a class="common_btn_2" href="javascript:;" onClick="payWithPaystack()"> {{ $websiteLang->where('lang_key','pay_with_paystack')->first()->custom_text }}</a>
                                    </div>
                                </div>
                            @endif

                            <div class="tab-pane fade" id="mollie_payment" role="tabpanel" aria-labelledby="mollie_payment_tab">
                                <div class="wsus__bank_details">
                                    <a class="common_btn_2" href="{{ route('user.mollie-payment', $package->id) }}"> {{ $websiteLang->where('lang_key','pay_with_mollie')->first()->custom_text }}</a>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="instamojo_payment" role="tabpanel" aria-labelledby="instamojo_payment_tab">
                                <div class="wsus__bank_details">
                                    <a class="common_btn_2" href="{{ route('user.pay-with-instamojo', $package->id) }}"> {{ $websiteLang->where('lang_key','pay_with_instamojo')->first()->custom_text }}</a>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="paymongo_payment" role="tabpanel" aria-labelledby="paymongo_payment_tab">
                                <div class="wsus__bank_details">
                                    <a class="common_btn_2" href="javascript:;" data-bs-toggle="modal" data-bs-target="#paywithPaymongo"> {{ $websiteLang->where('lang_key','card_payment')->first()->custom_text }}</a>

                                    <a class="common_btn_2" href="{{ route('user.pay-with-grab-pay', $package->id) }}"> {{ $websiteLang->where('lang_key','grab_pay')->first()->custom_text }}</a>

                                    <a class="common_btn_2" href="{{ route('user.pay-with-gcash', $package->id) }}"> {{ $websiteLang->where('lang_key','gcash')->first()->custom_text }}</a>
                                </div>
                            </div>






                            @if ($paymentSetting->bank_status==1)
                            <div class="tab-pane fade" id="bank_payment" role="tabpanel" aria-labelledby="bank_payment_tab">
                                <div class="wsus__cash_delivery">
                                    <p>{!! clean(nl2br(e($stripe->bank_account))) !!}</p>
                                    <form action="{{ route('user.bank-payment') }}" method="POST">
                                        @csrf
                                        <div class="wsus__rite_comment">
                                            <textarea placeholder="{{ $websiteLang->where('lang_key','trans_info')->first()->custom_text }}" name="tran_id"  id="" required></textarea>
                                        </div>
                                    <input type="hidden" name="package_id" value="{{ $package->id }}">
                                    <button type="submit" class="common_btn_2" href="{{ route('user.paypal',$package->id) }}">{{ $websiteLang->where('lang_key','payment')->first()->custom_text }}</button>

                                </form>
                                </div>

                            </div>
                            @endif

                        </div>
                    </div>
                </div>
                <div class="col-xl-7 col-lg-6">
                    <div class="wsus__booking_info">
                        <h4><i class="far fa-address-book"></i>{{ $websiteLang->where('lang_key','package_detail')->first()->custom_text }}</h4>
                        <div class="row">
                            <div class="col">
                                <table class="table table-bordered">
                                    <tr>
                                        <td width="50%">{{ $websiteLang->where('lang_key','package_name')->first()->custom_text }}</td>
                                        <td width="50%">{{ $package->package_name }}</td>
                                    </tr>
                                    <tr>
                                        <td width="50%">{{ $websiteLang->where('lang_key','price')->first()->custom_text }}</td>
                                        <td width="50%">{{ $currency->currency_icon }}{{ $package->price }}</td>
                                    </tr>

                                     <tr>
                                        <td width="50%">{{ $websiteLang->where('lang_key','expired_date')->first()->custom_text }}</td>
                                        <td width="50%">
                                            @if ($package->number_of_days==-1)
                                            {{ $websiteLang->where('lang_key','unlimited')->first()->custom_text }}
                                            @else
                                                {{ date('Y-m-d', strtotime($package->number_of_days.' days')) }}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="50%">{{ $websiteLang->where('lang_key','property')->first()->custom_text }}</td>
                                        <td width="50%">
                                            @if ($package->number_of_property==-1)
                                            {{ $websiteLang->where('lang_key','unlimited')->first()->custom_text }}
                                            @else
                                                {{ $package->number_of_property }}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="50%">{{ $websiteLang->where('lang_key','aminity')->first()->custom_text }}</td>
                                        <td width="50%">
                                            @if ($package->number_of_aminities==-1)
                                            {{ $websiteLang->where('lang_key','unlimited')->first()->custom_text }}
                                            @else
                                                {{ $package->number_of_aminities }}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="50%">{{ $websiteLang->where('lang_key','nearest_place')->first()->custom_text }}</td>
                                        <td width="50%">
                                            @if ($package->number_of_nearest_place==-1)
                                            {{ $websiteLang->where('lang_key','unlimited')->first()->custom_text }}
                                            @else
                                                {{ $package->number_of_nearest_place }}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="50%">{{ $websiteLang->where('lang_key','photo')->first()->custom_text }}</td>
                                        <td width="50%">
                                            @if ($package->number_of_photo==-1)
                                            {{ $websiteLang->where('lang_key','unlimited')->first()->custom_text }}
                                            @else
                                                {{ $package->number_of_photo }}
                                            @endif
                                        </td>
                                    </tr>

                                    <tr>
                                        <td width="50%">{{ $websiteLang->where('lang_key','featured_property')->first()->custom_text }}</td>
                                        <td width="50%">
                                            @if ($package->is_featured==1)
                                            {{ $websiteLang->where('lang_key','available')->first()->custom_text }}
                                            @else
                                            {{ $websiteLang->where('lang_key','not_available')->first()->custom_text }}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="50%">{{ $websiteLang->where('lang_key','featured_property')->first()->custom_text }}</td>
                                        <td width="50%">
                                            @if ($package->number_of_feature_property==-1)
                                            {{ $websiteLang->where('lang_key','unlimited')->first()->custom_text }}
                                            @else
                                                {{ $package->number_of_feature_property }}
                                            @endif
                                        </td>
                                    </tr>

                                    <tr>
                                        <td width="50%">{{ $websiteLang->where('lang_key','top_property')->first()->custom_text }}</td>
                                        <td width="50%">
                                            @if ($package->is_top==1)
                                            {{ $websiteLang->where('lang_key','available')->first()->custom_text }}
                                            @else
                                            {{ $websiteLang->where('lang_key','not_available')->first()->custom_text }}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="50%">{{ $websiteLang->where('lang_key','top_property')->first()->custom_text }}</td>
                                        <td width="50%">
                                            @if ($package->number_of_top_property==-1)
                                            {{ $websiteLang->where('lang_key','unlimited')->first()->custom_text }}
                                            @else
                                                {{ $package->number_of_top_property }}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="50%">{{ $websiteLang->where('lang_key','urgent_property')->first()->custom_text }}</td>
                                        <td width="50%">
                                            @if ($package->is_urgent==1)
                                            {{ $websiteLang->where('lang_key','available')->first()->custom_text }}
                                            @else
                                            {{ $websiteLang->where('lang_key','not_available')->first()->custom_text }}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="50%">{{ $websiteLang->where('lang_key','urgent_property')->first()->custom_text }}</td>
                                        <td width="50%">
                                            @if ($package->number_of_urgent_property==-1)
                                            {{ $websiteLang->where('lang_key','unlimited')->first()->custom_text }}
                                            @else
                                                {{ $package->number_of_urgent_property }}
                                            @endif
                                        </td>
                                    </tr>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--==========================
         CHECKOUT PART END
    ===========================-->


  <!-- Modal -->
  <div class="modal fade" id="paywithPaymongo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{ $websiteLang->where('lang_key','pay_with_paymongo')->first()->custom_text }}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('user.pay-with-paymongo',$package->id) }}" method="POST" >
                @csrf
                <div class="wsus__single_card">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="#">{{ $websiteLang->where('lang_key','card_number')->first()->custom_text }}</label>
                            <input type="text" name="card_number" required>
                        </div>
                        <div class="col-md-12">
                            <label for="#">{{ $websiteLang->where('lang_key','cvc')->first()->custom_text }}</label>
                            <input type="text" name="cvc" required>
                        </div>
                        <div class="col-md-12">
                            <label for="#">{{ $websiteLang->where('lang_key','exp_month')->first()->custom_text }}</label>
                            <input type="text" name="month"  required>
                        </div>

                        <div class="col-md-12">
                            <label for="#">{{ $websiteLang->where('lang_key','exp_year')->first()->custom_text }}</label>
                            <input type="text" name="year" required>
                        </div>

                    </div>

                </div>

                <button class="common_btn_2" type="submit">{{ $websiteLang->where('lang_key','payment')->first()->custom_text }}</button>
            </form>
        </div>

      </div>
    </div>
  </div>


<script src="https://js.paystack.co/v1/inline.js"></script>
<script src="https://checkout.flutterwave.com/v3.js"></script>

<script>
    // stripe
    $(function() {
        var $form = $(".require-validation");
        $('form.require-validation').bind('submit', function(e) {
            var $form         = $(".require-validation"),
            inputSelector = ['input[type=email]', 'input[type=password]',
                                'input[type=text]', 'input[type=file]',
                                'textarea'].join(', '),
            $inputs       = $form.find('.required').find(inputSelector),
            $errorMessage = $form.find('div.error'),
            valid         = true;
            $errorMessage.addClass('d-none');

            $('.has-error').removeClass('has-error');
            $inputs.each(function(i, el) {
                var $input = $(el);
                if ($input.val() === '') {
                    $input.parent().addClass('has-error');
                    $errorMessage.removeClass('d-none');
                    e.preventDefault();
                }
            });

            if (!$form.data('cc-on-file')) {
            e.preventDefault();
            Stripe.setPublishableKey($form.data('stripe-publishable-key'));
            Stripe.createToken({
                number: $('.card-number').val(),
                cvc: $('.card-cvc').val(),
                exp_month: $('.card-expiry-month').val(),
                exp_year: $('.card-expiry-year').val()
            }, stripeResponseHandler);
            }

        });

        function stripeResponseHandler(status, response) {
            if (response.error) {
                $('.error')
                    .removeClass('d-none')
                    .find('.alert')
                    .text(response.error.message);
            } else {
                var token = response['id'];
                $form.find('input[type=text]').empty();
                $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                $form.get(0).submit();
            }
        }
    });
</script>

@php
    // start paystack
    $public_key = $paystack->paystack_public_key;
    $currency = $paystack->paystack_currency_code;
    $currency = strtoupper($currency);

    $ngn_amount = $package_price * $paystack->paystack_currency_rate;
    $ngn_amount = $ngn_amount * 100;
    $ngn_amount = round($ngn_amount);
    // end paystack

    // start flutterwave
    $payable_amount = $package_price * $flutterwave->currency_rate;
    $payable_amount = round($payable_amount, 2);
    // end flutterwave
@endphp

<script>
    function makePayment() {
      FlutterwaveCheckout({
        public_key: "{{ $flutterwave->public_key }}",
        tx_ref: "RX1",
        amount: {{ $payable_amount }},
        currency: "{{ $flutterwave->currency_code }}",
        country: "{{ $flutterwave->country_code }}",
        payment_options: " ",
        customer: {
          email: "{{ $user->email }}",
          phone_number: "{{ $user->phone }}",
          name: "{{ $user->name }}",
        },
        callback: function (data) {
            var tnx_id = data.transaction_id;
            console.log(tnx_id);

            var _token = "{{ csrf_token() }}";
            var package_id = '{{ $package->id }}';
            $.ajax({
                type: 'post',
                data : {tnx_id,_token,package_id},
                url: "{{ url('user/flutterwave-payment/') }}",
                success: function (response) {
                    if(response.status == 'success'){
                        toastr.success(response.message);
                        window.location.href = "{{ route('user.my-order') }}";
                    }else{
                        toastr.error(response.message);
                        window.location.reload();

                    }
                },
                error: function(err) {}
            });

        },
        customizations: {
          title: "{{ $flutterwave->title }}",
          logo: "{{ asset($flutterwave->logo) }}",
        },
      });
    }



function payWithPaystack(){
    var package_id = '{{ $package->id }}';
    var handler = PaystackPop.setup({
        key: '{{ $public_key }}',
        email: '{{ $user->email }}',
        amount: '{{ $ngn_amount }}',
        currency: "{{ $currency }}",
        callback: function(response){
        let reference = response.reference;
        let tnx_id = response.transaction;
        let _token = "{{ csrf_token() }}";
        $.ajax({
            type: "post",
            data: {reference, tnx_id, _token, package_id},
            url: "{{ route('user.paystack-payment') }}",
            success: function(response) {
                if(response.status == 'success'){
                    window.location.href = "{{ route('user.my-order') }}";
                }else{
                    window.location.reload();
                }
            }
        });
        },
        onClose: function(){
            alert('window closed');
        }
    });
    handler.openIframe();
    }

  </script>
@endsection
