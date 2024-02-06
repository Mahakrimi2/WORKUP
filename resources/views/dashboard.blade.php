<x-app-layout>
    <h4 class="mb-3">Set Your weekly hours</h4>
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-block card-stretch">
                <div class="card-body">
                    <div class="row">
                        <div class="col"><canvas id="reservationS"></canvas>
                        </div>
                        <div class="col"><canvas id="reservationU"></canvas></div>
                    </div>
                </div>
            </div>
        </div>
        @push('calendrier')
            <script>
                const res = document.getElementById('reservationS');
                new Chart(res, {
                    type: 'line',
                    data:{
                        labels: [
                        @foreach ($salles as $salle)
                            '{{$salle->name}}',
                        @endforeach
                    ],
                    datasets: [{
                        label: 'Reservation by room',
                        data: [
                            @foreach ($salles as $salle)
                            '{{$salle->reservations->count()}}',
                        @endforeach
                        ],
                        borderColor: 'rgb(0, 0, 0)',
                        borderWidth: 3,
                        backgroundColor: [
                            'rgba(0, 255, 255)',
                            'rgba(0, 255, 0)',
                            'rgba(255, 0, 255)',
                            'rgba(153, 102, 255)'
                        ]
                    }],
                },
                    options: {

                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }

                    }
                });


                const resU = document.getElementById('reservationU');
                new Chart(resU, {
                    type: 'bar',
                    data:{
                        labels: [
                        @foreach ($users as $user)
                            '{{$user->name}}',
                        @endforeach
                    ],
                    datasets: [{
                        label: 'Reservation by user',
                        data: [
                            @foreach ($users as $user)
                            @foreach ($user->group_user as $grp)
                            {{\App\Models\reservation::where("group_id","=",$grp->id)->get()->count()}},
                            @endforeach
                        @endforeach
                        ],
                        borderColor: 'rgb(0, 0, 0)',
                        borderWidth: 3,
                        backgroundColor: [
                            'rgba(153, 102, 255)',
                            'rgba(0, 255, 255)',
                            'rgba(0, 255, 0)',
                            'rgba(255, 0, 255)',

                        ]
                    }],
                },
                    options: {

                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }

                    }
                });
            </script>
        @endpush
    </div>

</x-app-layout>
