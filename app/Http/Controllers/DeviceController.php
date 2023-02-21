<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Device;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DeviceController extends Controller {

	// handle fetch all eamployees ajax request
	public function fetchAllDevices() {
		$devs = Device::all();
		$output = '';
		if ($devs->count() > 0) {
			$output .= '<table class="table table-striped table-sm text-center align-middle" id="dataTableDevices">
            <thead>
              <tr>
                <th>Tipo</th>
                <th>Nombre</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Serie</th>
                <th>Estado</th>
                <th>Empleado</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>';
			foreach ($devs as $dev) {
				$output .= '<tr>
                <td>' . $dev->type . '</td>
                <td>' . $dev->name . '</td>
                <td>' . $dev->brand . '</td>
                <td>' . $dev->model . '</td>
                <td>' . $dev->serial . '</td>
                <td>' . $dev->status . '</td>
                <td>' . $dev->employee . '</td>
                <td>
                  <a href="#" id="' . $dev->id . '" class="text-success mx-1 editIcon edit-icon-device" data-bs-toggle="modal" data-bs-target="#editDeviceModal"><i class="bi-pencil-square h4"></i></a>

                  <a href="#" id="' . $dev->id . '" class="text-danger mx-1 deleteIcon delete-icon-device"><i class="bi-trash h4"></i></a>
                </td>
              </tr>';
			}
			$output .= '</tbody></table>';
			echo $output;
		} else {
			echo '<h1 class="text-center text-secondary my-5">No se han agregado dispositivos</h1>';
		}
	}

	// handle insert a new device ajax request
	public function store(Request $request) {
		$data = Employee::find($request->employee_id);
		$employee = $data->first_name.' '.$data->last_name;
		$devData = ['type' => $request->type, 'name' => $request->name, 'brand' => $request->brand, 'model' => $request->model, 'serial' => $request->serial, 'identificator' => $request->identificator, 'imei1' => $request->imei1, 'imei2' => $request->imei2, 'status' => $request->status, 'comments' => $request->comments, 'employee' => $employee, 'employee_id' => $request->employee_id];
		Device::create($devData);
		return response()->json([
			'status' => 200,
		]);
	}

	// handle edit an device ajax request
	public function edit(Request $request) {
		$id = $request->id;
		$dev = Device::find($id);
		return response()->json($dev);
	}

	// handle update an devloyee ajax request
	public function update(Request $request) {
		$data = Employee::find($request->employee_id);
		$employee = $data->first_name.' '.$data->last_name;
		$dev = Device::find($request->dev_id);

		$devData = ['type' => $request->type, 'name' => $request->name, 'brand' => $request->brand, 'model' => $request->model, 'serial' => $request->serial, 'identificator' => $request->identificator, 'imei1' => $request->imei1, 'imei2' => $request->imei2, 'status' => $request->status, 'comments' => $request->comments, 'employee' => $employee, 'employee_id' => $request->employee_id];

		$dev->update($devData);
		return response()->json([
			'status' => 200,
		]);
	}

	// handle delete an device ajax request
	public function delete(Request $request) {
		$id = $request->id;
		$dev = Device::find($id);
		Device::destroy($id);
	}
}