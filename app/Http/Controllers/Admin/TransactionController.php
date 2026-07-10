<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RentDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    private const PERIODS = ['daily', 'weekly', 'monthly', 'yearly'];

    public function index(Request $request)
    {
        $period = $request->query('period', 'daily');
        abort_unless(in_array($period, self::PERIODS), 404);

        $transactions = RentDetail::with(['user', 'car.carType'])
            ->where('status', 'approved')
            ->latest()
            ->get();

        $summary = [
            'today' => $transactions->filter(fn ($t) => $t->created_at->isToday())->sum->amount,
            'week'  => $transactions->filter(fn ($t) => $t->created_at->gte(now()->startOfWeek()))->sum->amount,
            'month' => $transactions->filter(fn ($t) => $t->created_at->isCurrentMonth())->sum->amount,
            'year'  => $transactions->filter(fn ($t) => $t->created_at->isCurrentYear())->sum->amount,
        ];

        $breakdown = $transactions
            ->groupBy(fn ($t) => $this->periodKey($t->created_at, $period))
            ->sortKeysDesc()
            ->map(fn ($group, $key) => [
                'label'   => $this->periodLabel($key, $period),
                'count'   => $group->count(),
                'revenue' => $group->sum->amount,
            ]);

        return view('transactions.index', compact('transactions', 'summary', 'breakdown', 'period'));
    }

    private function periodKey(Carbon $date, string $period): string
    {
        return match ($period) {
            'daily'   => $date->format('Y-m-d'),
            'weekly'  => $date->copy()->startOfWeek()->format('Y-m-d'),
            'monthly' => $date->format('Y-m'),
            'yearly'  => $date->format('Y'),
        };
    }

    private function periodLabel(string $key, string $period): string
    {
        return match ($period) {
            'daily'   => Carbon::parse($key)->format('d M Y'),
            'weekly'  => Carbon::parse($key)->format('d M Y') . ' - ' . Carbon::parse($key)->endOfWeek()->format('d M Y'),
            'monthly' => Carbon::createFromFormat('Y-m', $key)->format('F Y'),
            'yearly'  => $key,
        };
    }
}
