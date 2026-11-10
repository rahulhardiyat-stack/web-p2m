<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Lecturer;
use Illuminate\Http\Request;

class LecturerController extends Controller
{
    protected $lecturer = 'dosen';
    protected $tendik = 'tendik';

    public function index(Request $request)
    {

        $dosenQuery = Lecturer::active()->where('type', 'dosen');
        if($request->filled('q')) {
            $search = $request->q;
            $dosenQuery->where(function($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('nip', 'like', "%{$search}%")
                    ->orWhere('position', 'like', "%{$search}%");
            });
        } else {
            $query = Lecturer::active()
                ->where('type', $this->lecturer)
                ->orderBy('order')->paginate(15);
        }

        $dosen = $dosenQuery->orderBy('order')->paginate(15);
        $dosen->appends($request->all());
        $tendik = Lecturer::active()->where('type', 'tendik')->orderBy('order')->paginate(15);

        return view('frontend.lecturers.index', compact('dosen', 'tendik'));
    }

    public function show(Lecturer $lecturer)
    {
        abort_unless($lecturer->is_active, 404);
        return view('frontend.lecturers.show', compact('lecturer'));
    }
}
