<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSubmissionDataRequest;
use App\Jobs\ProcessSubmissionJob;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class PostSubmissionController extends Controller
{
    public function __invoke(StoreSubmissionDataRequest $request): JsonResponse
    {
        try {
            ProcessSubmissionJob::dispatch($request->validated())->onQueue('log');

            return response()->json(
                [
                    'success' => true,
                    'message' => 'Job dispatched successfully'
                ], 202);
        } catch (\Exception $e) {
            return response()->json(['errors' => $e->getMessage()], 400);
        }
    }
}
