<?php
namespace App\Http\Controllers;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class StudentController extends Controller
{
 public function index()
 {
 $students = Student::all();
 return view('students.index', compact('students'));
 }
 public function create()
 {
 return view('students.create');
 }
 public function store(Request $request)
 {
 $request->validate([
 'studentno' => 'required|unique:students',
 'firstname' => 'required',
 'lastname' => 'required',
 ]);
 Student::create($request->all());
 return redirect()->route('students.index')->with('success', 'Student created successfully.');
 }
 public function edit(Student $student)
 {
 return view('students.edit', compact('student'));
 }
 public function update(Request $request, Student $student)
 {
 $request->validate([
 'studentno' => 'required|unique:students,studentno,' . $student->id,
 'firstname' => 'required',
 'lastname' => 'required',
 ]);
 $student->update($request->all());
 return redirect()->route('students.index')->with('success', 'Student updated successfully.');
 }
 public function destroy(Student $student)
 {
 $student->delete();
 return redirect()->route('students.index')->with('success', 'Student deleted successfully.');
 }

 public function showLogin()
 {
    if (Auth::check()) {
        return redirect()->route('students.index');
    }
    return view('auth.login');
 }

 public function login(Request $request)
 {
    $request->validate([
        'email' => 'required|email|regex:/^[a-zA-Z0-9._%+-]+@usm\.edu\.ph$/',
        'password' => 'required',
    ]);

    if (Auth::attempt($request->only('email', 'password'))) {
        $request->session()->regenerate();
        return redirect()->intended(route('students.index'));
    }

    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ]);
 }

 public function logout(Request $request)
 {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
 }

 public function showRegister()
 {
    if (Auth::check()) {
        return redirect()->route('students.index');
    }
    return view('auth.register');
 }

    public function register(Request $request)
    {
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email|regex:/^[a-zA-Z0-9._%+-]+@usm\.edu\.ph$/',
        'password' => 'required|confirmed|min:6',
    ]);

    $user = \App\Models\User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => $request->password,
    ]);

    Auth::login($user);

    return redirect()->route('students.index');
 }
}
