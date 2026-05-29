<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\PortalUser;
use App\Models\Role;
use Illuminate\Http\JsonResponse;
use TNM\Auth\Services\Authentication\AuthenticationClient;

class LoginController extends Controller
{
    public function __invoke(LoginRequest $request): JsonResponse
    {
        $user = PortalUser::where('username', $request->get('username'))->first();

        if (!$user) {
            return $this->respond()->unauthorized("You are not permitted to access this system")->json();
        }

        $ldapResponse = (new AuthenticationClient($request->get('username'), $request->get('password')))->authenticate();

        if (!$ldapResponse) {
            return $this->respond()->unauthenticated("Invalid username or password")->json();
        }

        $data = $ldapResponse->toArray();

        unset($data['email']);

        if (!empty($user->name)) {
            unset($data['name']);
        }

        $user->update([
            ...$data,
            'last_active' => now(),
        ]);

        $ece_status = $user->isEligibleForDeviceRequisition();
        $user->setAttribute('ece_status', $ece_status);

        return $this->respond()->ok([
            'token' => ($user->createToken($user->{'username'}))->plainTextToken,
            'user' => $user->load(['grade.travelAllowanceRates', 'grade.eceEntitlement', 'division', 'department', 'role.permissions', 'actors'])
        ])->json();
    }
}
