<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use App\Payment;
use App\Learning;
use Redis;
class CourseController extends Controller
{
    public function single(Course $course){
      $course->increment('viewCount');
      // Redis::incr("views.{$course->id}.articles");

      return view('Home.courses',['course' =>$course]);
    }

protected $MerchantID = 'XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX'; //Required
    public function payment()
    {
      $this->validate(request(),[
        'course_id' =>'required',
      ]);
      //find agar nakone bayad error ham neshon bedi vali findorfail erron nemickad ckodesh 404 mide
      $course=Course::findOrFial(request('course_id'));
          if($course->price == 0 && $course->type == 'vip'){
            dd(alert()-error('این دوره قابل خریداری برای شما نیست '));
          }

      $Description = 'توضیحات تراکنش تستی'; // Required
      $Email = auth()->user()->email; // Optional
      $Mobile = '09123456789'; // Optional
      $CallbackURL = 'http://localhost:8000/course/payment/check'; // Required

      $client = new SoapClient('https://www.zarinpal.com/pg/services/WebGate/wsdl', ['encoding' => 'UTF-8']);

      $result = $client->PaymentRequest(
      [
      'MerchantID' => $this->MerchantID,//secret key
      'Amount' => $price,
      'Description' => $Description,
      'Email' => $Email,
      'CallbackURL' => $CallbackURL,
      ]
      );

        if ($result->Status == 100)
        {
          // Payment::create([
          //   'user_id'=>auth()->user()->id;
          // ]);

          //user id be sorat khodkar zakhire mishee
          auth()->user()->peyments()->create([
            'resnumber'=>$result->Authority,
            'price'    =>$price,
            'course_id'=>$course->id
          ]);




            redirect(' https://www.zarinpal.com/pg/StartPay/'.$result->Authority);
            } else {
            echo'ERR: '.$result->Status;
        }
    }
    public function check()
    {

      $Authority=request('Authority');
      $payment=Payment::whereResnumber($Authority)->firstOrFail();
      $course=Course::findOrFail($payment->course_id);
      if (request('Status') == 'OK') {
        $client = new SoapClient('https://www.zarinpal.com/pg/services/WebGate/wsdl', ['encoding' => 'UTF-8']);

          $result = $client->PaymentVerification(
          [
          'MerchantID' => $this->MerchantID,
          'Authority' => $Authority,
          'Amount' => $payment->price,
          ]
          );

          if ($result->Status == 100){
            if($this->addUserForLearning($payment,$course)){
              alert()->success('ok');
              return redirect($course->path());
            }

              echo 'Transaction success. RefID:'.$result->RefID;
            } else {
              echo 'Transaction failed. Status:'.$result->Status;
            }
        } else {
          echo 'Transaction canceled by user';
        }

    }


    protected function addUserForLearning($payment,$course){
      $payment->update([
          'payment'=>1
        ]);
      Learning::create([
        'user_id'=>auth()->user()->id,
        'course_id'=>$course->id,
      ]);
      return true;
    }

    public function filter()
    {
      $course=Course::filter()->paginate(5);
      return view('Home.all-course' ,['courses' =>$course]);
    }

}
