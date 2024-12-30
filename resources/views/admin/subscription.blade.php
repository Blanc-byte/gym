<x-app-layout>
    <div class="container mx-auto mt-8">
        <h1 class="text-2xl font-bold mb-4">Members List</h1>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200">
                <thead>
                    <tr class="bg-gray-100 border-b">
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Name</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Email</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Amount</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Payment Date</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Subscription Type</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($members as $member)
                        <tr class="border-b">
                            <td class="px-6 py-4 text-sm text-gray-700">{{ $member->name }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">{{ $member->email }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">{{ $member->amount }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">{{ $member->payment_date }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">{{ $member->subscription_type }}</td>
                            <td class="px-6 py-4">
                                <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600"
                                    onclick="openModal({{ $member->id }}, '{{ $member->subscription_type }}')">
                                    Assign Trainers
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div id="assignTrainerModal" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 hidden">
        <div class="bg-white p-6 rounded-lg w-2/3 max-h-[80vh] overflow-hidden">
            <h2 class="text-xl font-bold mb-4">Assign Trainers</h2>
            <input type="hidden" id="memberId">
            <input type="hidden" id="subscriptionId" name="subscription_id" value="">
    
            <div class="overflow-y-auto max-h-[60vh]">
                <table class="min-w-full bg-white border border-gray-300">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Name</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Gender</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Age</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Specialty</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Action</th>
                        </tr>
                    </thead>
                    <tbody id="trainerList">
                        @foreach($trainors as $trainor)
                            <tr class="border-b">
                                <td class="px-4 py-2 text-sm text-gray-700">{{ $trainor->name }}</td>
                                <td class="px-4 py-2 text-sm text-gray-700">{{ $trainor->gender }}</td>
                                <td class="px-4 py-2 text-sm text-gray-700">{{ $trainor->age }}</td>
                                <td class="px-4 py-2 text-sm text-gray-700">{{ $trainor->specialty }}</td>
                                <td class="px-4 py-2 text-sm">
                                    <button class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600"
                                        onclick="selectTrainer({{ $trainor->id }}, '{{ $trainor->name }}')">Select</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-4 flex justify-end space-x-4">
                <button id="doneButton" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 disabled:opacity-50" disabled
                    onclick="submitTrainerSelection()">Done</button>
                <button class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600" onclick="closeModal()">Cancel</button>
            </div>
        </div>
    </div>
    

</x-app-layout>
<script>
    let subscriptionType = '';
    let trainerLimit = 0;
    let selectedTrainers = [];

    function openModal(subscriptionId, subscriptionStatus) {
        document.getElementById('assignTrainerModal').classList.remove('hidden');
        document.getElementById('assignTrainerModal').classList.add('flex');

        document.getElementById('subscriptionId').value = subscriptionId;

        selectedTrainers = [];
        increament = 0;

        if (subscriptionStatus === 'Basic Plan') {
            trainerLimit = 1;
        } else if (subscriptionStatus === 'Standard Plan') {
            trainerLimit = 2;
        } else if (subscriptionStatus === 'Premium Plan') {
            trainerLimit = 3;
        }

        console.log(subscriptionStatus);
        console.log(trainerLimit);
    }


function closeModal() {
    document.getElementById('assignTrainerModal').classList.add('hidden');
}

function selectTrainer(trainerId, trainerName) {
    
    if (selectedTrainers.includes(trainerId)) {
        alert(`${trainerName} has already been selected.`);
        return; 
    }

    
    if (selectedTrainers.length < trainerLimit) {
        selectedTrainers.push(trainerId);
        alert(`${trainerName} has been selected.`);
    } else {
        alert(`You can only select ${trainerLimit} trainer(s) for a ${subscriptionType}.`);
    }

    
    updateDoneButtonState();
}

function updateDoneButtonState() {
    const doneButton = document.getElementById('doneButton');
    if (selectedTrainers.length === trainerLimit) {
        doneButton.disabled = false;
    } else {
        doneButton.disabled = true;
    }
}

function submitTrainerSelection() {
    const subscriptionId = document.getElementById('subscriptionId').value;

    fetch('/assign-trainers', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            subscription_id: subscriptionId,
            trainer_ids: selectedTrainers
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert(data.message);
            closeModal();
            location.reload(); // Reload to reflect changes
        } else {
            alert(data.message);
        }
    })
    .catch(error => console.error('Error:', error));
}


</script>