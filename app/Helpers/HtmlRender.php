<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Helpers;

use Illuminate\Database\Eloquent\Model;

class HtmlRender extends Model
{
    public static function HtmlConvertePost($param) {
        $data = '';
        foreach ($param as $key => $discussion) {
//            echo config("kjkj");
            $avatar = config('forum.user.avatar_image_database_field');
            $data .= ' <li class="panel post list-card" id="' . $discussion->id . '">
                <div class="chatter_avatar panel-bodys">
                    <div class="row">
                        <div class="col-xs-3 col-sm-2 col-md-2">
                            <div class="pad15">';
            if ($avatar) {
                $db_field = config('forum.user.avatar_image_database_field');

                if ((substr($discussion->user->{$db_field}, 0, 7) == 'http://') || (substr($discussion->user->{$db_field}, 0, 8) == 'https://')) {
                    $data .= ' <img src="' . $discussion->user->{$db_field} . '">';
                } else {
                    $img_url = config('forum.user.relative_url_to_image_assets') . $discussion->user->{$db_field};
                    $data .= '<img src="' . $img_url . '">';
                }
            } else {

                $data .= '<span class="avatar_circle" style="height:50px;width:50px;  background:#' . \App\Helpers\DataHelper::stringToColorCode($discussion->user->email) . '">
                                    ' . strtoupper(substr($discussion->user->email, 0, 1)) . '</span>';
            }
            $data .= '</div>
                        </div>
                        <div  class="col-xs-7 col-sm-9 col-md-9">
                            <div class="pad15_0 ">

                                <h5 class="user_info ">
                                    <a href="'.url(config('forum.routes.home').'/profil/'.$discussion->user->id).'">' . ucfirst($discussion->user->{config('forum.user.database_field_with_user_name')}) . '</a>
                                </h5>
                                <p class="user_post_date"> 
                                    <ul class="list-unstyled list-inline"><li><i class="fa fa-clock-o"></i> ' . \Carbon\Carbon::createFromTimeStamp(strtotime($discussion->created_at))->diffForHumans() . ' </li><li> <i class="fa fa-folder-o"></i> <span class="chatter_cat_" style="_background-color:' . $discussion->category->color . '">' . $discussion->category->name . '</span></li></ul>
                                </p>
                            </div>


                        </div>
                        <div class="col-xs-2 col-sm-1 col-md-1">
                        <i class="fa  fa-sort-desc pull-rights "></i>
                        </div>
                        
                    </div>

                </div>
                
        ';
            $body = $discussion->post;

            $discussion_body = '';
            if (count($body)) {
                $discussion_body = $body[0]["body"];
            };
            $data .= '<div class="chatter_middle pad-panel">
                    <a class="discussion_list" href="/' . config('forum.routes.home') . '/' . config('forum.routes.discussion') . '/' . $discussion->category->slug . '/' . $discussion->slug . '">
                        <div class="middle_title text-uppercase-">' . $discussion->title . '</div>
                    </a>
                    <p class="middle_content">  
                        <a class="discussion_list" href="/' . config('forum.routes.home') . '/' . config('forum.routes.discussion') . '/' . $discussion->category->slug . '/' . $discussion->slug . '">
                            ' . substr(strip_tags($discussion_body), 0, 200);
            $data .= (strlen(strip_tags($discussion_body)) > 200) ? '...' : '';
            $data .= '</a>
                        </p>
                </div>
                <div class="row post-footer">
                    <div class="btn bgf9 col-xs-6 col-sm-6">
                       <h5 class="text-muted"><i class="fa fa-comments"></i> '.$discussion->postsCount[0]->total.' </h5>
                       </div>
                       <div class="btn bgf9 col-xs-6 col-sm-6">
                       <h5 class="text-muted"><i class="fa fa-eye"></i> '.$discussion->viewCount[0]->total.' </h5>
                   </div>
                </div>
                <div class="chatter_right">

                </div>

            </a>
            </li>';
        }
        return $data;
    }
}