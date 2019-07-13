<?php

namespace App\Http\Controllers\Admin;

use App\ClientCollecting;
use App\ClientPayment;
use App\Expenses;
use App\PurchaseOrder;
use App\PurchaseOrderProducts;
use App\SaleOrder;
use App\SaleOrderProducts;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ReportsController extends Controller
{
    public function index()
    {
        return view('admin.reports.index');
    }

    public function dayBook()
    {

        return view('admin.reports.dayBook');
    }

    public function dayBookByAjax()
    {
        if (isset($_GET['dateSearch'])){
            $date = $_GET['dateSearch'];
            $saleOrder = SaleOrder::where('invoiceDate', $date)->first();
            $saleOrderIds = SaleOrder::where('invoiceDate', $date)->pluck('id')->toArray();
            $dayBook = SaleOrderProducts::whereIn('sale_order_id', $saleOrderIds)->orderBy('id', 'desc')->get();
            return response()->json(['dayBook' => $dayBook, 'saleOrder' => $saleOrder], 200);
        }
    }

    public function reportDay()
    {
        return view('admin.reports.reportDay');
    }

    public function reportDayAjax()
    {
        if (isset($_GET['searchDate'])){
            $searchDate = $_GET['searchDate'];
            $searchDate = explode('-', $searchDate);
//            dd($searchDate);
            $day = $searchDate[2]; // Day
            $month = $searchDate[1]; // Month
            $year = $searchDate[0]; // Year

            /* Purchases Of The Month */
            $purchaseOfTheMonth = PurchaseOrder::whereDay('created_at', $day)
                ->whereMonth('created_at', $month)
                ->whereYear('created_at', $year)
                ->pluck('id')->toArray();
            $totalPurchases = PurchaseOrderProducts::whereIn('purchase_order_id', $purchaseOfTheMonth)->sum('total');
            if (!$totalPurchases){
                $totalPurchases = 0;
            }
            /* Sales Of The Month */
            $salesOfTheMonth = SaleOrder::whereDay('created_at', $day)
                ->whereMonth('created_at', $month)
                ->whereYear('created_at', $year)
                ->pluck('id')->toArray();
            $totalCostOfSales = SaleOrderProducts::whereIn('sale_order_id', $salesOfTheMonth)->sum('total_purchase_price');
            $totalSales = SaleOrderProducts::whereIn('sale_order_id', $salesOfTheMonth)->sum('total');
            if (!$totalSales){
                $totalSales = 0;
                $salesProfit = 0;
                $profitPercent = 0;
            }else{
                $salesProfit = $totalSales - $totalCostOfSales;
                $profitPercent = number_format($salesProfit/$totalSales*100, 2);
            }



            /* Expenses Of The Month */
            $expenses = Expenses::whereDay('created_at', $day)
                ->whereMonth('created_at', $month)
                ->whereYear('created_at', $year)
                ->sum('amount');

            /* Payments Of The Month */
            $payments = ClientPayment::whereDay('created_at', $day)
                ->whereMonth('created_at', $month)
                ->whereYear('created_at', $year)
                ->sum('amount');

            /* Collecting Of The Month */
            $collecting = ClientCollecting::whereDay('created_at', $day)
                ->whereMonth('created_at', $month)
                ->whereYear('created_at', $year)
                ->sum('amount');

            $total = ($totalSales + $collecting) - ($totalPurchases + $payments + $expenses);

            return response()->json([
                'totalPurchases' => $totalPurchases,
                'totalSales' => $totalSales,
                'salesProfit' => $salesProfit,
                'profitPercent' => $profitPercent,
                'expenses' => $expenses,
                'payments' => $payments,
                'collecting' => $collecting,
                'total' => $total,
                ], 200);

        }
    }


    public function reportMonth()
    {
        return view('admin.reports.reportMonth');
    }

    public function reportMonthAjax()
    {
        if (isset($_GET['searchDate'])){
            $searchDate = $_GET['searchDate'];
            $searchDate = explode('-', $searchDate);
            $month = $searchDate[1];
            $year = $searchDate[0];

            /* Purchases Of The Month */
            $purchaseOfTheMonth = PurchaseOrder::whereMonth('created_at', $month)
                ->whereYear('created_at', $year)
                ->pluck('id')->toArray();
            $totalPurchases = PurchaseOrderProducts::whereIn('purchase_order_id', $purchaseOfTheMonth)->sum('total');
            if (!$totalPurchases){
                $totalPurchases = 0;
            }
            /* Sales Of The Month */
            $salesOfTheMonth = SaleOrder::whereMonth('created_at', $month)
                ->whereYear('created_at', $year)
                ->pluck('id')->toArray();
            $totalCostOfSales = SaleOrderProducts::whereIn('sale_order_id', $salesOfTheMonth)->sum('total_purchase_price');
            $totalSales = SaleOrderProducts::whereIn('sale_order_id', $salesOfTheMonth)->sum('total');
            if (!$totalSales){
                $totalSales = 0;
                $salesProfit = 0;
                $profitPercent = 0;
            }else{
                $salesProfit = $totalSales - $totalCostOfSales;
                $profitPercent = number_format($salesProfit/$totalSales*100, 2);
            }



            /* Expenses Of The Month */
            $expenses = Expenses::whereMonth('created_at', $month)
                ->whereYear('created_at', $year)
                ->sum('amount');

            /* Payments Of The Month */
            $payments = ClientPayment::whereMonth('created_at', $month)
                ->whereYear('created_at', $year)
                ->sum('amount');

            /* Collecting Of The Month */
            $collecting = ClientCollecting::whereMonth('created_at', $month)
                ->whereYear('created_at', $year)
                ->sum('amount');

            $total = ($totalSales + $collecting) - ($totalPurchases + $payments + $expenses);

            return response()->json([
                'totalPurchases' => $totalPurchases,
                'totalSales' => $totalSales,
                'salesProfit' => $salesProfit,
                'profitPercent' => $profitPercent,
                'expenses' => $expenses,
                'payments' => $payments,
                'collecting' => $collecting,
                'total' => $total,
            ], 200);

        }
    }

    public function reportYear()
    {
        return view('admin.reports.reportYear');
    }

    public function reportYearAjax()
    {
        if (isset($_GET['searchDate'])){
            $year = $_GET['searchDate'];


            /* Purchases Of The Year */
            $purchaseOfTheYear = PurchaseOrder::whereYear('created_at', $year)->pluck('id')->toArray();
            $totalPurchases = PurchaseOrderProducts::whereIn('purchase_order_id', $purchaseOfTheYear)->sum('total');
            if (!$totalPurchases){
                $totalPurchases = 0;
            }
            /* Sales Of The Year */
            $salesOfTheYear = SaleOrder::whereYear('created_at', $year)->pluck('id')->toArray();
            $totalCostOfSales = SaleOrderProducts::whereIn('sale_order_id', $salesOfTheYear)->sum('total_purchase_price');
            $totalSales = SaleOrderProducts::whereIn('sale_order_id', $salesOfTheYear)->sum('total');
            if (!$totalSales){
                $totalSales = 0;
                $salesProfit = 0;
                $profitPercent = 0;
            }else{
                $salesProfit = $totalSales - $totalCostOfSales;
                $profitPercent = number_format($salesProfit/$totalSales*100, 2);
            }



            /* Expenses Of The Year */
            $expenses = Expenses::whereYear('created_at', $year)->sum('amount');

            /* Payments Of The Year */
            $payments = ClientPayment::whereYear('created_at', $year)->sum('amount');

            /* Collecting Of The Year */
            $collecting = ClientCollecting::whereYear('created_at', $year)->sum('amount');

            $total = ($totalSales + $collecting) - ($totalPurchases + $payments + $expenses);

            return response()->json([
                'totalPurchases' => $totalPurchases,
                'totalSales' => $totalSales,
                'salesProfit' => $salesProfit,
                'profitPercent' => $profitPercent,
                'expenses' => $expenses,
                'payments' => $payments,
                'collecting' => $collecting,
                'total' => $total,
            ], 200);

        }
    }
}
