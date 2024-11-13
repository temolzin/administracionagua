<div class="modal fade" id="debtCustomersModal" tabindex="-1" role="dialog" aria-labelledby="debtCustomersModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="card-header" id="modalHeader" style="color:white;">
                <h5 class="modal-title" id="debtCustomersModalLabel">Clientes con Deuda</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table id="debtCustomersTable" class="table table-striped display responsive nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
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
