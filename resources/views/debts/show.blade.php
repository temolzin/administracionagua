<div class="modal fade" id="view{{ $customerDebt->id }}" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel{{ $customerDebt->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="card-info">
                <div class="card-header">
                    <div class="d-sm-flex align-items-center justify-content-between">
                        <h4 class="card-title">Información de la Deuda</h4>
                        <button type="button" class="close d-sm-inline-block text-white" onclick="closeCurrentModal('#view{{ $customerDebt->id }}')"aria-label="Close">
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
                                        <input type="text" disabled class="form-control" value="{{ $customerDebt->id }}" />
                                    </div>
                                </div>
                                <div class="col-lg-5">
                                    <div class="form-group">
                                        <label>Monto</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-dollar-sign"></i></span>
                                            </div>
                                            <input type="text" disabled class="form-control" value="{{ number_format($customerDebt->amount, 2) }}" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-5">
                                    <div class="form-group">
                                        <label>Estado</label>
                                        <p class="form-control">
                                            @if ($customerDebt->status === 'pending')
                                                <button class="btn btn-danger btn-xs">No pagada</button>
                                            @elseif ($customerDebt->status === 'partial')
                                                <button class="btn btn-warning btn-xs">Abonada</button>
                                            @elseif ($customerDebt->status === 'paid')
                                                <button class="btn btn-success btn-xs">Pagada</button>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Fecha de Inicio</label>
                                        <input type="text" disabled class="form-control" value="{{ strftime('%d de %B de %Y', strtotime($customerDebt->start_date)) }}" />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Fecha de Fin</label>
                                        <input type="text" disabled class="form-control" value="{{ strftime('%d de %B de %Y', strtotime($customerDebt->end_date)) }}" />
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Observación</label>
                                        <textarea disabled class="form-control">{{ $customerDebt->note }}</textarea>
                                    </div>
                                </div>
                               
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="closeCurrentModal('#view{{ $customerDebt->id }}')">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</div>
