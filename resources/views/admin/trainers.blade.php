<x-app-layout>
    <div class="container">
        <h2 class="heading">Trainers</h2>

        <!-- Success Message -->
        @if (session('message'))
            <div class="alert">
                {{ session('message') }}
            </div>
        @endif

        <!-- Add Trainer Button -->
        <button class="btn add" onclick="openModal('addTrainerModal')">Add Trainer</button>

        <!-- Trainers Table -->
        <table class="trainers-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Gender</th>
                    <th>Specialization</th>
                    <th>Duration</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($trainers as $trainer)
                    <tr>
                        <td>{{ $trainer->id }}</td>
                        <td>{{ $trainer->name }}</td>
                        <td>{{ $trainer->age }}</td>
                        <td>{{ $trainer->gender }}</td>
                        <td>{{ $trainer->specialty }}</td>
                        <td>{{ $trainer->duration }}</td>
                        <td>
                            <!-- Edit Modal Trigger -->
                            <button onclick="openEditModal({{ $trainer->id }}, '{{ $trainer->name }}', '{{ $trainer->age }}', '{{ $trainer->gender }}', '{{ $trainer->specialty }}', '{{ $trainer->duration }})"
                                class="btn edit">Edit</button>

                            <!-- Delete Button -->
                            <form action="{{ route('trainers.destroy', $trainer->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Are you sure you want to delete this trainer?')"
                                    class="btn delete">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Add Trainer Modal -->
        <div class="modal" id="addTrainerModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Trainer</h5>
                        <span class="close" onclick="closeModal('addTrainerModal')">&times;</span>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('trainers.store') }}" method="POST">
                            @csrf
                            <label for="name">Name</label>
                            <input type="text" id="name" name="name" required placeholder="Enter trainer's name">
                            <label for="age">Age</label>
                            <input type="number" id="age" name="age" required placeholder="Enter age">
                            <label for="gender">Gender</label>
                            <input type="text" id="gender" name="gender" required placeholder="Enter gender">
                            <label for="specialty">Specialty</label>
                            <input type="text" id="specialty" name="specialty" required placeholder="Enter specialty">
                            <label for="duration">Duration</label>
                            <input type="number" id="duration" name="duration" required placeholder="Enter duration">
                            <button type="submit" class="btn save">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Trainer Modal -->
        <div class="modal" id="editTrainerModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Trainer</h5>
                        <span class="close" onclick="closeModal('editTrainerModal')">&times;</span>
                    </div>
                    <div class="modal-body">
                        <form action="" id="editTrainerForm" method="POST">
                            @csrf
                            @method('PUT')
                            <label for="namee">Name</label>
                            <input type="text" id="namee" name="name" required placeholder="Enter name">
                            <label for="agee">Age</label>
                            <input type="number" id="agee" name="age" required placeholder="Enter age">
                            <label for="gendere">Gender</label>
                            <input type="text" id="gendere" name="gender" required placeholder="Enter gender">
                            <label for="specialtye">Specialty</label>
                            <input type="text" id="specialtye" name="specialty" required placeholder="Enter specialty">
                            <label for="duratione">Duration</label>
                            <input type="number" id="duratione" name="duration" required placeholder="Enter duration">
                            <button type="submit" class="btn save">Save Changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Close modal function
        function closeModal(modalId) {
            document.getElementById(modalId).classList.remove('show');
        }

        // Open modal function
        function openModal(modalId) {
            document.getElementById(modalId).classList.add('show');
        }

        // Optional: Close modal when clicking outside of it
        window.onclick = function(event) {
            var modals = document.getElementsByClassName('modal');
            for (var i = 0; i < modals.length; i++) {
                if (event.target == modals[i]) {
                    modals[i].classList.remove('show');
                }
            }
        }

        // Open Edit Modal with data pre-filled
        function openEditModal(id, name, age, gender, specialty, duration) {
            const form = document.getElementById('editTrainerForm');
            form.action = `/trainers/${id}`;
            document.getElementById('namee').value = name;
            document.getElementById('agee').value = age;
            document.getElementById('gendere').value = gender;
            document.getElementById('specialtye').value = specialty;
            document.getElementById('duratione').value = duration;
            openModal('editTrainerModal');
        }
    </script>
</x-app-layout>

<style>
    /* Container */
    .container {
        background-color: white;
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    /* Heading */
    .heading {
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 20px;
        color: #333;
    }

    /* Success Message */
    .alert {
        background-color: #d4edda;
        color: #155724;
        padding: 10px;
        margin-bottom: 20px;
        border: 1px solid #c3e6cb;
        border-radius: 5px;
    }

    /* Buttons */
    .btn {
        padding: 8px 15px;
        border-radius: 4px;
        cursor: pointer;
        font-size: 14px;
        transition: background-color 0.3s;
    }

    .btn.add {
        background-color: #007bff;
        color: white;
    }

    .btn.add:hover {
        background-color: #0056b3;
    }

    .btn.edit {
        background-color: #ffc107;
        color: white;
    }

    .btn.edit:hover {
        background-color: #e0a800;
    }

    .btn.delete {
        background-color: #dc3545;
        color: white;
    }

    .btn.delete:hover {
        background-color: #c82333;
    }

    .btn.save {
        background-color: #28a745;
        color: white;
    }

    .btn.save:hover {
        background-color: #218838;
    }

    /* Table */
    .trainers-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    .trainers-table th, .trainers-table td {
        padding: 12px;
        text-align: left;
        border: 1px solid #ddd;
    }

    .trainers-table th {
        background-color: #f8f9fa;
        font-weight: bold;
    }

    .trainers-table tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    /* Modal */
    .modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        justify-content: center;
        align-items: center;
    }

    .modal.show {
        display: flex;
    }

    .modal-dialog {
        background-color: white;
        border-radius: 8px;
        overflow: hidden;
        width: 400px;
    }

    .modal-header {
        padding: 15px;
        background-color: #f1f1f1;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .modal-title {
        font-size: 18px;
        font-weight: bold;
    }

    .modal-body {
        padding: 20px;
    }

    .modal-body input {
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    .modal-body label {
        font-size: 14px;
        font-weight: 600;
    }

    .close {
        font-size: 20px;
        cursor: pointer;
    }
</style>
