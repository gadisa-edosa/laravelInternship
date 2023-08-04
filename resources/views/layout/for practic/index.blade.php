$(".editButton").click(function(){
  var qid=$(this).attr('data-id'); 
  $.ajax({
      url:"{{ route('getQnaDetails') }}",
      type:"GET",
      data:{ qid: qid},
      success:function(data){
          console.log(data);
          var qna = data.data[0];
          $("#question_id").val(qna['id']);
          $("#question").val(qna['question']);
          $(".editAnswers").remove();
          var html='';
          for(let i=0; i<qna['answers'].length; i++){

              var checked = '';
              if(qna['answers'][i]['is_correct']==1){
                  checked='checked';

              }
                  var html += '<div class="row mt-2 editAnswers">' +
                          '<input type="radio" name="is_correct" class="edit_is_correct" '+checked+'/>' +
                          '<div class="col">' +
                              '<input type="text" name="answers['+qna['answers'][i]['id']+']" class="w-100" placeholder="Enter answer" value="+qna['answers'][i]['answer']+"required>' +
                          '</div>' +
                          '<button class="btn btn-danger removeButton">Remove</button>' +
                      '</div>';
          }
          $(".editModalAnswers").append(html);
      }
});
});
// update Qna sumbtion
$("#editQna").submit(function(e) {
  e.preventDefault();
  if ($(".editAnswers").length < 2) {
      $(".editError").text("please add minimum two answers");
      setTimeout(function() {
          $(".editError").text("");
      }, 2000);
  } else {
      var checkIsCorrect = false;
      for (let i = 0; i < $(".edit_is_correct").length; i++) {
          if ($(".edit_is_correct:eq("+i+")").prop("checked")) {
              checkIsCorrect = true;
              $(".edit_is_correct:eq("+i+")").val($(".is_correct:eq("+i+")").next().find("input").val());
          }
      }
      if (checkIsCorrect) {
     
      } else {
          $(".editError").text("please select one correct answer");
          setTimeout(function() {
              $(".editError").text("");
          }, 2000);
      }
  }
});