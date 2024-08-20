<div class="modal fade" id="edit{{ $customer->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="card-warning">
                <div class="card-header">
                    <div class="d-sm-flex align-items-center justify-content-between">
                        <h4 class="card-title">Editar Cliente <small> &nbsp;(*) Campos requeridos</small></h4>
                        <button type="button" class="close d-sm-inline-block text-white" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                </div>
                <form action="{{ route('customers.update', $customer->id) }}" method="post" id="edit-customer-form-{{ $customer->id }}">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="card">
                            <div class="card-header py-2 bg-secondary">
                                <h3 class="card-title">Datos del Cliente</h3>
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
                                            <label for="nameUpdate" class="form-label">Nombre(*)</label>
                                            <input type="text" class="form-control" name="nameUpdate" id="nameUpdate" value="{{ $customer->name }}" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="lastNameUpdate" class="form-label">Apellido(*)</label>
                                            <input type="text" class="form-control" name="lastNameUpdate" id="lastNameUpdate" value="{{ $customer->last_name }}" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="blockUpdate" class="form-label">Bloque(*)</label>
                                            <input type="text" class="form-control" name="blockUpdate" id="blockUpdate" value="{{ $customer->block }}" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="streetUpdate" class="form-label">Calle(*)</label>
                                            <input type="text" class="form-control" name="streetUpdate" id="streetUpdate" value="{{ $customer->street }}" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="interiorNumberUpdate" class="form-label">Número Interior(*)</label>
                                            <input type="text" class="form-control" name="interiorNumberUpdate" id="interiorNumberUpdate" value="{{ $customer->interior_number }}" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="maritalStatusUpdate" class="form-label">Estado Civil(*)</label>
                                            <select class="form-control" id="maritalStatusUpdate" name="maritalStatusUpdate" required>
                                                <option value="">Selecciona una opción</option>
                                                <option value="1" {{ $customer->marital_status == 1 ? 'selected' : '' }}>Casado</option>
                                                <option value="0" {{ $customer->marital_status == 0 ? 'selected' : '' }}>Soltero</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="partnerNameUpdate" class="form-label">Nombre del Pareja</label>
                                            <input type="text" class="form-control" name="partnerNameUpdate" id="partnerNameUpdate" value="{{ $customer->partner_name }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="hasWaterConnectionUpdate" class="form-label">¿Tiene Toma de agua?</label>
                                            <select class="form-control" id="hasWaterConnectionUpdate" name="hasWaterConnectionUpdate" required>
                                                <option value="">Selecciona una opción</option>
                                                <option value="1" {{ $customer->has_water_connection == 1 ? 'selected' : '' }}>Sí</option>
                                                <option value="0" {{ $customer->has_water_connection == 0 ? 'selected' : '' }}>No</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="hasStoreUpdate" class="form-label">¿Tiene Local?</label>
                                            <select class="form-control" id="hasStoreUpdate" name="hasStoreUpdate" required>
                                                <option value="">Selecciona una opción</option>
                                                <option value="1" {{ $customer->has_store == 1 ? 'selected' : '' }}>Sí</option>
                                                <option value="0" {{ $customer->has_store == 0 ? 'selected' : '' }}>No</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="hasAllPaymentsUpdate" class="form-label">¿Está al día?</label>
                                            <select class="form-control" id="hasAllPaymentsUpdate" name="hasAllPaymentsUpdate" required>
                                                <option value="">Selecciona una opción</option>
                                                <option value="1" {{ $customer->up_to_date == 1 ? 'selected' : '' }}>Sí</option>
                                                <option value="0" {{ $customer->up_to_date == 0 ? 'selected' : '' }}>No</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="hasWaterDayNightUpdate" class="form-label">¿Tiene agua día y noche?</label>
                                            <select class="form-control" id="hasWaterDayNightUpdate" name="hasWaterDayNightUpdate" required>
                                                <option value="">Selecciona una opción</option>
                                                <option value="1" {{ $customer->has_water_day_night == 1 ? 'selected' : '' }}>Sí</option>
                                                <option value="0" {{ $customer->has_water_day_night == 0 ? 'selected' : '' }}>No</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="occupantsNumberUpdate" class="form-label">Número de Ocupantes(*)</label>
                                            <input type="number" class="form-control" name="occupantsNumberUpdate" id="occupantsNumberUpdate" value="{{ $customer->occupants_number }}" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="waterDaysUpdate" class="form-label">Días de Agua(*)</label>
                                            <input type="number" class="form-control" name="waterDaysUpdate" id="waterDaysUpdate" value="{{ $customer->water_days }}" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="hasWaterPressureUpdate" class="form-label">¿Tiene presión de agua?</label>
                                            <select class="form-control" id="hasWaterPressureUpdate" name="hasWaterPressureUpdate" required>
                                                <option value="">Selecciona una opción</option>
                                                <option value="1" {{ $customer->has_water_pressure == 1 ? 'selected' : '' }}>Sí</option>
                                                <option value="0" {{ $customer->has_water_pressure == 0 ? 'selected' : '' }}>No</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="hasCisternUpdate" class="form-label">¿Tiene cisterna?</label>
                                            <select class="form-control" id="hasCisternUpdate" name="hasCisternUpdate" required>
                                                <option value="">Selecciona una opción</option>
                                                <option value="1" {{ $customer->has_cistern == 1 ? 'selected' : '' }}>Sí</option>
                                                <option value="0" {{ $customer->has_cistern == 0 ? 'selected' : '' }}>No</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="costIdUpdate" class="form-label">Costo(*)</label>
                                            <select class="form-control" id="costIdUpdate" name="costIdUpdate" required>
                                                <option value="">Selecciona una opción</option>
                                                @foreach($costs as $cost)
                                                    <option value="{{ $cost->id }}" {{ $customer->cost_id == $cost->id ? 'selected' : '' }}>{{ $cost->category }} - {{ $cost->price }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-warning">Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
