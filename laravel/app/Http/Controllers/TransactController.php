<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Transaction;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Exception;

class TransactController extends Controller
{
    public function index()
{
    $transacts = Transaction::all();
    $transactionHashes = $transacts->pluck('transact_hash');
    $items = Transaction::whereIn('transact_hash', $transactionHashes)->get();
   
    $itemNames = $this->mapItemNames($items);

    foreach ($transacts as $transact) {
        $hash = $transact->transact_hash;
        $availability = $this->checkTransactAvailability($hash);
        $transact->available = $availability;
    }

    

    return view('transact.index', compact('transacts', 'itemNames'));
}

private function checkTransactAvailability($hash)
{
    $url = "http://localhost:3000/api/transact/$hash";
    $response = Http::get($url);
    

    return $response->successful();
}

    private function mapItemNames($items)
    {
        $itemNames = [];
        foreach ($items as $item) {

            $itemNames[$item->id] = $item->item_name;
        }
        return $itemNames;
    }

    public function store(Request $request)
    {
        try {
            // Validate the incoming request data
            $validatedData = $request->validate([
                'action' => 'required|string',
                'duration' => 'required|integer',
                'borrower_id' => 'required|integer',
                'item_id' => 'required|integer',
                'room_id' => 'required|integer'
            ]);

            $validatedData['created_at'] = now()->timestamp; // Add the current timestamp to the validated data

            $transact_hash = hash('sha256', Str::random(40));

            $user = $request->user();

            $strippedToken = $this->createAndRetrieveToken($user);

            // Store the transaction in the blockchain
            $this->storeInBlockchain($strippedToken, $validatedData, $transact_hash);

            // Create a new transaction record in the database
            $transaction = new Transaction;
            $transaction->action = $validatedData['action'];
            $transaction->duration = $validatedData['duration'];
            $transaction->borrower_id = $validatedData['borrower_id'];
            $transaction->item_id = $validatedData['item_id'];
            $transaction->room_id = $validatedData['room_id'];
            $transaction->transact_hash = $transact_hash;
            $transaction->created_at = $validatedData['created_at'];
            $transaction->save();





            return response()->json(['message' => 'Transaction stored successfully.', 'Blockchain Hash' => $transact_hash]);
        } catch (Exception $e) {
            // Handle the exception, log or report it, and return an appropriate error response
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    private function storeInBlockchain($bearerToken, $data, $transact_hash)
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $bearerToken,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->post('http://localhost:3000/api/transact/store', [
                'action' => $data['action'],
                'duration' => $data['duration'],
                'borrower_id' => $data['borrower_id'],
                'item_id' => $data['item_id'],
                'room_id' => $data['room_id'],
                'created_at' => $data['created_at'],
                'transact_hash' => $transact_hash,
            ]);

            // Check if the request was successful
            if (!$response->successful()) {
                throw new Exception('Failed to store transaction in the blockchain.');
            }
        } catch (Exception $e) {
            // Handle the exception, log or report it, and throw it to the calling function
            throw $e;
        }
    }

    private function createAndRetrieveToken($user)
    {
        // Revoke existing Store tokens
        $user->tokens()->where('name', 'Store Token')->delete();

        // Create a new token
        $token = $user->createToken('Store Token');
        $token->accessToken->save();

        $tokenValue = $token->plainTextToken;

        preg_match('/\|(.+)/', $tokenValue, $matches);
        $strippedToken = $matches[1] ?? null;

        return $strippedToken;
    }
}
