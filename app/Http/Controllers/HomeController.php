<?php

namespace App\Http\Controllers;

use App\Card;
use App\Purchase;
use App\User;
use Illuminate\Http\Request;
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
     */
    public function index()
    {
        $customer_count = User::where('type', 'customer')->count();
        $card_count = Card::whereNotNull('user_id')->count();
        $turnover_top = Purchase
            ::groupBy('user_id')
            ->select(['user_id', DB::raw('sum(`amount`) as `turnover`')])
            ->where('created_at', '>', today()->subDays(30))
            ->with('user')
            ->orderBy('turnover', 'desc')
            ->take(10)
            ->get()
        ;

        $customers = User::where('users.type', 'customer')->with('cards');

        $filter = request()->get('filter');
        if (!empty($filter)) {
            $customers
                ->where('name', 'like', "{$filter}%")
                ->orWhere('list_name', 'like', "{$filter}%")
                ->orWhereIn('id', function($query) use (&$filter) {
                    $query
                        ->select('user_id')
                        ->from('cards')
                        ->where('number', 'like', "{$filter}%")
                    ;
                })
            ;
        }

        $customers = $customers->paginate();

        $get_params = collect(request()->query())->except(['page'])->toArray();

        $data = [
            'customer_count' => $customer_count,
            'card_count' => $card_count,
            'turnover_top' => $turnover_top,
            'customers' => $customers,
            'get_params' => $get_params,
            'filter' => $filter,
        ];

        return view('home')->with($data);
    }
}
