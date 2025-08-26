@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0"><i class="bi bi-bar-chart-fill"></i> Gráficas de Usuarios</h1>
        <a href="{{ route('usuarios.index') }}" class="btn btn-outline-primary"><i class="bi bi-arrow-left"></i> Volver a Usuarios</a>
    </div>

    <div class="row">
        <div class="col-lg-6 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title"><i class="bi bi-pie-chart-fill text-primary"></i> Usuarios por Rango de Edad</h5>
                    <div class="flex-grow-1 d-flex align-items-center justify-content-center">
                        <canvas id="edadChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title"><i class="bi bi-graph-up-arrow text-success"></i> Usuarios por Año de Nacimiento</h5>
                    <div class="flex-grow-1">
                        <canvas id="anioChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title"><i class="bi bi-calendar-week-fill text-info"></i> Usuarios Registrados por Mes</h5>
                    <canvas id="mesChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const fontStyle = {
            family: '"Helvetica Neue", Helvetica, Arial, sans-serif',
            size: 14,
        };

        // 1. Usuarios por Rango de Edad (Doughnut Chart)
        const edadCtx = document.getElementById('edadChart').getContext('2d');
        const edadData = {!! json_encode(array_values($rangos)) !!};
        const edadLabels = {!! json_encode(array_keys($rangos)) !!};
        new Chart(edadCtx, {
            type: 'doughnut',
            data: {
                labels: edadLabels,
                datasets: [{
                    label: 'Usuarios',
                    data: edadData,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.8)',
                        'rgba(54, 162, 235, 0.8)',
                        'rgba(255, 206, 86, 0.8)',
                        'rgba(75, 192, 192, 0.8)',
                        'rgba(153, 102, 255, 0.8)',
                        'rgba(255, 159, 64, 0.8)'
                    ],
                    borderColor: 'rgba(255, 255, 255, 0.5)',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: { font: fontStyle }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                if (context.parsed !== null) {
                                    label += context.parsed + ' usuarios';
                                }
                                return label;
                            }
                        }
                    }
                }
            }
        });

        // 2. Usuarios por Año de Nacimiento (Line Chart with Gradient)
        const anioCtx = document.getElementById('anioChart').getContext('2d');
        const anioData = {!! json_encode($porAnio->values()) !!};
        const anioLabels = {!! json_encode($porAnio->keys()) !!};
        const gradient = anioCtx.createLinearGradient(0, 0, 0, anioCtx.canvas.clientHeight);
        gradient.addColorStop(0, 'rgba(75, 192, 192, 0.6)');
        gradient.addColorStop(1, 'rgba(75, 192, 192, 0.1)');

        new Chart(anioCtx, {
            type: 'line',
            data: {
                labels: anioLabels,
                datasets: [{
                    label: 'Usuarios',
                    data: anioData,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: gradient,
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { font: fontStyle }
                    },
                    x: {
                        ticks: { font: fontStyle }
                    }
                }
            }
        });

        // 3. Usuarios Registrados por Mes (Bar Chart with Rounded Corners)
        const mesCtx = document.getElementById('mesChart').getContext('2d');
        const mesData = {!! json_encode($porMes->values()) !!};
        const mesLabels = {!! json_encode($porMes->keys()) !!};
        new Chart(mesCtx, {
            type: 'bar',
            data: {
                labels: mesLabels,
                datasets: [{
                    label: 'Nuevos Usuarios',
                    data: mesData,
                    backgroundColor: 'rgba(54, 162, 235, 0.8)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1,
                    borderRadius: 8
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { font: fontStyle, stepSize: 1 }
                    },
                    x: {
                        ticks: { font: fontStyle }
                    }
                }
            }
        });
    });
</script>
@endsection
