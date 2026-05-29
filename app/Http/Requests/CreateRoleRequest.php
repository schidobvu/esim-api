<?php

namespace App\Http\Requests;

use App\Models\Role;
use Bluecloud\ResponseBuilder\Requests\BaseFormRequest;
use Illuminate\Validation\Rule;

class CreateRoleRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|unique:roles,name',
            'type' => 'required|string',
        ];
    }
}
