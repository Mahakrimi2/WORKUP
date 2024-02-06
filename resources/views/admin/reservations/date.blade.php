<x-app-layout>
    @if ($message = Session::get('message'))
    <script>
        Swal.fire({
            position: "center",
            icon: "error",
            title: "{{ $message }}",
            showConfirmButton: false,
            timer: 3000
        });
    </script>
@endif

@if ($message = Session::get('messageSucces'))
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
    <h4 class="mb-3">Book here
        <span class="badge badge-primary">{{$salle->name}}</span>
       <span class="badge badge-info">{{$salle->number_u}}</span>
        </h4>
    <div class="row">

        <div class="col-lg-12">
            <div class="card card-block card-stretch">
                <div class="card-body">
                    <div id="calendar1" class="calendar-s"></div>
                </div>
            </div>
        </div>
    </div>
    @push("calendrier")
    <script>
        var calendar1;
    if (jQuery('#calendar1').length) {
        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar1');

            calendar1 = new FullCalendar.Calendar(calendarEl, {
                selectable: true,
                plugins: ["timeGrid", "dayGrid", "list", "interaction"],
                timeZone: "UTC",
                defaultView: "dayGridMonth",
                contentHeight: "auto",
                eventLimit: true,
                dayMaxEvents: 4,
                header: {
                    left: "prev,next today",
                    center: "title",
                    right: "dayGridMonth,timeGridWeek,timeGridDay,listWeek"
                },
                dateClick: function (info) {
                    $('#schedule-start-date').val(info.dateStr)
                    $('#schedule-end-date').val(info.dateStr)
                    $('#date-event').modal('show')
                },
                events: [
                    @foreach ($salleRes as $r)
                    @if (Auth::user()->role=='admin')
                    {
                            title: "{{$r->groups->nom_g}}",
                            url: '{{route('reservations.show',$r->id)}}',
                            start:" {{$r->date}}"+'T'+"{{$r->start_time}}"+'.000Z',
                            end:" {{$r->date}}"+'T'+"{{$r->end_time}}"+'.000Z',
                            color: '#{{$r->id*4}}73{{$r->id*2}}b{{$r->id}}',
                            },
                     @else

                            @if ($r->groups->user_id==Auth::user()->id)
                            {
                            title: "{{$r->groups->nom_g}}",
                            url: '{{route('reservations.show',$r->id)}}',
                            start:" {{$r->date}}"+'T'+"{{$r->start_time}}"+'.000Z',
                            end:" {{$r->date}}"+'T'+"{{$r->end_time}}"+'.000Z',
                            color: '#{{$r->id*4}}73{{$r->id*2}}b{{$r->id}}',
                            },
                            @else
                            {
                            title: "{{$r->groups->nom_g}}",
                            start:" {{$r->date}}"+'T'+"{{$r->start_time}}"+'.000Z',
                            end:" {{$r->date}}"+'T'+"{{$r->end_time}}"+'.000Z',
                            color: '#{{$r->id*4}}73{{$r->id*2}}b{{$r->id}}',
                            },

                        @endif

                        @endif
                    @endforeach


                ]
            });
            calendar1.render();
        });
        $(document).on("submit", "#submit-schedule", function (e) {
            e.preventDefault()
            const title = $(this).find('#schedule-title').val()
            const startDate = moment(new Date($(this).find('#schedule-start-date').val()), 'YYYY-MM-DD').format('YYYY-MM-DD') + 'T05:30:00.000Z'
            const endDate = moment(new Date($(this).find('#schedule-end-date').val()), 'YYYY-MM-DD').format('YYYY-MM-DD') + 'T05:30:00.000Z'
            const color = $(this).find('#schedule-color').val()
            console.log(startDate, endDate, color)
            const event = {
                title: title,
                start: startDate || '2020-12-22T02:30:00',
                end: endDate || '2020-12-12T14:30:00',
                color: color || '#7858d7'
            }
            $(this).closest('#date-event').modal('hide')
            calendar1.addEvent(event)
        })
    }
    </script>
    @endpush


    <div class="modal fade" id="date-event" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="popup text-left">
                        <h4 class="mb-3">Add Schedule</h4>
                        <form action="{{route('reservations.store',$salle->id)}}" method="POST">
                            @method("POST")
                            @csrf
                            <div class="content create-workform row">
                                @if(Auth::user()->role=='worker')
                                        <input class="form-control" placeholder="Enter Title" type="hidden" name="title" value="{{Auth::user()->name}}" id="schedule-title" required />
                                @else
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label" for="schedule-title">group title</label>
                                        <input class="form-control" placeholder="Enter Title" type="text" name="title" id="schedule-title" required />
                                    </div>
                                </div>
                                @endif

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="schedule-start-date">Date</label>
                                        <input class="form-control" placeholder="2020-06-20" type="text" name="date" id="schedule-start-date" required />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="schedule-end-date">Start time</label>
                                        <input class="form-control" placeholder="2020-06-20" type="time" name="start_time"  required />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="schedule-end-date">End time</label>
                                        <input class="form-control" placeholder="2020-06-20" type="time" name="end_time"  required />
                                    </div>
                                </div>

                                <div class="col-md-12 mt-4">
                                    <div class="d-flex flex-wrap align-items-ceter justify-content-center">
                                        <button class="btn btn-primary mr-4" data-dismiss="modal">Cancel</button>
                                        <button class="btn btn-outline-primary" type="submit">Save</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
      </div>
    </div>
</x-app-layout>

