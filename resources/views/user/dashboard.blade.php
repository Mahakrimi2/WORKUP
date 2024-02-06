<x-app-layout>
    @if ($message = Session::get('message'))
        <script>
            Swal.fire({
                position: "center",
                icon: "success",
                title: "{{ $message }}",
                showConfirmButton: false,
                timer: 3000
            });
        </script>
    @endif

    <div class="row">
        <div class="col-lg-12">
            <div class="card card-block card-stretch card-height">
                <div class="card-header d-flex justify-content-between">
                    <div class="iq-header-title">
                        <h4 class="card-title mb-0">list of reservations</h4>
                    </div>

                </div>

                <div class="card-body">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <div class="row">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif

                    <div class="table-responsive data-table">
                        <table class="data-tables table" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Name of reservation:</th>
                                    <th>Date</th>
                                    <th>Salle</th>
                                    <th>Start Time</th>
                                    <th>End Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($groups as $group)
                                    <tr>
                                        <td>{{ $group->nom_g }}</td>
                                        <td>{{ $group->reservations[0]->date }}</td>
                                        <td>{{ $group->reservations[0]->salles->name }}</td>
                                        <td>{{ $group->reservations[0]->start_time }}</td>
                                        <td>{{ $group->reservations[0]->end_time }}</td>

                                        <td>
                                            <div class="d-flex align-items-center list-action">
                                                    <a class="badge bg-success-light mr-2" data-toggle="tooltip"
                                                    data-placement="top" title="" data-original-title="View"
                                                    href="{{route('reservations.show',$group->reservations[0]->id)}}"><i class="lar la-eye"></i></a>

                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
