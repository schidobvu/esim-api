<?php

namespace App\Http\Requests;

use Bluecloud\ResponseBuilder\Requests\BaseFormRequest;

class UpdatePortalUserRequest extends BaseFormRequest
{
    public function rules(): array
    {
        $loginType = $this->input('login_type');

        return [
            'name' => 'string',
            'email' => 'nullable|string',
            'position' => 'nullable|string',
            'username' => 'nullable|string|unique:portal_users,username,' . $this->user->getKey(),
            'role_id' => 'sometimes|exists:roles,id',
            'msisdn' => [
                'sometimes',
                'nullable',
                $loginType === 'msisdn' ? 'required' : 'nullable',
                'string',
            ]
        ];
    }

    public function messages()
    {
        return [
            'login_type.required' => 'The login type is required.',
            'login_type.in' => 'The login type must be either "username" or "msisdn".',
            'username.unique' => 'The username must be unique.',
            'msisdn.required' => 'MSISDN is required if login type is "msisdn".',
        ];
    }
}
