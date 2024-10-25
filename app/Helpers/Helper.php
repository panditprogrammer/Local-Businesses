<?php

use Illuminate\Support\Facades\Storage;

if (!function_exists('deleteLocalFile')) {
    /**
     * Delete a file from the server.
     *
     * @param string $filePath The path to the file to be deleted.
     * @param string $disk The storage disk (default: 'public').
     * @return bool True if the file was deleted, false otherwise.
     */
    function deleteLocalFile($filePath, $disk = 'public')
    {
        // Check if the file exists before attempting to delete
        if (Storage::disk($disk)->exists($filePath)) {
            return Storage::disk($disk)->delete($filePath);
        }
        return false; // Return false if the file does not exist
    }
}




class SMSHelper
{
    public static function sendSMS($message, $mobileNumbers)
    {
        $senderId = 'FSTSMS';
        $apiKey = env('FAST2SMS_API_KEY');
        $url = 'https://www.fast2sms.com/dev/bulkV2';

        $response = Http::withHeaders([
            'authorization' => $apiKey,
            "Content-Type" => "application/json"
        ])->post($url, [
            'sender_id' => $senderId, // Sender ID (customizable in Fast2SMS dashboard)
            'message'   => $message,
            'route'     => 'q',
            'numbers'   => $mobileNumbers,
            'flash' => "1"
        ]);

        return $response->json();   // Handle response as needed
    }
}

// Generate a random numeric OTP
if (!function_exists('generateOtp')) {
    function generateOtp($length = 6)
    {
        return str_pad(mt_rand(0, 999999), $length, '0', STR_PAD_LEFT);
    }
}
