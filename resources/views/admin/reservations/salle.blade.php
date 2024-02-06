<x-app-layout>
    <h4 class="mb-3">Available rooms</h4>
    <div class="row">
        @foreach ($salles as $salle)
        <div class="col-md-3">
        <div class="card">
            <img src="{{$salle->image_path==null?'/assets/images/salleR.jpg':'/'.$salle->image_path}}" class="card-img-top" alt="...">
            <div class="card-body justify-content-center text-center">
                <div class="row justify-content-center text-center">
                    <div class="col"><span class="badge badge-primary">{{$salle->name}}</span></div>
                    <div class="col"><span class="badge badge-info">{{$salle->number_u}}</span></div>
                </div>
              <p class="card-text">{{$salle->desc}}</p>
              <div class="d-grid ">

                <form action="{{route("reservations.date",$salle->id)}}" method="GET">
                    @csrf
                <button class="btn btn-primary" type="submit" style="width: 230px">book</button>
            </form>
            </div>
            </div>
          </div>
        </div>
        @endforeach
        </div>
</x-app-layout>
