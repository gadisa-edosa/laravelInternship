@extends('layout/student-layout')
@section('space-work')
<h3>Results</h3>
<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Exam</th>
            <th>result</th>
            <th>status</th>
        </tr>
    </thead>
    <tbody>
        @if (count($attempts) > 0)
        @php
            $x=1;
        @endphp
        @foreach ($attempts as $attempt)
        <tr>
            <td>{{ $x++ }}</td>
            <td>{{ $attempt->exam->exam_name }}</td>
            <td>
                @if ($attempt->status == 0)
                not Declared
                @else
                @if ($attempt->marks >=$attempt->exam->pass_marks)
                <span style="color: green;">passed</span>
                @else
                <span style="color: red;">failed</span>
                    
                @endif
                @endif
            </td>
           <td>
            @if ($attempt->status == 0)
            <span style="color: red;">pending</span>
                    
                
                @else
                   <a href="#" data-id="{{ $attempt->id }}" class="reviewExam" data-toggle="modal" data-target="#reviewQnaModal">Review Q&A</a>
                @endif
           </td>
        </tr>
            
        @endforeach
        @else
        <tr>
            <td colspan="4">you not attempted any Exam!</td>
        </tr>
            
        @endif
    </tbody>

</table>
        
<div class="modal fade" id="reviewQnaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Reivew Exam</h5>
                <button id="addEditAnswer" class="ml-5 btn btn-info">Add Answer</button>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
          
                <div class="modal-body reivew-qna">
                    loading....
                    
                    </div>
                
                <div class="modal-footer">
                    <span class="editError" style="color: red;"></span>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">update Q&A</button>
                </div>
            </div>
        </div>
    </div>
    <script>
       $(document).ready(function() {
  $('.reviewExam').click(function() {
    var id = $(this).attr('data-id');
    $.ajax({
      url: "{{ route('reviewStudentQna') }}",
      type: 'GET',
      data: { attempt_id: id },
      success: function(data) {
        var html = '';
        if (data && data.success === true) {
          var responseData = data.data;
          if (responseData && responseData.length > 0) {
            for (let i = 0; i < responseData.length; i++) {
              let isCorrect = '<span style="color:red;" class="fa fa-close"></span>';
              let answer = responseData[i]['answers']['answer'];
              if (responseData[i]['answers']['is_correct'] === 1) {
                isCorrect = '<span style="color:green;" class="fa fa-check"></span>';
              }
              html += '<div class="row">' +
                '<div class="col-sm-12">' +
                '<h6>Q(' + (i + 1) + '). ' + responseData[i]['question']['question'].replace(/'/g, "\\'") + '</h6>' +
                '<p>Ans: ' + answer + '  ' + isCorrect + '</p>' +
                '</div>' +
                '</div>';
            }
          } else {
            html += '<h6>You did not attempt any questions</h6>';
          }
        } else {
          html += '<p>Having some issues on the server side.</p>';
        }
        $('.review-qna').html(html);
      },
      error: function() {
        var html = '<p>Error occurred while processing the request.</p>';
        $('.review-qna').html(html);
      }
    });
  });
});
    
    </script>
@endsection