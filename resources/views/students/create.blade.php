<!DOCTYPE html>
<html>
<head>
 <title>Add Student</title>
 <style>
  body {
   font-family: Tahoma;
   background-color: #f0f0f0;
   margin: 0;
   padding: 20px;
  }
  h1 {
   color: #67865fff;
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
   background-color: #67865fff;
   color: black;
   padding: 10px 15px;
   border: none;
   border-radius: 4px;
   cursor: pointer;
   font-size: 16px;
   width: 100%;
  }
  button:hover {
   background-color: #407454ff;
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
 <h1>Add Student</h1>
 @if ($errors->any())
 <div class="error">
 <ul>
 @foreach ($errors->all() as $error)
 <li>{{ $error }}</li>
 @endforeach
 </ul>
 </div>
 @endif
 <form action="{{ route('students.store') }}" method="POST">
 @csrf
 <label>Student No:</label>
 <input type="text" name="studentno" value="{{ old('studentno') }}">
 <label>First Name:</label>
 <input type="text" name="firstname" value="{{ old('firstname') }}">
 <label>Middle Name:</label>
 <input type="text" name="middlename" value="{{ old('middlename') }}">
 <label>Last Name:</label>
 <input type="text" name="lastname" value="{{ old('lastname') }}">
 <button type="submit">Save</button>
 </form>
 <a href="{{ route('students.index') }}" class="back-link">Back to Students List</a>
</body>
</html>