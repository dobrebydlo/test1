@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-8">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <td>Customer name</td>
                                            <td>Card numbers</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($customers as $customer)
                                            <tr>
                                                <td>{{ $customer->list_name }}</td>
                                                <td>{{ collect($customer->cards)->pluck('number')->implode(', ') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="text-center">
                                    {{ $customers->appends(isset($get_params) ? $get_params : request()->query())->render() }}
                                </div>

                            </div>
                            <div class="col-md-4">
                                <h5>Stats</h5>
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <th>Number of Customers</th>
                                            <td>{{ $card_count }}</td>
                                        </tr>
                                        <tr>
                                            <th>Number of assigned Cards</th>
                                            <td>{{ $customer_count }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <h5>Top 10 turnover in the last 30 days</h5>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Customer</th>
                                            <th>Turnover</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($turnover_top as $record)
                                            <tr>
                                                <td>{{ $record->user->name }}</td>
                                                <td>{{ $record->turnover }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
