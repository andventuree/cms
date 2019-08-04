<?php

use App\Post;

/*
|--------------------------------------------------------------------------
| ELOQUENT ORM
|--------------------------------------------------------------------------
*/

Route::get('/find', function() {
    // $posts = App\Post; // same as use App\Post; above which will import this class
    
    $posts = Post::all();
    foreach($posts as $post) {
        return $post->title;
    }

});

Route::get('/findwhere', function() {
    $post = Post::where('id', 2)->orderBy('id', 'desc')->take(1)->get();
    return $post;
});

Route::get('/findmore', function() {
    // $posts = Post::findOrFail(1); 
    // // If post is not found, it'll throw a 404 with the following:
    // // NotFoundHttpException in Handler.php line 103:
    // // No query results for model [App\Post].

    // return $posts;

    $posts = Post::where('users_count', '<', 50)->firstOrFail();
    return $posts;
});

Route::get('/basicinsert', function() {
    $post = new Post;
    $post->title = 'New Eloquent title insert';
    $post->content = 'Wow Eloquent is really cool, look at this content';
    $post->save();

    // if you want to update an existing record
});

Route::get('/basicinsert2', function() {
    $post = Post::find(2);
    $post->title = 'New Eloquent title insert 2nd time';
    $post->content = 'Wowwwwww';
    $post->save();
});

Route::get('/create', function() {
    // Post::create(['title'=>'The create method', 'content'=>'Wow im learning php']);
    // This would be a mass assignment error exception without you indicating that its self to do so
    
    // Which is done in Post Controller 
    // ----------------------------------
    //     class Post extends Model
    // {
    //     // By default, you'll get a table you can reference with "posts"
    //     // protected $table = 'posts'; //Use this only if 

    //     // protected $primaryKey = 'id'; // By default - you don't need to use this if you just use id

    //     protected $fillable = [ //This allows mass assignment
    //         'title',
    //         'content'
    //     ];
    // }
    // ----------------------------------
    Post::create(['title'=>'The create method', 'content'=>'Wow im learning php']);
});

Route::get('/update', function() {
    Post::where('id', 2)->where('is_admin', 0)->update(['title'=> 'New PHP title', 'content'=>'I love it']);
});

Route::get('/delete', function() {
    $post = Post::find(1);
    $post->delete();
    return $post;
});

Route::get('/delete9', function(){
    $post = Post::destroy(10); //if you only want to delete id 10
    // $post = Post::destroy([4,5]); //if you want to delete multiple records 4 and 5
    // $post = Post::where('is_admin', 0)->delete(); //mass delete where is_admin is 0 
    return $post;
});

Route::get('/softdelete', function() {
    Post::find(1)->delete(); //Note: once softdeleted, /find won't return any records that have a value in deleted_at    
});

Route::get('/readsoftdelete', function() {
    // $post = Post::find(1); //This won't return anything b/c the table only has 1 instance with a deleted_at col populated
    $post = Post::withTrashed()->where('id', 1)->get();
    // $post = Post::onlyTrashed()->where('is_admin', 0)->get(); //returns you all entries that are deleted
    return $post;
});

Route::get('/restore', function() {
    $post = Post::withTrashed()->where('is_admin', 0)->restore(); //cleans the deleted_at col
});

Route::get('/forcedelete', function() {
    Post::onlyTrashed()->where("is_admin", 0)->forceDelete();
});

/*
|--------------------------------------------------------------------------
| Database Raw SQL Queries
|--------------------------------------------------------------------------
*/

// Route::get('/insert', function() {
//     //DB class
//     DB::insert('insert into posts(title, content) value(?, ?)', ['PHP with Laravel', 'Laravel is the best to happen to PHP']);
// });

// Route::get('/read', function() {
//     $results = DB::select('select * from posts where id = ?', [1]);
//     // 'select * from posts where id = ?',  //SQL query
//     // [1] //this value is binded to id = ?

//     return $results;
//     // foreach($results as $post) {
//     //     return $post->title;
//     // }
// });

// Route::get('/update', function () {
//     // DB::update('') //returns the affected row that was updated 
//     $affectedRow = DB::update('update posts set title = "Update title" where id = ?', [1]);
//     return $affectedRow;
// });

// Route::get('/delete', function() {
//     $deleted = DB::delete('delete from posts where id = ?', [1]);
//     return $deleted;
// });

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/about', function () {
//     return 'This is the about page';
// });

// Route::get('/example/{parameter}', function ($parameter) {

//     return "This is the path /example/" . $parameter;
// });

// Route::get('/admin/post/example', array('as' => "admin.home", function () {
//     //route() is a a global variable in laravel
//     $url = route('admin.home'); # nickname or alias for the route
//     // Can be used in our templates, for example: 
//         //<a href={admin.home}>Admin Panel</a>
//     return "this url is ". $url; 
//     //remember that the . is string concatenation
// }));

//It'll look into this controller and index method
// Route::get('/post/{someParameter}', 'PostsController@index'); 

Route::resource('posts', 'PostsController'); //::resource quickly makes CRUD routes

Route::get('/contact', 'PostsController@contact');

Route::get('/post/{id}/{name}', 'PostsController@show_post');

Route::get('/admin/{name}', 'PostsController@show_admin');

