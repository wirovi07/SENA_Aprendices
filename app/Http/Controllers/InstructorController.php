<?php

namespace App\Http\Controllers;

use App\Models\Instructor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Helpers\Codification;
use Illuminate\Database\QueryException;

class InstructorController extends Controller
{

    public function index()
    {
        $instructores = Instructor::all();

        return response()->json(['message' => 'List instructores', 'data' => $instructores]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'type_document' => 'required|string',
            'document' => 'required|numeric',
            'name' => 'required|string',
            'email' => 'required|string',
            'sex' => 'required|string',
            'phone' => 'required|numeric',
            'address' => 'required|string',
            'birthdate' => 'required|date',
            'address' => 'required|string',
            'city' => 'required|string',
            'profesion' => 'required|string',
            'estado' => 'required|string',
        ]);

        DB::beginTransaction();

        try {

            $user = new User();
            $user->type_document = $request->type_document;
            $user->document = $request->document;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->sex = $request->sex;
            $user->phone = $request->phone;
            $user->birthdate = $request->birthdate;
            $user->address = $request->address;
            $user->city = $request->city;
            $user->rol = "instructor";
            $user->save();

            $instructores = new Instructor();
            $instructores->profesion = $request->profesion;
            $instructores->estado = $request->estado;
            $instructores->user_id = $user->id;
            $instructores->save();


            DB::commit();
            return response()->json(['message' => 'Instructores created successfully']);
        } catch (QueryException $e) {
            DB::rollBack();
            return response()->json(['message' => 'Error creating Instructores: ' . $e->getMessage()], 500);
        }
    }

    public function show(string $id)
    {
        $instructores = Instructor::find($id);

        if ($instructores) {
            return response()->json(['message' => 'Instructor found in the list', 'data' => $instructores]);
        } else {
            return response()->json(['message' => 'Instructor not found in the list']);
        }
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'type_document' => 'required|string',
            'document' => 'required|numeric',
            'name' => 'required|string',
            'email' => 'required|email',
            'sex' => 'required|string',
            'phone' => 'required|string',
            'address' => 'required|string',
            'birthdate' => 'required|date',
            'city' => 'required|string',
            'profesion' => 'required|string',
            'estado' => 'required|string',
        ]);
    
        try {
            $user = User::findOrFail($id);
            $user->document = $request->document;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->sex = $request->sex;
            $user->phone = $request->phone;
            $user->birthdate = $request->birthdate;
            $user->address = $request->address;
            $user->city = $request->city;
            $user->save();
    
            $instructor = Instructor::findOrFail($id);
            $instructor->profesion = $request->profesion;
            $instructor->estado = $request->estado;
            $instructor->save();
    
            return response()->json(['message' => 'Instructor and User UPDATED'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    
    public function destroy(string $id)
    {
        $instructor = Instructor::find($id);
        $user = User::find($id);
    
        if (!$instructor && !$user) {
            return response()->json(['message' => 'Instructor and User not found'], 404);
        } else {
            if ($instructor) {
                $instructor->delete();
            }
            if ($user) {
            $user->delete();
            }
            return response()->json(['message' => 'Instructor and User deleted successfully']);
        }
    }
    
}
