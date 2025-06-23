<x-guest-layout>
<form action="{{ route('users.store') }}" method="POST">
                @csrf
                <div>
                    <label for="nacionalidad">Nacionalidad:</label>
                    <select class="form-control" name="nacionalidad" id="nacionalidad" required>
                        <option value="V">V</option>
                        <option value="E">E</option>
                    </select>
                    <label for="cedula">Cédula de identidad:</label>
                    <input type="number" class="form-control" name="cedula" id="cedula" placeholder=" Campo Requerido*" required>
                </div>
                <div>
                    <label for="name">Nombre y Apellido:</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Campo Requerido*" required>
                </div>
                <div>
                    <label for="direccion">Dirección:</label>
                    <input type="text" class="form-control" name="direccion" id="direccion" placeholder="Campo Requerido*" required>
                </div>
                <div>
                    <label for="telefono">Telefono:</label>
                    <input type="number" class="form-control" name="telefono" id="telefono" placeholder="Campo Requerido*" required>
                </div>
                <div>
                    <label for="email">Correo Electrónico:</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Campo Requerido*" required>
                </div>
                <div>
                    <label for="password">Contraseña:</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Campo Requerido*" required>
                </div>
                <div>
                    <label for="usertype">Tipo de Usuario:</label>
                    <select class="form-control" name="usertype" id="usertype" required>
                        <option value="admin">Administrador</option>
                        <option value="user">Usuario</option>
                        <option value="instructor">Instructor</option>
                    </select>
                </div>
                <div>
                    <label for="status">Estatus:</label>
                    <select class="form-control" name="status" id="status" required>
                        <option value="Activo">Activo</option>
                        <option value="Retirado">Retirado</option>
                    </select>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-5"></div>
                    <button type="submit" class="btn btn-info btn-sm " value='CrearUsuario' name='btn-CrearUsuario' >Crear Usuario</button>
                </div>
            </form>
</x-guest-layout>