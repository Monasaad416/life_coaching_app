<?php

namespace Modules\Appointment\Http\Controllers;

use Alert;
use Exception;
use App\Models\Coach;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Support\Renderable;
use Modules\Appointment\Entities\Appointment;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        if(Auth::guard('admin')->check()) {
            if ($request->has('name')) {
                // Search by coach name
                return $this->searchByCoach($request->input('name'));
            } else {
                // Show all appointments
                $appointments = Appointment::paginate(20);

                return view('appointment::index', compact('appointments'));
            }

        } elseif(Auth::guard('coach')->check()) {
            $appointments = Appointment::where('coach_id',auth('coach')->user()->id)->get();
            return view('appointment::index',compact('appointments'));
        }

    }
    public function create()
    {
        return view('appointment::create');
    }

    public function store(Request $request)
    {
        try{
            //return dd($request->day);
            Appointment::create([
                'day' => $request->day,
                'from' => $request->from,
                'to' => $request->to,
                'coach_id' => auth('coach')->user()->id,
            ]);
             Alert::success( trans('admin.appointment_created_successfully'));
            return redirect()->route('coach.appointment.index');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function show($id)
    {
        return view('appointment::show');
    }

    public function edit($id)
    {
        $appointment = Appointment::findOrFail($id);
        return view('appointment::edit',compact('appointment'));
    }

    public function update(Request $request)
    {
        try{
            //return dd($request->day);
            $appointment = Appointment::findOrFail($request->id);
            $appointment->update([
                'day' => $request->day,
                'from' => $request->from,
                'to' => $request->to,
                'coach_id' => auth('coach')->user()->id,
            ]);
            Alert::success( trans('admin.appointment_updated_successfully'));
            return redirect()->route('coach.appointment.index');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Request $request)
    {
        try{
            $appointment = Appointment::findOrFail($request->id);
            $appointment->delete();
            Alert::success(trans('admin.appointment_deleted_successfully'));
        return redirect()->route('coach.appointment.index');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function searchByCoach(Request $request)
    {
        $query = $request->get('query');
        $coach = Coach::where('name', 'like', '%'.$query.'%')->first();
        if (!$coach) {
            // Coach not found, return an empty result set
            $appointments = collect();
        } else {
            // Coach found, get the appointments for the coach
            $appointments = $coach->appointments;
        }

            return response()->json([
                'appointments'=>$appointments,
                'coach'=>$coach->name
            ]);
    }
}
