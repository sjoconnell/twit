<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Twitter;
use Session;
use Redirect;
use Illuminate\Support\Facades\Input;


class HomeController extends Controller
{
    
    public function login() {
        // your SIGN IN WITH TWITTER  button should point to this route
        $sign_in_twitter = true;
        $force_login = true;

        // Make sure we make this request w/o tokens, overwrite the default values in case of login.
        Twitter::reconfig(['token' => '', 'secret' => '']);
        $token = Twitter::getRequestToken(route('twitter.callback'));

        if (isset($token['oauth_token_secret']))
        {
            $url = Twitter::getAuthorizeURL($token, $sign_in_twitter, $force_login);

            Session::put('oauth_state', 'start');
            Session::put('oauth_request_token', $token['oauth_token']);
            Session::put('oauth_request_token_secret', $token['oauth_token_secret']);

            return Redirect::to($url);
        }

        return Redirect::route('twitter.error');
    }


    public function callback() {
        // You should set this route on your Twitter Application settings as the callback
        // https://apps.twitter.com/app/YOUR-APP-ID/settings
        if (Session::has('oauth_request_token'))
        {
            $request_token = [
                'token'  => Session::get('oauth_request_token'),
                'secret' => Session::get('oauth_request_token_secret'),
            ];

            Twitter::reconfig($request_token);

            $oauth_verifier = false;

            if (Input::has('oauth_verifier'))
            {
                $oauth_verifier = Input::get('oauth_verifier');
            }

            // getAccessToken() will reset the token for you
            $token = Twitter::getAccessToken($oauth_verifier);

            if (!isset($token['oauth_token_secret']))
            {
                return Redirect::route('twitter.login')->with('flash_error', 'We could not log you in on Twitter.');
            }

            $credentials = Twitter::getCredentials();

            
            if (is_object($credentials) && !isset($credentials->error))
            {

                $array =  (array) $credentials;
                $twit_id = $array['id'];
                $twit_name = $array['name'];
                $twit_screen_name = $array['screen_name'];
                $twit_image = $array["profile_image_url"];
                // $twit_= $array['id'];
                // $twit_= $array['id'];
                // $twit_= $array['id'];

                $tweets = Twitter::getUserTimeline(['screen_name' => $twit_screen_name, 'count' => 10, 'format' => 'json']);

                $my_tweets = json_decode($tweets, true);


                // $credentials contains the Twitter user object with all the info about the user.
                // Add here your own user logic, store profiles, create new users on your tables...you name it!
                // Typically you'll want to store at least, user id, name and access tokens
                // if you want to be able to call the API on behalf of your users.

                // This is also the moment to log in your users if you're using Laravel's Auth class
                // Auth::login($user) should do the trick.

                Session::put('access_token', $token);
                Session::put('twit_screen_name', $twit_screen_name);
                Session::put('twit_id', $twit_id);
                Session::put('twit_name', $twit_name);
                Session::put('my_tweets', $my_tweets);
                Session::put('twit_image', $twit_image);

                return Redirect::to('/home');

            }

            return Redirect::route('twitter.error')->with('flash_error', 'Crab! Something went wrong while signing you up!');
        }
    }

    public function home(Request $request) {

        if ($request->session()->has('access_token')) {

            $my_tweets = $request->session()->get('my_tweets');
            $twit_id = $request->session()->get('twit_id');
            $twit_name = $request->session()->get('twit_name');
            $twit_screen_name = $request->session()->get('twit_screen_name');
            $twit_image = $request->session()->get('twit_image');

            foreach ($my_tweets as $tweet) {
                $linkified_tweets[] = Twitter::linkify($tweet['text']);
            }

            $feed = Twitter::getHomeTimeline(['count' => 10, 'format' => 'json']);

            $timeline = json_decode($feed, true);


            foreach ($timeline as $time) {
                $timeline_tweets[] = Twitter::linkify($time['text']);
                $timeline_data[] = $time['user'];
            }

            $ti = count($timeline_tweets);

            return view('home')->with([
                        'linkified_tweets' => $linkified_tweets,
                        'timeline_tweets' => $timeline_tweets,
                        'timeline_data' => $timeline_data,
                        'ti' => $ti,
                        'twit_id' => $twit_id,
                        'twit_name' => $twit_name,
                        'twit_screen_name' => $twit_screen_name,
                        'twit_image' => $twit_image,
                        ]);
        } else {

            return Redirect::to('/');
        }
    }


    public function error() {
        return 'You Screwed Up';
    }


    public function logout() {
        Session::forget('access_token');
        return Redirect::to('/')->with('flash_notice', 'You\'ve successfully logged out!');
    }


    public function tweet(Request $request) {

        $this->validate($request, [
            'tweet_text' => 'required|max:140',
        ]);

        $tweet_text = $request->input('tweet_text');

        $twit_screen_name = $request->session()->get('twit_screen_name');

        Twitter::postTweet(['status' => $tweet_text, 'format' => 'json']);

        $tweets = Twitter::getUserTimeline(['screen_name' => $twit_screen_name, 'count' => 10, 'format' => 'json']);

        $my_tweets = json_decode($tweets, true);

        Session::put('my_tweets', $my_tweets);

        return Redirect::to('/home');
        
    }


}
