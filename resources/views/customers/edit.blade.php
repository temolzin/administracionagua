<div class="modal fade" id="edit{{ $customer->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="card-warning">
                <div class="card-header">
                    <div class="d-sm-flex align-items-center justify-content-between">
                        <h4 class="card-title">Editar Usuario <small> &nbsp;(*) Campos requeridos</small></h4>
                        <button type="button" class="close d-sm-inline-block text-white" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                </div>
                <form action="{{ route('customers.update', $customer->id) }}" enctype="multipart/form-data" method="post" id="edit-customer-form-{{ $customer->id }}">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="card">
                            <div class="card-header py-2 bg-secondary">
                                <h3 class="card-title">Datos del Usuario</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-8 offset-lg-2">
                                        <div class="form-group text-center">
                                            <label for="photo-{{ $customer->id }}" class="form-label"></label>
                                            <div class="image-preview-container" style="display: flex; justify-content: center; margin-bottom: 10px;">
                                                <img id="photo-preview-edit-{{ $customer->id }}" src="{{ $customer->getFirstMediaUrl('customerGallery') ? $customer->getFirstMediaUrl('customerGallery') : asset('img/userDefault.png') }}" 
                                                  alt="Foto Actual" style="width: 120px; height: 120px; border-radius: 50%; margin-bottom: 5px;">
                                            </div>
                                            <input type="file" class="form-control" name="photo" id="photo-{{ $customer->id }}" onchange="previewImageEdit(event, {{ $customer->id }})">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="nameUpdate" class="form-label">Nombre(*)</label>
                                            <input type="text" class="form-control" name="nameUpdate" id="nameUpdate" placeholder="Ingresa nombre" value="{{ $customer->name }}" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="lastNameUpdate" class="form-label">Apellido(*)</label>
                                            <input type="text" class="form-control" name="lastNameUpdate" id="lastNameUpdate"  placeholder="Ingresa apellido" value="{{ $customer->last_name }}" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="blockUpdate" class="form-label">Manzana(*)</label>
                                            <input type="text" class="form-control" name="blockUpdate" id="blockUpdate"  placeholder="Ingresa la Manzana" value="{{ $customer->block }}" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="streetUpdate" class="form-label">Calle(*)</label>
                                            <input type="text" class="form-control" name="streetUpdate" id="streetUpdate"  placeholder="Ingresa la calle" value="{{ $customer->street }}" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="interiorNumberUpdate" class="form-label">Número Interior</label>
                                            <input type="text" class="form-control" name="interiorNumberUpdate" id="interiorNumberUpdate"  placeholder="Ingresa número interior" value="{{ $customer->interior_number }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="maritalStatusUpdate" class="form-label">Estado Civil(*)</label>
                                            <select class="form-control" id="maritalStatusUpdate" name="maritalStatusUpdate" required>
                                                <option value="">Selecciona una opción</option>
                                                <option value="Casado/a" {{ $customer->marital_status == "Casado/a" ? 'selected' : '' }}>Casado/a</option>
                                                <option value="Soltero/a" {{ $customer->marital_status == "Soltero/a" ? 'selected' : '' }}>Soltero/a</option>
                                                <option value="Divorciado/a" {{ $customer->marital_status == "Divorciado/a" ? 'selected' : '' }}>Viudo/a</option>
                                                <option value="Viudo/a" {{ $customer->marital_status == "Viudo/a" ? 'selected' : '' }}>Viudo/a</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="partnerNameUpdate" class="form-label">Nombre de la Pareja</label>
                                            <input type="text" class="form-control" name="partnerNameUpdate" id="partnerNameUpdate"  placeholder="Nombre de la pareja" value="{{ $customer->partner_name }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="hasWaterConnectionUpdate" class="form-label">¿Tiene Toma de agua?</label>
                                            <select class="form-control" id="hasWaterConnectionUpdate" name="hasWaterConnectionUpdate">
                                                <option value="" {{ is_null($customer->has_water_connection) ? 'selected' : '' }}>Selecciona una opción</option>
                                                <option value="1" {{ $customer->has_water_connection == 1 ? 'selected' : '' }}>Sí</option>
                                                <option value="0" {{ $customer->has_water_connection === 0 ? 'selected' : '' }}>No</option>
                                            </select>                                                                                    
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="hasStoreUpdate" class="form-label">¿Tiene Local?</label>
                                            <select class="form-control" id="hasStoreUpdate" name="hasStoreUpdate" >
                                                <option value="" {{ is_null($customer->has_store) ? 'selected' : '' }}>Selecciona una opción</option>
                                                <option value="1" {{ $customer->has_store == 1 ? 'selected' : '' }}>Sí</option>
                                                <option value="0" {{ $customer->has_store === 0 ? 'selected' : '' }}>No</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="hasAllPaymentsUpdate" class="form-label">¿Está al día?</label>
                                            <select class="form-control" id="hasAllPaymentsUpdate" name="hasAllPaymentsUpdate" >
                                                <option value="" {{ is_null($customer->has_all_payments) ? 'selected' : '' }}>Selecciona una opción</option>
                                                <option value="1" {{ $customer->has_all_payments == 1 ? 'selected' : '' }}>Sí</option>
                                                <option value="0" {{ $customer->has_all_payments === 0 ? 'selected' : '' }}>No</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="hasWaterDayNightUpdate" class="form-label">¿Tiene agua día y noche?</label>
                                            <select class="form-control" id="hasWaterDayNightUpdate" name="hasWaterDayNightUpdate" >
                                                <option value="">Selecciona una opción</option>
                                                <option value="Día sí, noche no" {{ $customer->has_water_day_night == "Día sí, noche no" ? 'selected' : '' }}>Día sí, noche no</option>
                                                <option value="Noche sí, día no" {{ $customer->has_water_day_night == "Noche sí, día no" ? 'selected' : '' }}>Noche sí, día no</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="occupantsNumberUpdate" class="form-label">Número de Ocupantes</label>
                                            <input type="number" class="form-control" name="occupantsNumberUpdate" id="occupantsNumberUpdate" placeholder="Ingresa número de ocupantes"  value="{{ $customer->occupants_number }}" >
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="waterDaysUpdate" class="form-label">Días de Agua</label>
                                            <input type="number" class="form-control" name="waterDaysUpdate" id="waterDaysUpdate"  placeholder="Ingresa días de agua" value="{{ $customer->water_days }}" >
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="hasWaterPressureUpdate" class="form-label">¿Tiene presión de agua?</label>
                                            <select class="form-control" id="hasWaterPressureUpdate" name="hasWaterPressureUpdate" >
                                                <option value="">Selecciona una opción</option>
                                                <option value="Día sí, noche no" {{ $customer->has_water_pressure == "Día sí, noche no" ? 'selected' : '' }}>Día sí, noche no</option>
                                                <option value="Noche sí, día no" {{ $customer->has_water_pressure == "Noche sí, día no" ? 'selected' : '' }}>Noche sí, día no</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="hasCisternUpdate" class="form-label">¿Tiene cisterna?</label>
                                            <select class="form-control" id="hasCisternUpdate" name="hasCisternUpdate" >
                                                <option value="" {{ is_null($customer->has_cistern) ? 'selected' : '' }}>Selecciona una opción</option>
                                                <option value="1" {{ $customer->has_cistern == 1 ? 'selected' : '' }}>Sí</option>
                                                <option value="0" {{ $customer->has_cistern === 0 ? 'selected' : '' }}>No</option>
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
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="state" class="form-label">Estatus</label>
                                            <select class="form-control" id="stateUpdate" name="stateUpdate">
                                                <option value="" {{ is_null($customer->state) ? 'selected' : '' }}>Selecciona una opción</option>
                                                <option value="1" {{ $customer->state == 1 ? 'selected' : '' }}>Activo</option>
                                                <option value="0" {{ $customer->state === 0 ? 'selected' : '' }}>Inactivo</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="status" class="form-label">Estado del titular</label>
                                            <select class="form-control" id="statusUpdate" name="statusUpdate">
                                                <option value="" {{ is_null($customer->status) ? 'selected' : '' }}>Selecciona una opción</option>
                                                <option value="1" {{ $customer->status == 1 ? 'selected' : '' }}>Con Vida</option>
                                                <option value="0" {{ $customer->status === 0 ? 'selected' : '' }}>Fallecido</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12" id="responsibleNameUpdate">
                                        <div class="form-group">
                                            <label for="responsibleNameUpdate" class="form-label">Nombre de la persona que será responsable</label>
                                            <input type="text" class="form-control" name="responsibleNameUpdate" 
                                            placeholder="Nombre de la persona responsable si el titular fallecio, si no hay dejalo vacio"  id="responsibleNameUpdate" value="{{ $customer->responsible_name }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="observationUpdate" class="form-label">Nota</label>
                                            <textarea class="form-control" name="observationUpdate" id="observationUpdate"  placeholder="Ingresa nota">{{ $customer->observation }}</textarea>
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

<script>
    function previewImageEdit(event, id) {
        var input = event.target;
        var reader = new FileReader();
        reader.onload = function() {
            var dataURL = reader.result;
            var output = document.getElementById('photo-preview-edit-' + id);
            output.src = dataURL;
            output.style.display = 'block';
        };
        reader.readAsDataURL(input.files[0]);
    }
</script>
