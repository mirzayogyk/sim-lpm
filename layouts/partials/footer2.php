<div class="row-fluid">
      <div id="footer" class="span12"> 2016 &copy; Kelurahan Komet Banjarbaru </div>
</div>
            <script src="js/jquery.min.js"></script>
            <script src="js/jquery.ui.custom.js"></script>
            <script src="js/bootstrap.min.js"></script>
            <script src="js/fullcalendar.min.js"></script>
            <script src="js/maruti.js"></script>
            <script src="js/maruti.calendar.js"></script>
				<script src="js/highcharts.js"></script>
				<script src="js/exporting.js"></script>
				<script src="js/valid.js"></script>


<script type="text/javascript">
$(function () {
    $('#view1').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Grafik Indek Kepuasan Masyarakat <?php echo $data['id_kuesioner']; ?>'
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            categories: [
                'Aspek Pelayanan'
            ]
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Nilai Rata-rata Unsur'
            }
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [
		
		<?php
		while($r=mysqli_fetch_array($q)){
		 	echo "{ name: '".$r["nama_aspek"]."',data: [".$r["unsur"]."] },";
		}
		?>
		
		]
    });
});
</script>
<script type="text/javascript">
$(function () {
    $('#view2').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Grafik Total Indek Kepuasan Masyarakat'
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            categories: [
                'Aspek Pelayanan'
            ]
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Nilai Rata-rata Unsur'
            }
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [
		
		<?php
		$no =1;
		while($r=mysqli_fetch_array($t)){
		 	echo "{ name: '".$no++.". ".$r["nama_aspek"]."',data: [".$r["unsur"]."] },";
		}
		?>
		
		]
    });
});
</script>


<script type="text/javascript">
$(function () {
    $('#view3').highcharts({
        title: {
            text: 'Data Hasil Kuesioner Per Bulan',
            x: -20 //center
        },
        subtitle: {
            text: '',
            x: -20
        },
        xAxis: {
            categories: [<?php while($r=mysqli_fetch_array($l)){ echo "'".$r["bulan1"].", ".$r["tahun"]."',";}?>]
        },
        yAxis: {
            title: {
                text: 'Nilai Indeks Kepuasan Masyarakat'
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
        tooltip: {
            valueSuffix: ''
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
        },
        series: [{
            name: 'Jumlah ',
            data: [<?php while($t=mysqli_fetch_array($v)){ echo $t["ikm"].",";}?>]
        }]
    });
});
</script>