<?php

namespace App\Http\Controllers;

use App\Session;
use App\Chapitre;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Requests\CreateSessionRequest;
use App\Http\Requests\UpdateSessionRequest;

class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CreateSessionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Chapitre $chapitre, CreateSessionRequest $request)
    {
        $data = $this->setVideoData($request->all());
        $num_ordre_auto = false;
        if (isset($data['num_ordre'])) {
          if (is_null($data['num_ordre'])) {
            $num_ordre_auto =  true;
          }
        } else {
          $num_ordre_auto =  true;
        }

        if ($num_ordre_auto) {
          $num_ordre = $chapitre->sessions->count();
          $num_ordre = $num_ordre + 1;
          $data['num_ordre'] = $num_ordre;
        }

        $data['code'] = Session::getUniqcode();

        return $chapitre->sessions()->create($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function show(Session $session)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function edit(Session $session)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSessionRequest  $request
     * @param  \App\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function update(Chapitre $chapitre, Session $session, UpdateSessionRequest $request)
    {
        $data = $this->setVideoData($request->all());

        $session->update($data);

        return $session->fresh();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function destroy(Chapitre $chapitre, Session $session)
    {
        $session->delete();

        return response()->json(['status' => 'ok'], 200);
    }

    public function setVideoData($data) {
        $vimeodata = $this->getVimeoVideoData($data['lien']);
        if (is_null($vimeodata)) {
            $data['duree_s'] = 0;
            $data['duree_hhmmss'] = $this->secondsToHHMMSS(0);
            $data['width'] = 0;
            $data['height'] = 0;
            $data['stats_number_of_likes'] = 0;
            $data['stats_number_of_plays'] = 0;
            $data['stats_number_of_comments'] = 0;
        } else {
            $data['duree_s'] = $vimeodata->duration;
            $data['duree_hhmmss'] = $this->secondsToHHMMSS($vimeodata->duration);
            $data['width'] = $vimeodata->width;
            $data['height'] = $vimeodata->height;
            $data['stats_number_of_likes'] = $vimeodata->stats_number_of_likes;
            $data['stats_number_of_plays'] = $vimeodata->stats_number_of_plays;
            $data['stats_number_of_comments'] = $vimeodata->stats_number_of_comments;
        }

        $data['taille_o'] = 0;

        return $data;
    }

    /**
     * Vimeo video duration in seconds
     *
     * @param $video_url
     * @return object|null vimeo video's data infos
     */
    public function getVimeoVideoData($video_id) {

        //$video_id = "230485453";
        //$video_id = (int)substr(parse_url($video_url, PHP_URL_PATH), 1);

        $json_url = 'http://vimeo.com/api/v2/video/' . $video_id . '.xml';

        $ch = curl_init($json_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        $data = curl_exec($ch);
        curl_close($ch);
        $data = new \SimpleXmlElement($data, LIBXML_NOCDATA);

        //dd($json_url,$ch,$data);

        if (!isset($data->video)) {
            return null;
        }

        // object attributes:
        // id,title,description,url,upload_date,thumbnail_small,thumbnail_medium,thumbnail_large,
        // user_id,user_name,user_url,user_portrait_small,user_portrait_medium,user_portrait_large,
        // user_portrait_huge,stats_number_of_likes,stats_number_of_plays,stats_number_of_comments,
        // duration,width,height,
        // tags => SimpleXMLElement,
        // embed_privacy

        //$duration = $data->video->duration;
        return $data->video;
    }

    function secondsToHHMMSS($seconds) {
      $t = round($seconds);
      return sprintf('%02d:%02d:%02d', ($t/3600),($t/60%60), $t%60);
    }
}
