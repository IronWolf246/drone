<?php

namespace App\ResponseReturn;

final class ApiReturn
{
	/**
	 * @param  bool $error
	 * @param  string $message
	 * @param  mixed $data
	 * @param  int $serverError
	 * @return void
	 */
	public static function defaultReturn(bool $error, ?string $message, $data, int $serverError)
	{
		$result = [
			'error' => $error,
			'message' =>  $message,
            'data' => $data
        ];

        return response()->json($result,  $serverError);
	}
}
