<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inventario Tecnológico</title>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/css/bootstrap.min.css' />
  <link rel='stylesheet'
    href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css' />
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.10.25/datatables.min.css" />

</head>
{{-- add new employee modal start --}}
<div class="modal fade" id="addEmployeeModal" tabindex="-1" aria-labelledby="exampleModalLabel"
  data-bs-backdrop="static" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar Empleado</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="#" method="POST" id="add_employee_form" enctype="multipart/form-data">
        @csrf
        <div class="modal-body p-4 bg-light">
          <div class="row">
            <div class="my-2">
              <label for="fname">Nombres</label>
              <input type="text" name="fname" class="form-control" placeholder="Nombres" required>
            </div>
            <div class="my-2">
              <label for="lname">Apellidos</label>
              <input type="text" name="lname" class="form-control" placeholder="Apellidos" required>
            </div>
          </div>
          <div class="my-2">
            <label for="dni">Rut</label>
            <input type="text" name="dni" class="form-control" placeholder="Rut" required>
          </div>
          <div class="my-2">
            <label for="email">E-mail</label>
            <input type="email" name="email" class="form-control" placeholder="E-mail" required>
          </div>
          <div class="my-2">
            <label for="phone">Teléfono</label>
            <input type="tel" name="phone" class="form-control" placeholder="Teléfono" required>
          </div>
          <div class="my-2">
            <label for="employeepos">Cargo</label>
            <input type="text" name="employeepos" class="form-control" placeholder="Cargo" required>
          </div>
          <div class="my-2">
            <label for="office">Oficina</label>
            <select class="form-select" name="office">
              <option value="Coronel">Coronel</option>
              <option value="Chillan">Chillan</option>
              <option value="Santiago">Santiago</option>
            </select>
          </div>
          <div class="my-2">
            <label for="avatar">Select Avatar</label>
            <input type="file" name="avatar" class="form-control">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          <button type="submit" id="add_employee_btn" class="btn btn-primary">Agregar Empleados</button>
        </div>
      </form>
    </div>
  </div>
</div>
{{-- add new employee modal end --}}

{{-- edit employee modal start --}}
<div class="modal fade" id="editEmployeeModal" tabindex="-1" aria-labelledby="exampleModalLabel"
  data-bs-backdrop="static" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar Empleado</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="#" method="POST" id="edit_employee_form" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="emp_id" id="emp_id">
        <input type="hidden" name="emp_avatar" id="emp_avatar">
        <div class="modal-body p-4 bg-light">
          <div class="row">
            <div class="my-2">
              <label for="fname">Nombres</label>
              <input type="text" name="fname" id="fname" class="form-control" placeholder="Nombres" required>
            </div>
            <div class="my-2">
              <label for="lname">Apellidos</label>
              <input type="text" name="lname" id="lname" class="form-control" placeholder="Apellidos" required>
            </div>
          </div>
          <div class="my-2">
            <label for="dni">Rut</label>
            <input type="text" name="dni" id="dni" class="form-control" placeholder="Rut" required>
          </div>
          <div class="my-2">
            <label for="email">E-mail</label>
            <input type="email" name="email" id="email" class="form-control" placeholder="E-mail" required>
          </div>
          <div class="my-2">
            <label for="phone">Teléfono</label>
            <input type="tel" name="phone" id="phone" class="form-control" placeholder="Teléfono" required>
          </div>
          <div class="my-2">
            <label for="employeepos">Cargo</label>
            <input type="text" name="employeepos" id="employeepos" class="form-control" placeholder="Cargo" required>
          </div>
          <div class="my-2">
            <label for="office">Oficina</label>
            <select class="form-select" name="office" id="office">
              <option value="Coronel">Coronel</option>
              <option value="Chillan">Chillan</option>
              <option value="Santiago">Santiago</option>
            </select>
          </div>
          <div class="my-2">
            <label for="avatar">Foto de perfil</label>
            <input type="file" name="avatar" class="form-control">
          </div>
          <div class="mt-2" id="avatar">

          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          <button type="submit" id="edit_employee_btn" class="btn btn-success">Actualizar</button>
        </div>
      </form>
    </div>
  </div>
