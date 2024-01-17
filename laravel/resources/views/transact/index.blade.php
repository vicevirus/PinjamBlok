
<x-app-layout>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <div class="header flex justify-between items-center">
        <h1 class="text-5xl font-bold">Transaction List</h1>
        <div>
            {{-- <a href="{{ route('room.add') }}" class="btn btn-success">Add Room</a> --}}
        </div>
    </div>

    <div class="divider"></div>

    <div class="overflow-x-auto">
        <table id="roomsTable" class="table table-zebra table-lg">
            <!-- head -->

            <thead>
                <tr>
                    <th></th>
                    <th>Action</th>
                    <th>Item Name</th>
                    <th>Item Duration</th>
                    <th>Room ID</th>
                    <th>Borrower ID</th>
                    <th>Blockchain</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($transacts as $transact)
                    <tr>
                        <td>{{ $transact->id }}</td>
                        <td>{{ $transact->action  }}</td>
                        <td>{{ $itemNames[$transact->item_id]  }}</td>
                        <td>{{ $transact->duration }}</td>
                        <td>{{ $transact->room_id }}</td>
                        <td>{{ $transact->borrower_id }}</td>
                        
                        
                        <td>{{ $transact->available ? 'Valid' : 'Rogue' }}</td>
                        
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>

<script>
    $(document).ready(function() {
        $('#roomsTable').DataTable();
    });
</script>
