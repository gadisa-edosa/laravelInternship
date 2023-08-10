@extends('layout.layout-common')

@section('space-work')
<div style="color: black" class="container">
    <p style="color: black;">Welcome, {{ Auth::user()->name }}</p>
    <h3 class="text-center">{{ $exam[0]['exam_name'] }}</h3>
    @if ($success == true)
    @if (count($qna)>0)
    @foreach ($qna as $data)
       <h5>Q.{{ $data['question'][0]['question'] }}</h5>
        
    @endforeach
    @else
       <h3 class="text-center" style="color: red;">Questions and Answers not Availabile</h3>
    @endif
    @else
      <h3 class="text-center" style="color: red;">{{ $msg }}</h3>
    @endif
   
@endsection