</div>
{{-- edit employee modal end --}}

  <div class="container">
    <div class="row my-5">
      <div class="col-lg-12">
        <div class="card shadow">
          <div class="card-header bg-primary d-flex justify-content-between align-items-center">
            <h3 class="text-light">Empleados</h3>
            <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#addEmployeeModal"><i
                class="bi-plus-circle me-2"></i>Agregar Empleado</button>
          </div>
          <div class="card-body" id="show_all_employees">
            <h1 class="text-center text-secondary my-5">Cargando...</h1>
          </div>
        </div>
      </div>
    </div>
  </div>


{{-- add new device modal start --}}
<div class="modal fade" id="addDeviceModal" tabindex="-1" aria-labelledby="exampleModalLabel"
  data-bs-backdrop="static" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar Dispositivo</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="#" method="POST" id="add_device_form" enctype="multipart/form-data">
        @csrf
        <div class="modal-body p-4 bg-light">
          <div class="my-2">
            <label for="fname">Tipo</label>
            <select class="form-select" name="type">
              <option value="Equipo">Equipo</option>
              <option value="Periferico">Periférico</option>
              <option value="Redes">Redes</option>
              <option value="Electronicos">Electrónicos</option>
              <option value="Servidores">Servidores</option>
              <option value="Terceros">Terceros</option>
              <option value="Otros">Otros</option>
            </select>
          </div>
          <div class="my-2">
            <label for="name">Nombre</label>
            <input type="text" name="name" class="form-control" placeholder="Notebook, celular, etc" required>
          </div>
          <div class="my-2">
            <label for="brand">Marca</label>
            <input type="text" name="brand" class="form-control" placeholder="Marca" required>
          </div>
          <div class="my-2">
            <label for="model">Modelo</label>
            <input type="text" name="model" class="form-control" placeholder="Modelo" required>
          </div>
          <div class="my-2">
            <label for="serial">Serie</label>
            <input type="text" name="serial" class="form-control" placeholder="Serie">
          </div>
          <div class="my-2">
            <label for="identificator">Identificador</label>
            <input type="text" name="identificator" class="form-control" placeholder="Identificador">
          </div>
          <div class="my-2">
            <label for="imei1">Imei1</label>
            <input type="text" name="imei1" class="form-control" placeholder="Imei1">
          </div>
          <div class="my-2">
            <label for="imei2">Imei2</label>
            <input type="text" name="imei2" class="form-control" placeholder="Imei2">
          </div>
          <div class="my-2">
            <label for="status">Estado</label>
            <input type="text" name="status" class="form-control" placeholder="Estado" required>
          </div>
          <div class="my-2">
            <label for="comments">Comentarios</label>
            <textarea name="comments"  rows="5" class="w-100"></textarea>
            </select>
          </div>
          <div class="my-2">
            <label for="employee">Asignado a</label>
            <select class="form-select employee-select employee-name" name="employee_id">

            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          <button type="submit" id="add_device_btn" class="btn btn-primary">Agregar Dispositivo</button>
        </div>
      </form>
    </div>
  </div>
</div>
{{-- add new device modal end --}}

{{-- edit device modal start --}}
<div class="modal fade" id="editDeviceModal" tabindex="-1" aria-labelledby="exampleModalLabel"
  data-bs-backdrop="static" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar Dispositivo</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="#" method="POST" id="edit_device_form" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="dev_id" id="dev_id">
        <div class="modal-body p-4 bg-light">
          <div class="my-2">
            <label for="fname">Tipo</label>
            <select class="form-select" name="type" id="type">
              <option value="Equipo">Equipo</option>
              <option value="Periferico">Periférico</option>
              <option value="Redes">Redes</option>
              <option value="Electronicos">Electrónicos</option>
              <option value="Servidores">Servidores</option>
              <option value="Terceros">Terceros</option>
              <option value="Otros">Otros</option>
            </select>
          </div>
          <div class="my-2">
            <label for="name">Nombre</label>
            <input type="text" id="name" name="name" class="form-control" placeholder="Notebook, celular, etc" required>
          </div>
          <div class="my-2">
            <label for="brand">Marca</label>
            <input type="text" id="brand" name="brand" class="form-control" placeholder="Marca" required>
          </div>
          <div class="my-2">
            <label for="model">Modelo</label>
            <input type="text" id="model" name="model" class="form-control" placeholder="Modelo" required>
          </div>
          <div class="my-2">
            <label for="serial">Serie</label>
            <input type="text" id="serial" name="serial" class="form-control" placeholder="Serie" >
          </div>
          <div class="my-2">
            <label for="identificator">Identificador</label>
            <input type="text" id="identificator" name="identificator" class="form-control" placeholder="Identificador" >
          </div>
          <div class="my-2">
            <label for="imei1">Imei1</label>
            <input type="text" id="imei1" name="imei1" class="form-control" placeholder="Imei1" >
          </div>
          <div class="my-2">
            <label for="imei2">Imei2</label>
            <input type="text" id="imei2" name="imei2" class="form-control" placeholder="Imei2" >
          </div>
          <div class="my-2">
            <label for="status">Estado</label>
            <input type="text" id="status" name="status" class="form-control" placeholder="Estado" required>
          </div>
          <div class="my-2">
            <label for="comments">Comentarios</label>
            <textarea name="comments" id="comments" rows="5" class="w-100"></textarea>
          </div>
          <div class="my-2">
            <label for="employee">Asignado a</label>
            <select class="form-select employee-select employee-name" name="employee_id">
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          <button type="submit" id="edit_device_btn" class="btn btn-success">Actualizar</button>
        </div>
      </form>
    </div>
  </div>
