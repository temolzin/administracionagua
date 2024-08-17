
<div class="modal fade" id="createCustomer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="card-success">
                <div class="card-header">
                    <div class="d-sm-flex align-items-center justify-content-between">
                        <h4 class="card-title">Agregar usuario <small> &nbsp;(*) Campos requeridos</small></h4>
                        <button type="button" class="close d-sm-inline-block text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <form action="{{ route('customers.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="card">
                            <div class="card-header py-2 bg-secondary">
                                <h3 class="card-title">Ingrese los Datos del Cliente</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="name" class="form-label">Nombre(*)</label>
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Ingresa nombre" value="{{ old('name') }}" required />
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="last_name" class="form-label">Apellido(*)</label>
                                            <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Ingresa apellido" value="{{ old('last_name') }}" required />
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="block" class="form-label">Manzana(*)</label>
                                            <input type="text" class="form-control" id="block" name="block" placeholder="Ingresa bloque" value="{{ old('block') }}" required />
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="street" class="form-label">Calle(*)</label>
                                            <input type="text" class="form-control" id="street" name="street" placeholder="Ingresa calle" value="{{ old('street') }}" required />
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="interior_number" class="form-label">Número Interior(*)</label>
                                            <input type="text" class="form-control" id="interior_number" name="interior_number" placeholder="Ingresa número interior" value="{{ old('interior_number') }}" required />
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="marital_status" class="form-label">Estado Civil(*)</label>
                                            <select class="form-control" id="marital_status" name="marital_status" required>
                                                <option value="">Selecciona una opción</option>
                                                <option value="1" {{ old('marital_status') == '1' ? 'selected' : '' }}>Casado</option>
                                                <option value="0" {{ old('marital_status') == '0' ? 'selected' : '' }}>Soltero</option>
                                            </select>
                                        </div>
                                    </div>                                    
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="partner_name" class="form-label">Nombre de la Pareja</label>
                                            <input type="text" class="form-control" id="partner_name" name="partner_name" placeholder="Ingresa nombre de la pareja" value="{{ old('partner_name') }}" />
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="has_water_connection" class="form-label">¿Tiene Toma de agua?</label>
                                            <select class="form-control" id="has_water_connection" name="has_water_connection" required>
                                                <option value="">Selecciona una opción</option>
                                                <option value="1" {{ old('has_water_connection') == '1' ? 'selected' : '' }}>Sí</option>
                                                <option value="0" {{ old('has_water_connection') == '0' ? 'selected' : '' }}>No</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="has_store" class="form-label">¿Tiene local?</label>
                                            <select class="form-control" id="has_store" name="has_store" required>
                                                <option value="">Selecciona una opción</option>
                                                <option value="1" {{ old('has_store') == '1' ? 'selected' : '' }}>Sí</option>
                                                <option value="0" {{ old('has_store') == '0' ? 'selected' : '' }}>No</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="connection_holder" class="form-label">Titular de la Toma</label>
                                            <input type="text" class="form-control" id="connection_holder" name="connection_holder" placeholder="Ingresa titular de la conexión" value="{{ old('connection_holder') }}" />
                                        </div>
                                    </div>                                   
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="has_all_payments" class="form-label">¿Está al día?</label>
                                            <select class="form-control" id="has_all_payments" name="has_all_payments" required>
                                                <option value="">Selecciona una opción</option>
                                                <option value="1" {{ old('up_to_date') == '1' ? 'selected' : '' }}>Sí</option>
                                                <option value="0" {{ old('up_to_date') === '0' ? 'selected' : '' }}>No</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="has_water_day_night" class="form-label">¿Tiene agua día y noche?</label>
                                            <select class="form-control" id="has_water_day_night" name="has_water_day_night" required>
                                                <option value="">Selecciona una opción</option>
                                                <option value="1" {{ old('has_water_day_night') == '1' ? 'selected' : '' }}>Sí</option>
                                                <option value="0" {{ old('has_water_day_night') == '0' ? 'selected' : '' }}>No</option>
                                            </select>
                                        </div>
                                    </div>                                    
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="occupants_number" class="form-label">Número de Ocupantes(*)</label>
                                            <input type="number" class="form-control" id="occupants_number" name="occupants_number" placeholder="Ingresa número de ocupantes" value="{{ old('occupants_number') }}" required />
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="water_days" class="form-label">Días de Agua(*)</label>
                                            <input type="number" class="form-control" id="water_days" name="water_days" placeholder="Ingresa días de agua" value="{{ old('water_days') }}" required />
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="has_water_pressure" class="form-label">¿Tiene presión de agua?</label>
                                            <select class="form-control" id="has_water_pressure" name="has_water_pressure" required>
                                                <option value="">Selecciona una opción</option>
                                                <option value="1" {{ old('has_water_pressure') === '1' ? 'selected' : '' }}>Sí</option>
                                                <option value="0" {{ old('has_water_pressure') === '0' ? 'selected' : '' }}>No</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="has_cistern" class="form-label">¿Tiene cisterna?</label>
                                            <select class="form-control" id="has_cistern" name="has_cistern" required>
                                                <option value="">Selecciona una opción</option>
                                                <option value="1" {{ old('has_cistern') === '1' ? 'selected' : '' }}>Sí</option>
                                                <option value="0" {{ old('has_cistern') === '0' ? 'selected' : '' }}>No</option>
                                            </select>
                                        </div>
                                    </div>                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" id="save" class="btn btn-success">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
