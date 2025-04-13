<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TicketHistory;

class HistoryController extends Controller
{
    public function historyTicket()
    {
        $histories = TicketHistory::with('ticket')->get(); // relasi ticket
        return view('pages.history', compact('histories'));
    }
}
