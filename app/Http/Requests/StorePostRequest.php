<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
	public function rules()
	{
		return [
			'quote-en'  => ['required'],
			'quote-ka'  => ['required'],
			'thumbnail' => ['required'],
			'movie'     => ['required'],
		];
	}
}
