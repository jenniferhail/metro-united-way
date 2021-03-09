<?php
$display_share = get_sub_field('display_share');
$share_buttons = get_sub_field('share_buttons');

$share_link = $share_buttons['link'];
$link_url = $share_link['url'];
$link_title = $share_link['title'];

$share_summary = $share_buttons['summary'];
// $share_image = $share_buttons['image'];
?>

<?php if ( $display_share ) : ?>
	<div class="share-links">
		<ul class="share-list social-links">
			<li class="share-link"><a href="http://www.facebook.com/sharer.php?s=100&amp;p[title]=<?php echo $link_title; ?>&amp;p[summary]=<?php echo $share_summary; ?>&amp;p[url]=<?php print(urlencode($link_url)); ?>" onclick="window.open(this.href, 'facebookwindow','left=20,top=20,width=600,height=700,toolbar=0,resizable=1'); return false;" class="facebook" alt="Share on Facebook"><i class="fab fa-facebook-f"></i></a></li>
			<li class="share-link"><a href="http://twitter.com/intent/tweet?text=<?php echo $share_summary; ?>&url=<?php print(urlencode($link_url)); ?>" onclick="window.open(this.href, 'twitterwindow','left=20,top=20,width=600,height=300,toolbar=0,resizable=1'); return false;" class="twitter" alt="Share on Twitter"><i class="fab fa-twitter"></i></a></li>
	</div>
<?php endif; ?>
