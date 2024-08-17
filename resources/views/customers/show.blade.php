<div class="modal fade" id="view{{ $customer->id }}" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel{{ $customer->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="card-info">
                <div class="card-header">
                    <div class="d-sm-flex align-items-center justify-content-between">
                        <h4 class="card-title">Información del Cliente</h4>
                        <button type="button" class="close d-sm-inline-block text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label>ID</label>
                                        <input type="text" disabled class="form-control" value="{{ $customer->id }}" />
                                    </div>
                                </div>
                                <div class="col-lg-10">
                                    <div class="form-group">
                                        <label>Nombre</label>
                                        <input type="text" disabled class="form-control" value="{{ $customer->name }} {{ $customer->last_name }}" />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Bloque</label>
                                        <input type="text" disabled class="form-control" value="{{ $customer->block }}" />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Calle</label>
                                        <input type="text" disabled class="form-control" value="{{ $customer->street }}" />
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label>Número Interior</label>
                                        <input type="text" disabled class="form-control" value="{{ $customer->interior_number }}" />
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>Estado Civil</label>
                                        <input type="text" disabled class="form-control" value="{{ $customer->marital_status ? 'Casado' : 'Soltero' }}" />
                                    </div>
                                </div>
                                <div class="col-lg-5">
                                    <div class="form-group">
                                        <label>Nombre del Pareja</label>
                                        <input type="text" disabled class="form-control" value="{{ $customer->partner_name }}" />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>¿Tiene Toma de Agua?</label>
                                        <input type="text" disabled class="form-control" value="{{ $customer->has_water_connection ? 'Sí' : 'No' }}" />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Nombre del Titular de Conexión</label>
                                        <input type="text" disabled class="form-control" value="{{ $customer->connection_holder }}" />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>¿Tiene Local?</label>
                                        <input type="text" disabled class="form-control" value="{{ $customer->has_store ? 'Sí' : 'No' }}" />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>¿Está al Día?</label>
                                        <input type="text" disabled class="form-control" value="{{ $customer->has_all_payments ? 'Sí' : 'No' }}" />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>¿Tiene Agua Día y Noche?</label>
                                        <input type="text" disabled class="form-control" value="{{ $customer->has_water_day_night ? 'Sí' : 'No' }}" />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Número de Ocupantes</label>
                                        <input type="text" disabled class="form-control" value="{{ $customer->occupants_number }}" />
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>Días de Agua</label>
                                        <input type="text" disabled class="form-control" value="{{ $customer->water_days }}" />
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>¿Tiene Presión de Agua?</label>
                                        <input type="text" disabled class="form-control" value="{{ $customer->has_water_pressure ? 'Sí' : 'No' }}" />
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>¿Tiene Cisterna?</label>
                                        <input type="text" disabled class="form-control" value="{{ $customer->has_cistern ? 'Sí' : 'No' }}" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</div>
