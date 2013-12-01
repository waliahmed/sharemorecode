<?php

class Tag extends Eloquent {
    protected $guarded = array();

    public static $rules = array();

    public function snippets() {
        return $this->belongsToMany('Snippet');
    }
}
