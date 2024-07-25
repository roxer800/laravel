<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\vacansy;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VacancyController extends Controller
{

    public function index()
    {
        $vacansies = vacansy::get();


        return view('./vacancys/index', ["vacansies" => $vacansies]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {



        return view('./vacancys/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'available_at' => 'required|date|after_or_equal:today',

        ]);

        vacansy::create([
            'name' => $request['name'],
            'description' => $request['description'],
            'available_at' => Carbon::parse($request->available_at),
            'users_id' => Auth::id(),
            'photo' =>  $request->file('image')->store('photos', 'public')
        ]);

        if ($request === false) {
            return redirect()->back()
                ->withError('შეცდომა')
                ->withInput();
        }


        return redirect('./')->with('success', 'vacancy added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $vacansies = vacansy::find($id);



        return view('./vacancys/vacancy-show', compact('vacansies'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(vacansy $vacancy)
    {


        return view('./vacancys/vacancy-edit', ['vacansy' => $vacancy]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, vacansy $vacancy)
    {


        $validated = $request->validate([
            'name' => 'required | string | max:50',
            'description' => 'required | string | max:300',

        ]);

        $vacancy->update([
            'name' => $validated['name'],
            'description' => $validated['description'],

        ]);

        return redirect('./')->with('success', 'Product updated successfully');
    }

    public function apply(Request $request, $id)
    {
        $vacancy = vacansy::find($id);
        $user = Auth::user();





        if ($vacancy->users_id == $user->id) {
            return redirect('./')->with('error', 'საკუთარ ვაკანსიაზე დატეგისტრირება აკრძალულია');
        }


        if (Application::where('users_id', $user->id)->where('vacansies_id', $vacancy->id)->exists()) {
            return redirect('./')->with('error', 'ამ ვაკანსიაზე უკვე დარეგისტირებული ხარ');
        }

        Application::create([
            'users_id' => $user->id,
            'vacansies_id' => $vacancy->id,
            'name' => $request['name'],
            'email' => $request['email'],
            'motivation' => $request['motivation'],
        ]);

        return redirect('./')->with('success', 'თქვენ წარმატებით გაიარეთ რეგისტრაცია');
    }

    public function myVacancy()
    {
        $user = Auth::user();
        $vacancy = vacansy::where('users_id', $user->id)->get();


        return view('./vacancys/my-vacancy', compact("vacancy"));
    }
    public function registeredVacancy()
    {
        $user = Auth::id();
        $applications = Application::where('users_id', $user)->get();
        $vacanciesIds = $applications->pluck('vacansies_id');

        $vacancy = vacansy::whereIn('id', $vacanciesIds)->get();



        return view('./vacancys/registered-vacancy', compact('vacancy'));
    }

    public function submissions()
    {
        $user = Auth::user();

        $applications = DB::table('applications')
            ->join('vacansies', 'applications.vacansies_id', '=', 'vacansies.id')
            ->where('vacansies.users_id', $user->id)
            ->whereColumn('applications.users_id', '!=', 'vacansies.users_id')
            ->get();

        dump($applications);

        return view('./vacancys.submissions', compact('applications'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(vacansy $vacancy)
    {
        $vacancy->delete();


        return redirect('./')->with('success', 'პროდუქტი წაიშალა');
    }
}
