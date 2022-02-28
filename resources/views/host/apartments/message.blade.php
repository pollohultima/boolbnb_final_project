@extends('layouts.host')
@section('content')

<div class="messages_section">
    <div class="container">
        <div class="row">
            <div class="col">
            @foreach($messages_list as $message)
                <div class="message my-3">
                    <!-- customer details -->
                    <div class="customer">
                        <div class="box">
                            <!-- customer name -->
                            <p class="block"><i class="fa-solid fa-user"></i> {{$message->name}}</p>
                            
                            <!-- customer email -->
                            <p class="block"><i class="fa-solid fa-envelope"></i> {{$message->email}}</p>
                        </div>
                    </div>

                    <!-- message details -->
                    <div class="message_content">
                            <!-- message content -->
                            <p class="content">{{$message->content}}</p>

                            <!-- submit date -->
                            <div class="box">
                                
                                <p class="date">Inviato: {{$message->created_at}}</p>
                            </div>
                    </div>
                </div>
            @endforeach
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Messaggi ricevuti nel 2022 per questo appartamento</div>
                    <div class="graphic_wrapper">
                        <canvas id="canvas" class="graphic_canvas"></canvas>
                    </div>
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
            backgroundColor: "#ff385c",
            borderColor: "#ff385c",
            borderWidth: 0,
            hoverBackgroundColor: "rgba(255,99,132,0.4)",
            hoverBorderColor: "rgba(255,99,132,1)",
            data: report
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
