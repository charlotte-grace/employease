<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\JsonResponse;

class ApiController extends BaseController
{
    use AuthorizesRequests;
    use ValidatesRequests;

    /**
     * @param $result
     * @param $message
     * @param int $code
     * @return JsonResponse
     */
    protected function sendResponse($result, $message, int $code = 200): JsonResponse
    {
        $response = [
            'success' => true,
            'message' => $message,
            'data' => $result,
        ];

        return response()->json($response, $code);
    }

    /**
     * @param JsonResource $resource
     * @param string|null $message
     * @param int $code
     * @return JsonResponse
     */
    protected function sendResourceResponse(JsonResource $resource, ?string $message = null, int $code = 200): JsonResponse
    {
        $response = [
            'success' => true,
            'message' => $message,
            'data' => $resource,
        ];

        return response()->json($response, $code);
    }

    /**
     * @param $error
     * @param array|null $errorMessages
     * @param int $code
     * @return JsonResponse
     */
    protected function sendErrorResponse($error, array $errorMessages = null, int $code = 404): JsonResponse
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];

        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }

        return response()->json($response, $code);
    }
}
