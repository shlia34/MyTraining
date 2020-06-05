@if($workout->is_max == 1)
    <li data-workout_id = {{$workout->id}} class = "{{$type}}-training _add-underline ">{{$workout->weight_and_rep }}</li>
@else
    <li data-workout_id = {{$workout->id}} class = "{{$type}}-training">{{$workout->weight_and_rep }}</li>
@endif
{{-- event.showとstage.showで使ってる --}}