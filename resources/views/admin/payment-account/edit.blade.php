@extends('layouts.admin.layout')
@section('title')
<title>{{ $websiteLang->where('lang_key','payment_account')->first()->custom_text }}</title>
@endsection
@section('admin-content')

<div class="row">
    <div class="col-md-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">{{ $websiteLang->where('lang_key','paypal')->first()->custom_text }}</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.payment-account.update',$paymentAccount->id) }}" method="POST">
                    @csrf
                    @method('patch')


                    <div class="form-group">
                        <label for="">{{ $websiteLang->where('lang_key','paypal_account_mode')->first()->custom_text }}</label>
                        <select name="account_mode" id="" class="form-control">
                            <option {{ $paymentAccount->account_mode=='live' ? 'selected':'' }} value="live">{{ $websiteLang->where('lang_key','live')->first()->custom_text }}</option>
                            <option {{ $paymentAccount->account_mode=='sandbox' ? 'selected':'' }} value="sandbox">{{ $websiteLang->where('lang_key','sandbox')->first()->custom_text }}</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="paypal_client_id">{{ $websiteLang->where('lang_key','paypal_client_id')->first()->custom_text }}</label>
                        <textarea name="paypal_client_id" id="paypal_client_id" cols="30" rows="2" class="form-control">{{ $paymentAccount->paypal_client_id }}</textarea>

                    </div>
                    <div class="form-group">
                        <label for="paypal_secret">{{ $websiteLang->where('lang_key','paypal_secret_key')->first()->custom_text }}</label>
                        <textarea name="paypal_secret" id="paypal_secret" cols="30" rows="2" class="form-control" >{{ $paymentAccount->paypal_secret }}</textarea>

                    </div>


                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">{{ $websiteLang->where('lang_key','country_name')->first()->custom_text }}</label>
                                <select name="paypal_country_code" id="" class="form-control select2">
                                    <option value="">{{ $websiteLang->where('lang_key','select_country')->first()->custom_text }}
                                  </option>
                                  @foreach ($countires as $country)
                                  <option {{ $paymentAccount->paypal_country_code == $country->code ? 'selected' : '' }} value="{{ $country->code }}">{{ $country->name }}
                                  </option>
                                  @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">{{ $websiteLang->where('lang_key','currency_name')->first()->custom_text }}</label>
                                <select name="paypal_currency_code" id="" class="form-control select2">
                                    <option value="">{{ $websiteLang->where('lang_key','select_currency')->first()->custom_text }}
                                  </option>
                                  @foreach ($currencies as $currency)
                                  <option {{ $paymentAccount->paypal_currency_code == $currency->code ? 'selected' : '' }} value="{{ $currency->code }}">{{ $currency->name }}
                                  </option>
                                  @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">{{ $websiteLang->where('lang_key','active_currency')->first()->custom_text }} ({{ $websiteLang->where('lang_key','per')->first()->custom_text }} {{ $setting->currency_name }})</label>
                                <input type="text" class="form-control" name="paypal_currency_rate" value="{{ $paymentAccount->paypal_currency_rate }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">{{ $websiteLang->where('lang_key','status')->first()->custom_text }}</label>
                                <select name="paypal_status" id="" class="form-control">
                                    <option {{ $paymentAccount->paypal_status==1 ? 'selected':'' }} value="1">{{ $websiteLang->where('lang_key','active')->first()->custom_text }}</option>
                                    <option {{ $paymentAccount->paypal_status==0 ? 'selected':'' }} value="0">{{ $websiteLang->where('lang_key','inactive')->first()->custom_text }}</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success">{{ $websiteLang->where('lang_key','update')->first()->custom_text }}</button>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">{{ $websiteLang->where('lang_key','stripe')->first()->custom_text }}</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.stripe-update',$paymentAccount->id) }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="stripe_key">{{ $websiteLang->where('lang_key','stripe_key')->first()->custom_text }}</label>
                        <textarea name="stripe_key" id="stripe_key" cols="30" rows="2" class="form-control">{{ $paymentAccount->stripe_key }}</textarea>

                    </div>
                    <div class="form-group">
                        <label for="stripe_secret">{{ $websiteLang->where('lang_key','stripe_secret')->first()->custom_text }}</label>
                        <textarea name="stripe_secret" id="stripe_secret" cols="30" rows="2" class="form-control">{{ $paymentAccount->stripe_secret }}</textarea>

                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">{{ $websiteLang->where('lang_key','country_name')->first()->custom_text }}</label>
                                <select name="stripe_country_code" id="" class="form-control select2">
                                    <option value="">{{ $websiteLang->where('lang_key','select_country')->first()->custom_text }}
                                    </option>
                                  @foreach ($countires as $country)
                                  <option {{ $paymentAccount->stripe_country_code == $country->code ? 'selected' : '' }} value="{{ $country->code }}">{{ $country->name }}
                                  </option>
                                  @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">{{ $websiteLang->where('lang_key','currency_name')->first()->custom_text }}</label>
                                <select name="stripe_currency_code" id="" class="form-control select2">
                                    <option value="">{{ $websiteLang->where('lang_key','select_currency')->first()->custom_text }}
                                    </option>
                                  @foreach ($currencies as $currency)
                                  <option {{ $paymentAccount->stripe_currency_code == $currency->code ? 'selected' : '' }} value="{{ $currency->code }}">{{ $currency->name }}
                                  </option>
                                  @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">{{ $websiteLang->where('lang_key','active_currency')->first()->custom_text }} ({{ $websiteLang->where('lang_key','per')->first()->custom_text }} {{ $setting->currency_name }})</label>
                                <input type="text" class="form-control" name="stripe_currency_rate" value="{{ $paymentAccount->stripe_currency_rate }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">{{ $websiteLang->where('lang_key','status')->first()->custom_text }}</label>
                                <select name="stripe_status" id="" class="form-control">
                                    <option {{ $paymentAccount->stripe_status==1 ? 'selected':'' }} value="1">{{ $websiteLang->where('lang_key','active')->first()->custom_text }}</option>
                                    <option {{ $paymentAccount->stripe_status==0 ? 'selected':'' }} value="0">{{ $websiteLang->where('lang_key','inactive')->first()->custom_text }}</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success">{{ $websiteLang->where('lang_key','update')->first()->custom_text }}</button>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">{{ $websiteLang->where('lang_key','razorpay')->first()->custom_text }}</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.razorpay-update',$razorpay->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="">{{ $websiteLang->where('lang_key','razorpay_key')->first()->custom_text }}</label>
                        <input type="text" class="form-control" name="razorpay_key" value="{{ $razorpay->razorpay_key }}">

                    </div>
                    <div class="form-group">
                        <label for="">{{ $websiteLang->where('lang_key','razorpay_secret_key')->first()->custom_text }}</label>
                        <input type="text" class="form-control" name="razorpay_secret" value="{{ $razorpay->secret_key }}">
                    </div>

                    <div class="form-group">
                        <label for="">{{ $websiteLang->where('lang_key','name')->first()->custom_text }}</label>
                        <input type="text" class="form-control" name="name" value="{{ $razorpay->name }}">
                    </div>

                    <div class="form-group">
                        <label for="">{{ $websiteLang->where('lang_key','des')->first()->custom_text }}</label>
                        <input type="text" class="form-control" name="description" value="{{ $razorpay->description }}">
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">{{ $websiteLang->where('lang_key','country_name')->first()->custom_text }}</label>
                                <select name="country_code" id="" class="form-control select2">
                                    <option value="">{{ $websiteLang->where('lang_key','select_country')->first()->custom_text }}
                                    </option>
                                  @foreach ($countires as $country)
                                  <option {{ $razorpay->country_code == $country->code ? 'selected' : '' }} value="{{ $country->code }}">{{ $country->name }}
                                  </option>
                                  @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">{{ $websiteLang->where('lang_key','currency_name')->first()->custom_text }}</label>
                                <select name="currency_code" id="" class="form-control select2">
                                    <option value="">{{ $websiteLang->where('lang_key','select_currency')->first()->custom_text }}
                                    </option>
                                  @foreach ($currencies as $currency)
                                  <option {{ $razorpay->currency_code == $currency->code ? 'selected' : '' }} value="{{ $currency->code }}">{{ $currency->name }}
                                  </option>
                                  @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="">{{ $websiteLang->where('lang_key','active_currency')->first()->custom_text }} ({{ $websiteLang->where('lang_key','per')->first()->custom_text }} {{ $setting->currency_name }})</label>
                                <input type="text" class="form-control" value="{{ $razorpay->currency_rate }}" name="currency_rate">
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="">{{ $websiteLang->where('lang_key','status')->first()->custom_text }}</label>
                                <select name="razorpay_status" id="" class="form-control">
                                    <option {{ $razorpay->razorpay_status==1 ? 'selected':'' }} value="1">{{ $websiteLang->where('lang_key','active')->first()->custom_text }}</option>
                                    <option {{ $razorpay->razorpay_status==0 ? 'selected':'' }} value="0">{{ $websiteLang->where('lang_key','inactive')->first()->custom_text }}</option>
                                </select>
                            </div>
                        </div>

                    </div>


                    <div class="form-group">
                        <label for="">{{ $websiteLang->where('lang_key','exist_img')->first()->custom_text }}</label>
                        <div>
                            <img width="200px" src="{{ asset($razorpay->image) }}" alt="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">{{ $websiteLang->where('lang_key','img')->first()->custom_text }}</label>
                        <input type="file" class="form-control-file" name="image">
                    </div>

                    <div class="form-group">
                        <label for="">{{ $websiteLang->where('lang_key','theme_color')->first()->custom_text }}</label>
                        <br>
                        <input type="color" name="theme_color" value="{{ $razorpay->theme_color }}">
                    </div>

                    <button type="submit" class="btn btn-success">{{ $websiteLang->where('lang_key','update')->first()->custom_text }}</button>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">{{ $websiteLang->where('lang_key','flutterwave')->first()->custom_text }}</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.flutterwave-update',$flutterwave->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="">{{ $websiteLang->where('lang_key','public_key')->first()->custom_text }}</label>
                        <input type="text" class="form-control" name="public_key" value="{{ $flutterwave->public_key }}">

                    </div>
                    <div class="form-group">
                        <label for="">{{ $websiteLang->where('lang_key','secret_key')->first()->custom_text }}</label>
                        <input type="text" class="form-control" name="secret_key" value="{{ $flutterwave->secret_key }}">
                    </div>

                    <div class="form-group">
                        <label for="">{{ $websiteLang->where('lang_key','title')->first()->custom_text }}</label>
                        <input type="text" class="form-control" name="title" value="{{ $flutterwave->title }}">
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">{{ $websiteLang->where('lang_key','country_name')->first()->custom_text }}</label>
                                <select name="country_code" id="" class="form-control select2">
                                    <option value="">{{ $websiteLang->where('lang_key','select_country')->first()->custom_text }}
                                    </option>
                                  @foreach ($countires as $country)
                                  <option {{ $flutterwave->country_code == $country->code ? 'selected' : '' }} value="{{ $country->code }}">{{ $country->name }}
                                  </option>
                                  @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">{{ $websiteLang->where('lang_key','currency_name')->first()->custom_text }}</label>
                                <select name="currency_code" id="" class="form-control select2">
                                    <option value="">{{ $websiteLang->where('lang_key','select_currency')->first()->custom_text }}
                                    </option>
                                  @foreach ($currencies as $currency)
                                  <option {{ $flutterwave->currency_code == $currency->code ? 'selected' : '' }} value="{{ $currency->code }}">{{ $currency->name }}
                                  </option>
                                  @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="">{{ $websiteLang->where('lang_key','active_currency')->first()->custom_text }} ({{ $websiteLang->where('lang_key','per')->first()->custom_text }} {{ $setting->currency_name }})</label>
                                <input type="text" class="form-control" value="{{ $flutterwave->currency_rate }}" name="currency_rate">
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="">{{ $websiteLang->where('lang_key','status')->first()->custom_text }}</label>
                                <select name="status" id="" class="form-control">
                                    <option {{ $flutterwave->status==1 ? 'selected':'' }} value="1">{{ $websiteLang->where('lang_key','active')->first()->custom_text }}</option>
                                    <option {{ $flutterwave->status==0 ? 'selected':'' }} value="0">{{ $websiteLang->where('lang_key','inactive')->first()->custom_text }}</option>
                                </select>
                            </div>
                        </div>

                    </div>


                    <div class="form-group">
                        <label for="">{{ $websiteLang->where('lang_key','exist_img')->first()->custom_text }}</label>
                        <div>
                            <img width="200px" src="{{ asset($flutterwave->logo) }}" alt="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">{{ $websiteLang->where('lang_key','img')->first()->custom_text }}</label>
                        <input type="file" class="form-control-file" name="image">
                    </div>


                    <button type="submit" class="btn btn-success">{{ $websiteLang->where('lang_key','update')->first()->custom_text }}</button>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">{{ $websiteLang->where('lang_key','paystack')->first()->custom_text }}</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.paystack-update',$paystack->id) }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="">{{ $websiteLang->where('lang_key','public_key')->first()->custom_text }}</label>
                        <input type="text" name="paystack_public_key" class="form-control" value="{{ $paystack->paystack_public_key }}">
                    </div>

                    <div class="form-group">
                        <label for="">{{ $websiteLang->where('lang_key','secret_key')->first()->custom_text }}</label>
                        <input type="text" name="paystack_secret_key" class="form-control" value="{{ $paystack->paystack_secret_key }}">
                    </div>

                    <div class="form-group">
                        <label for="">{{ $websiteLang->where('lang_key','country_name')->first()->custom_text }}</label>
                        <select name="paystack_country_name" id="" class="form-control select2">
                            <option value="">{{ $websiteLang->where('lang_key','select_country')->first()->custom_text }}
                            </option>
                          @foreach ($countires as $country)
                          <option {{ $paystack->paystack_country_code == $country->code ? 'selected' : '' }} value="{{ $country->code }}">{{ $country->name }}
                          </option>
                          @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="">{{ $websiteLang->where('lang_key','currency_name')->first()->custom_text }}</label>
                        <select name="paystack_currency_name" id="" class="form-control select2">
                            <option value="">{{ $websiteLang->where('lang_key','select_currency')->first()->custom_text }}
                            </option>
                          @foreach ($currencies as $currency)
                          <option {{ $paystack->paystack_currency_code == $currency->code ? 'selected' : '' }} value="{{ $currency->code }}">{{ $currency->name }}
                          </option>
                          @endforeach
                        </select>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">{{ $websiteLang->where('lang_key','active_currency')->first()->custom_text }} ({{ $websiteLang->where('lang_key','per')->first()->custom_text }} {{ $setting->currency_name }})</label>
                                <input type="text" class="form-control" name="paystack_currency_rate" value="{{ $paystack->paystack_currency_rate }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">{{ $websiteLang->where('lang_key','status')->first()->custom_text }}</label>
                                <select name="status" id="" class="form-control">
                                    <option {{ $paystack->paystack_status==1 ? 'selected':'' }} value="1">{{ $websiteLang->where('lang_key','active')->first()->custom_text }}</option>
                                    <option {{ $paystack->paystack_status==0 ? 'selected':'' }} value="0">{{ $websiteLang->where('lang_key','inactive')->first()->custom_text }}</option>
                                </select>
                            </div>
                        </div>
                    </div>


                    <button class="btn btn-primary">{{ $websiteLang->where('lang_key','update')->first()->custom_text }}</button>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">{{ $websiteLang->where('lang_key','mollie')->first()->custom_text }}</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.mollie-update', $mollie->id) }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="">{{ $websiteLang->where('lang_key','mollie_key')->first()->custom_text }}</label>
                        <input type="text" class="form-control" name="mollie_key" value="{{ $mollie->mollie_key }}">
                    </div>

                    <div class="form-group">
                        <label for="">{{ $websiteLang->where('lang_key','country_name')->first()->custom_text }}</label>
                        <select name="mollie_country_name" id="" class="form-control select2">
                            <option value="">{{ $websiteLang->where('lang_key','select_country')->first()->custom_text }}
                            </option>
                          @foreach ($countires as $country)
                          <option {{ $mollie->mollie_country_code == $country->code ? 'selected' : '' }} value="{{ $country->code }}">{{ $country->name }}
                          </option>
                          @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="">{{ $websiteLang->where('lang_key','currency_name')->first()->custom_text }}</label>
                        <select name="mollie_currency_name" id="" class="form-control select2">
                            <option value="">{{ $websiteLang->where('lang_key','select_currency')->first()->custom_text }}
                            </option>
                          @foreach ($currencies as $currency)
                          <option {{ $mollie->mollie_currency_code == $currency->code ? 'selected' : '' }} value="{{ $currency->code }}">{{ $currency->name }}
                          </option>
                          @endforeach
                        </select>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">{{ $websiteLang->where('lang_key','active_currency')->first()->custom_text }} ({{ $websiteLang->where('lang_key','per')->first()->custom_text }} {{ $setting->currency_name }})</label>
                                <input type="text" class="form-control" name="mollie_currency_rate" value="{{ $mollie->mollie_currency_rate }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">{{ $websiteLang->where('lang_key','status')->first()->custom_text }}</label>
                                <select name="status" id="" class="form-control">
                                    <option {{ $mollie->mollie_status==1 ? 'selected':'' }} value="1">{{ $websiteLang->where('lang_key','active')->first()->custom_text }}</option>
                                    <option {{ $mollie->mollie_status==0 ? 'selected':'' }} value="0">{{ $websiteLang->where('lang_key','inactive')->first()->custom_text }}</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <button class="btn btn-primary">{{ $websiteLang->where('lang_key','update')->first()->custom_text }}</button>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">{{ $websiteLang->where('lang_key','instamojo')->first()->custom_text }}</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.instamojo-update', $instamojo->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="">{{ $websiteLang->where('lang_key','account_mode')->first()->custom_text }}</label>
                        <select name="account_mode" id="account_mode" class="form-control">
                            <option value="Sandbox">{{ $websiteLang->where('lang_key','sandbox')->first()->custom_text }}</option>
                            <option value="Live">{{ $websiteLang->where('lang_key','live')->first()->custom_text }}</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="">{{ $websiteLang->where('lang_key','api_key')->first()->custom_text }}</label>
                        <input type="text" name="api_key" class="form-control" value="{{ $instamojo->api_key }}">
                    </div>

                    <div class="form-group">
                        <label for="">{{ $websiteLang->where('lang_key','auth_token')->first()->custom_text }}</label>
                        <input type="text" name="auth_token" class="form-control" value="{{ $instamojo->auth_token }}">
                    </div>

                    <div class="form-group">
                        <label for="">{{ $websiteLang->where('lang_key','active_currency')->first()->custom_text }} ({{ $websiteLang->where('lang_key','per')->first()->custom_text }} {{ $setting->currency_name }})</label>
                        <input type="text" class="form-control" name="currency_rate" value="{{ $instamojo->currency_rate }}">
                    </div>

                    <div class="form-group">
                        <label for="">{{ $websiteLang->where('lang_key','status')->first()->custom_text }}</label>
                        <select name="status" id="" class="form-control">
                            <option {{ $instamojo->status==1 ? 'selected':'' }} value="1">{{ $websiteLang->where('lang_key','active')->first()->custom_text }}</option>
                            <option {{ $instamojo->status==0 ? 'selected':'' }} value="0">{{ $websiteLang->where('lang_key','inactive')->first()->custom_text }}</option>
                        </select>
                    </div>

                    <button class="btn btn-primary">{{ $websiteLang->where('lang_key','update')->first()->custom_text }}</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">{{ $websiteLang->where('lang_key','paymongo')->first()->custom_text }}</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.paymongo-update',$paymongo->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="">{{ $websiteLang->where('lang_key','public_key')->first()->custom_text }}</label>
                        <input type="text" class="form-control" name="public_key" value="{{ $paymongo->public_key }}">

                    </div>
                    <div class="form-group">
                        <label for="">{{ $websiteLang->where('lang_key','secret_key')->first()->custom_text }}</label>
                        <input type="text" class="form-control" name="secret_key" value="{{ $paymongo->secret_key }}">
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">{{ $websiteLang->where('lang_key','country_name')->first()->custom_text }}</label>
                                <select name="country_code" id="" class="form-control select2">
                                    <option value="">{{ $websiteLang->where('lang_key','select_country')->first()->custom_text }}
                                    </option>
                                  @foreach ($countires as $country)
                                  <option {{ $paymongo->country_code == $country->code ? 'selected' : '' }} value="{{ $country->code }}">{{ $country->name }}
                                  </option>
                                  @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">{{ $websiteLang->where('lang_key','currency_name')->first()->custom_text }}</label>
                                <select name="currency_code" id="" class="form-control select2">
                                    <option value="">{{ $websiteLang->where('lang_key','select_currency')->first()->custom_text }}
                                    </option>
                                  @foreach ($currencies as $currency)
                                  <option {{ $paymongo->currency_code == $currency->code ? 'selected' : '' }} value="{{ $currency->code }}">{{ $currency->name }}
                                  </option>
                                  @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="">{{ $websiteLang->where('lang_key','active_currency')->first()->custom_text }} ({{ $websiteLang->where('lang_key','per')->first()->custom_text }} {{ $setting->currency_name }})</label>
                                <input type="text" class="form-control" value="{{ $paymongo->currency_rate }}" name="currency_rate">
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="">{{ $websiteLang->where('lang_key','status')->first()->custom_text }}</label>
                                <select name="status" id="" class="form-control">
                                    <option {{ $paymongo->status==1 ? 'selected':'' }} value="1">{{ $websiteLang->where('lang_key','active')->first()->custom_text }}</option>
                                    <option {{ $paymongo->status==0 ? 'selected':'' }} value="0">{{ $websiteLang->where('lang_key','inactive')->first()->custom_text }}</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success">{{ $websiteLang->where('lang_key','update')->first()->custom_text }}</button>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">{{ $websiteLang->where('lang_key','bank_payment')->first()->custom_text }}</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.bank-update',$paymentAccount->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="bank_account">{{ $websiteLang->where('lang_key','bank_details')->first()->custom_text }}</label>
                        <textarea name="bank_account" id="bank_account" cols="30" rows="5" class="form-control" >{{ $paymentAccount->bank_account }}</textarea>

                    </div>

                    <div class="form-group">
                        <label for="">{{ $websiteLang->where('lang_key','status')->first()->custom_text }}</label>
                        <select name="bank_status" id="" class="form-control">
                            <option {{ $paymentAccount->bank_status==1 ? 'selected':'' }} value="1">{{ $websiteLang->where('lang_key','active')->first()->custom_text }}</option>
                            <option {{ $paymentAccount->bank_status==0 ? 'selected':'' }} value="0">{{ $websiteLang->where('lang_key','inactive')->first()->custom_text }}</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success">{{ $websiteLang->where('lang_key','update')->first()->custom_text }}</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
