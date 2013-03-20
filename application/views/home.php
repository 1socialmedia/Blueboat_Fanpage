<?=Headers(); ?>
<div class="header_wrapper">
	<div class="main_header_logo_frame"></div>
	<div class="head_img_youtube"></div>
</div>
<div class="page-title">
	<h2><span class="title_strong">VIDEO'S -</span> BLUE BOAT COMPANY</h2>
</div>

<div class="content">
	<div id="youtube-channel"></div>
</div>
 <script>
    $(function() {
        var count = 2;
        $('#youtube-channel').youtubeChannel({
            username: 'BlueBoatCompany',
            startIndex: 1,
            maxResults: 10,
            orderBy: 'published',
            callback: function(api) {
                // check if plugin failed to load any videos
                if (!api.failed) {
                    // log the number of videos loaded so far
                    console.log('loaded ' + api.videoCount + ' videos');
                    // execute two more loads asynchronously
                    if (count--) {
                        // add some delay, just because :)
                        setTimeout(function() {
                            api.loadMore(10);
                        }, 1000);
                    }
                }
            }
        });
    });
    </script>
<?=Footer();?>