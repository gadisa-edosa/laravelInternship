@extends('layout/layout-common')
@section('space-work')
<div style="color: black" class="container">
    <p>Welcome, {{ Auth::user()->name }}</p>
    <h1 class="text-center">{{ $exam[0]['exam_name'] }}</h1>
    @if ($success == true)
    @if (count($qna) > 0)
    @php  $qcount = 1;  @endphp
    @foreach ($qna as $data)
    <h5>Q{{$qcount++}}. {{ $data['question'][0]['question'] }}</h5>
    @php $acount = 1; @endphp
    @foreach ($data['question'][0]['answers'] as $answer)
    <p><b>{{ $acount++ }}).<b>{{ $answer['answer'] }}</p>
        
    @endforeach
        
    @endforeach

    @else
      <h3 class="text-center" style="color: red;">Questions & Answers not available</h3>
    @endif
    @else
    <h3 class="text-center" style="color: red;">{{ $msg }}</h3>
        
    @endif
</div>
@endsection