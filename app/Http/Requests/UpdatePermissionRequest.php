<?php

namespace App\Http\Requests;

use App\Enums\ClientType;
use Bluecloud\ResponseBuilder\Requests\BaseFormRequest;
use Illuminate\Validation\Rule;

class UpdatePermissionRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'code' => 'required|string|unique:permissions,code,'.$this->permission->getKey(),
            'endpoint' => 'required|string|unique:permissions,endpoint,'.$this->permission->getKey(),
            'method' => ['required', 'string', Rule::in('GET', 'POST', 'PATCH', 'DELETE', 'PUT')],
            'group' => 'required|string',
            'type' => 'required',
        ];
    }
}
