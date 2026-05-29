<?php

namespace App\Http\Requests;

use App\Models\Role;
use Bluecloud\ResponseBuilder\Requests\BaseFormRequest;
use Illuminate\Validation\Rule;

class UpdateRoleRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|unique:roles,name,' . $this->role->{'name'},
            'type' => ['required', 'string', Rule::in(['portal', 'api'])],
        ];
    }
}
