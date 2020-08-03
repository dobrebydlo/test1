<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Card;
use App\Purchase;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
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
     */
    public function index()
    {
        /** @var User $user */
        $user = auth()->user();
        $isAdmin = $user->isAdmin();

        $data = [
            'user' => $user,
            'isAdmin' => $isAdmin,
        ];

        return $isAdmin
            ? $this->adminIndex($user, $data)
            : $this->customerIndex($user, $data);
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
        $customerCount = $user->query()->where('type', 'customer')->count();

        // Assigned card count
        $assignedCardCount = Card::query()->whereNotNull('user_id')->count();

        // Last purchase date to calculate 'the last 30 days' period
        $lastPurchaseDate = Carbon::parse(Purchase::query()->max('created_at'));

        // Top 10 customers by turnover
        $turnoverTop = Purchase
            ::with('user')
            ->join('item_purchase', 'item_purchase.purchase_id', 'purchases.id')
            ->groupBy(['user_id'])
            ->select(['user_id', DB::raw('sum(`amount`) as `turnover`')])
            ->where('created_at', '>', $lastPurchaseDate->subDays(30))
            ->orderBy('turnover', 'desc')
            ->take(10)
            ->get();

        // Extract filter string from the request
        $filter = request()->get('filter');

        // Customer listing with pagination and filter
        $customers = User
            /** @see \App\User::scopeFilteredBy() */
            ::filteredBy($filter)
            ->with('cards')
            ->where('type', 'customer')
            ->paginate();

        // Prepare get params for the pagination
        $getParams = collect(request()->query())
            ->except(['page'])
            ->toArray();

        // Put together all data for the layout
        $data = array_merge(
            $data,
            [
                'customerCount' => $customerCount,
                'assignedCardCount' => $assignedCardCount,
                'turnoverTop' => $turnoverTop,
                'customers' => $customers,
                'getParams' => $getParams,
                'filter' => $filter,
            ]
        );

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
        $data = array_merge(
            $data,
            [
                'cards' => $user->cards()->pluck('number'),
                'purchaseCount' => intval($user->purchases()->count()),
            ]
        );

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
