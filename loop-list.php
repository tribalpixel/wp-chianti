<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <h2><?php the_title(); ?></h2>
    <div class="article-picture"><?php the_post_thumbnail(); ?></div>
    <div class="article-content"> 
        <p><?php the_excerpt(); ?></p>
        <div class="metas"><?php the_tags(); ?></div>
    </div>
</article>