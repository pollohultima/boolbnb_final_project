@extends('layouts.host')
@section('content')
<h1>Statistiche Visualizzazioni 2022</h1>
<div class="container">
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <div class="panel panel-default">
                <div class="panel-heading">Statistiche Visualizzazioni 2022</div>
                
                    <div class="graphic_wrapper">
                       <canvas id="canvas" class="graphic_canvas"></canvas>
                    </div>
                    
               
            </div>
        </div>
    </div>
</div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
<script>
     const report = <?php
     echo $report_value_list; ?>;
    const month = ['Gennaio','Febbraio','Marzo','Aprile','Maggio','Giugno','Luglio','Agosto','Settembre','Ottobre','Novembre','Dicembre'];

 var barChartData = {
        labels: month,
        datasets: [{
            label: "messaggi",
            backgroundColor: "#ff385c",
            borderColor: "#ff385c",
            borderWidth: 0,
            hoverBackgroundColor: "rgba(255,99,132,0.4)",
            hoverBorderColor: "rgba(255,99,132,1)",
            data: report,
  }]
    };

    window.onload = function() {
        var ctx = document.getElementById("canvas").getContext("2d");
        window.myBar = new Chart(ctx, {
            type: 'bar',
            data: barChartData,
            options: {
                maintainAspectRatio: false,
                scales: {
                        y: {
                        stacked: true,
                        grid: {
                            display: true,
                            color: "rgba(255,99,132,0.2)"
                        }
                        },
                        x: {
                            
                        grid: {
                            display: false,
                            
                        }
                        }
                    },
                elements: {
                    rectangle: {
                        borderWidth: 0,
                        borderColor: '#c1c1c1',
                        borderSkipped: 'bottom'
                    }
                },
                responsive: true,
                title: {
                    display: true,
                    
                }
            }
        });
        
    };

</script>
@endsection
