<!-- Inclure la bibliothèque Chart.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js"></script>

<!-- Appliquer des styles personnalisés -->
<style>
    #revenue-chart {
        width: 600px;
        height: 400px;
        margin: 0 auto;
    }

    .chart-container {
        position: relative;
        margin-top: 30px;
    }
</style>

<!-- Créer un conteneur pour le graphique -->
<div class="container">
    <div class="d-flex justify-content-center align-items-center mt-3">
        <h3>Total des revenus : <?= $totalRevenues ?> €</h3>
    </div>
    <div class="chart-container">
        <canvas id="revenue-chart"></canvas>
    </div>
</div>

<!-- Créer un tableau contenant les données du graphique -->
<script>
    var data = {
        labels: <?php echo json_encode($dateLabels); ?>,
        datasets: [{
            label: "Revenus",
            data: <?php echo json_encode($revenueData); ?>,
            backgroundColor: "rgba(0, 255, 0, 0.2)"
        }]
    };
</script>


<!-- Créer un objet Chart.js pour dessiner le graphique -->
<script>
    var ctx = $("#revenue-chart");
    var myChart = new Chart(ctx, {
        type: "bar",
        data: data
    });
</script>

<!-- Rafraîchir le graphique avec de nouvelles données -->
<script>
    function refreshChart() {
        // Mettre à jour les données du graphique
        myChart.data.datasets[0].data = [800, 1200, 1000, 1500, 1100, 1800, 2500];
        // Rafraîchir le graphique
        myChart.update();
    }
</script>