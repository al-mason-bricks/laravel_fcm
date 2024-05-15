<?php

namespace App\Helpers;

use Exception;
use Illuminate\Support\Facades\Http;
use App\Models\User;
use App\DTOs\FcmDTO;

class FcmHelper
{
    private static function getFcmApiUrl(): string
    {
        $projectId = config('fcm.project_id');

        throw_if(empty($projectId), new Exception('You did\'t provide any project id yet'));

        return "https://fcm.googleapis.com/v1/projects/$projectId/messages:send";
    }

    private static function getFcmHeader(): array
    {
        $credentialsFilePath = config('fcm.config_file_path');
        $client = new \Google_Client();
        $client->setAuthConfig($credentialsFilePath);
        $client->addScope('https://www.googleapis.com/auth/firebase.messaging');

        $client->refreshTokenWithAssertion();
        $token = $client->getAccessToken();
        $access_token = $token['access_token'];

        return [
            'Authorization' => "Bearer $access_token",
            'Content-Type' => 'application/json',
        ];
    }

    public static function send(User $user, FcmDTO $fcmDTO): void
    {
        foreach ($user->fcmTokens()->pluck('token') as $token) {
            $payload['message'] = $fcmDTO->toArray($token);
            Http::withHeaders(static::getFcmHeader())
                ->post(static::getFcmApiUrl(), $payload);
        }
    }
}
