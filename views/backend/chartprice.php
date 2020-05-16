
<div class="grid_10">
    <div class="box round first grid">
        <div id="piechart"></div>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
            // Load google charts
            google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(drawChart);

            // Draw the chart and set the chart values
            function drawChart() {
                var data = google.visualization.arrayToDataTable([
                    ['Task', 'Hours per Day'],
                    <?php echo $category1;?>
                    <?php echo $category2;?>
                    <?php echo $category3;?>
                    <?php echo $category4;?>
                    <?php echo $category5;?>
                    <?php echo $category6;?>
                    <?php echo $category7;?>
                    <?php echo $category8;?>
                    <?php echo $category9;?>
                    <?php echo $category10;?>

                ]);

                // Optional; add a title and set the width and height of the chart
                var options = {'title':'Biểu đồ phần trăm giá trị doanh thu ', 'width':950, 'height':500};

                // Display the chart inside the <div> element with id="piechart"
                var chart = new google.visualization.PieChart(document.getElementById('piechart'));
                chart.draw(data, options);
            }
        </script>
        <div><?php years($year,'chartprice'); ?></div>
    </div>
</div>