</div>
{{-- edit device modal end --}}

  <div class="container">
    <div class="row my-5">
      <div class="col-lg-12">
        <div class="card shadow">
          <div class="card-header bg-primary d-flex justify-content-between align-items-center">
            <h3 class="text-light">Dispositivos</h3>
            <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#addDeviceModal"><i
                class="bi-plus-circle me-2"></i>Agregar Dispositivo</button>
          </div>
          <div class="card-body" id="show_all_devices">
            <h1 class="text-center text-secondary my-5">Cargando...</h1>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/js/bootstrap.bundle.min.js'></script>
  <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.10.25/datatables.min.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    $(function() {

      // add new employee ajax request
      $("#add_employee_form").submit(function(e) {
        e.preventDefault();
        const fd = new FormData(this);
        $("#add_employee_btn").text('Agregando...');
        $.ajax({
          url: '{{ route('storeEmployee') }}',
          method: 'post',
          data: fd,
          cache: false,
          contentType: false,
          processData: false,
          dataType: 'json',
          success: function(response) {
            if (response.status == 200) {
              Swal.fire(
                'Agregado!',
                'Empleado agregado con éxito!',
                'Hecho'
              )
              fetchAllEmployeesJson();

            }
            $("#add_employee_btn").text('Agregar Empleado');
            $("#add_employee_form")[0].reset();
            $("#addEmployeeModal").modal('hide');
            fetchAllEmployees().ajax.reload();
          }
        });
      });

      // edit employee ajax request
      $(document).on('click', '.edit-icon-employee', function(e) {
        e.preventDefault();
        let id = $(this).attr('id');
        $.ajax({
          url: '{{ route('editEmployee') }}',
          method: 'get',
          data: {
            id: id,
            _token: '{{ csrf_token() }}'
          },
          success: function(response) {
            $("#fname").val(response.first_name);
            $("#lname").val(response.last_name);
            $("#dni").val(response.dni);
            $("#email").val(response.email);
            $("#phone").val(response.phone);
            $("#office").val(response.office);
            $("#employeepos").val(response.employeepos);
            $("#avatar").html(
              `<img src="storage/images/${response.avatar}" width="100" class="img-fluid img-thumbnail">`);
            $("#emp_id").val(response.id);
            $("#emp_avatar").val(response.avatar);
          }
        });
      });

      // update employee ajax request
      $("#edit_employee_form").submit(function(e) {
        e.preventDefault();
        const fd = new FormData(this);
        $("#edit_employee_btn").text('Actualizando...');
        $.ajax({
          url: '{{ route('updateEmployee') }}',
          method: 'post',
          data: fd,
          cache: false,
          contentType: false,
          processData: false,
          dataType: 'json',
          success: function(response) {
            if (response.status == 200) {
              Swal.fire(
                'Actualizado!',
                'Empleado actualizado con éxito!',
                'Hecho'
              )
              fetchAllEmployeesJson();

            }
            $("#edit_employee_btn").text('Actualizar Empleado');
            $("#edit_employee_form")[0].reset();
            $("#editEmployeeModal").modal('hide');
            fetchAllEmployees().ajax.reload();
          }
        });
      });

      // delete employee ajax request
      $(document).on('click', '.delete-icon-employee', function(e) {
        e.preventDefault();
        let id = $(this).attr('id');
        let csrf = '{{ csrf_token() }}';
        Swal.fire({
          title: 'Está seguro?',
          text: "Desea eliminar este usuario?",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Eliminar'
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
              url: '{{ route('deleteEmployee') }}',
              method: 'delete',
              data: {
                id: id,
                _token: csrf
              },
              success: function(response) {
                Swal.fire(
                  'Eliminado!',
                  'Usuario eliminado',
                  'Hecho'
                )
                fetchAllEmployees().ajax.reload();
                fetchAllEmployeesJson();

              }
            });
          }
        })
      });

      // fetch all employees ajax request
      fetchAllEmployees();
      fetchAllEmployeesJson();
      fetchAllDevices();
      // runDataTable();

      function fetchAllEmployees() {
        $.ajax({
          url: '{{ route('fetchAllEmployees') }}',
          method: 'get',
          success: function(response) {
            $("#show_all_employees").html(response);
            $("#dataTableEmployees").DataTable({
              order: [0, 'desc'],
            });
          }
        });
      }

      function fetchAllEmployeesJson() {
        $.ajax({
          url: '{{ route('fetchAllEmployeesJson') }}',
          method: 'get',
          success: function(response) {
            $(".employee-select").append(response);
          }
        });
      }


