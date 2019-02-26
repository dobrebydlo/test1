<?php

namespace App\Http\Controllers;

use App\Card;
use App\Purchase;
use App\User;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    /**
     * @var array
     */
    protected $views = [
        'index' => 'home',
    ];

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
        $user = auth()->user();
        $is_admin = $user->type === 'admin';

        $data = [
            'user' => $user,
            'is_admin' => $is_admin,
        ];

        return $is_admin ? $this->adminIndex($user, $data) : $this->customerIndex($user, $data);
    }

    /**
     * Show stats
     *
     * @param User $user
     * @param array $data
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    protected function adminIndex(User $user, array $data = [])
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
            ->filteredBy($filter)
            // @see \App\User::scopeFilteredBy()
            ->paginate();

        // Prepare get params for the pagination
        $get_params = collect(request()->query())->except(['page'])->toArray();

        // Put together all data for the layout
        $data = array_merge($data, [
            'customer_count' => $customer_count,
            'assigned_card_count' => $assigned_card_count,
            'turnover_top' => $turnover_top,
            'customers' => $customers,
            'get_params' => $get_params,
            'filter' => $filter,
        ]);

        return $this->getIndexView()->with($data);
    }

    /**
     * Show customer their personal data
     *
     * @param User $user
     * @param array $data
     * @return \Illuminate\View\View
     */
    protected function customerIndex(User $user, array $data = [])
    {

        $data = array_merge($data, [
            'cards' => $user->cards()->pluck('number'),
            'purchase_count' => intval($user->purchases()->count()),
        ]);

        return $this->getIndexView()->with($data);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    protected function getIndexView()
    {
        return view($this->views['index']);
    }

}
