<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller {

	// set index page view
	public function index() {
		return view('index');
	}

	// handle fetch all eamployees ajax request
	public function fetchAllEmployees() {
		$emps = Employee::all();
		$output = '';
		if ($emps->count() > 0) {
			$output .= '<table class="table table-striped table-sm text-center align-middle" id="dataTableEmployees">
            <thead>
              <tr>
                <th>ID</th>
                <th>Imagen</th>
                <th>Nombre</th>
                <th>Rut</th>
                <th>E-mail</th>
                <th>Teléfono</th>
                <th>Oficina</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>';
			foreach ($emps as $emp) {
				$output .= '<tr>
                <td>' . $emp->id . '</td>
                <td><img src="storage/images/' . $emp->avatar . '" width="50" class="img-thumbnail rounded-circle"></td>
                <td>' . $emp->first_name . ' ' . $emp->last_name . '</td>
                <td>' . $emp->dni . '</td>
                <td>' . $emp->email . '</td>
                <td>' . $emp->phone . '</td>
                <td>' . $emp->office . '</td>
                <td>
                  <a href="#" id="' . $emp->id . '" class="text-success mx-1 editIcon edit-icon-employee" data-bs-toggle="modal" data-bs-target="#editEmployeeModal"><i class="bi-pencil-square h4"></i></a>

                  <a href="#" id="' . $emp->id . '" class="text-danger mx-1 deleteIcon delete-icon-employee"><i class="bi-trash h4"></i></a>
                </td>
              </tr>';
			}
			$output .= '</tbody></table>';
			echo $output;
		} else {
			echo '<h1 class="text-center text-secondary my-5">No se han agregado empleados</h1>';
		}
	}

	public function fetchAllEmployeesJson() {
		$emps = Employee::all();
		$output = '';

		if ($emps->count() > 0) {
			foreach ($emps as $emp) {
				$output .= '<option  value="'.$emp->id.'">'.$emp->first_name.' '.$emp->last_name.'</option>';
			}
			echo $output;
		} else { 
			echo '<h1 class="text-center text-secondary my-5">No se han agregado dispositivos</h1>';
		}
	}

	// handle insert a new employee ajax request
	public function store(Request $request) {
		$file = $request->file('avatar');
		$fileName = time() . '.' . $file->getClientOriginalExtension();
		$file->storeAs('public/images', $fileName);

		$empData = ['first_name' => $request->fname, 'last_name' => $request->lname, 'dni' => $request->dni, 'email' => $request->email, 'phone' => $request->phone, 'office' => $request->office, 'employeepos' => $request->employeepos, 'avatar' => $fileName];
		Employee::create($empData);
		return response()->json([
			'status' => 200,
		]);
	}

	// handle edit an employee ajax request
	public function edit(Request $request) {
		$id = $request->id;
		$emp = Employee::find($id);
		return response()->json($emp);
	}

	// handle update an employee ajax request
	public function update(Request $request) {
		$fileName = '';
		$emp = Employee::find($request->emp_id);
		if ($request->hasFile('avatar')) {
			$file = $request->file('avatar');
			$fileName = time() . '.' . $file->getClientOriginalExtension();
			$file->storeAs('public/images', $fileName);
			if ($emp->avatar) {
				Storage::delete('public/images/' . $emp->avatar);
			}
		} else {
			$fileName = $request->emp_avatar;
		}

		$empData = ['first_name' => $request->fname, 'last_name' => $request->lname,  'dni' => $request->dni, 'email' => $request->email, 'phone' => $request->phone, 'office' => $request->office, 'employeepos' => $request->employeepos, 'avatar' => $fileName];

		$emp->update($empData);
		return response()->json([
			'status' => 200,
		]);
	}

	// handle delete an employee ajax request
	public function delete(Request $request) {
		$id = $request->id;
		$emp = Employee::find($id);
		if (Storage::delete('public/images/' . $emp->avatar)) {
			Employee::destroy($id);
		}
	}
}