<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::all();


        return view('item.index', compact('items'));
    }

    public function generateQRCode($itemId)
    {
        // Generate the QR code using the item ID
        $qrCode = QrCode::format('png')
            ->size(200)
            ->errorCorrection('H')
            ->generate($itemId);

        // Return the QR code image as a response
        return response($qrCode)->header('Content-Type', 'image/png');
    }
}
