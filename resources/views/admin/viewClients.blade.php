<x-app-layout>
    <div class="container">
        <h2 class="title">Clients</h2>

        <!-- Success Message (if any) -->
        @if(session('message'))
            <div class="success-message">
                {{ session('message') }}
            </div>
        @endif

        <div class="table-container">
            <table class="client-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($clients as $client)
                        <tr>
                            <td>{{ $client->name }}</td>
                            <td>{{ $client->email }}</td>
                            <td>{{ \Carbon\Carbon::parse($client->created_at)->format('Y-m-d H:i') }}</td>
                            <td>{{ \Carbon\Carbon::parse($client->updated_at)->format('Y-m-d H:i') }}</td>
                            <td>
                                <!-- Delete Button -->
                                <form action="{{ route('clients.destroy', $client->id) }}" method="POST" class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="delete-btn">Delete</button>
                                </form>

                                <!-- Unsubscribe Button (if applicable) -->
                                @if ($subscriptions)
                                    @foreach($subscriptions as $subscription)
                                        @if ($subscription->member_id === $client->id)
                                            <form action="{{ route('clients.unsubscribe', $client->id) }}" method="POST" class="delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="unsubscribe-btn">Unsubscribe</button>
                                            </form>
                                        @endif
                                    @endforeach
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>

<style>
    
    .container {
        width: 90%;
        max-width: 1200px;
        margin: 30px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    
    .title {
        font-size: 32px;
        font-weight: 600;
        color: #333;
        text-align: center;
        margin-bottom: 25px;
    }

    
    .success-message {
        background-color: #d4edda;
        color: #155724;
        padding: 15px;
        border-radius: 5px;
        margin-bottom: 25px;
        text-align: center;
        font-size: 16px;
    }

    
    .table-container {
        overflow-x: auto;
    }

    
    .client-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    .client-table th, .client-table td {
        padding: 14px;
        text-align: left;
        border-bottom: 1px solid #f2f2f2;
    }

    .client-table th {
        background-color: #f5f5f5;
        font-weight: 500;
        color: #333;
    }

    .client-table tr:hover {
        background-color: #f9f9f9;
    }

    
    .delete-btn, .unsubscribe-btn {
        padding: 6px 12px;
        border: 1px solid #e74c3c;
        color: #e74c3c;
        background-color: transparent;
        border-radius: 5px;
        cursor: pointer;
        font-size: 14px;
        text-align: center;
    }

    .delete-btn:hover, .unsubscribe-btn:hover {
        background-color: #e74c3c;
        color: #fff;
    }

    
    .delete-form {
        display: inline-block;
    }
</style>
