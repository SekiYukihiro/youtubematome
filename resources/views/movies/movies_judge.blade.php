@if($movie)
            @php
                $api = "AIzaSyDRVUDMZb8B3v6qRfIIQxkYQ3TX-TO3xlw";
                $get_api_url = "https://www.googleapis.com/youtube/v3/videos?id=$movie->url&key=$api&part=snippet,contentDetails,statistics,status";
                $json = @file_get_contents($get_api_url);

                if($json){
                    $getData = json_decode( $json , true);
                    foreach((array)$getData['items'] as $key => $gDat){
                    $video_title = $gDat['snippet']['title'];
                }

                }else{
                    $video_title="※一時的な情報制限中です";
                }

            @endphp
@endif