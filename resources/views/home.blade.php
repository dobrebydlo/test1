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

                    @if($isAdmin)
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="alert">
                                        <form action="/home" method="get" class="form form-inline" name="filterForm">
                                            <div class="container-fluid">
                                                <div class="row">
                                                    <div class="col-md-2 text-left">
                                                        <label for="filter">Filter:</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input style="width: 100%;" class="form-text" type="text" name="filter" value="{{ $filter }}" placeholder="Name, surname, or card number">
                                                    </div>
                                                    <div class="col-md-4 text-right">
                                                        <button class="form-submit" type="submit">Apply filter</button>
                                                        <button class="form-button" type="button" onclick="javascript:document.filterForm.filter.value = '';document.filterForm.submit();">Drop filter</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
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
                                        {{ $customers->appends(isset($getParams) ? $getParams : request()->query())->render() }}
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <h5>Stats</h5>
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <th>Number of Customers</th>
                                                <td>{{ $customerCount }}</td>
                                            </tr>
                                            <tr>
                                                <th>Number of assigned Cards</th>
                                                <td>{{ $assignedCardCount }}</td>
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
                                            @foreach($turnoverTop as $record)
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
                    @else
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <th>Name</th>
                                    <td>{{ $user->name }}</td>
                                </tr>
                                <tr>
                                    <th>email</th>
                                    <td>{{ $user->email }}</td>
                                </tr>
                                <tr>
                                    <th>Cards</th>
                                    <td>{{ $cards->isNotEmpty() ? $cards->implode(', ') : 'None' }}</td>
                                </tr>
                                <tr>
                                    <th>Purchases</th>
                                    <td>{{ $purchaseCount }}</td>
                                </tr>
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
