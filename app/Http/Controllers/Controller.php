<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function success(string $message, array $data = [])
    {
    	$data['success'] = true;
    	$data['message'] = $message;

    	return response()->json($data);
    }

    public function resource(string $key = 'data', $data, string $message = 'Data Fetched Successfully')
    {
        return $this->success($message, [
            $key => $data
        ]);
    }

    public function resources(array $resources = [])
    {
        return $this->success($message, $resources);
    }

    public function resource_error($data = [])
    {
        return $this->error($data['message'], $data['code'], $data['errors'], $data['error']);
    }


    public function error(string $message, int $code = 500, array $errors = [], array $error_data = [])
    {
    	$data = [
    		'success' => false,
    		'message' => $message,
    		'errors' => $errors,
            'data' => $error_data
    	];

    	return response()->json($data, $code);
    }

    public function exception(\Exception $exception)
    {
        return $this->error($exception->getMessage(), 500, [
            'message' => $exception->getMessage(),
            'file' => $exception->getFile(),
            'line' => $exception->getLine(),
            'trace' => $exception->getTrace(),
        ]);
    }

    public function form_errors(array $errors, $code = 422, $message = 'Incorrect form data')
    {
        return $this->error($message, $code, $errors);
    }
}
