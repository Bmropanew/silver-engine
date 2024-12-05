<!DOCTYPE html>
<html lang="es">
<?php
session_start();
ini_set('display_errors', 0);
error_reporting(0);
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="Todo.css">
    <link rel="stylesheet" href="informe.css">
    <title>Reporte de Ventas</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>


<body>
    <header>
        <div class="logo">
            <img src="img/el_logo_BM.jpg" alt="Logo">
        </div>
        <nav>
            <ul>
                <?php include("menu.php"); ?>
            </ul>
        </nav>
    </header>

    <div class="container">
        <h1>Reporte de Ventas</h1>

        <div class="filter-container">
            <div>
                <label for="filtro">Filtrar por:</label>
                <select id="filtro" onchange="mostrarFiltroMes(); cargarGraficoVentas();">
                    <option value="dia">Día</option>
                    <option value="mes">Mes</option>
                    <option value="anio">Año</option>
                </select>
            </div>

            <div>
                <label for="filtroMes" id="labelMes" style="display: none;">Filtrar por Mes:</label>
                <select id="filtroMes" style="display: none;" onchange="cargarGraficoVentas()">
                    <option value="01">Enero</option>
                    <option value="02">Febrero</option>
                    <option value="03">Marzo</option>
                    <option value="04">Abril</option>
                    <option value="05">Mayo</option>
                    <option value="06">Junio</option>
                    <option value="07">Julio</option>
                    <option value="08">Agosto</option>
                    <option value="09">Septiembre</option>
                    <option value="10">Octubre</option>
                    <option value="11">Noviembre</option>
                    <option value="12">Diciembre</option>
                </select>
            </div>
        </div>

        <div style="max-width: 800px; margin: 0 auto;">
            <canvas id="ventasChart" width="300" height="150"></canvas>
        </div>

        <h1>Productos más Vendidos</h1>

        <div class="filter-container">
          
            <label for="filtroTipoTiempo">Filtrar por:</label>
            <select id="filtroTipoTiempo" onchange="manejarFiltroProductos(); cargarGraficoProductos();">
                <option value="dia">Día</option>
                <option value="mes">Mes</option>
                <option value="anio">Año</option>
            </select>

            <label for="filtroMes2" id="labelMesProductos" style="display: none;">Seleccionar Mes:</label>
            <select id="filtroMes2" style="display: none;" onchange="cargarGraficoProductos();">
                <option value="01">Enero</option>
                <option value="02">Febrero</option>
                <option value="03">Marzo</option>
                <option value="04">Abril</option>
                <option value="05">Mayo</option>
                <option value="06">Junio</option>
                <option value="07">Julio</option>
                <option value="08">Agosto</option>
                <option value="09">Septiembre</option>
                <option value="10">Octubre</option>
                <option value="11">Noviembre</option>
                <option value="12">Diciembre</option>
            </select>
        </div>

        <div class="filter-container">
            <label for="filtroOrden">Orden:</label>
            <select id="filtroOrden" onchange="cargarGraficoProductos();">
                <option value="mas_vendidos">Más Vendidos</option>
                <option value="menos_vendidos">Menos Vendidos</option>
            </select>
        </div>

        <div style="max-width: 800px; margin: 0 auto;">
            <canvas id="productosChart" width="300" height="150"></canvas>
        </div>


        <div class="container">
            <h1>Reporte de Ganancias</h1>

            <div class="filter-container">
                <div>
                    <label for="filtroGanancia">Filtrar por:</label>
                    <select id="filtroGanancia" onchange="mostrarFiltroMesGanancia(); cargarGraficoGanancias();">
                        <option value="dia">Día</option>
                        <option value="mes">Mes</option>
                        <option value="anio">Año</option>
                    </select>
                </div>

                <div>
                    <label for="filtroMesGanancia" id="labelMesGanancia" style="display: none;">Filtrar por Mes:</label>
                    <select id="filtroMesGanancia" style="display: none;" onchange="cargarGraficoGanancias()">
                        <option value="01">Enero</option>
                        <option value="02">Febrero</option>
                        <option value="03">Marzo</option>
                        <option value="04">Abril</option>
                        <option value="05">Mayo</option>
                        <option value="06">Junio</option>
                        <option value="07">Julio</option>
                        <option value="08">Agosto</option>
                        <option value="09">Septiembre</option>
                        <option value="10">Octubre</option>
                        <option value="11">Noviembre</option>
                        <option value="12">Diciembre</option>
                    </select>
                </div>
            </div>

            <div style="max-width: 800px; margin: 0 auto;">
                <canvas id="gananciasChart" width="300" height="150"></canvas>
            </div>
        </div>



        <script>
            let ventasChart;
            let productosChart;

            function mostrarFiltroMes() {
                const filtro = document.getElementById('filtro').value;
                const filtroMes = document.getElementById('filtroMes');
                const labelMes = document.getElementById('labelMes');

                if (filtro === 'dia') {
                    filtroMes.style.display = 'inline'; 
                    labelMes.style.display = 'inline'; 
                } else {
                    filtroMes.style.display = 'none'; 
                    labelMes.style.display = 'none'; 
                }
            }

            async function cargarGraficoVentas() {
                const filtro = document.getElementById('filtro').value;
                const filtroMes = document.getElementById('filtroMes').value;

                let filtroFinal = filtro; 

                if (filtro === 'dia' && filtroMes) {
                    filtroFinal = `${filtro}-${filtroMes}`; 
                }

                try {
                    const response = await fetch('controlerInforme.php?filtro=' + filtroFinal);

                    if (!response.ok) {
                        throw new Error('Error en la respuesta del servidor');
                    }

                    const data = await response.json();

                    if (!data || data.error) {
                        console.error('Error al obtener los datos:', data.error);
                        return;
                    }

                    const labels = data.map(item => item.fecha);
                    const valores = data.map(item => item.total_ventas);

                    const ctx = document.getElementById('ventasChart').getContext('2d');

                    if (ventasChart) {
                        ventasChart.destroy();  
                    }

                    ventasChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'Ventas',
                                data: valores,
                                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                borderColor: 'rgba(75, 192, 192, 1)',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            scales: {
                                y: { beginAtZero: true }
                            }
                        }
                    });
                } catch (error) {
                    console.error('Error al cargar el gráfico de ventas:', error);
                }
            }

            function manejarFiltroProductos() {
                const filtro = document.getElementById('filtroTipoTiempo').value;
                const filtroMes = document.getElementById('filtroMes2');
                const labelMesProductos = document.getElementById('labelMesProductos');

                if (filtro === 'dia' || filtro === 'mes') {
                    filtroMes.style.display = 'inline'; 
                    labelMesProductos.style.display = 'inline'; 
                } else {
                    filtroMes.style.display = 'none';  
                    labelMesProductos.style.display = 'none'; 
                }
            }

            document.getElementById('filtroTipoTiempo').addEventListener('change', manejarFiltroProductos);


            function mostrarFiltroMesProductos() {
                const filtro = document.getElementById('filtroTipoTiempo').value;
                const filtroMes = document.getElementById('filtroMes2');

                if (filtro === 'dia') {
                    filtroMes.style.display = 'inline'; 
                } else {
                    filtroMes.style.display = 'none';  
                }
            }

            async function cargarGraficoProductos() {
                const filtro = document.getElementById('filtroTipoTiempo').value; 
                const tipo = document.getElementById('filtroOrden').value;      
                const mes = document.getElementById('filtroMes2').value;         

                let query = `controlerProductosVendidos.php?filtro=${filtro}&tipo=${tipo}`;
                if (filtro === 'dia' || filtro === 'mes') {
                    query += `&mes=${mes}`;
                }

                try {
                    const response = await fetch(query);

                    if (!response.ok) {
                        throw new Error('Error en la respuesta del servidor');
                    }

                    const data = await response.json();

                    if (!Array.isArray(data) || data.length === 0) {
                        console.error('Datos inválidos o vacíos recibidos:', data);
                        return;
                    }

                    const labels = data.map(item => item.nombre);
                    const valores = data.map(item => parseInt(item.total_cantidad, 10) || 0);

                    const ctx = document.getElementById('productosChart').getContext('2d');

                    if (productosChart) {
                        productosChart.destroy();
                    }

                    productosChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'Cantidad Vendida',
                                data: valores,
                                backgroundColor: 'rgba(153, 102, 255, 0.2)',
                                borderColor: 'rgba(153, 102, 255, 1)',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            indexAxis: 'y',
                            responsive: true,
                            scales: {
                                x: { beginAtZero: true }
                            }
                        }
                    });
                } catch (error) {
                    console.error('Error al cargar el gráfico de productos:', error);
                }
            }


            let gananciasChart;

            function mostrarFiltroMesGanancia() {
                const filtro = document.getElementById('filtroGanancia').value;
                const filtroMes = document.getElementById('filtroMesGanancia');
                const labelMes = document.getElementById('labelMesGanancia');

                if (filtro === 'dia') {
                    filtroMes.style.display = 'inline'; 
                    labelMes.style.display = 'inline'; 
                } else {
                    filtroMes.style.display = 'none'; 
                    labelMes.style.display = 'none'; 
                }
            }

            async function cargarGraficoGanancias() {
                const filtro = document.getElementById('filtroGanancia').value;
                const filtroMes = document.getElementById('filtroMesGanancia').value;

                let filtroFinal = filtro;

                if (filtro === 'dia' && filtroMes) {
                    filtroFinal = `${filtro}-${filtroMes}`;
                }

                try {
                    const response = await fetch('controlerGanancias.php?filtro=' + filtroFinal);

                    if (!response.ok) {
                        throw new Error('Error en la respuesta del servidor');
                    }

                    const data = await response.json();

                    if (!data || data.error) {
                        console.error('Error al obtener los datos:', data.error);
                        return;
                    }

                    const gananciaNeta = data.ganancia_neta || 0;
                    const inversion = data.inversion || 0;

                    const ctx = document.getElementById('gananciasChart').getContext('2d');

                    if (gananciasChart) {
                        gananciasChart.destroy();
                    }

                    gananciasChart = new Chart(ctx, {
                        type: 'pie',
                        data: {
                            labels: ['Ganancia Neta', 'Inversión'],
                            datasets: [{
                                label: 'Ganancias',
                                data: [gananciaNeta, inversion],
                                backgroundColor: ['#FFCE56', '#FF6384']
                            }]
                        },
                        options: {
                            responsive: true
                        }
                    });
                } catch (error) {
                    console.error('Error al cargar el gráfico de ganancias:', error);
                }
            }

            mostrarFiltroMes();
            cargarGraficoVentas();
            mostrarFiltroMesProductos();
            manejarFiltroProductos();
            cargarGraficoProductos();
            mostrarFiltroMesGanancia();
            cargarGraficoGanancias();
        </script>


</body>

</html>