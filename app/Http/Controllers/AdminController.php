<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\users;
use App\Models\country;
use App\Models\city;
use App\Models\countrylanguage;





class AdminController extends Controller
{
    public function login(Request $request){

        // Validate the request data
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $email = $request->input('email');
        $password = $request->input('password');

        // Fetch the user by email
        $user = users::where('email', $email)->first();

        if ($user) {
            // Verify the hashed password
            if (Hash::check($password, $user->password)) {
                // Store user information in session
                Session::put('user_id', $user->id);

                return redirect()->route('dashboard');
            }
        }

        // Redirect back with error message
        return redirect()->back()->withErrors(['login' => 'Invalid login details.']);
    }

    public function dashboard(){
        $countries = country::orderBy('Name')->get();
        $cities = city::whereIn('ID', $countries->pluck('Capital'))->get(); 

        return view('dashboard' ,compact('countries',  'cities'));
    }

    public function editCountry(Request $request){
        $validated = $request->validate([
            'code' => 'required|string|max:3',
            'name' => 'required|string|max:255',
            'continent' => 'required|string|max:255', 
            'region' => 'required|string|max:255',
            'surfaceArea' => 'required|numeric',
            'indepYear' => 'nullable|integer',
            'population' => 'required|integer',
            'lifeExpectancy' => 'nullable|numeric',
            'gnp' => 'nullable|numeric',
            'gnpOld' => 'nullable|numeric',
            'localName' => 'required|string|max:255',
            'governmentForm' => 'required|string|max:255',
            'headOfState' => 'nullable|string|max:255',
            'capital' => 'required|string|max:255',
            'code2' => 'required|string|max:3',
        ]);


        $country = country::where('Code', $validated['code'])->first();

        if (!$country) {
            return redirect()->back()->with('error', 'Country not found');
        }

        $country->update([
            'Code' => $validated['code'],
            'Name' => $validated['name'],
            'Continent' => $validated['continent'], // Corrected to match the model's fillable property
            'Region' => $validated['region'],
            'SurfaceArea' => $validated['surfaceArea'],
            'IndepYear' => $validated['indepYear'],
            'Population' => $validated['population'],
            'LifeExpectancy' => $validated['lifeExpectancy'],
            'GNP' => $validated['gnp'],
            'GNPOld' => $validated['gnpOld'],
            'LocalName' => $validated['localName'],
            'GovernmentForm' => $validated['governmentForm'],
            'HeadOfState' => $validated['headOfState'],
            'Capital' => $validated['capital'],
            'Code2' => $validated['code2'],
        ]);


        return redirect()->route('dashboard')->with('success', 'Country updated successfully');
    }

    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|string|max:3',
            'name' => 'required|string|max:255',
            'continent' => 'required|string|max:255', // Fixed field name to match the form and model
            'region' => 'required|string|max:255',
            'surfaceArea' => 'required|numeric',
            'indepYear' => 'nullable|integer',
            'population' => 'required|integer',
            'lifeExpectancy' => 'nullable|numeric',
            'gnp' => 'nullable|numeric',
            'gnpOld' => 'nullable|numeric',
            'localName' => 'required|string|max:255',
            'governmentForm' => 'required|string|max:255',
            'headOfState' => 'nullable|string|max:255',
            'capital' => 'required|string|max:255',
            'code2' => 'required|string|max:3',
        ]);

        Country::create([
            'Code' => $validated['code'],
            'Name' => $validated['name'],
            'Continent' => $validated['continent'], // Corrected to match the model's fillable property
            'Region' => $validated['region'],
            'SurfaceArea' => $validated['surfaceArea'],
            'IndepYear' => $validated['indepYear'],
            'Population' => $validated['population'],
            'LifeExpectancy' => $validated['lifeExpectancy'],
            'GNP' => $validated['gnp'],
            'GNPOld' => $validated['gnpOld'],
            'LocalName' => $validated['localName'],
            'GovernmentForm' => $validated['governmentForm'],
            'HeadOfState' => $validated['headOfState'],
            'Capital' => $validated['capital'],
            'Code2' => $validated['code2'],
        ]);

        return redirect()->route('dashboard')->with('success', 'Country added successfully.');
    }


    public function deleteCountry($code){
        try {
            country::where('Code', $code)->delete();
            
            return redirect()->route('dashboard');

        }catch(\Exception $e){

            return dd($e);
        }
    }

    public function logout(Request $request){
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login-form');
    }

    public function createUser(Request $request){
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:6',
            ]);

            users::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
            ]);

            return redirect()->route('dashboard')->with('success', 'User created successfully.');
        } catch (\Exception $e) {
            return dd($e);
        }
    }
}
