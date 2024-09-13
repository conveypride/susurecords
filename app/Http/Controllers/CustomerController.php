<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    //
    public function fetchBookletPage(Request $request)
    {
        $customerid = $request->input('customerid');
        $page = $request->input('page', 1);
        $companyId = Auth::user()->companyId;
    
        // Paginate the savings booklet pages to show one page at a time
        $savingsBookletPages = DB::table('savings_booklet_pages')
            ->where('companyId', $companyId)
            ->where('customerid', $customerid)
            ->paginate(1, ['*'], 'page', $page); // One page at a time
    
        return response()->json($savingsBookletPages);
    }
    
    public function fetchTransactions(Request $request)
    {
        $customerid = $request->input('customerid');
        $pageNum = $request->input('pagenum');
        $companyId = Auth::user()->companyId;
    
        // Get the transactions for the current savings booklet page and paginate them
        $transactions = DB::table('transactions')
            ->where('companyId', $companyId)
            ->where('customerid', $customerid)
            ->where('pagenum', $pageNum)
            ->paginate(31); // Up to 31 transactions per page
    
        return response()->json($transactions);
    }
    

    public function createBookletPage(Request $request)
    {
        $customerId = $request->input('customerid');
        $bookletId = $request->input('bookletId');
    
        // Create a new page in the savings booklet
        $newPage = DB::table('savings_booklet_pages')->insertGetId([
            'companyId' => Auth::user()->companyId,
            'customerid' => $customerId,
            'bookletId' => $bookletId,
            'pagenum' => DB::table('savings_booklet_pages')->where('customerid', $customerId)->max('pagenum') + 1, // Increment page number
            'balance' => 0, // Initialize other fields as needed
            'totaldeposit' => 0,
            'profit' => 0,
            'isfull'=> 'false',
            'haswithdrawn'=> 'false',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    
        // Return success response with the new page number
        return response()->json(['success' => true, 'newPage' => $newPage]);
    }
    
    public function saveTransaction(Request $request)
    {
        // Get the data from the request
        $customerId = $request->input('customerid');
        $bookletId = $request->input('bookletId');
        $pagenum = $request->input('pagenum');
        $boxId = $request->input('boxid');
        $transactionDate = $request->input('transactionDate');
        $depositAmount = $request->input('depositamount');
    
        // Save the transaction
        DB::table('transactions')->insert([
            'companyId' => Auth::user()->companyId,
            'customerid' => $customerId,
            'bookletId' => $bookletId,
            'pagenum' => $pagenum,
            'boxid' => $boxId,
            'transactionDate' => $transactionDate,
            'depositamount' => $depositAmount,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    
        // Return success response
        return response()->json(['success' => true]);
    }
    

}
