<?php

use App\Http\Controllers\DeviceController;
use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [EmployeeController::class, 'index']);

/**Employees */
Route::post('employee/store', [EmployeeController::class, 'store'])->name('storeEmployee');
Route::get('fetchallemployees', [EmployeeController::class, 'fetchAllEmployees'])->name('fetchAllEmployees');
Route::get('fetchallemployeesjson', [EmployeeController::class, 'fetchAllEmployeesJson'])->name('fetchAllEmployeesJson');
Route::delete('employee/delete', [EmployeeController::class, 'delete'])->name('deleteEmployee');
Route::get('employee/edit', [EmployeeController::class, 'edit'])->name('editEmployee');
Route::post('employee/update', [EmployeeController::class, 'update'])->name('updateEmployee');

/**Devices */
Route::post('device/store', [DeviceController::class, 'store'])->name('storeDevice');
Route::get('fetchalldevices', [DeviceController::class, 'fetchAllDevices'])->name('fetchAllDevices');
Route::delete('device/delete', [DeviceController::class, 'delete'])->name('deleteDevice');
Route::get('device/edit', [DeviceController::class, 'edit'])->name('editDevice');
Route::post('device/update', [DeviceController::class, 'update'])->name('updateDevice');