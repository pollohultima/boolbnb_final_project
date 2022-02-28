@extends('layouts.host')
@section('content')
<div class="container">
    <div class="row">
@foreach($messages_list as $message)
<div class="content_message">
    <p>Nome: {{$message->name}}</p>
    <p>Email: {{$message->email}}</p>
    <p>Contenuto del messaggio: {{$message->content}}</p>
    <p>Inviato alle: {{$message->created_at}}</p>
</div>
@endforeach
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <div class="panel panel-default">
                <div class="panel-heading">Statistiche Visualizzazioni 2022</div>
                <div class="panel-body">
                    <canvas id="canvas" height="280" width="600"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
<script>
     const report = <?php
     echo $report_message_list; ?>;
    const month = ['Gennaio','Febbraio','Marzo','Aprile','Maggio','Giugno','Luglio','Agosto','Settembre','Ottobre','Novembre','Dicembre'];
    console.log(report);
 var barChartData = {
        labels: month,
        datasets: [{
            label: 'report',
            backgroundColor: "pink",
            data: report
        }]
    };

    window.onload = function() {
        var ctx = document.getElementById("canvas").getContext("2d");
        window.myBar = new Chart(ctx, {
            type: 'bar',
            data: barChartData,
            options: {
                elements: {
                    rectangle: {
                        borderWidth: 2,
                        borderColor: '#c1c1c1',
                        borderSkipped: 'bottom'
                    }
                },
                responsive: true,
                title: {
                    display: true,
                    text: 'Yearly User Joined'
                }
            }
        });
        
    };

</script>
@endsection
