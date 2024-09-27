@extends('adminlte::page')

@section('title', 'Dasboard')

@section('content')
    <section class="content">
        <div class="right_col" role="main">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="row">
                        <div class="container-fluid">
                            <div class="card-box head">
                                <div class="row align-items-center">
                                    <div class="col-md-2 text-center">
                                        @if ($authUser->getFirstMediaUrl('userGallery'))
                                            <img src="{{ $authUser->getFirstMediaUrl('userGallery') }}"
                                                alt="Foto de {{ $authUser->name }}">
                                        @else
                                            <img src="{{ asset('img/userDefault.png') }}">
                                        @endif
                                    </div>

                                    <div class="col-md-8">
                                        <h4 class="font-weight-bold text-capitalize welcome">Bienvenid@</h4>
                                        <h1 class="font-weight-bold text-blue">{{ $authUser->name }} {{ $authUser->last_name }}</h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if ($data['noDebtsForCurrentMonth'])
                        <div class="alert alert-warning" role="alert">
                            Ya ha iniciado un nuevo mes y no se han asignado deudas a los Usuarios para este periodo.
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-lg-4 col-xs-6">
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>{{ $data['totalCustomers'] }}</h3>
                                    <p>Total de Usuarios</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-users"></i>
                                </div>
                                <a href="{{ route('customers.index') }}" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>

                        <div class="col-lg-4 col-xs-6">
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h3>{{ $data['customersWithoutDebts'] }}</h3>
                                    <p>Usuarios al día</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <a href="{{ route('customers.index') }}" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>

                        <div class="col-lg-4 col-xs-6">
                            <div class="small-box bg-red">
                                <div class="inner">
                                    <h3>{{ $data['customersWithDebts'] }}</h3>
                                    <p>Usuarios con Deudas</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-exclamation-circle"></i>
                                </div>
                                <a href="{{ route('debts.index') }}" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>

                    @include('customers.customerWhitDebs')

                    <div class="col-md-12 p-1">
                        <div class="card card-success">
                            <div class="card-header" style="background-color:#9b1010; color:white;">
                                <h3 class="card-title">Clientes con Deuda Mayor a 3 Años</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body p-1">
                                <table id="customers" class="table table-striped display responsive nowrap" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Apellido</th>
                                            <th>Meses de Deuda</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data['debtOverThreeYears'] as $key => $customer)
                                            @if ($key < 5)
                                                <tr>
                                                    <td>{{ $customer->name }}</td>
                                                    <td>{{ $customer->last_name }}</td>
                                                    <td>{{ $customer->total_months }} meses</td>
                                                </tr>
                                            @else
                                                @break
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer text-center">
                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#allCustomersModal">
                                    Ver Todos
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Ganancias Mensuales</h3>
                                </div>
                                <div class="card-body">
                                    <canvas id="earningsChart" width="400" height="200"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Ganancias Anuales por Mes</h3>
                                </div>
                                <div class="card-body">
                                    <canvas id="annualEarningsChart" width="400" height="200"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('css/dashboard/dashboard.css') }}">
@stop

@section('js')
    @include('language.datatables_language')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        $('#allCustomersModal').on('show.bs.modal', function () {
            $.ajax({
                url: '{{ route('debt.customers') }}',
                type: 'GET',
                success: function(response) {
                    let tableBody = $('#customersWhitDebts tbody');
                    tableBody.empty();
                    response.data.forEach(function(customer) {
                        tableBody.append(`
                            <tr>
                                <td>${customer.name}</td>
                                <td>${customer.last_name}</td>
                                <td>${customer.total_months} meses</td>
                            </tr>
                        `);
                    });

                    if ($.fn.DataTable.isDataTable('#customersWhitDebts')) {
                        $('#customersWhitDebts').DataTable().clear().destroy();
                    }

                    $('#customersWhitDebts').DataTable({
                        responsive: true,
                        pageLength: 10,
                        buttons: ['excel', 'pdf', 'print'],
                        dom: 'Bfrtip',
                        destroy: true,
                        language: idiomaDataTable,
                    });
                },
                error: function() {
                    alert('Error al cargar los datos de clientes.');
                }
            });
        });

        var ctx = document.getElementById('earningsChart').getContext('2d');
        var earningsChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($data['months']),
                datasets: [{
                    label: 'Ganancias en $',
                    data: @json($data['earningsPerMonth']),
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        var ctxAnnual = document.getElementById('annualEarningsChart').getContext('2d');
        var annualEarningsChart = new Chart(ctxAnnual, {
            type: 'line',
            data: {
                labels: @json($data['months']),
                datasets: [{
                    label: 'Ganancias Anuales en $',
                    data: @json($data['earningsPerMonth']),
                    backgroundColor: 'rgba(255, 99, 132, 0.5)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 2
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@stop
