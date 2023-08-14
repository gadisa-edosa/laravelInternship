<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Exam;
use App\Models\QnaExam;
use App\Models\ExamAttempt;
use App\Models\ExamAnswer;
use Illuminate\Support\Facades\Auth;




use Carbon\Carbon;

class ExamController extends Controller
{
   
        public function loadExamDashboard($id)
        {
            $qnaExam = Exam::where('enterance_id', $id)->with('getQnaExam')->inRandomOrder()->get();
            /*if($count($qnaExam) > 0){

            
            if(getQnaExam[0]['date'] == date('Y-m-d')){
                if(count(getQnaExam[0]['getQnaExam'])>0){

                }else{
                    return view('student.exam-dashboard',['success'=>false,'msg'=>'This exam is not availabile for now','exam'=>$qnaExam]);

                }
            }
            else if(getQnaExam[0]['date'] >date('Y-m-d')){
                return view('student.exam-dashboard',['success'=>false,'msg'=>'This exam will be start on'.$qnaExam[0]['date'],'exam'=>$qnaExam]);

            }else{
                return view('student.exam-dashboard',['success'=>false,'msg'=>'This exam has been expiered on'.$qnaExam[0]['date'],'exam'=>$qnaExam]);


            }
            }
            else{return view('404');}*/

            $attemptCount = 0; // Initialize the variable with a default value

            if ($attemptCount >= $qnaExam[0]['attempt']) {
                return view('/student.exam-dashboard', ['success' => false, 'msg' => 'Your exam attempt has been completed', 'exam' => $qnaExam]);
            }
    
            $qna = QnaExam::where('exam_id', $qnaExam[0]['id'])->with('question','answers')->get();
    
            return view('student.exam-dashboard', ['success' => true, 'exam' => $qnaExam, 'qna' => $qna]);
        }
        public function examSubmit(Request $request){
            
            
            $attempt_id = ExamAttempt::insertGetId([
                'exam_id' => $request->exam_id,
                'user_id' => Auth::user()->id
            ]);
           
               
                $qcount = count($request->q);
                if($qcount > 0 ){
                    for($i = 0; $i = $qcount; $i++){
                        if(!empty($request->input('ans_'.($i+1)))){
                            ExamAnswer::insert([
                                'attempt_id' => $attempt_id,
                                'question_id' => $request->q[$i],
                                'answer_id' => $request()->input('ans_'.($i+1))
                            ]);

                        }
                      
                    }
                
            }
            return view('thank-you');
        }
    }
    
       
       