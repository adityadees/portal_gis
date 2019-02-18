<script>
    google.charts.load('current', {
  callback: function () {
    var cols = [{ id: 'task', label: 'Employee Name', type: 'string' },
                { id: 'startDate', label: 'Pembangunan (km)', type: 'number' },
                { id: 'startDate2', label: 'Target (km)', type: 'number' }];

    var rows = [
         <?php foreach ($air_bersih->result_array() as $i) :?>
        { c: [{ v: '<?= $i['year']; ?>' }, { v: <?= $i['historis_vpenanganan']; ?> }, { v: <?= $i['target_volume']; ?> }] },
           <?php endforeach; ?>
        ];

    var data = new google.visualization.DataTable({
     cols: cols,
     rows: rows
    });

    var view = new google.visualization.DataView(data);
    view.setColumns([0,
      1,
      {
        calc: "stringify",
        sourceColumn: 1,
        type: "string",
        role: "annotation"
      },
      2,
      {
        calc: "stringify",
        sourceColumn: 2,
        type: "string",
        role: "annotation"
      },
    ]);

    var options = {
        title: 'Perbandingan Pembangunan dan Target Pada Air Bersih',
        height: 500,
        width: 1000,
    };


    var chart = new google.visualization.ColumnChart(document.getElementById('air_bersih'));
    chart.draw(view, options);
  },
  packages: ['bar', 'corechart']
});
</script>

