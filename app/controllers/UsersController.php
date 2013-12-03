<?php

class UsersController extends BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $users = User::all();
        return View::make( 'users.index' )->with( 'users', $users );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View::make( 'users.create' );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
            $username = Input::get('username');
            $email = Input::get('email');

            if ( !User::checkUsernameAvailable($username) ) {
                $message = 'Sorry, that username is taken =[';
                return View::make('users.create')->with( 'message', $message );
            }

            if ( !User::checkEmailAvailable($email) ) {
                $message = 'Sorry, that email is already in use =[';
                return View::make('users.create')->with( 'message', $message );
            }

            $user = new User;
            $user->username = Input::get( 'username' );
            $user->email = Input::get( 'email' );
            $user->password = Hash::make( Input::get( 'password' ) );
            $user->save();

            Auth::login( $user );

            return Redirect::to( '/' );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        if ( Auth::check() ) {
            $user = User::find( $id );
            $snippets = Snippet::where( 'author_id', '=', $id )->orderBy( 'created_at', 'desc' )->paginate( 15 );
            $bugs = Bug::where( 'snippet_owner_id', '=', $id )->get();
            $feats = Featurerequest::where( 'author_id', '=', $id )->get();
            $total_snippets = count( Snippet::where( 'author_id', '=', $id )->get() );

            foreach( $bugs as $bug ) {
                $bug['reporter'] = User::find( $bug->reporter_id );
                $bug['snippet'] = Snippet::find( $bug->snippet_id );
            }

            foreach( $feats as $feat ) {
                $feat['requester'] = User::find( $feat->requester_id );
                $feat['snippet'] = Snippet::find( $feat->snippet_id );
            }

            foreach( $snippets as $snippet ) {
                    $snippet['avg_rating'] = Snippet::getAverageRating( $snippet->id );
            }


            $user_data = array(
                'user' => $user,
                'snippets' => $snippets,
                'bugs' => $bugs,
                'feats' => $feats,
                'total_snippets' => $total_snippets
            );

            return View::make( 'users.show' )->with( 'user_data', $user_data );
        } else {
            return Redirect::to( '/' );
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        if ( $id == Session::get( 'user_id' ) ) {
            $user = User::find( $id );
            return View::make( 'users.edit' )->with( 'user', $user );
        } else {
            return Redirect::to( '/' );
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $user = User::find( $id );

        $username = Input::get( 'username' );

        if ( !User::checkUsernameAvailable( $username ) ) {
            $message = 'Sorry, that username is taken =[';
            return View::make( 'users.create' )->with( 'message', $message );
        }

        if ( Input::hasFile( 'profile_pic' ) ) {
             $rules = array(
                'profile_pic' => 'mimes:jpeg,png,gif,JPEG,jpg',
            );

             $validation = Validator::make( array( Input::file( 'profile_pic' ) ), $rules);

             if ( !$validation ) {
                $message = 'Image is of wrong type, please use: jpg, png, or gif';
                return View::make('users.edit')->with( 'message', $message );
             }

            // Save profile_pic in the database
            $filename = Str::random(20) . '.' . Input::file( 'profile_pic' )->getClientOriginalExtension();

            $user->profile_pic_url = 'img/uploads/profile_pics/' . $filename;
            Session::put( 'profile_pic_url', $user->profile_pic_url );

            Input::file( 'profile_pic' )->move( 'img/uploads/profile_pics/', $filename );

            Image::make( 'img/uploads/profile_pics/' . $filename )->resize( 250, 250, false, true)->save();


        }

        if ( Input::has( 'description' ) ) {
            $user->description = Input::get( 'description' );
            Session::put( 'description', Input::get( 'description' ) );
        }
        if ( Input::has( 'website_url' ) ) {
            $user->website_url = Input::get( 'website_url' );
            Session::put( 'website_url', Input::get( 'website_url' ) );
        }
        if ( Input::has( 'quote' ) ) {
            $user->quote = Input::get( 'quote' );
            Session::put( 'quote', Input::get( 'quote' ) );
        }

        $user->save();

        return Redirect::to( route( 'users.show', $id ) );

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {

    }

    public function logout() {
        Auth::logout();
        return Redirect::to( '/' );
    }

}