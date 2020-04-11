@if($training->is_max == 1)
    <li data-training_id = {{$training->training_id}} class = "{{$type}}-training _add-underline ">{{$training->weight_and_rep }}</li>
@else
    <li data-training_id = {{$training->training_id}} class = "{{$type}}-training">{{$training->weight_and_rep }}</li>
@endif

{{-- event.showとstage.showで使ってる --}}