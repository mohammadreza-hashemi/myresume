<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{

  protected $fillable = [
      'resnumber',
      'price',
      'course_id',
      'payment'
  ];
  public function scopeSpanningPayment($query , $month , $paymen) {
      $query->selectRaw('monthname(created_at) month , count(*) published')
          ->where('created_at' , '>' , Carbon::now()->subMonth($month))
          ->wherePayment($paymen)
          ->groupBy('month')
          ->latest();
  }

}
