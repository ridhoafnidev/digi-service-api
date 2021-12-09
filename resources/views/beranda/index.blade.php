@extends('layouts/main')

@section('judul_halaman','Data Jenis Hp')

@section('konten')

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
        <div class="widget-content widget-content-area br-6">
            <h2 style="margin:10px 0px 0px 100px; text-align: center;">Grafik Data Pelanggan, Teknisi dan Jenis Hp</h2>
            <div id="linechart" style="width: 100%; height: 400px; alignment: center; align-items: center; justify-content: center; display: flex;"></div>
            <script type="text/javascript">
                google.charts.load('current', {'packages':['corechart']});
                google.charts.setOnLoadCallback(drawChart);
                function drawChart() {
                    var data = google.visualization.arrayToDataTable([
                        ['Pelanggan', 'Jenis HP'],
                        ['Pelanggan', <?php echo $pelanggan; ?>],
                        ['Teknisi', <?php echo $teknisi; ?>],
                        ['Jenis HP', <?php echo $jenis_hp; ?>]
                    ]);
                    var options = {
                        curveType: 'function',
                        legend: { position: 'bottom' }
                    };
                    var chart = new google.visualization.PieChart(document.getElementById('linechart'));
                    chart.draw(data, options);
                }
            </script>
        </div>
    </div>

@endsection
