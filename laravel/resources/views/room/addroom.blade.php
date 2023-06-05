<x-app-layout>
    <div class="header flex justify-between items-center">
        <h1 class="text-5xl font-bold">Add Room</h1>
        
    </div>
    <div class="divider"></div>
    <div>
        <form action="{{ route('room.store') }}" method="POST">
            @csrf
            <!-- Add CSRF protection token -->

            <table class="table-auto">
                <tbody>
                    <tr class="mb-6">
                        <td>
                            <label for="room_name" class="mx-3">Room Name</label>
                        </td>
                        <td>
                            <input type="text" id="room_name" name="room_name" placeholder="Room Name" class="input w-full max-w-xs" required />
                        </td>
                    </tr>
                    <tr class="mb-4">
                        <td>
                            <label for="room_desc" class="mx-3">Room Description</label>
                        </td>
                        <td>
                            <input type="text" id="room_desc" name="room_desc" placeholder="Room Description" class="input w-full max-w-xs" required />
                        </td>
                    </tr>
                </tbody>
            </table>

            <div class="mt-4">
                <button type="submit" class="btn">Submit</button>
            </div>
        </form>


        <div>
</x-app-layout>
