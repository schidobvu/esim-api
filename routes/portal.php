<?php

use App\Http\Controllers\Portal\AssignPermissionToRoleController;
use App\Http\Controllers\Portal\BlockPortalUserController;
use App\Http\Controllers\Portal\BlockRoleController;
use App\Http\Controllers\Portal\CloneRoleController;
use App\Http\Controllers\Portal\CreatePermissionController;
use App\Http\Controllers\Portal\CreatePortalUserController;
use App\Http\Controllers\Portal\CreateRoleController;
use App\Http\Controllers\Portal\DeletePermissionController;
use App\Http\Controllers\Portal\GetPermissionController;
use App\Http\Controllers\Portal\GetPortalUserController;
use App\Http\Controllers\Portal\GetRoleController;
use App\Http\Controllers\Portal\ListPermissionsController;
use App\Http\Controllers\Portal\ListPortalUsersController;
use App\Http\Controllers\Portal\ListRolesController;
use App\Http\Controllers\Portal\LoginController;
use App\Http\Controllers\Portal\LogoutController;
use App\Http\Controllers\Portal\RemovePermissionFromRoleController;
use App\Http\Controllers\Portal\UnblockPortalUserController;
use App\Http\Controllers\Portal\UnblockRoleController;
use App\Http\Controllers\Portal\UpdatePermissionController;
use App\Http\Controllers\Portal\UpdatePortalUserController;
use App\Http\Controllers\Portal\UpdateRoleController;
use Illuminate\Support\Facades\Route;

Route::prefix('portal')->group(function () {
    Route::group(['middleware' => ['auth:sanctum']], function () {
        Route::middleware(['user.permission'])->group(function () {
            Route::group(['prefix' => 'auth'], function () {
                Route::post('/login', LoginController::class)->withoutMiddleware(['auth:sanctum', 'permission.user']);
                Route::delete('/logout', LogoutController::class)->withoutMiddleware(['permission.user']);
            });

            Route::group(['prefix' => 'portal-users'], function () {
                Route::post('/', CreatePortalUserController::class);
                Route::get('/', ListPortalUsersController::class)->withoutMiddleware('footprints');

                Route::group(['prefix' => '{user}'], function () {
                    Route::get('/', GetPortalUserController::class);
                    Route::patch('/', UpdatePortalUserController::class);
                    Route::patch('/block', BlockPortalUserController::class);
                    Route::patch('/unblock', UnblockPortalUserController::class);
                });
            });

            Route::group(['prefix' => 'roles'], function () {
                Route::post('/', CreateRoleController::class);
                Route::get('/', ListRolesController::class);

                Route::group(['prefix' => '{role}'], function () {
                    Route::get('/', GetRoleController::class);
                    Route::patch('/', UpdateRoleController::class);
                    Route::post('/clone', CloneRoleController::class);
                    Route::patch('/block', BlockRoleController::class);
                    Route::patch('/unblock', UnblockRoleController::class);
                    Route::group(['prefix' => 'permissions'], function () {
                        Route::put('/{permission}', AssignPermissionToRoleController::class);
                        Route::delete('/{permission}', RemovePermissionFromRoleController::class);
                    });
                });
            });

            Route::group(['prefix' => 'permissions'], function () {
                Route::post('/', CreatePermissionController::class);
                Route::get('/', ListPermissionsController::class)->withoutMiddleware('footprints');

                Route::group(['prefix' => '{permission}'], function () {
                    Route::get('/', GetPermissionController::class)->withoutMiddleware('footprints');
                    Route::patch('/', UpdatePermissionController::class);
                    Route::delete('/', DeletePermissionController::class);
                });
            });
        });

    });
});


