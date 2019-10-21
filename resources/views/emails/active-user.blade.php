@component('mail::message')
#ایمیل فعال سازی

@component('mail::button' , ['url' => route('activation.account' ,$code)])
#فعال سازی اکانت
@endcomponent

@endcomponent
