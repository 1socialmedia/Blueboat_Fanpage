<?=Headers(); ?>
<div class="header_wrapper">
	<div class="main_header_logo_frame"></div>
	<div class="head_img_twitter"></div>
</div>
<div class="page-title">
	<h2><span class="title_strong">TWEETS -</span> BLUE BOAT COMPANY</h2>
</div>

<div class="content">
	<div class="tweet"></div>
<script>
jQuery(function($){
        $(".tweet").tweet({
          join_text: "auto",
          username: "BlueBoatCompany",
          avatar_size: 48,
          count: 900,
          auto_join_text_default: " We zeiden, ",
          auto_join_text_ed: " We ",
          auto_join_text_ing: " We waren ",
          auto_join_text_reply: " We reageerde ",
          auto_join_text_url: " We bekeken ",
          loading_text: "loading tweets..."
        });
      });
    
</script>	
</div>
<?=Footer();?>