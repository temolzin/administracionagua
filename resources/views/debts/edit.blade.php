<div class="modal fade" id="edit{{ $customerDebt->id}}" tabindex="-1" role="dialog" aria-labelledby="editCostLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="card-warning">
                <div class="card-header">
                    <div class="d-sm-flex align-items-center justify-content-between">
                        <h4 class="card-title">Actualizar Deuda<small> &nbsp;(*) Campos requeridos</small></h4>
                        <button type="button" class="close" onclick="closeCurrentModal('#edit{{ $customerDebt->id }}')" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <form action="{{ route('debts.update', $customerDebt->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="card">
                            <div class="card-body">
                                <input type="hidden" name="customer_id" value="{{ $customerDebt->customer_id }}">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="start_date" class="form-label">Fecha Inicio(*)</label>
                                            <input type="month" class="form-control" name="start_date" id="start_date" placeholder="Ingresa Fecha inicio" value="{{ old('start_date', \Carbon\Carbon::parse($customerDebt->start_date)->format('Y-m')) }}" required />
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="end_date" class="form-label">Feccha fin(*)</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fa fa-dollar-sign"></i></span>
                                                </div>
                                                <input type="month" class="form-control" name="end_date" id="end_date" placeholder="Ingresa Fecha fin" value="{{ old('end_date', \Carbon\Carbon::parse($customerDebt->end_date)->format('Y-m')) }}" required />
                                            </div>
                                        </div>
                                    </div>                                    
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="amount" class="form-label">Cantidad(*)</label>
                                            <input type="number" class="form-control" name="amount" id="amount" placeholder="Ingresa el monto" value="{{ old('amount', $customerDebt->amount) }}" required />
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="note" class="form-label">Nota</label>
                                            <textarea class="form-control" name="note" id="note" placeholder="Ingresa una descripción">{{ old('note', $customerDebt->note) }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary">Cerrar</button>
                        <button type="submit" class="btn btn-warning">Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
