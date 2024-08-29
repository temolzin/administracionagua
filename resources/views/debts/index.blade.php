@extends('adminlte::page')

@section('title', 'Deudas')

@section('content')
    <section class="content">
        <div class="right_col" role="main">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Deudas</h2>
                        <div class="row">
                            @include('debts.periods')
                            <div class="col-lg-12 text-right">
                                <form action="{{ route('debts.assignAll') }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#assignDebtModal">
                                        <i class="fa fa-plus"></i> Asignar Deuda a Todos
                                    </button>
                                </form>
                                <button type="button" class="btn btn-success" data-toggle="modal"
                                    data-target="#createDebt">
                                    <i class="fa fa-plus"></i> Crear Deuda
                                </button>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <table id="debts" class="table table-striped display responsive nowrap"
                                        style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>USUARIO</th>
                                                <th>TOTAL DE LA DEUDA</th>
                                                <th>OPCIONES</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($debts as $debt)
                                                <tr>
                                                    <td>{{ $debt->customer->id }} </td>
                                                    <td>{{ $debt->customer->name }} {{ $debt->customer->last_name }}</td>
                                                    <td>{{ $debt->total_amount }}</td>
                                                    <td>
                                                        <div class="btn-group" role="group" aria-label="Opciones">
                                                            <button type="button" class="btn btn-info mr-2" data-toggle="modal" title="Ver Detalles"data-target="#viewDebts{{ $debt->customer->id }}">
                                                                <i class="fas fa-eye"></i>
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @include('debts.showDebts')
                                            @empty
                                                <tr>
                                                    <td colspan="3">No hay deudas registradas.</td>
                                                </tr>
                                            @endforelse
                                            @include('debts.create')
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var modalId = "{{ session('modal_id') }}";
            if (modalId) {
                $('#' + modalId).modal('show');
            }
        });

        $(document).ready(function() {
            $('#debts').DataTable({
                responsive: true,
                buttons: ['excel', 'pdf', 'print'],
                dom: 'Bfrtip',
            });

            var successMessage = "{{ session('success') }}";
            if (successMessage) {
                Swal.fire({
                    icon: 'success',
                    title: 'Éxito',
                    text: successMessage,
                    confirmButtonText: 'Aceptar'
                });
            }
            var errorMessage = "{{ session('error') }}";
            if (errorMessage) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: errorMessage,
                    confirmButtonText: 'Aceptar'
                });
            }
        });
        $('#createDebt').on('shown.bs.modal', function() {
            $('.select2').select2({
                dropdownParent: $('#createDebt')
            });
        });

        $('[id^=edit]').on('shown.bs.modal', function() {
            $('.select2').select2({
                dropdownParent: $(this)
            });
        });

        function closeCurrentModal(modalId) {
            $(modalId).modal('hide');
        }
    </script>
@endsection
