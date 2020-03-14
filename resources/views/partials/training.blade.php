@foreach($group as $training)
    @if($training->is_max == 1)
        <li data-training_id = {{$training->training_id}} class = "{{$type}}-training _add-underline ">{{$training->getWeightAndRep() }}</li>
    @else
        <li data-training_id = {{$training->training_id}} class = "{{$type}}-training">{{$training->getWeightAndRep() }}</li>
    @endif
@endforeach