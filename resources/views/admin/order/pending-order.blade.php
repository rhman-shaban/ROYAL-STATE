@extends('layouts.admin.layout')
@section('title')
<title>{{ $websiteLang->where('lang_key','pending_order')->first()->custom_text }}</title>
@endsection
@section('admin-content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ $websiteLang->where('lang_key','pending_order')->first()->custom_text }}</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                    <thead>
                        <tr>
                            <th width="5%">{{ $websiteLang->where('lang_key','serial')->first()->custom_text }}</th>
                            <th width="10%">{{ $websiteLang->where('lang_key','agent_s')->first()->custom_text }}</th>
                            <th width="10%">{{ $websiteLang->where('lang_key','email')->first()->custom_text }}</th>
                            <th width="10%">{{ $websiteLang->where('lang_key','package_s')->first()->custom_text }}</th>
                            <th width="15%">{{ $websiteLang->where('lang_key','purchase_date')->first()->custom_text }}</th>
                            <th width="15%">{{ $websiteLang->where('lang_key','expired_date')->first()->custom_text }}</th>
                            <th width="5%">{{ $websiteLang->where('lang_key','price')->first()->custom_text }}</th>
                            <th width="5%">{{ $websiteLang->where('lang_key','status')->first()->custom_text }}</th>
                            <th width="10%">{{ $websiteLang->where('lang_key','action')->first()->custom_textt }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $index => $order)
                        <tr>
                            <td>{{ ++$index }}</td>
                            <td>{{ $order->user->name }}</td>
                            <td>{{ $order->user->email }}</td>
                            <td>{{ $order->package->package_name }}</td>
                            <td>{{ $order->purchase_date }}</td>
                            <td>
                                @if ($order->expired_date==null)
                                {{ $websiteLang->where('lang_key','unlimited')->first()->custom_text }}
                                @else
                                    {{ $order->expired_date }}
                                @endif
                            </td>
                            <td>{{ $order->currency_icon }}{{ $order->amount_real_currency }}</td>
                            <td>
                                @if ($order->payment_status==1)
                                <span class="badge badge-success">{{ $websiteLang->where('lang_key','active')->first()->custom_text }}</span>
                                @else
                                <span class="badge badge-danger">{{ $websiteLang->where('lang_key','pending')->first()->custom_text }}</span>
                                @endif

                            </td>
                            <td>
                                <a onclick="return confirm('{{ $confirmNotify }}')" href="{{ route('admin.order-delete',$order->id) }}" class="btn btn-danger btn-sm"><i class="fas fa-trash" aria-hidden="true"></i></a>
                                <a href="{{ route('admin.pending-payment',$order->id) }}" class="btn btn-success btn-sm"><i class="fas fa-eye" aria-hidden="true"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>


                </table>
            </div>
        </div>
    </div>
@endsection
