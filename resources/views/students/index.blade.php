<!DOCTYPE html>
<html>
<head>
 <title>Students List</title>
 <style>
  body {
   font-family: Tahoma, sans-serif;
  }
  h1 {
   background-color: white;
   color: #407454ff;
   padding: 10px;
   text-align: left;
   border-radius: none;
   margin-bottom: 20px;
   font-weight: 5px;
  }
  table {
   width: 100%;
   border-collapse: collapse;
   background-color: white;
   border-radius: 70px;
  }
  th {
   background-color: #407454ff;
   color: white;
   padding: 10px;
   text-align: left;
  }
  td {
   padding: 10px;
   border-bottom: 1px solid #ddd;
  }
  tr:nth-child(even) {
   background-color: #f2f2f2;
  }
  tr:hover {
   background-color: #e8f5e8;
  }
  a {
   background-color: #4c794dff;
   color: white;
   border: none;
   padding: 5px 10px;
   cursor: pointer;
   display: inline-block;
   font-family: Tahoma, sans-serif;
   font-size: 14px;
   border-radius: 90px;
  }
  a:hover {
   text-decoration: none;

  }
  .edit-link:hover {
   text-decoration: none;
  }
  button {
   background-color: #f44336;
   color: white;
   border: none;
   padding: 5px 10px;
   cursor: pointer;
   font-family: Tahoma, sans-serif;
   font-size: 14px;
   border-radius: 90px;
  }
  button:hover {
   background-color: #d32f2f;
  }
  @keyframes shake {
   0% { transform: translateX(0); }
   25% { transform: translateX(-5px); }
   50% { transform: translateX(5px); }
   75% { transform: translateX(-5px); }
   100% { transform: translateX(0); }
  }
  .modal {
   display: none;
   position: fixed;
   z-index: 1;
   left: 0;
   top: 0;
   width: 100%;
   height: 100%;
   background-color: rgba(0,0,0,0.4);
   animation: fadeIn 0.3s;
  }
  .modal-content {
   background-color: white;
   margin: 15% auto;
   padding: 20px;
   border: 1px solid #888;
   width: 300px;
   border-radius: 8px;
   text-align: center;
  }
  @keyframes fadeIn {
   from { opacity: 0; }
   to { opacity: 1; }
  }
  .modal-button {
   background-color: #f44336;
   color: white;
   border: none;
   padding: 5px 10px;
   margin: 10px;
   cursor: pointer;
   border-radius: 4px;
  }
  .modal-button.cancel {
   background-color: #4CAF50;
  }
  .add-link {
   background-color: #54856cff;
   color: white;
   padding: 10px 15px;
   text-decoration: none;
   border-radius: 4px;
   display: inline-block;
   margin-bottom: 10px;
  }
  .add-link:hover {
   background-color: #366e50ff;
  }
  .success {
   color: #4CAF50;
   font-weight: bold;
  }
 </style>
</head>
<body>
 <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
  <h1>Students List</h1>
  <form action="{{ route('logout') }}" method="POST" style="display: inline;">
   @csrf
   <button type="submit" style="background-color: #f44336; color: white; border: none; padding: 8px 16px; border-radius: 4px; cursor: pointer;">Logout</button>
  </form>
 </div>
 @if(session('success'))
 <p class="success">{{ session('success') }}</p>
 @endif
 <div style="display: flex; justify-content: center; align-items: center; gap: 10px; margin-bottom: 10px;">
  <a href="{{ route('students.create') }}" class="add-link" style="width: 200px; text-align: center; height: 40px; box-sizing: border-box; line-height: 20px; margin: 0;">Add Student</a>
  <input type="text" id="searchInput" placeholder="Search students..." style="width: 200px; height: 40px; padding: 8px; border: 1px solid #ccc; border-radius: 4px; font-size: 14px; box-sizing: border-box; margin: 0;">
 </div>
 <table>
 <thead>
 <tr>
 <th>ID</th>
 <th>Student No</th>
 <th>First Name</th>
 <th>Middle Name</th>
 <th>Last Name</th>
 <th>Action</th>
 </tr>
 </thead>
 <tbody>
 @foreach($students as $student)
 <tr>
 <td>{{ $student->id }}</td>
 <td>{{ $student->studentno }}</td>
 <td>{{ $student->firstname }}</td>
 <td>{{ $student->middlename }}</td>
 <td>{{ $student->lastname }}</td>
 <td>
  <a href="{{ route('students.edit', $student) }}" class="edit-link">Edit</a>
  <button onclick="openModal({{ $student->id }}, '{{ $student->firstname }} {{ $student->lastname }}')">Delete</button>
 </td>
 </tr>
 @endforeach
 </tbody>
 </table>

 <div id="deleteModal" class="modal">
  <div class="modal-content">
   <p id="modalText">Are you sure you want to delete this student?</p>
   <form id="deleteForm" method="POST" style="display:inline;">
    @csrf
    @method('DELETE')
    <button type="submit" class="modal-button">Delete</button>
    <button type="button" class="modal-button cancel" onclick="closeModal()">Cancel</button>
   </form>
  </div>
 </div>

 <script>
  function openModal(studentId, studentName) {
   const modal = document.getElementById('deleteModal');
   const modalText = document.getElementById('modalText');
   const deleteForm = document.getElementById('deleteForm');
   modalText.textContent = `Are you sure you want to delete student "${studentName}"?`;
   deleteForm.action = `/students/${studentId}`;
   modal.style.display = 'block';
  }
  function closeModal() {
   const modal = document.getElementById('deleteModal');
   modal.style.display = 'none';
  }
  window.onclick = function(event) {
   const modal = document.getElementById('deleteModal');
   if (event.target == modal) {
    modal.style.display = 'none';
   }
  }

  // Search functionality
  document.getElementById('searchInput').addEventListener('input', function() {
   const filter = this.value.toLowerCase();
   const rows = document.querySelectorAll('tbody tr');
   rows.forEach(row => {
    const cells = row.querySelectorAll('td');
    let match = false;
    cells.forEach(cell => {
     if (cell.textContent.toLowerCase().includes(filter)) {
      match = true;
     }
    });
    row.style.display = match ? '' : 'none';
   });
  });
 </script>
</body>
</html>
