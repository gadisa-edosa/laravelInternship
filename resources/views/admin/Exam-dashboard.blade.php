@extends('layout/admin-layout')
@section('space-work')
<h2 class="mb-4">Exam</h2><!-- Button trigger modal -->

    <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addExamModel">
Add Exam
  </button>
  <table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Exam Name</th>
            <th>Subject</th>
            <th>Date</th>
            <th>Time</th>
            <th>attempt</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            @if (count($exams)>0) 
            @foreach ($exams as $exam) 
            <tr>
                <td>{{ $exam->id }}</td>
                <td>{{ $exam->exam_name }}</td>
                <td>{{ $exam->subject }}</td>
                <td>{{ $exam->date }}</td>
                <td>{{ $exam->time }}Hrs</td>
                <td>{{ $exam->attempt }}Time</td>
                <td>
                  <button  class="btn btn-info editButton" data-id="{{ $exam->id }}" data-toggle="modal" data-target="#editExamModel">Edit </button>
                 
                </td>
                <td>
                  <button class="btn btn-danger deleteButton" data-id="{{ $exam->id }}" data-toggle="modal" data-target="#deleteExamModel">Delete </button>
                </td>
            </tr>
                
            @endforeach
            @else
                <tr>
                    <td colspan="5">Exams not Found!</td>
                </tr>

                
            @endif
        </tr>
    </tbody>

</table>
  
  

  <!-- Add Exam Modal -->
  <div class="modal fade" id="addExamModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">

 
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Add Exam</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="addExam">
                @csrf
              <div class="modal-body">
                  <label >Exam</label>
                  <input type="text" name="exam_name" placeholder="Enter Exam name" class="w-100" required><br><br>
                  <select name="subject_id" id="" required class="w-100">
                    <option value="">Select Subject</option>
                    @if (count($subjects) >0 )
                    @foreach ($subjects as $subject)
                        <option value="{{ $subject->id }}">{{ $subject->subject }}</option>
                        
                    @endforeach
                        
                    @endif

                  </select>
                  <br><br>
                  <input type="date" name="date" class="w-100"  requireds min="@php
                      echo date('Y-m-d');
                  @endphp"
                      
                  ><br><br>
                  <input type="time" name="time" class="w-100"  requireds >
                  <br><br>
                  <input type="number" name="attempt" min="1" id="attempt" placeholder="Enter attempt Exam Time" class="w-100"  requireds >


              </div>    
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Add Exam</button>
              </div>
      </form>
      </div>
   
    </div>
  </div>
                  <!-- edit Exam Modal -->
  <div class="modal fade" id="editExamModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">

 
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Edit Exam</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="editExam">
                @csrf
              <div class="modal-body">
                  <label >Exam</label>
                  <input type="text" name="exam_name" id="exam_name" placeholder="Enter Exam name" class="w-100" id="edit_exam" required><br><br>s
                  <input type="hidden" name="exam_id" id="exam_id">
                  <select name="subject_id" id="subject_id" required class="w-100">
                    <option value="">Select Subject</option>
                    @if (count($subjects) >0 )
                    @foreach ($subjects as $subject)
                        <option value="{{ $subject->id }}">{{ $subject->subject }}</option>
                        
                    @endforeach
                        
                    @endif

                  </select>
                  <br><br>
                  <input type="date" name="date" id="date" class="w-100"  requireds min="@php
                      echo date('Y-m-d');
                  @endphp"
                      
                  ><br><br>
                  <input type="time" name="time" id="time" class="w-100"  requireds 

              </div>    
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Update</button>
              </div>
             </div>
    </form>
    </div>
  </div>
    <!-- delete Exam Modal -->
    <div class="modal fade" id="deleteExamModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Delete Exam</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form id="deleteExamForm">
            <div class="modal-body">
              <label>Exam</label>
              <input type="hidden" name="exam_id" id="deleteExamId">
              <p>Are you sure you want to delete the Exam?</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-danger">Delete</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  <script>
    $(document).ready(function() {
  $("#addExam").submit(function(e) {
    e.preventDefault();
    var formData = $(this).serialize();
    $.ajax({
      url: "{{ route('addExam') }}",
      type: "POST",
      data: formData,
      success: function(data) {
        if (data.success) {
          location.reload();
        } else {
          alert(data.msg);
        }
      }
    });
  });

  // Handle AJAX request for editing an exam
  $(".editButton").click(function() {
    var id = $(this).data('id');
    var url = $(this).data('url').replace('id', id);

    $.ajax({
      url: url,
      type: "GET",
      success: function(data) {
        if (data.success) {
          var exam = data.data;
          $("#exam_id").val(exam.exam_id);
          $("#exam_name").val(exam.exam_name);
          $("#subject_id").val(exam.subject_id);
          $("#date").val(exam.date);
          $("#time").val(exam.time);
          $("#attempt").val(exam.attempt);
        } else {
          alert(data.msg);
        }
      }
    });
  });

  // Rest of the code...
});
  // Handle AJAX request for deleting an exam
  $(".deleteButton").click(function() {
    // ...
  });

  $("#deleteExam").submit(function(e) {
    e.preventDefault();
    var formData = $(this).serialize();
    $.ajax({
      url: "{{ route('deleteExam') }}",
      type: "POST",
      data: formData,
      success: function(data) {
        if (data.success == true) {
          location.reload();
        } else {
          alert(data.msg);
        }
      }
    });
  }); // Add this closing brace
});
             </script>
             @endsection