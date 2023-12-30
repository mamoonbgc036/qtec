<?php

namespace App\Http\Controllers\User;

use App\Models\Url;
use Illuminate\Http\Request;
use App\Services\UrlShortenService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreUrlRequest;
use App\Http\Requests\UpdateUrlRequest;

class DashboardController extends Controller
{
    public function index()
    {
        $short_url_lists = auth()->user()->urls;
        // dd($short_url_lists);
        return view('user.dashboard.index', compact('short_url_lists'));
    }

    public function shorten()
    {
        return view('user.dashboard.shorten');
    }

    public function short_url(StoreUrlRequest $request)
    {
        $id = 1;

        $check = Url::where(['long_url' => $request->long_url, 'user_id' => auth()->user()->id])->exists();
        //chech for existance in db
        if ($check) {
            $check = Url::where(['long_url' => $request->long_url, 'user_id' => auth()->user()->id])->first();
            return back()->with(['alart' => "It's short url is : " . $check->short_url]);
        }
        //is it initial post
        if (Url::all()->count() > 0) {
            $id = Url::all()->last()->id;
        }

        //generate unique identifier for short url
        $url_short_instance = new UrlShortenService;
        $short_url_pointer = $url_short_instance->short_url($id + 2);
        $request['pointer'] = $short_url_pointer;
        $request['short_url'] = url('/') . '/' . $short_url_pointer;
        $user = Auth::user();

        $user->urls()->create($request->all());


        return redirect('user/dashboard');
    }

    public function edit($url_id)
    {
        $url_edit = Url::findOrFail($url_id);
        return view('user.dashboard.edit', compact('url_edit'));
    }

    public function update(UpdateUrlRequest $request, $url_for_update)
    {
        $url_data = Url::findOrFail($url_for_update);

        if ($request->long_url == $url_data->long_url) {
            return redirect('user/dashboard')->with('nochange', 'you have not edited the url');
        }



        $check = Url::where(['long_url' => $request->long_url, 'user_id' => auth()->user()->id])->exists();
        //chech for existance in db
        if ($check) {
            $check = Url::where(['long_url' => $request->long_url, 'user_id' => auth()->user()->id])->first();
            return back()->with(['alart' => "It's short url is : " . $check->short_url]);
        }


        //generate unique identifier for short url
        $url_short_instance = new UrlShortenService;
        $short_url_pointer = $url_short_instance->short_url($url_data->id);
        $request['pointer'] = $short_url_pointer;
        $request['short_url'] = url('/') . '/' . $short_url_pointer;
        $user = Auth::user();

        // $user->urls()->create($request->all());

        $url_data->update($request->all());


        return redirect('user/dashboard');

        // $url_for_update->update()
    }

    public function redirect($id)
    {
        $actual_url = Url::where('pointer', $id)->exists();
        if (!$actual_url) {
            return response()->json(['error' => 'corresponding url not found'], 401);
        }
        $actual_url = Url::where('pointer', $id)->first();

        $actual_url->increment('click');
        return redirect($actual_url->long_url);
    }

    public function destroy(Url $url)
    {
        $url->delete();
        return back()->with('success', 'url deleted successfully');
    }
}
