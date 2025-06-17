<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Presensi;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = auth()->user();
        
        if ($user->isAdmin()) {
            return $this->adminDashboard();
        } else {
            return $this->userDashboard();
        }
    }

    private function adminDashboard()
    {
        $totalUsers = User::where('role', 'user')->count();
        $totalPresensis = Presensi::count();
        $todayPresensis = Presensi::whereDate('tanggal', Carbon::today())->count();
        $todayHadir = Presensi::whereDate('tanggal', Carbon::today())
                             ->where('status', 'Hadir')
                             ->count();
        
        $recentPresensis = Presensi::with('user')
                                  ->latest()
                                  ->take(5)
                                  ->get();
        
        $statusStats = [
            'hadir' => Presensi::where('status', 'Hadir')->count(),
            'izin' => Presensi::where('status', 'Izin')->count(),
            'sakit' => Presensi::where('status', 'Sakit')->count(),
            'alpha' => Presensi::where('status', 'Alpha')->count(),
        ];

        return view('dashboard.admin', compact(
            'totalUsers', 
            'totalPresensis', 
            'todayPresensis', 
            'todayHadir',
            'recentPresensis',
            'statusStats'
        ));
    }

    private function userDashboard()
    {
        $user = auth()->user();
        $myPresensis = Presensi::where('user_id', $user->id)
                              ->latest()
                              ->take(10)
                              ->get();
        
        $myStats = [
            'hadir' => Presensi::where('user_id', $user->id)->where('status', 'Hadir')->count(),
            'izin' => Presensi::where('user_id', $user->id)->where('status', 'Izin')->count(),
            'sakit' => Presensi::where('user_id', $user->id)->where('status', 'Sakit')->count(),
            'alpha' => Presensi::where('user_id', $user->id)->where('status', 'Alpha')->count(),
        ];

        return view('dashboard.user', compact('myPresensis', 'myStats'));
    }
}
