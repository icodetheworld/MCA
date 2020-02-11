<?php

 Route::get('/', function () {
    return redirect('/login');
});
Route::get('/ss',function(){
    return view('log');
});
Auth::routes();
Route::get('/home', function(){
    if(Auth::user()->role=='admin') return redirect('/index');
    elseif(Auth::user()->role=='parent') return redirect('/dashboard');
    else return redirect('/homepage');
});
Route::get('/student/{id}', 'DashController@student');

Route::get('/notice', 'BaseController@notice');
Route::get('/birthday/wishes/123/456','AtdController@bday');
// Admin Routes
Route::group(['middleware' => ['admin']], function () {

    Route::get('/index', function () {
        return view('admin.index');
    });
    // Messages ----------
    Route::get('/messages','MessageController@index');
    Route::post('/sms/add','MessageController@send');
    Route::get('/sms/retry','MessageController@retry');
    Route::get('/sms/clear','MessageController@clear');
    //Notice--------
    Route::post('/notice/add', 'BaseController@notice_add');
    Route::get('/notice/delete/{id}', 'BaseController@notice_delete');
    // Students -------------
    Route::get('/all_students', 'DashController@all_students');
    Route::get('/student/view/{id}', 'DashController@edit_view');
    Route::get('/student/delete/{id}', 'DashController@delete');
    Route::post('/student/edit/', 'DashController@edit');
    Route::get('/admission',  'DashController@admission');
    Route::post('/student/admission/add','DashController@another');
    Route::post('/student/parent/add','DashController@relation');
    Route::get('/promotion','DashController@promo');
    Route::post('/promote','DashController@promotion');
    Route::get('/student/room/{id}', 'DashController@student_room');
    Route::get('/student/transport/{id}', 'DashController@student_trans');

    //classs-----------------------
    Route::get('/classes', 'CommonControllers@classes');
    Route::post('/add/class', 'CommonControllers@add_class');
    Route::post('/add/house', 'CommonControllers@add_house');
    Route::post('/add/room', 'CommonControllers@add_room');
    Route::get('/subjects', 'DashController@subject');
    Route::get('/edit/subject/{id}', 'DashController@subject_edit');
    Route::post('/add/subject', 'DashController@add_subject');
    Route::post('/edit/subject', 'DashController@edit_subject');

    // teachers -------------
    Route::get('/all_teachers', 'TeacherController@index');
    Route::get('/teacher/{id}', 'TeacherController@teacher');
    Route::get('/teacher/view/{id}', 'TeacherController@edit_view');
    Route::get('/teacher/delete/{id}', 'TeacherController@delete');
    Route::post('/teacher/edit/', 'TeacherController@edit');
    Route::post('/teacher/admission/add','TeacherController@suck');

    // parents -------------
    Route::get('/all_parents','ParentController@index');
    Route::get('/parent/view/{id}','ParentController@view');
    Route::get('/parent/edit/{id}','ParentController@edit');
    Route::post('/parent/add/','ParentController@add');
    Route::post('/parent/edit/','ParentController@edit_post');
    Route::get('/parent/delete/{id}','ParentController@delete');

    // attendance --------
    Route::get('/attendance_all','AtdController@index');
    Route::post('/attendance/view','AtdController@view');
    Route::get('/attendance','AtdController@view_all');
    Route::post('/attendance/edit','AtdController@class');
    Route::post('/attendance/add','AtdController@add');
    Route::get('/atd/sms/123/456','AtdController@sms');
    
    //marks----------
    Route::get('/marks','CommonControllers@marks');
    Route::get('/mark/clear','CommonControllers@clear');
    Route::get('/marks/{id}','CommonControllers@marks_class');
    Route::get('student/add/mark/{id}','CommonControllers@student_mark');
    Route::post('/add/marks/stud','CommonControllers@add_marks');
    Route::get('/result','CommonControllers@result');
    Route::post('/result/flush','CommonControllers@flush');
    Route::get('/result/{id}','CommonControllers@result_view');
    //exams----------
    Route::get('/exam', 'CommonControllers@exam');
    Route::post('/exam/add', 'CommonControllers@exam_add');
    Route::get('/exam/clear', 'CommonControllers@exam_clear');
    Route::get('/exam/{id}', 'CommonControllers@exam_class');
    Route::get('/exam/schedule/delete/{id}','CommonControllers@exam_delete');
    Route::get('/timetable', 'CommonControllers@timetable');
    Route::get('/timetable/{id}', 'CommonControllers@timetable_class');
    Route::post('/add/timetable/', 'CommonControllers@timetable_add');  
    
    Route::get('/settings','BaseController@settings');
    Route::post('/user/password','BaseController@pwd');
    Route::post('/users/add','BaseController@add');
});
// Parent Routes
Route::group(['middleware' => ['parent']], function () {
    Route::get('/dashboard','PController@index');
    Route::get('/dashboard/{id}','PController@view');
    Route::post('/password/reset','PController@settings');
    
});

// Teacher Routes
Route::group(['middleware' => ['teacher']], function () {
    Route::get('/homepage','TController@index');
    Route::get('/attendance_view','TController@atd_all');
    Route::post('/atd/view','TController@atd_view');
    Route::post('/atd/add','TController@class');
    Route::post('/attd/add','TController@class2');
    route::get('/take_attendance','TController@take');
    Route::get('/add_marks','TController@marks_class');
    Route::get('std/add/mark/{id}','TController@student_mark');
    Route::post('/adds/marks/std','TController@add_marks');
    Route::get('/results','TController@result');
    Route::get('/results/{id}','TController@result_view');
    Route::post('/results/flush','TController@flush');
    Route::post('/pwd/reset/tc','TController@pwd');
    Route::get('/student/room/{id}', 'DashController@student_room_t');
});

