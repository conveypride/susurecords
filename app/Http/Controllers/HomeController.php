<?php

namespace App\Http\Controllers;

use App\Models\Withdraw;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
    
 

public function index(Request $request)
{
    if (Auth::check()) {
        $year = $request->input('year', 'All'); // Default to 'All' if not provided
        $month = $request->input('month', 'All'); // Default to 'All' if not provided

        // Initialize query builder
        $query = DB::table('savings_booklet_pages')->where('companyId', Auth::user()->companyId );
        $withdrawQuery = Withdraw::query();
        $customerQuery = DB::table('registercustomers')->where('companyId', Auth::user()->companyId )->where('status', 'Active');

        if ($year !== 'All') {
            $query->whereYear('created_at', $year);
            $withdrawQuery->where('companyId', Auth::user()->companyId )->whereYear('created_at', $year);
            $customerQuery->whereYear('created_at', $year);
              // Count the total number of transactions
          $totalTransactions = DB::table('transactions') // Replace 'transactions' with your actual table name
          ->where('companyId', Auth::user()->companyId )
          ->whereYear('created_at', $year)
          ->whereMonth('created_at', $month)
          ->count();
        }

        if ($month !== 'All') {
            $month = str_pad($month, 2, '0', STR_PAD_LEFT);
            $query->whereMonth('created_at', $month);
            $withdrawQuery->where('companyId', Auth::user()->companyId )->whereMonth('created_at', $month);
            $customerQuery->whereMonth('created_at', $month);

  // Count the total number of transactions
  $totalTransactions = DB::table('transactions') // Replace 'transactions' with your actual table name
  ->where('companyId', Auth::user()->companyId )
  ->whereYear('created_at', $year)
  ->whereMonth('created_at', $month)
  ->count();

        }

        $profit = $query->sum('profit');
        $totaldeposit = $query->sum('totaldeposit');
        $totalwithdrwan = $withdrawQuery->where('companyId', Auth::user()->companyId )->sum('withdrawalamount');
        $balance = $totaldeposit - ($totalwithdrwan + $profit);
        $customers = $customerQuery->count('cardnum');


          // Count the total number of transactions
          $totalTransactions = DB::table('transactions')->where('companyId', Auth::user()->companyId )->count();

        // Total number of users
        $totalUsers = DB::table('registercustomers')->where('companyId', Auth::user()->companyId )->count();
        
        if ($totalUsers > 0) {
          // Total number of male and female users
          $totalMales = DB::table('registercustomers')->where('companyId', Auth::user()->companyId )->where('gender', 'Male')->count();
          $totalFemales = DB::table('registercustomers')->where('companyId', Auth::user()->companyId )->where('gender', 'Female')->count();

          // Total number of active and inactive users
          $totalActive = DB::table('registercustomers')->where('companyId', Auth::user()->companyId )->where('status', 'Active')->count();
          $totalInactive = DB::table('registercustomers')->where('companyId', Auth::user()->companyId )->where('status', 'Disabled')->count();

          // Calculate percentages
          $percentageMales =round( ($totalMales / $totalUsers) * 100);
          $percentageFemales = round(($totalFemales / $totalUsers) * 100);
          $percentageActive = round(($totalActive / $totalUsers) * 100);
          $percentageInactive = round(($totalInactive / $totalUsers) * 100);
      } else {
          // Handle case where there are no users
          $totalMales = $totalFemales = $totalActive = $totalInactive = 0;
          $percentageMales = $percentageFemales = $percentageActive = $percentageInactive = 0;
      }


      $startOfWeek = Carbon::now()->startOfWeek();
      $endOfWeek = Carbon::now()->endOfWeek();

      // Query total expenses for the current week
      $weeklyExpenses = DB::table('expenditures')
          ->where('companyId', Auth::user()->companyId)
          ->whereBetween('date', [$startOfWeek, $endOfWeek])
          ->sum('amount');

// Get start and end of last week
$startOfLastWeek = Carbon::now()->subWeek()->startOfWeek();
$endOfLastWeek = Carbon::now()->subWeek()->endOfWeek();

// Query total expenses for last week
$lastWeekExpenses = DB::table('expenditures')
    ->where('companyId', Auth::user()->companyId)
    ->whereBetween('date', [$startOfLastWeek, $endOfLastWeek])
    ->sum('amount');



        return view('content.dashboard.dashboards-analytics', compact('profit', 'totaldeposit', 'balance', 'customers', 'totalwithdrwan', 'year', 'month', 'totalTransactions', 'totalMales', 'totalFemales', 'percentageMales', 'percentageFemales', 'totalActive', 'totalInactive', 'percentageActive', 'percentageInactive', 'totalUsers', 'weeklyExpenses','lastWeekExpenses'));
    } else {
        return redirect()->route('login');
    }
}

 
// In your Controller

public function getChartData()
{
    $data = DB::table('savings_booklet_pages')
        ->select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('SUM(totaldeposit) as totaldeposit')
        )
        ->where('companyId', Auth::user()->companyId)
        ->groupBy(DB::raw('MONTH(created_at)'))
        ->orderBy('month')
        ->get();

    // Format the data to match the chart requirements
    $formattedData = [
        'months' => $data->pluck('month')->map(function($month) {
            return date('M', mktime(0, 0, 0, $month, 1)); // Convert month number to abbreviated month name
        })->toArray(),
        'values' => $data->pluck('totaldeposit')->toArray()
    ];

    return response()->json($formattedData);
}


 

}
