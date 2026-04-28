<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;

class SuperadminController extends Controller
{
    public function index()
    {
        if (Auth::user()->role !== 'superadmin') {
            return redirect('/')->with('error', 'Akses ditolak! Anda bukan Superadmin.');
        }

        $pendingUsers = User::where('status', 'pending')->get();
        $pendingEvents = Event::with('panitia')->where('status', 'pending')->get();

        return view('superadmin.index', compact('pendingUsers', 'pendingEvents'));
    }

    public function approveUser($id)
    {
        $user = User::findOrFail($id);
        $user->update(['status' => 'active']);
        return back()->with('success', 'Akun organisasi berhasil diaktifkan!');
    }

    public function updateEventStatus(Request $request, $id)
    {
        $event = Event::findOrFail($id);
        $event->update([
            'status' => $request->action,
            'reject_reason' => $request->reject_reason ?? null
        ]);
        
        return redirect()->route('superadmin.index')->with('success', 'Status acara berhasil diperbarui.');
    }

    public function allEvents()
    {
        $events = Event::with('panitia')->latest()->get();
        return view('superadmin.events', compact('events'));
    }

    public function showEvent($id)
    {
        $event = Event::with('panitia')->findOrFail($id);
        return view('superadmin.event_detail', compact('event'));
    }

    public function dashboard()
    {
        $totalOrgs = \App\Models\User::where('role', 'admin')->count();
        $totalEvents = \App\Models\Event::count();
        $totalPending = \App\Models\Event::where('status', 'pending')->count();
        $pendingEvents = \App\Models\Event::with('user')->where('status', 'pending')->latest()->take(5)->get();

        return view('superadmin.dashboard', compact('totalOrgs', 'totalEvents', 'totalPending', 'pendingEvents'));
    }

    public function organizations()
    {
        $organizations = User::where('role', 'admin')->where('status', 'active')->get();
        return view('superadmin.organizations', compact('organizations'));
    }

    public function updateOrganization(Request $request, $id)
    {
        $org = User::findOrFail($id);
        $org->update([
            'name' => $request->name,
            'organization' => $request->organization,
            'email' => $request->email
        ]);
        return back()->with('success', 'Data organisasi berhasil diperbarui!');
    }

    public function deleteOrganization($id)
    {
        User::findOrFail($id)->delete();
        return back()->with('success', 'Organisasi berhasil dihapus dari sistem!');
    }

    public function storeOrg(\Illuminate\Http\Request $request)
    {
        $request->validate([
            'organization' => 'required|string|max:255',
            'name'         => 'required|string|max:255',
            'email'        => 'required|string|email|max:255|unique:users',
            'password'     => 'required|string|min:6',
        ], [
            'email.unique' => 'Email ini sudah terdaftar, gunakan email lain.'
        ]);

        \App\Models\User::create([
            'organization' => $request->organization,
            'name'         => $request->name,
            'email'        => $request->email,
            'password'     => \Illuminate\Support\Facades\Hash::make($request->password),
            'role'         => 'admin', 
            'status'       => 'active'
        ]);
        return back()->with('success', 'Organisasi ' . $request->organization . ' berhasil ditambahkan!');
    }

}