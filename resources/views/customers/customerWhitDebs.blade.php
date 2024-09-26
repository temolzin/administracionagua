<div class="modal fade" id="allCustomersModal" tabindex="-1" role="dialog" aria-labelledby="allCustomersModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="card-header" style="background-color:#9b1010; color:white;">
                <h5 class="modal-title" id="allCustomersModalLabel">Clientes con Deuda Mayor a 3 Años</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table id="customersWhitDebts" class="table table-striped display responsive nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Meses de Deuda</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>            
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
