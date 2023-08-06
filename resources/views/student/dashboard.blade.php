@extends('layout.student-layout')
@section('space-work')
<h5>Exams</h5>
<table class="table">
    <thead>
        <th>#</th>
        <th>Exam Name</th>
        <th>Subject Name</th>
        <th>Date</th>
        <th>Time</th>
        <th>Total attempt</th>
        <th>Availabile attempt</th>
        <th>Copy Link</th>

    </thead>
    <tbody>
        @if (count($exams) > 0)
        @php
            $count = 1;
        @endphp
        @foreach ($exams as $exam)
        <tr>
            <td>{{ $count++ }}</td>
            <td>{{ $exam->exam_name }}</td>
            
            <td>{{ $exam->date }}</td>
            <td>{{ $exam->time }} Hrs</td>
            <td>{{ $exam->attempt }} Time</td>
            <td></td>
            <th></th>
            <td><a href="#" data-code="{{ $exam->enterance_id }}" class="copy" ><i class="fa fa-copy"></i></a></td>
        </tr>
            
        @endforeach
        @else
        <tr>
            <td colspan="8">No Exams Avilabile!</td>
        </tr>
            
        @endif
    </tbody>
</table>
<script>
    $(document).ready(function(){
        $('.copy').click(function(){
            $(this).parent().prepend('<span class="copied_text"> Copied</span>');
            var code = $(this).attr('data-code');
            var url = "{{URL::to('/')}}/exam/"+code;
            var $temp=("<input>");
            $("body").append($temp);
            $temp.val(url).select();
            document.execCommand("copy");
            $temp.remove();
            setTimeout(() => {
                $('.copied_text').remove();
                
            }, 20000);
        });
    });

</script>
@endsection