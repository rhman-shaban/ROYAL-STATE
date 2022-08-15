@extends('layouts.user.profile.layout')
@section('title')
    <title>{{ $websiteLang->where('lang_key','order')->first()->custom_text }}</title>
@endsection
@section('user-dashboard')
<div class="row">
    <div class="col-xl-9 ms-auto">
        <div class="wsus__dashboard_main_content">
            <div class="wsus__invoice">
                <div class="wsus__invoice_area">
                    <div class="wsus__invoice_content">
                        <div class="wsus__invoice_single">
                            <img  class="mb-2 custom-invoice-img" src="{{ asset($logo->logo) }}" alt="Logo">
                            <h6>{{ $order->user->name }}</h6>
                            <p>{{ $order->user->email }}</p>
                            @if ($order->user->phone)
                            <p>{{ $order->user->phone }}</p>
                            @endif
                            @if ($order->user->address)
                            <p>{{ $order->user->address }}</p>
                            @endif
                        </div>
                        <div class="wsus__invoice_single text-end">
                            <h6>{{ $websiteLang->where('lang_key','order_id')->first()->custom_text }}: {{ $order->order_id }}</h6>
                            <p>{{ $websiteLang->where('lang_key','amount')->first()->custom_text }}: {{ $order->currency_icon }}{{ $order->amount_real_currency }}</p>
                            @if ($order->payment_method)
                            <p>{{ $websiteLang->where('lang_key','payment')->first()->custom_text }}: {{ $order->payment_method }}</p>
                            @endif
                            @if ($order->transaction_id)
                            <p>{{ $websiteLang->where('lang_key','trans_id')->first()->custom_text }}: {!! clean(nl2br(e($order->transaction_id))) !!} </p>
                            @endif

                        </div>
                    </div>
                    <div class="mt-3">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="table-light">
                                    <tr>
                                        <th>{{ $websiteLang->where('lang_key','package')->first()->custom_text }}</th>
                                        <th>{{ $websiteLang->where('lang_key','purchase_date')->first()->custom_text }}</th>
                                        <th>{{ $websiteLang->where('lang_key','expired_date')->first()->custom_text }}</th>
                                        <th>{{ $websiteLang->where('lang_key','amount')->first()->custom_text }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            {{ $order->package->package_name }}
                                        </td>
                                        <td>{{ $order->purchase_date }}</td>
                                        <td>{{ $order->expired_date == null ? 'Unlimited' :$order->expired_date }}</td>
                                        <td>{{ $order->currency_icon }}{{ $order->amount_real_currency }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <a class="common_btn mt-4" onclick="window.print()" href="javascript:;">{{ $websiteLang->where('lang_key','print')->first()->custom_text }}</a>
    </div>
</div>
@endsection
