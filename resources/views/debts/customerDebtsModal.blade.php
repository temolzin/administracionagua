<div class="modal fade" id="consolidateDebts{{ $debt->customer->id }}" tabindex="-1" role="dialog" aria-labelledby="consolidateModalLabel{{ $debt->customer->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="card-success">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="consolidateModalLabel{{ $debt->customer->id }}">Consolidar Deudas del Usuario</h5>
                    <button type="button" class="close text-white" onclick="closeCurrentModal('#consolidateDebts{{ $debt->customer->id}}')"  aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('debts.consolidate', $debt->customer->id) }}" method="POST">
                    @csrf
                    <input type="hidden" name="customer_id" value="{{ $debt->customer->id }}">
                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label>Fecha de Inicio</label>
                                <input type="text" name="start_date" readonly class="form-control" id="consolidateStartDate{{ $debt->customer->id }}">
                            </div>
                            <div class="col-md-6">
                                <label>Fecha de Fin</label>
                                <input type="text" readonly name="end_date" class="form-control" id="consolidateEndDate{{ $debt->customer->id }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Monto Total</label>
                            <input type="text" name="total_amount" readonly class="form-control" id="consolidateTotalAmount{{ $debt->customer->id }}">
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="note" class="form-label">Observación</label>
                                <textarea class="form-control" name="note" placeholder="Ingresa una observación">{{ old('note') }}</textarea>
                            </div>
                        </div>

                        <div class="debt-list overflow-auto" style="max-height: 200px;">
                            <h5>Deudas a Unir</h5>
                            <ul id="debtList{{ $debt->customer->id }}" class="list-group small">
                            </ul>
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Confirmar Unión</button>
                        <button type="button" class="btn btn-secondary" onclick="closeCurrentModal('#consolidateDebts{{ $debt->customer->id}}')" >Cerrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
