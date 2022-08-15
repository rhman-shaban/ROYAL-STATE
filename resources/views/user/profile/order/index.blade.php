@extends('layouts.user.profile.layout')
@section('title')
    <title>{{ $websiteLang->where('lang_key','order')->first()->custom_text }}</title>
@endsection
@section('user-dashboard')
<div class="row">
    <div class="col-xl-9 ms-auto">
        <div class="wsus__dashboard_main_content">
            <h4 class="heading">{{ $websiteLang->where('lang_key','order')->first()->custom_text }}</h4>
            <div class="wsus__message">
                <div class="table-responsive">

                    <table class="table">
                        <thead>
                            <tr>
                                <th>{{ $websiteLang->where('lang_key','serial')->first()->custom_text }}</th>
                                <th>{{ $websiteLang->where('lang_key','package')->first()->custom_text }}</th>
                                <th>{{ $websiteLang->where('lang_key','purchase_date')->first()->custom_text }}</th>
                                <th>{{ $websiteLang->where('lang_key','expired_date')->first()->custom_text }}</th>
                                <th>{{ $websiteLang->where('lang_key','price')->first()->custom_text }}</th>
                                <th>{{ $websiteLang->where('lang_key','action')->first()->custom_text }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $index => $order)
                                <tr>
                                    <td>{{ ++$index }}</td>
                                    <td>
                                        {{ $order->package->package_name }}
                                        <br>
                                        @if ($order->status==1)
                                            @if ($order->expired_date==null)
                                                <span class="custom-badge">{{ $websiteLang->where('lang_key','currently_active')->first()->custom_text }}</span>
                                            @else
                                                @if (date('Y-m-d') < $order->expired_date)
                                                    <span class="custom-badge">{{ $websiteLang->where('lang_key','currently_active')->first()->custom_text }}</span>
                                                @endif
                                            @endif
                                        @endif

                                    </td>
                                    <td>{{ $order->purchase_date }}</td>
                                    <td>{{ $order->expired_date == null ? $websiteLang->where('lang_key','unlimited')->first()->custom_text :$order->expired_date }}</td>
                                    <td>{{ $order->currency_icon }}{{ $order->amount_real_currency }}</td>
                                    <td>
                                        <a href="{{ route('user.order.details',$order->id) }}" class="btn btn-success btn-sm"> <i class="fa fa-eye" aria-hidden="true"></i> </a>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                    {{ $orders->links() }}
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
