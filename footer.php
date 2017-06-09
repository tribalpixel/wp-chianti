            <footer>
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'nav-footer',
                    'container' => 'nav',
                    'container_id' => 'nav-footer',
                    'fallback_cb' => false,
                        //'container_class'=>'nav',
                        //'menu_class'=>'',
                        //'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                ));
                ?>
                <?php wp_footer(); ?>
            </footer>

        </div>

    </body>
</html>