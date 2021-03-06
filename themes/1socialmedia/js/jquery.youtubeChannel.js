
;(function($,undef){

    $.fn.youtubeChannel = function(settings) {
            // this plugin's version
        var version         = {major:0,minor:5,build:10},
            // the API version to use
            apiVersion      = 2,
            // the element where the plugin was called
            $ytEl           = $(this),
            // the list element
            $ytList         = $('<ul/>',{'class':'yt-channel-list'}),
            // the header
            $ytHead,
            // the footer (copyright note)
            $ytFoot,
            // maximum number of results that the api can return per call
            maxApiResults   = 50,
            // string to hold the html to be inserted
            listHtml        = '',
            // the plugin's options
            options         = $.extend({}, {username:'',query:'',startIndex:1,maxResults:50,orderBy:'published',callback:function(){}}, settings),
            // the current offset (must start at 1)
            resultOffset    = options.startIndex    = (options.startIndex < 1 ? 1 : options.startIndex),
            /*  -- API OBJECT --  */
            api = {
                // failed to get videos?
                failed: false,
                // the array of videos
                videos: [],
                // number of videos
                videoCount: 0
            },
            /*  -- PLUGIN FUNCTIONS --  */
            // get the html for the header
            getTitle    = function() {
                if (options.username!=='') {
                    
                }
                else if (options.query!=='') {
                    
                }
                else {
                
                }
            },
            // get the plugin's version
            getVersion  = function() {
                return [version.major,version.minor,version.build].join('.');
            },
            // calculate the next set of results to request from the API
            nextSet     = function() {
                var resultCall = options.startIndex + options.maxResults - resultOffset;
                return (resultCall > maxApiResults) ? maxApiResults : resultCall;
            },
            // build the url to make the API call
            buildUrl    = function() {
                var base    = 'https://gdata.youtube.com/feeds/api/videos',
                    params  = ['alt=json','v='+apiVersion,'orderby='+options.orderBy,'start-index='+resultOffset,'max-results='+nextSet()];
                if (options.username!=='') {
                    params.push('author='+options.username);
                }
                else if (options.query!=='') {
                    params.push('q='+encodeURIComponent(options.query));
                }
                params.push('callback=?');
                return base+'?'+params.join('&');
            },
            // parse the videos' time (from secs to mins:secs)
            parseTime   = function(secs) {
                var m,s = parseInt(secs,10);
                m = Math.floor(s / 60);
                s -= (m * 60);
                return m+':'+s;
            },
            // add a video to the list
            addVideo    = function(vid) {
                // change the id to be more html friendly
                vid.htmlId = 'videoid-'+vid.id;
                // add video data to the videos array
                api.videos.push(vid);
      
                // return the styled HTML
                return [
                    '<li id="',vid.htmlId,'" class="yt-channel-video">',
                        '<a target="_blank" href="http://youtube.com/v/',vid.id,'&autoplay=1">',
                            '<span class="thumb-wrap">',
                                '<img class="vid-thumb" alt="',vid.title,'" src="',vid.thumb,'"/>',
                                '<span class="vid-duration">',parseTime(vid.duration),'</span>',
                            '</span>',
                            '<div class="vid-details">',
                                '<span class="vid-title">',vid.title,'</span>',
                                '<span class="vid-views">',vid.views,' weergaven</span>',
                            '</div>',
                        '</a>',
                    '</li>'].join('');
            },
            // parse the list of videos sent from the API
            parseList   = function(data) {
                var vid, e, length;
                // do we have videos to add?
                if (data.feed.entry) {
                    length = data.feed.entry.length;
                    // parse each video returned
                    for (var i=0; i<length; i++) {
                        // local cache of the video entry
                        e = data.feed.entry[i];
                        // add the video to the videos array and return the HTML for the list
                        listHtml += addVideo({
                            id:         (e ? e.media$group.yt$videoid.$t : ''),
                            link:       (e ? e.media$group.media$player.url : ''),
                            title:      (e ? e.media$group.media$title.$t : ''),
                            thumb:      (e ? e.media$group.media$thumbnail[1].url : ''),
                            duration:   (e ? e.media$group.yt$duration.seconds : 0),
                            views:      (e && e.yt$statistics ? e.yt$statistics.viewCount : 0)
                        });
                        resultOffset++;
                        api.videoCount++;
                    }
                    // check if we want to list more results
                    if (resultOffset < options.maxResults) {
                        // make one more api call for more results
                        $.getJSON(buildUrl(),parseList);
                    } else {
                        // done retrieving videos, compile the HTML
                        outputHtml();
                        // use callback, if set
                        options.callback.apply(self, [api]);
                    }
                } else {
                    // if no results were returned on the first call...
                    if (resultOffset === options.startIndex) {
                        api.failed = true;
                        listHtml += '<li class="yt-channel-video"><a>NO RESULTS</a></li>';
                    }
                    // we're done here, compile the HTML
                    outputHtml();
                    // use callback, if set
                    options.callback.apply(self, [api]);
                }
            },
            // output the final HTML
            outputHtml  = function() {
                // append the list of videos
                
                $ytFoot.before(listHtml);
            };
        /*  -- API FUNCTIONS --  */
        api.loadMore = function loadMore(num) {
            // increase the maximum number of results
            options.maxResults += parseInt(num, 10);
            // make one more api call for more results
            $.getJSON(buildUrl(),parseList);
        };
        /*  -- PLUGIN MAIN CODE --  */
        // apply styling to the parent element
        $ytEl.addClass('yt-channel-holder');
        // set the header and append it
        $ytHead = $('<li/>',{'class':'yt-channel-title'}).html(getTitle()).appendTo($ytList);
        // set copyright notice and append it
        $ytFoot = $('<li/>',{'class':'yt-channel-copy'}).html('').appendTo($ytList);
        // display the list of videos
        $ytList.appendTo($ytEl);
        // start querying the API
        $.getJSON(buildUrl(),parseList);
        // maintain jQuery chainability
        return this;
    };
})(jQuery);