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
            <!-- Head -->
            <thead>
                <tr>
                    <th></th>
                    <th>Item Name</th>
                    <th>Item Description</th>
                    <th>Item Type</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->item_name }}</td>
                        <td>{{ $item->item_desc }}</td>
                        <td>{{ $item->item_type }}</td>
                        <td>
                            <button class="btn btn-secondary" onclick="showQrCode('{{ $item->item_hash }}')">QR</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <dialog id="qrCodeDialog" class="modal">
        <form method="dialog" class="modal-box ">
            <button onclick="closeQrCodeDialog()"
                class="btn btn-sm btn-circle btn-ghost absolute top-2 right-2">✕</button>
            <h3 class="font-bold text-lg text-center">QR Code</h3>
            <div id="qrCodeContainer" class="py-4 flex flex-col items-center">
                <div id="qrCodeImageContainer"></div>
            </div>
            <a id="downloadButton" href="#" download
                class="btn btn-secondary flex justify-center items-center mt-4">Download</a>
        </form>
        <form method="dialog" class="modal-backdrop" onclick="closeQrCodeDialog()"></form>
    </dialog>

    <script>
        $(document).ready(function() {
            $('#itemsTable').DataTable();
        });

        function showQrCode(itemId) {
            const qrCodeContainer = document.getElementById('qrCodeContainer');
            qrCodeContainer.innerHTML = ''; // Clear previous QR code if any

            // Generate the QR code image element
            const qrCodeImg = document.createElement('img');
            qrCodeImg.src = '/generate-qrcode/' + itemId;
            qrCodeImg.alt = 'QR Code';

            // Append the QR code image to the container
            qrCodeContainer.appendChild(qrCodeImg);

            // Show the dialog
            const qrCodeDialog = document.getElementById('qrCodeDialog');
            qrCodeDialog.showModal();
        }

        function closeQrCodeDialog() {
            const qrCodeDialog = document.getElementById('qrCodeDialog');
            qrCodeDialog.close();
        }
    </script>
</x-app-layout>
