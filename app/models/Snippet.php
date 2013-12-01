<?php

class Snippet extends Eloquent {
    protected $guarded = array();

    public static $rules = array();


    /**
     * set up relationships
     */
    public function user() {
        return $this->belongsToOne('User');
    }

    public function reviews() {
        return $this->belongsToMany('Review');
    }

    public function comments() {
        return $this->belongsToMany('Comment');
    }

    public function issues() {
        return $this->belongsToMany('Issue');
    }

    public function features() {
        return $this->belongsToMany('Feature');
    }

    public function tags() {
        return $this->belongsToMany('Tag');
    }
}
