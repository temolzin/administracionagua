<div class="modal fade" id="UpdatePassword{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="UpdatePassword" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="card-primary">
                <div class="card-header bg-secondary">
                    <div class="d-sm-flex align-items-center justify-content-between ">
                        <h4 class="card-title">Actualizar Contraseña</h4>
                        <button type="button" class="close d-sm-inline-block text-white" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                </div>
                <form role="form" id="formUpdatePassword{{ $user->id }}" enctype="multipart/form-data" name="formUpdatePassword{{ $user->id }}" method="post" action="{{ route('users.updatePassword', $user->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <input type="text" class="form-control" id="idUser" name="idUser" value="{{ $user->id }}" hidden/>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Contraseña (*)</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-lock"></i></span>
                                        <input type="password" class="form-control" id="newPassword" name="newPassword" placeholder="Ingrese la Nueva Contraseña" required/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center mt-3">
                            <button type="submit" class="btn btn-secondary">Confirmar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
