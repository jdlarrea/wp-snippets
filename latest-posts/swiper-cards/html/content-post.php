<?php
/**
 * Template part for displaying featured post cards
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package acme
 */
$post_type = get_post_type();
$type = '';
if($post_type === 'post') {
    $terms= get_the_terms(get_the_ID(),'content-type'); 
    $type = "Blog";
    if($terms) {
        $type = $terms[0]->name;
    }
} elseif($post_type === 'case-study') {
    $terms= get_the_terms(get_the_ID(),'post_tag'); 
    if($terms) {
        $type = $terms[0]->name;
    }
} else {
    $terms= get_the_terms(get_the_ID(),'news-type'); 
    if($terms) {
        $type = $terms[0]->name;
    }
}
?> 
<a href="<?php the_permalink(); ?>" class="item">
    <?php acme_post_thumbnail(); ?>
    <?php if ($type) { ?>
        <div class="tag"><?= $type ?></div>
    <?php } ?>
    <div class="title h3"><?= get_the_title() ?></div>
</a>