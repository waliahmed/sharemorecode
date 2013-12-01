<?php

class Comment extends Eloquent {
    protected $guarded = array();

    public static $rules = array();


    /**
     * set up relationships
     */
    public function user() {
        return $this->belongsToOne('User');
    }

    public function snippet() {
        return $this->belongsToOne('Snippet');
    }
}
