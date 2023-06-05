<x-app-layout>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <div class="header flex justify-between items-center">
        <h1 class="text-5xl font-bold">Item List</h1>
        <div>
            <a href="" class="btn btn-success">Add Item</a>
        </div>
    </div>

    <div class="divider"></div>

    <div class="overflow-x-auto">
        <table id="itemsTable" class="table table-zebra table-lg">
            <!-- head -->

            <thead>
                <tr>
                    <th></th>
                    <th>Item Name</th>
                    <th>Item Description</th>
                    <th>Item Type</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($items as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->item_name }}</td>
                        <td>{{ $item->item_desc }}</td>
                        <td>{{ $item->item_type }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>

<script>
    $(document).ready(function() {
        $('#itemsTable').DataTable();
    });
</script>
