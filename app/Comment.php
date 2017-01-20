<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Comment
 *
 * @property-read \App\User $author
 * @property-read \App\Post $post
 * @mixin \Eloquent
 * @property int $id
 * @property int $on_post
 * @property int $from_user
 * @property string $body
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Comment whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Comment whereOnPost($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Comment whereFromUser($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Comment whereBody($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Comment whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Comment whereUpdatedAt($value)
 */
class Comment extends Model
{
    public function author(){
        return $this->belongsTo('App\User','from_user');
    }
    public function post(){
        return $this->belongsTo('App\Post','on_post');
    }
}
