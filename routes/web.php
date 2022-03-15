<?php


use App\Models\User;
use App\Models\Post;
use App\Models\Address;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Response;
use Barryvdh\Debugbar\Facade as Debugbar;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $category = Category::all();
    // dd($category[1]->name);
    return view('dashboard',compact('category'));
})->middleware(['auth'])->name('dashboard');

Route::get('/category/{id}', function(){
    return view('dashboard');
})->name('category');

require __DIR__.'/auth.php';


Route::get('/table', function(){
    return view('table');
});
Route::get('/tags',function(){
    $tags = Tag::with('posts')->get();
    // dd($tags);
    return view('tags.index', compact('tags'));
}); 

Route::get('/posts', function(){
    // Post::create([
    //     'title' => 'Title 12',
    //     'title' => 'Title 12',   
    //     'description' => 'Description Twelve'
    // ]);
    // Tag::create([

    $tag = Tag::first();
    $post = Post::with('tags')->get();
    // dd($post);

    $showAdditionalPivotField = $post[0]->tags->first()->pivot->status;
    // // Passing extra field in pivot
    // $post[0]->tags()->attach([
    //     1 => [
    //         'status' => 'approved'
    //     ]
    //     ]);

    // $pivotDate = $post[0]->tags->first()->pivot->created_at;

    // $post[0]->tags()->attach(1);
    // $post[0]->tags()->detach();
    // $post[0]->tags()->sync([1,2]);
    // $post->tags()->attach([2,4,5]);
    // $post->tags()->attach($tag);
    $posts = Post::with(['user','tags'])->get();
    // return $posts;
    return view('posts.index', compact('posts'));
});
function generateRandomString($length = 2) {
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return strtoupper($randomString);
}
Route::get('/user', function(){
    // \App\Models\User::factory(1)->create();
    // Relation using associate 
    // $user = User::factory()->create();
    // $address = new Address([
    //     'country' => 'UK'
    // ]);
    // $address->user()->associate($user);
    // $address->save();
    // $user =  User::factory()->create();
    // $user->address()->create([
    //     'country' => generateRandomString()
    // ]);
    // \App\Models\Address::create([
    //     'uid' => 12,
    //     'country' => 'BD'
    // ]);
    // \App\Models\Address::create([
    //     'uid' => 13,
    //     'country' => 'US'
    // ]);
//    $users = User::all();
//    $addresses = Address::all();
$addresses = Address::with('user')->get();
// Debugbar::info($addresses);      
   
Debugbar::addMessage('Another message', 'Threshold');
Debugbar::warning('Warning');
Debugbar::error('error');
Debugbar::startMeasure('render','Time for rendering');
Debugbar::stopMeasure('render');
Debugbar::addMeasure('now', LARAVEL_START, microtime(true));
Debugbar::measure('My long operation', function() {
});
// $users = User::with('addresses')->get();
$users = User::doesntHave('posts')->with('posts')->get();
// $users = User::whereHas('posts', function($q){
//     $q->where('title','like','%Title%');
// })->with('posts')->get();
// $users[0]->addresses()->create([ 'country' => 'AU']);
// dd($users);
//    return $address;
return view('users.index', compact('users','addresses'));
});
 
Route::get('/users', function () {
    return Response::json([
        'message'=>'success',
        'user'=>'user1',
        'type'=>'admin'
    ]);
});