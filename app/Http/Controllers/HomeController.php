<?php

namespace App\Http\Controllers;

use App\Card;
use App\Purchase;
use App\User;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     * @see \App\User::scopeFilteredBy()
     */
    public function index()
    {
        // Total customer count
        $customer_count = User::where('type', 'customer')->count();

        // Assigned card count
        $assigned_card_count = Card::whereNotNull('user_id')->count();

        // Top 10 customers by turnover
        $turnover_top = Purchase
            ::with('user')
            ->groupBy('user_id')
            ->select(['user_id', DB::raw('sum(`amount`) as `turnover`')])
            ->where('created_at', '>', today()->subDays(30))
            ->orderBy('turnover', 'desc')
            ->take(10)
            ->get();

        // Extract filter string from the request
        $filter = request()->get('filter');

        // Customer listing with pagination and filter
        $customers = User
            ::with('cards')
            ->where('type', 'customer')
            ->filteredBy($filter) // See \App\User::scopeFilteredBy()
            ->paginate();

        // Prepare get params for the pagination
        $get_params = collect(request()->query())->except(['page'])->toArray();

        // Put together all data for the layout
        $data = [
            'customer_count' => $customer_count,
            'assigned_card_count' => $assigned_card_count,
            'turnover_top' => $turnover_top,
            'customers' => $customers,
            'get_params' => $get_params,
            'filter' => $filter,
        ];

        return view('home')->with($data);
    }
}
