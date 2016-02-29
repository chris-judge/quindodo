<?php

    //Helper function for making curl calls
    function quindo_fetch_data($url){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 20);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    //Makes call and gets latest instagram data
    function quindo_get_instagram(){
        $insta_token = "208025959.381a727.4fd356e35222428fb541c2ff3a995c8b";
        $user_id = 208025959;
        $url = "https://api.instagram.com/v1/users/".$user_id."/media/recent/?access_token=".$insta_token;
        $result = quindo_fetch_data($url);
        $feed = json_decode($result, $assoc = true);
        return $feed;
    }

    //Makes call and gets latest facebook updates
    function quindo_get_facebook(){
        $appid = '432271006917605';
        $secret = 'fb52b286bd3fa8c48eae770764dcac01';
        $pageid = 'BIGEYEagency';

        $token = file_get_contents('https://graph.facebook.com/oauth/access_token?grant_type=client_credentials&client_id='.$appid.'&client_secret='.$secret);
        $feed = file_get_contents('https://graph.facebook.com/'.$pageid.'/feed?access_token='.$appid.'|'.$secret);
        $feed = json_decode($feed);
        
        return $feed;
    }

    //Makes call and gets latest linkedin updates
    function quindo_get_linkedin(){
        require_once('OAuth.php');

        $app_key = '75tofrl03dkjdj'; // take it from your application
        $app_secret = 'qJNqRDHILGUuB49Z'; // take it from your application
        $company_id = 3243028;
        $company_name = "stellar-sign-and-design";
        // Call with this URL to get company id
        //$url = "http://api.linkedin.com/v1/companies/universal-name=" . $company_name;
        $url = "http://api.linkedin.com/v1/companies/".$company_id."/updates";

        $consumer = new OAuthConsumer($app_key, $app_secret); 
        $request = OAuthRequest::from_consumer_and_token($consumer, NULL,"GET", $url, $args);  
        $request->sign_request(new OAuthSignatureMethod_HMAC_SHA1(), $consumer, NULL);  
        $url = sprintf("%s?%s", $url, OAuthUtil::build_http_query($args));  
        $feed = quindo_fetch_data($url);
        return $feed;
    }

    // Shrink string down to a desired length without cutting a word in the middle
    function quindo_truncate_string($string, $desired_length) {
        $parts = preg_split('/([\s\n\r]+)/', $string, null, PREG_SPLIT_DELIM_CAPTURE);
        $parts_count = count($parts);

        $length = 0;
        $last_part = 0;
        for (; $last_part < $parts_count; ++$last_part) {
            $length += strlen($parts[$last_part]);
            if ($length > $desired_length) { break; }
        }
        return trim(implode(array_slice($parts, 0, $last_part)));
    }

    // Allow private pages to be parent pages
    // https://core.trac.wordpress.org/ticket/8592#comment:129
    function quindo_admin_private_parent_metabox($output){
        global $post;

        $args = array(
            'post_type'         => $post->post_type,
            'exclude_tree'      => $post->ID,
            'selected'          => $post->post_parent,
            'name'              => 'parent_id',
            'show_option_none'  => __('(no parent)'),
            'sort_column'       => 'menu_order, post_title',
            'echo'              => 0,
            'post_status'       => array('publish', 'private'),
        );

        $defaults = array(
            'depth'                 => 0,
            'child_of'              => 0,
            'selected'              => 0,
            'echo'                  => 1,
            'name'                  => 'page_id',
            'id'                    => '',
            'show_option_none'      => '',
            'show_option_no_change' => '',
            'option_none_value'     => '',
        );

        $r = wp_parse_args($args, $defaults);
        extract($r, EXTR_SKIP);

        $pages = get_pages($r);
        $name = esc_attr($name);
        // Back-compat with old system where both id and name were based on $name argument
        if (empty($id))
        {
            $id = $name;
        }

        if (!empty($pages))
        {
            $output = "<select name=\"$name\" id=\"$id\">\n";

            if ($show_option_no_change)
            {
                $output .= "\t<option value=\"-1\">$show_option_no_change</option>";
            }
            if ($show_option_none)
            {
                $output .= "\t<option value=\"" . esc_attr($option_none_value) . "\">$show_option_none</option>\n";
            }
            $output .= walk_page_dropdown_tree($pages, $depth, $r);
            $output .= "</select>\n";
        }

        return $output;
    }
    add_filter('wp_dropdown_pages', 'quindo_admin_private_parent_metabox');
?>