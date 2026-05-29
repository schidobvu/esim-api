<?php

namespace App\Http\Requests;

use App\Enums\ClientType;
use Bluecloud\ResponseBuilder\Requests\BaseFormRequest;
use Illuminate\Validation\Rule;

class CreatePermissionRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'code' => 'required|string|unique:permissions,code',
            'endpoint' => 'required|string|unique:permissions,endpoint',
            'method' => ['required', 'string', Rule::in('GET', 'POST', 'PATCH', 'DELETE', 'PUT')],
            'group' => 'required|string',
            'type' => 'required|string'
        ];
    }
}
