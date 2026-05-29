<?php

namespace App\Http\Requests;

use Bluecloud\ResponseBuilder\Requests\BaseFormRequest;

class CreatePortalUserRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'username' => 'nullable|unique:portal_users',
            'role_id' => 'required|exists:roles,id',
            'division_id' => 'nullable|exists:divisions,id',
            'name' => 'nullable|string',
            'email' => 'nullable|string',
            'msisdn' => 'nullable|string',
        ];
    }
}
