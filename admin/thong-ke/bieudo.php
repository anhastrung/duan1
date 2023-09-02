<h2 class="bg-green-100 w-full p-4 text-green-800 text-3xl uppercase rounded-[5px]">biểu đồ thống kê</h2>
<div id="myChart" style="width:100%; max-width:600px; height:500px;">
</div>
<script>
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Danh mục', 'Số lượng sản phẩm'],
            <?php foreach ($listTK as $li) { ?>['<?= $li['name_category'] ?>', <?= $li['soluong'] ?>], <?php } ?>
        ]);
        var options = {
            title: 'TỶ LỆ HÀNG HOÁ',
            is3D: true
        };
        var chart = new google.visualization.PieChart(document.getElementById('myChart'));
        chart.draw(data, options);
    }
</script>