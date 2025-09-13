<!DOCTYPE html>
<html>
<head>
 <title>Edit Student</title>
 <style>
  body {
   font-family: Tahoma, sans-serif;
   background-color: #f0f0f0;
   margin: 0;
   padding: 20px;
  }
  h1 {
   color: #4CAF50;
   text-align: center;
  }
  .error {
   color: red;
   background-color: #ffe6e6;
   border: 1px solid red;
   padding: 10px;
   margin-bottom: 20px;
   border-radius: 4px;
  }
  form {
   background-color: white;
   padding: 20px;
   border-radius: 8px;
   box-shadow: 0 0 10px rgba(0,0,0,0.1);
   max-width: 400px;
   margin: 0 auto;
  }
  label {
   display: block;
   margin-bottom: 5px;
   color: #333;
   font-weight: bold;
  }
  input[type="text"] {
   width: 100%;
   padding: 10px;
   margin-bottom: 15px;
   border: 1px solid #ccc;
   border-radius: 4px;
   box-sizing: border-box;
  }
  button {
   background-color: #FFC107;
   color: black;
   padding: 10px 15px;
   border: none;
   border-radius: 4px;
   cursor: pointer;
   font-size: 16px;
   width: 100%;
  }
  button:hover {
   background-color: #FFB300;
  }
  .back-link {
   display: block;
   text-align: center;
   margin-top: 20px;
   color: #4CAF50;
   text-decoration: none;
  }
  .back-link:hover {
   text-decoration: underline;
  }
 </style>
</head>
<body>
 <h1>Edit Student</h1>
 @if ($errors->any())
 <div class="error">
 <ul>
 @foreach ($errors->all() as $error)
 <li>{{ $error }}</li>
 @endforeach
 </ul>
 </div>
 @endif
 <form action="{{ route('students.update', $student) }}" method="POST">
 @csrf
 @method('PUT')
 <label>Student No:</label>
 <input type="text" name="studentno" value="{{ old('studentno', $student->studentno) }}">
 <label>First Name:</label>
 <input type="text" name="firstname" value="{{ old('firstname', $student->firstname) }}">
 <label>Middle Name:</label>
 <input type="text" name="middlename" value="{{ old('middlename', $student->middlename) }}">
 <label>Last Name:</label>
 <input type="text" name="lastname" value="{{ old('lastname', $student->lastname) }}">
 <button type="submit">Update</button>
 </form>
 <a href="{{ route('students.index') }}" class="back-link">Back to Students List</a>
</body>
</html>