//Devices

      function fetchAllDevices() {
        $.ajax({
          url: '{{ route('fetchAllDevices') }}',
          method: 'get',
          success: function(response) {
            $("#show_all_devices").html(response);
            $("#dataTableDevices").DataTable({
              order: [0, 'desc'],
            });
          }
        });
      }

        // add new device ajax request
        $("#add_device_form").submit(function(e) {
        e.preventDefault();
        const fd = new FormData(this);
        $("#add_device_btn").text('Agregando...');
        $.ajax({
          url: '{{ route('storeDevice') }}',
          method: 'post',
          data: fd,
          cache: false,
          contentType: false,
          processData: false,
          dataType: 'json',
          success: function(response) {
            if (response.status == 200) {
              Swal.fire(
                'Agregado!',
                'Dispositivo agregado con éxito!',
                'Hecho'
              )
            }
            $("#add_device_btn").text('Agregar Dispositivo');
            $("#add_device_form")[0].reset();
            $("#addDeviceModal").modal('hide');
            fetchAllDevices().ajax.reload();
          }
        });
      });

      // edit device ajax request
      $(document).on('click', '.edit-icon-device', function(e) {
        let id = $(this).attr('id');
        $.ajax({
          url: '{{ route('editDevice') }}',
          method: 'get',
          data: {
            id: id,
            _token: '{{ csrf_token() }}'
          },
          success: function(response) {
            console.log(response);
            $("#type").val(response.type);
            $("#name").val(response.name);
            $("#brand").val(response.brand);
            $("#model").val(response.model);
            $("#serial").val(response.serial);
            $("#identificator").val(response.identificator);
            $("#imei1").val(response.imei1);
            $("#imei2").val(response.imei2);
            $("#status").val(response.status);
            $("#comments").text(response.comments);
            $("#employee_id").val(response.employee_id);
            $("#dev_id").val(response.id);
          }
        });
      });

            // update device ajax request
        $("#edit_device_form").submit(function(e) {
        e.preventDefault();
        const fd = new FormData(this);
        $("#edit_device_btn").text('Actualizando...');
        $.ajax({
          url: '{{ route('updateDevice') }}',
          method: 'post',
          data: fd,
          cache: false,
          contentType: false,
          processData: false,
          dataType: 'json',
          success: function(response) {
            if (response.status == 200) {
              Swal.fire(
                'Actualizado!',
                'Dispositivo actualizado con éxito!',
                'Hecho'
              )
            }
            $("#edit_device_btn").text('Actualizar Dispositivo');
            $("#edit_device_form")[0].reset();
            $("#editDeviceModal").modal('hide');
            fetchAllDevices().ajax.reload();
          }
        });
      });

        // delete device ajax request
      $(document).on('click', '.delete-icon-device', function(e) {
        e.preventDefault();
        let id = $(this).attr('id');
        let csrf = '{{ csrf_token() }}';
        Swal.fire({
          title: 'Está seguro?',
          text: "Desea eliminar este usuario?",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Eliminar'
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
              url: '{{ route('deleteDevice') }}',
              method: 'delete',
              data: {
                id: id,
                _token: csrf
              },
              success: function(response) {
                Swal.fire(
                  'Eliminado!',
                  'Usuario eliminado',
                  'Hecho'
                )
                fetchAllDevices().ajax.reload();
              }
            });
          }
        })
      });
    });
  </script>
</body>

</html>