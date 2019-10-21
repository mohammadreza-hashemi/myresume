<?php

namespace App\Http\Controllers\Admin;

use App\Course;
use App\Http\Requests\CourseRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CourseController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $course=Course::latest()->paginate(10);
        return view('Admin.courses.all',['courses' =>$course]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.courses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CourseRequest $request)
    {
        $file=request()->file('images');
        if($request->isMethod="post" && request()->hasFile('images') && $file->isValid()){
          auth()->loginUsingId(1);
          $imagesUrl=$this->uploadImages($file);
          auth()->user()->course()->create(array_merge(request()->all(),  ['images' =>  $imagesUrl]));

          alert()->success('message','title')->autoclose(5000);
          return redirect(route('courses.index'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        return view('Admin.courses.edit',['courses' =>$course]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(CourseRequest $request, Course $course)
    {
      $file=$request->file('images');
      $inputs=$request->all();
      if($file)
        {
          $inputs['images'] = $this->uploadImages($file);

        }else{
          $inputs['images'] =$course->images;
        }
        $inputs['images']['thumb']=$inputs['imagesThumb'];
        unset($inputs['imagesThumb']);
        $course->update($inputs);
        alert()->success('دوره شما اپدیت شد ','UPDATED');
        return redirect(route('courses.index'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        $course->delete();
        return redirect(route('courses.index'));
    }
}
