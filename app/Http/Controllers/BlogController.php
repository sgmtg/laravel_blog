<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;

use App\Http\Requests\BlogRequest;

class BlogController extends Controller
{
    //
    /**
     * ブログ一覧を表示する
     * 
     *　@return view
     */
    public function showList()
    {
        $blogs = Blog::all();

        // dd($blogs);デバッグのために中身をみることができる
        return view(
            'blog.list',
            ['blogs' => $blogs] //$blogsという配列をblogsという名前をつけてblog.list.blade.phpに渡す
        );
        //resources/views/blog/list.blade.phpが表示される
    }


    /**
     * ブログ詳細を表示する
     *  @param int $id
     *　@return view
     */
    public function showDetail($id)
    {
        $blog = Blog::find($id);
        if (is_null($blog)) {
            \Session::flash('err_msg', 'データがありませーん');
            return redirect(route('blogs')); //routeで決めた名前を指定
        }
        return view(
            'blog.detail',
            ['blog' => $blog] //$blogという配列をblogという名前をつけてblog.detail.blade.phpに渡す
        );
        //resources/views/blog/detail.blade.phpが表示される
    }


    /**
     * ブログ登録画面を表示する
     * 
     *　@return view
     */
    public function showCreate()
    {
        return view('blog.form');
    }
    /**
     * ブログを登録する
     * 
     *　@return view
     */
    public function exeStore(BlogRequest $request)
    {
        //ブログのデータを受け取る
        $inputs = $request->all();

        \DB::beginTransaction(); //エラーがあった場合にDBに登録しないようにする。
        // dd($inputs);
        //登録
        try {
            Blog::create($inputs);
            \DB::commit();
        } catch (\Throwawble $e) {
            \DB::rollback();
            abort(500);
        }
        \Session::flash('err_msg', 'ブログを登録しました');
        return redirect(route('blogs'));
    }


    /**
     * ブログ編集画面を表示する
     *  @param int $id
     *　@return view
     */
    public function showEdit($id)
    {
        $blog = Blog::find($id);
        if (is_null($blog)) {
            \Session::flash('err_msg', 'データがありませんw');
            return redirect(route('blogs')); //routeで決めた名前を指定
        }
        return view(
            'blog.edit',
            ['blog' => $blog] //$blogという配列をblogという名前をつけてblog.detail.blade.phpに渡す
        );
        //resources/views/blog/detail.blade.phpが表示される
    }
    /**
     * ブログを登録する
     * 
     *　@return view
     */
    public function exeUpdate(BlogRequest $request)
    {
        //更新後のデータ
        $inputs = $request->all();
        // dd($inputs);
        \DB::beginTransaction(); //エラーがあった場合にDBに登録しないようにする。
        //登録
        try {
            //更新前のデータを受け取る
            $blog = Blog::find($inputs['id']);
            //更新
            $blog->fill([
                'title' => $inputs['title'],
                'content' => $inputs['content']
            ]);
            $blog->save();
            \DB::commit();
        } catch (\Throwawble $e) {
            \DB::rollback();
            abort(500);
        }
        \Session::flash('err_msg', 'ブログを更新しました！');
        return redirect(route('blogs'));
    }
    /**
     * ブログを登録する
     * @param int $id
     *　@return view
     */
    public function exeDelete($id)
    {
        // dd($inputs);
        if (empty($id)) {
            \Session::flash('err_msg', 'データがありません!');
            return redirect(route('blogs')); //routeで決めた名前を指定
        }

        //登録
        try {
            //削除のデータ
            Blog::destroy($id);
            // \DB::commit();Transactionをbiginしない、commitもrollbackもいらない
        } catch (\Throwawble $e) {
            // \DB::rollback();
            abort(500);
        }
        \Session::flash('err_msg', '削除しました');
        return redirect(route('blogs'));
    }
}
