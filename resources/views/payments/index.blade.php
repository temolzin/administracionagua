@extends('adminlte::page')
@section('title', 'Pagos')
@section('content')
    <section class="content">
        <div class="right_col" payment="main">
            <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Pagos</h2>
                        <div class="row">
                            @include('payments.create')
                            <div class="col-lg-12 text-right">
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#createPayment">
                                    <i class="fa fa-plus"></i> Registrar Pago
                                </button>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <table id="payments" class="table table-striped display responsive nowrap" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>ID PAGO</th>
                                                <th>USUARIO</th>
                                                <th>DEUDA</th>
                                                <th>MONTO</th>
                                                <th>OPCIONES</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($payments) <= 0)
                                                <tr>
                                                    <td colspan="5">No hay resultados</td>
                                                </tr>
                                            @else
                                                @foreach($payments as $payment)
                                                    <tr>
                                                        <td>{{ $payment->id }}</td>
                                                        <td>{{ $payment->debt->customer->name ?? 'Desconocido' }} {{ $payment->debt->customer->last_name ?? 'Desconocido' }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($payment->debt->start_date)->locale('es')->isoFormat('MMMM [/] YYYY')}} - 
                                                            {{ \Carbon\Carbon::parse($payment->debt->end_date)->locale('es')->isoFormat('MMMM [/] YYYY') }}
                                                            | Monto: {{ $payment->debt->amount }}</td>
                                                        <td>{{ $payment->amount }}</td>
                                                        <td>
                                                            <div class="btn-group" payment="group" aria-label="Opciones">
                                                                <button type="button" class="btn btn-info mr-2" data-toggle="modal" title="Ver Detalles" data-target="#view{{ $payment->id }}">
                                                                    <i class="fas fa-eye"></i>
                                                                </button>
                                                                <button type="button" class="btn btn-warning mr-2" data-toggle="modal" title="Editar Datos" data-target="#editPayment{{$payment->id}}">
                                                                    <i class="fas fa-edit"></i>
                                                                </button>
                                                                <button type="button" class="btn btn-danger mr-2" data-toggle="modal" title="Eliminar Registro" data-target="#delete{{ $payment->id }}">
                                                                    <i class="fas fa-trash-alt"></i>
                                                                </button>
                                                            </div>
                                                        </td>
                                                        @include('payments.delete')
                                                        @include('payments.edit')
                                                        @include('payments.show')
                                                    </tr>
                                                @endforeach
                                            @endif
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
    $(document).ready(function() {
  $('#customer_id').change(function() {
        var customerId = $(this).val();
        
        if (customerId) {
            $.ajax({
                url: '{{ route("getCustomerDebts") }}',
                type: 'GET',
                data: { customer_id: customerId },
                success: function(response) {
                    $('#debt_id').empty();
                    $('#debt_id').append('<option value="">Selecciona una deuda</option>');
                    $.each(response.debts, function(key, value) {
                        $('#debt_id').append('<option value="'+ value.id +'" data-remaining-amount="'+ value.remaining_amount +'">'+ value.start_date +' - '+ value.end_date +' | Monto: '+ value.amount +'</option>');
                    });
                },
                error: function(xhr) {
                    console.log('Error:', xhr.responseText);
                }
            });
        } else {
            $('#debt_id').empty();
            $('#debt_id').append('<option value="">Selecciona una deuda</option>');
        }
    });

    $('#debt_id').change(function() {
        var selectedOption = $(this).find('option:selected');
        var remainingAmount = selectedOption.data('remaining-amount');
        
        if (remainingAmount !== undefined) {
            $('#suggested_amount').text('Monto sugerido a pagar: $' + remainingAmount);
        } else {
            $('#suggested_amount').text('');
        }
    });

        $('#payments').DataTable({
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
</script>
@endsection
