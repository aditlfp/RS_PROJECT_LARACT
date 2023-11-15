<?php

namespace App\Http\Controllers;

use App\Http\Requests\PatientRequest;
use App\Http\Resources\PatientResource;
use App\Models\Patient;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PatientController extends Controller
{
    public function index(Request $request)
    {
        $patientQuery = Patient::when($request->search, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('NIK', 'LIKE', '%' . $search . '%')
                    ->orWhere('no_reg', 'LIKE', '%' . $search . '%');
            });
        });
        
        $patient = $patientQuery->paginate(15);
        
        if ($patient->count() <= 0) {
            // Handle the case where no data is found
            $patients = new PatientResource(Patient::paginate(15));
            return Inertia::render('', ['patient' => $patients])->with('red', 'Data Not Found!');
        }
        
        $patient = new PatientResource($patient);
        
        return Inertia::render('', ['patient' => $patient]);
    }

    public function create()
    {
        return Inertia::render('');
    }

    public function store(PatientRequest $request)
    {
        $patient = new Patient();
        $patient = $request->rules();
        Patient::create($patient);
        return to_route('')->with('message', 'Data Has Been Created!');
        // $patient = [
        //     'nama_pasien' => $request->nama_pasien,
        //     'NIK' => $request,
        //     'alamat_lengkap' => $request,
        //     'no_tlp' => $request,
        //     'umur' => $request,
        //     'keluhan' => $request,
        //     'tgl_daftar' => $request
        // ];
    }

    public function edit($id)
    {
        try {
            $patient = Patient::findOrFail($id);
        } catch (\Throwable $th) {
            return redirect()->back()->with('red', 'Data Not Found!');
        }

        return Inertia::render('', compact('patient'));
    }

    public function update(Request $request, $id)
    {
         $patient = [
            'nama_pasien' => $request->nama_pasien,
            'NIK' => $request,
            'alamat_lengkap' => $request,
            'no_tlp' => $request,
            'umur' => $request,
            'keluhan' => $request,
            'tgl_daftar' => $request
        ];

        $patientID = Patient::findOrFail($id);
        $patientID->update($patient);
        return to_route('')->with('message', 'Data Patient Has Been Updated!');
    }

    public function show($id)
    {
        $patient = Patient::findOrFail($id);
        return Inertia::render('', compact('patient'));
    }

    public function destroy($id)
    {
        $patient = Patient::findOrFail($id);
        $patient->delete($id);
        return redirect()->back()->with('yellow', 'Data Patient Has Been Deleted Permanently!');
    }
}
