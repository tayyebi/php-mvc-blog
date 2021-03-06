<div class="card m-4">
    <div class="card-header" id="Requests">تعداد درخواست‌های ارسال شده به سرور</div>
    <div class="card-body">
        <canvas id="myAreaChart" width="736" height="294" style="display: block; width: 736px; height: 294px;" class="chartjs-render-monitor"></canvas>
    </div>
</div>

<div class="card m-4" id="Agents">
    <div class="card-header">مرورگر‌ها</div>
    <div class="card-body">
        <canvas id="myPieChart" width="736" height="294" style="display: block; width: 736px; height: 294px;" class="chartjs-render-monitor"></canvas>
    </div>
</div>

<div class="card m-4" id="Agents">
    <div class="card-header">درخواست‌ها به پست‌ها</div>
    <div class="card-body">
    <table class="table table-striped table-dark" style="table-layout: fixed;">
      <thead>
        <tr>
          <th scope="col">تعداد درخواست</th>
          <th scope="col" colspan="5">آدرس</th>
          <!-- <th scope="col">دم دستی‌ها</th> -->
        </tr>
      </thead>
      <tbody>
        <?php
        foreach ($Data['PostsVisitCountByAddress'] as $item)
        {
        ?>
        <tr>
          <td><?php echo $item['TotalRequests'] ?></td>
          <td colspan="5" style="white-space: nowrap; overflow-x:auto;font-size:xx-small"><?php echo $item['Uri'] ?></td>
          <!-- <td>
          <a class="btn btn-light btn-sm" href="#">مراجعه</a>
          </td> -->
        </tr>
        <?php
        }
        ?>


      </tbody>
    </table>
    </div>
</div>
<script>

// ==== Area Chart ====

var myLineChart = new Chart('myAreaChart', {
  type: 'line',
  data: {
    labels: [
      <?php
      foreach ($Data['GroupedVisitCountRows'] as $item)
      {
        echo '"' . $item['WeekNumber'] . '", ';
      }
      ?>
      ],
    datasets: [{
      label: "درخواست‌ها",
      lineTension: 0.3,
      backgroundColor: "rgba(2,117,216,0.2)",
      borderColor: "rgba(2,117,216,1)",
      pointRadius: 5,
      pointBackgroundColor: "rgba(2,117,216,1)",
      pointBorderColor: "rgba(255,255,255,0.8)",
      pointHoverRadius: 5,
      pointHoverBackgroundColor: "rgba(2,117,216,1)",
      pointHitRadius: 50,
      pointBorderWidth: 2,
      data: [
      <?php
      $max = 0;
      foreach ($Data['GroupedVisitCountRows'] as $item)
      {
        $max = $max > $item['TotalRequests'] ? $max : $item['TotalRequests'];
        echo $item['TotalRequests'] . ', ';
      }
      ?>
      ],
    }],
  },
  options: {
    scales: {
      xAxes: [{
        time: {
          unit: 'date'
        },
        gridLines: {
          display: false
        },
        ticks: {
          maxTicksLimit: 7
        }
      }],
      yAxes: [{
        ticks: {
          min: 0,
          max: <?php echo $max + floor($max / 10) ?>,
          maxTicksLimit: 5
        },
        gridLines: {
          color: "rgba(0, 0, 0, .125)",
        }
      }],
    },
    legend: {
      display: false
    }
  }
});


// ==== Pie Chart ====
function randomColor() {
  return '#'+Math.floor(Math.random()*16777215).toString(16);
}

var data = {
  datasets: [{
    data: [
            <?php
            foreach ($Data['GroupedVisitCountByAgent'] as $item)
            {
              echo '"' . $item['TotalRequests'] . '", ';
            }
            ?>
					],
					backgroundColor: [
						randomColor(),
						randomColor(),
						randomColor(),
						randomColor(),
						randomColor(),
					],
					label: 'انواع مرورگر‌ها'
				}],
				labels: [
          <?php
          foreach ($Data['GroupedVisitCountByAgent'] as $item)
          {
            echo '"' . $item['Agent'] . '", ';
          }
          ?>
				]
  };

var options = {
  responsive: true
};

var chart = new Chart('myPieChart', {
  type: 'pie',
  data: data,
  options: options
});

chart.options.cutoutPercentage = 50;
chart.update();

</script>