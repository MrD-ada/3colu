<?php

// テーマセットアップ
function threecolu_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_image_size('widget-thumb', 80, 80, true); // アイキャッチのサイズを定義（幅80px, 高さ80px, ハードクロップ）
    add_theme_support( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ) );

    // カスタムロゴ機能を追加
    add_theme_support( 'custom-logo', array(
        'height'      => 50, // ロゴの最大高さ
        'width'       => 230, // ロゴの最大幅
        'flex-height' => true,
        'flex-width'  => true,
    ) );
}
add_action( 'after_setup_theme', 'threecolu_setup' );

// スタイルシートの読み込み
function threecolu_scripts() {
    wp_enqueue_style( 'threecolu-style', get_stylesheet_uri() );
}
add_action( 'wp_enqueue_scripts', 'threecolu_scripts' );

// ナビゲーションメニューの登録
function threecolu_register_menus() {
    register_nav_menus( array(
        'header-menu' => 'ヘッダーメニュー',
    ) );
}
add_action( 'init', 'threecolu_register_menus' );

// クラシックエディターを有効化
add_filter( 'use_block_editor_for_post', '__return_false', 10 );

// クラシックウィジェットを有効化
add_filter( 'gutenberg_can_edit_widgets', '__return_false' );
add_filter( 'use_widgets_block_editor', '__return_false' );

// widgets.phpを読み込む
require get_template_directory() . '/inc/widgets.php';

// SEO設定用のカスタムメタボックスを追加
function add_seo_metabox() {
    add_meta_box(
        'seo_settings_metabox',
        'SEO設定',
        'show_seo_metabox',
        'post',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'add_seo_metabox');

// カスタムメタボックスの内容を表示
function show_seo_metabox($post) {
    // セキュリティのためのNonceフィールド
    wp_nonce_field('save_seo_metabox_data', 'seo_metabox_nonce');

    // 現在の投稿からメタデータを取得
    $seo_title = get_post_meta($post->ID, '_seo_title', true);
    $meta_description = get_post_meta($post->ID, '_meta_description', true);
    $meta_keywords = get_post_meta($post->ID, '_meta_keywords', true);
    $noindex = get_post_meta($post->ID, '_noindex', true);
    $nofollow = get_post_meta($post->ID, '_nofollow', true);
    $canonical_url = get_post_meta($post->ID, '_canonical_url', true);
    $custom_css = get_post_meta($post->ID, '_custom_css', true);
    $custom_js = get_post_meta($post->ID, '_custom_js', true);

    ?>
    <style>
        .seo-field { margin-bottom: 20px; }
        .seo-field label { display: block; font-weight: bold; margin-bottom: 5px; }
        .seo-field input[type="text"], .seo-field textarea { width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; }
        .seo-field textarea { height: 80px; }
        .seo-field p { font-size: 13px; color: #666; margin-top: 5px; }
    </style>

    <div class="seo-field">
        <label for="seo_title">SEOタイトル</label>
        <p>検索エンジンに表示させたいタイトルを入力してください。記事のタイトルより、こちらに入力したテキストが優先的にタイトルタグ(&lt;title&gt;)に挿入されます。一般的に日本語の場合は、32文字以内が最適とされています。（※ページやインデックスの見出し部分には「記事のタイトル」が利用されます）</p>
        <input type="text" id="seo_title" name="seo_title" value="<?php echo esc_attr($seo_title); ?>" placeholder="タイトルを入力してください。" />
    </div>

    <div class="seo-field">
        <label for="meta_description">メタディスクリプション</label>
        <p>記事の説明を入力してください。日本語では、およそ120文字前後の入力をおすすめします。スマートフォンではそのうちの約50文字が表示されます。こちらに入力したメタディスクリプションはブログカードのスニペット（抜粋文部分）にも利用されます。こちらに入力しない場合は、「抜粋」に入力したものがメタディスクリプションとして挿入されます。</p>
        <textarea id="meta_description" name="meta_description" placeholder="記事の説明文を入力してください。"><?php echo esc_textarea($meta_description); ?></textarea>
    </div>

    <div class="seo-field">
        <label for="meta_keywords">メタキーワード</label>
        <p>記事に関連するキーワードを,（カンマ）区切りで入力してください。入力しない場合は、カテゴリー名などから自動で設定されます。</p>
        <input type="text" id="meta_keywords" name="meta_keywords" value="<?php echo esc_attr($meta_keywords); ?>" placeholder="半角カンマ区切りで入力してください。" />
    </div>

    <div class="seo-field">
        <label>
            <input type="checkbox" name="noindex" value="1" <?php checked($noindex, '1'); ?> />
            インデックスしない（noindex）
        </label>
        <p>このページが検索エンジンにインデックスされないようにメタタグを設定します。</p>
    </div>

    <div class="seo-field">
        <label>
            <input type="checkbox" name="nofollow" value="1" <?php checked($nofollow, '1'); ?> />
            リンクをフォローしない（nofollow）
        </label>
        <p>検索エンジンがこのページ上のリンクをフォローしないようにメタタグを設定します。</p>
    </div>

    <div class="seo-field">
        <label for="canonical_url">詳細設定：canonical URL</label>
        <p>ページ内容が類似もしくは重複しているURLが複数存在する場合に、検索エンジンからのページ評価が分散されないよう、正規のURLがどれなのかを検索エンジンに示すために用いる記述です。コンテンツが重複している場合は、正規ページのURLを入力してください。</p>
        <input type="text" id="canonical_url" name="canonical_url" value="<?php echo esc_url($canonical_url); ?>" placeholder="正規ページのURLを入力" />
    </div>

    <div class="seo-field">
        <label for="custom_css">詳細設定：カスタムCSS</label>
        <p>ページ単体にカスタムCSSをあてるための項目</p>
        <textarea id="custom_css" name="custom_css" placeholder="ここにCSSを記述してください。"><?php echo esc_textarea($custom_css); ?></textarea>
    </div>

    <div class="seo-field">
        <label for="custom_js">詳細設定：カスタムJavascript</label>
        <p>ページ単体にカスタムJavascriptをあてるための項目</p>
        <textarea id="custom_js" name="custom_js" placeholder="ここにJavaScriptを記述してください。"><?php echo esc_textarea($custom_js); ?></textarea>
    </div>

    <?php
}

// カスタムメタボックスのデータを保存
function save_seo_metabox_data($post_id) {
    // Nonceチェック
    if (!isset($_POST['seo_metabox_nonce']) || !wp_verify_nonce($_POST['seo_metabox_nonce'], 'save_seo_metabox_data')) {
        return;
    }

    // 権限チェック
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    // 入力データの保存
    $fields = ['seo_title', 'meta_description', 'meta_keywords', 'noindex', 'nofollow', 'canonical_url', 'custom_css', 'custom_js'];

    foreach ($fields as $field) {
        $meta_key = '_' . $field;

        if (isset($_POST[$field])) {
            $value = sanitize_text_field($_POST[$field]);
            if ($field === 'meta_description' || $field === 'custom_css' || $field === 'custom_js') {
                $value = wp_kses_post($_POST[$field]);
            }
            update_post_meta($post_id, $meta_key, $value);
        } else {
            delete_post_meta($post_id, $meta_key);
        }
    }
}
add_action('save_post', 'save_seo_metabox_data');

// カスタムロゴの補足説明を追加
function threecolu_custom_logo_description($wp_customize) {
    // 既存のカスタムロゴセクションを取得
    $wp_customize->get_control('custom_logo')->description = '推奨サイズは **230px x 50px** です。これより大きいサイズの画像もアップロードできますが、テーマの表示領域に合わせて自動的に縮小されます。';
}
add_action('customize_register', 'threecolu_custom_logo_description', 11);

// 人気記事ウィジェットの追加 (カスタマイズ版)
class Popular_Posts_Widget extends WP_Widget {
    function __construct() {
        parent::__construct(
            'popular_posts_widget',
            '人気記事（カスタマイズ版）',
            array('description' => '人気記事を表示するウィジェットです')
        );
    }

    public function widget($args, $instance) {
        echo $args['before_widget'];
        if (!empty($instance['title'])) {
            echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
        }

        $posts_per_page = !empty($instance['posts_per_page']) ? $instance['posts_per_page'] : 5;
        $image_layout = !empty($instance['image_layout']) ? $instance['image_layout'] : 'none';

        $popular_posts_args = array(
            'posts_per_page' => $posts_per_page,
            'orderby' => 'comment_count',
            'order' => 'DESC',
            'ignore_sticky_posts' => true
        );
        $popular_posts_query = new WP_Query($popular_posts_args);

        if ($popular_posts_query->have_posts()) {
            echo '<ul class="widget-list">';
            while ($popular_posts_query->have_posts()) {
                $popular_posts_query->the_post();
                $post_class = 'widget-item';
                if ($image_layout !== 'none') {
                    $post_class .= ' has-thumbnail widget-item-' . esc_attr($image_layout);
                }
                echo '<li class="' . esc_attr($post_class) . '">';

                if ($image_layout === 'overlay' && has_post_thumbnail()) {
                    echo '<div class="widget-thumbnail-overlay">';
                    echo '<a href="' . get_the_permalink() . '">';
                    the_post_thumbnail('medium');
                    echo '<span class="widget-title-overlay">' . get_the_title() . '</span>';
                    echo '</a>';
                    echo '</div>';
                } elseif ($image_layout === 'below' && has_post_thumbnail()) {
                    echo '<a href="' . get_the_permalink() . '" class="widget-thumbnail-below">';
                    the_post_thumbnail('medium');
                    echo '</a>';
                    echo '<div class="widget-content">';
                    echo '<a href="' . get_the_permalink() . '" class="widget-title">' . get_the_title() . '</a>';
                    echo '</div>';
                } elseif ($image_layout === 'side' && has_post_thumbnail()) {
                    echo '<div class="widget-thumbnail-side">';
                    echo '<a href="' . get_the_permalink() . '">';
                    the_post_thumbnail('widget-thumb'); // widget-thumb サイズを使用
                    echo '</a>';
                    echo '</div>';
                    echo '<div class="widget-content">';
                    echo '<a href="' . get_the_permalink() . '" class="widget-title">' . get_the_title() . '</a>';
                    echo '</div>';
                } else {
                    echo '<div class="widget-content">';
                    echo '<a href="' . get_the_permalink() . '" class="widget-title">' . get_the_title() . '</a>';
                    echo '</div>';
                }

                echo '</li>';
            }
            echo '</ul>';
            wp_reset_postdata();
        } else {
            echo '人気記事は見つかりませんでした。';
        }
        echo $args['after_widget'];
    }

    public function form($instance) {
        $title = !empty($instance['title']) ? $instance['title'] : '人気記事';
        $posts_per_page = !empty($instance['posts_per_page']) ? $instance['posts_per_page'] : 5;
        $image_layout = !empty($instance['image_layout']) ? $instance['image_layout'] : 'none';
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>">タイトル:</label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('posts_per_page')); ?>">表示件数:</label>
            <input class="tiny-text" id="<?php echo esc_attr($this->get_field_id('posts_per_page')); ?>" name="<?php echo esc_attr($this->get_field_name('posts_per_page')); ?>" type="number" step="1" min="1" value="<?php echo esc_attr($posts_per_page); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('image_layout')); ?>">アイキャッチ画像の表示形式:</label>
            <select id="<?php echo esc_attr($this->get_field_id('image_layout')); ?>" name="<?php echo esc_attr($this->get_field_name('image_layout')); ?>" class="widefat">
                <option value="none" <?php selected($image_layout, 'none'); ?>>表示しない</option>
                <option value="overlay" <?php selected($image_layout, 'overlay'); ?>>重ねて表示</option>
                <option value="below" <?php selected($image_layout, 'below'); ?>>下に表示</option>
                <option value="side" <?php selected($image_layout, 'side'); ?>>横に表示</option>
            </select>
        </p>
        <?php
    }

    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? sanitize_text_field($new_instance['title']) : '';
        $instance['posts_per_page'] = (!empty($new_instance['posts_per_page'])) ? intval($new_instance['posts_per_page']) : 5;
        $instance['image_layout'] = (!empty($new_instance['image_layout'])) ? sanitize_text_field($new_instance['image_layout']) : 'none';
        return $instance;
    }
}
function register_popular_posts_widget() {
    register_widget('Popular_Posts_Widget');
}
add_action('widgets_init', 'register_popular_posts_widget');

// 新着記事ウィジェットの追加 (カスタマイズ版)
class New_Posts_Widget extends WP_Widget {
    function __construct() {
        parent::__construct(
            'new_posts_widget',
            '新着記事（カスタマイズ版）',
            array('description' => '新着記事を表示するウィジェットです')
        );
    }
    public function widget($args, $instance) {
        $hide_on_front = isset($instance['hide_on_front']) ? (bool) $instance['hide_on_front'] : false;

        // トップページで非表示にする設定の場合、トップページでは何も出力しない
        if ($hide_on_front && (is_front_page() || is_home())) {
            return;
        }

        echo $args['before_widget'];
        if (!empty($instance['title'])) {
            echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
        }

        $posts_per_page = !empty($instance['posts_per_page']) ? $instance['posts_per_page'] : 5;
        $image_layout = !empty($instance['image_layout']) ? $instance['image_layout'] : 'none';

        $new_posts_args = array(
            'posts_per_page' => $posts_per_page,
            'order' => 'DESC',
            'ignore_sticky_posts' => true
        );
        $new_posts_query = new WP_Query($new_posts_args);

        if ($new_posts_query->have_posts()) {
            echo '<ul class="widget-list">';
            while ($new_posts_query->have_posts()) {
                $new_posts_query->the_post();
                $post_class = 'widget-item';
                if ($image_layout !== 'none') {
                    $post_class .= ' has-thumbnail widget-item-' . esc_attr($image_layout);
                }
                echo '<li class="' . esc_attr($post_class) . '">';

                if ($image_layout === 'overlay' && has_post_thumbnail()) {
                    echo '<div class="widget-thumbnail-overlay">';
                    echo '<a href="' . get_the_permalink() . '">';
                    the_post_thumbnail('medium');
                    echo '<span class="widget-title-overlay">' . get_the_title() . '</span>';
                    echo '</a>';
                    echo '</div>';
                } elseif ($image_layout === 'below' && has_post_thumbnail()) {
                    echo '<a href="' . get_the_permalink() . '" class="widget-thumbnail-below">';
                    the_post_thumbnail('medium');
                    echo '</a>';
                    echo '<div class="widget-content">';
                    echo '<a href="' . get_the_permalink() . '" class="widget-title">' . get_the_title() . '</a>';
                    echo '</div>';
                } elseif ($image_layout === 'side' && has_post_thumbnail()) {
                    echo '<div class="widget-thumbnail-side">';
                    echo '<a href="' . get_the_permalink() . '">';
                    the_post_thumbnail('widget-thumb'); // widget-thumb サイズを使用
                    echo '</a>';
                    echo '</div>';
                    echo '<div class="widget-content">';
                    echo '<a href="' . get_the_permalink() . '" class="widget-title">' . get_the_title() . '</a>';
                    echo '</div>';
                } else {
                    echo '<div class="widget-content">';
                    echo '<a href="' . get_the_permalink() . '" class="widget-title">' . get_the_title() . '</a>';
                    echo '</div>';
                }

                echo '</li>';
            }
            echo '</ul>';
            wp_reset_postdata();
        } else {
            echo '新着記事は見つかりませんでした。';
        }
        echo $args['after_widget'];
    }

    public function form($instance) {
        $title = !empty($instance['title']) ? $instance['title'] : '新着記事';
        $posts_per_page = !empty($instance['posts_per_page']) ? $instance['posts_per_page'] : 5;
        $image_layout = !empty($instance['image_layout']) ? $instance['image_layout'] : 'none';
        $hide_on_front = isset($instance['hide_on_front']) ? (bool) $instance['hide_on_front'] : false;
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>">タイトル:</label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('posts_per_page')); ?>">表示件数:</label>
            <input class="tiny-text" id="<?php echo esc_attr($this->get_field_id('posts_per_page')); ?>" name="<?php echo esc_attr($this->get_field_name('posts_per_page')); ?>" type="number" step="1" min="1" value="<?php echo esc_attr($posts_per_page); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('image_layout')); ?>">アイキャッチ画像の表示形式:</label>
            <select id="<?php echo esc_attr($this->get_field_id('image_layout')); ?>" name="<?php echo esc_attr($this->get_field_name('image_layout')); ?>" class="widefat">
                <option value="none" <?php selected($image_layout, 'none'); ?>>表示しない</option>
                <option value="overlay" <?php selected($image_layout, 'overlay'); ?>>重ねて表示</option>
                <option value="below" <?php selected($image_layout, 'below'); ?>>下に表示</option>
                <option value="side" <?php selected($image_layout, 'side'); ?>>横に表示</option>
            </select>
        </p>
        <p>
            <input class="checkbox" type="checkbox" <?php checked($hide_on_front); ?> id="<?php echo esc_attr($this->get_field_id('hide_on_front')); ?>" name="<?php echo esc_attr($this->get_field_name('hide_on_front')); ?>" />
            <label for="<?php echo esc_attr($this->get_field_id('hide_on_front')); ?>">トップページで非表示にする</label>
        </p>
        <?php
    }
    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? sanitize_text_field($new_instance['title']) : '';
        $instance['posts_per_page'] = (!empty($new_instance['posts_per_page'])) ? intval($new_instance['posts_per_page']) : 5;
        $instance['image_layout'] = (!empty($new_instance['image_layout'])) ? sanitize_text_field($new_instance['image_layout']) : 'none';
        $instance['hide_on_front'] = isset($new_instance['hide_on_front']) ? (bool) $new_instance['hide_on_front'] : false;
        return $instance;
    }
}
function register_new_posts_widget() {
    register_widget('New_Posts_Widget');
}
add_action('widgets_init', 'register_new_posts_widget');

// 新着コメントウィジェットの追加 (カスタマイズ版)
class Recent_Comments_Widget extends WP_Widget {
    function __construct() {
        parent::__construct(
            'recent_comments_widget',
            '新着コメント（カスタマイズ版）',
            array('description' => '新着コメントを表示するウィジェットです')
        );
    }
    public function widget($args, $instance) {
        echo $args['before_widget'];
        if (!empty($instance['title'])) {
            echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
        }
        
        $posts_per_page = !empty($instance['posts_per_page']) ? $instance['posts_per_page'] : 5;

        $recent_comments = get_comments(array(
            'number' => $posts_per_page,
            'status' => 'approve'
        ));
        if ($recent_comments) {
            echo '<ul class="widget-list">';
            foreach ($recent_comments as $comment) {
                echo '<li class="widget-item">';
                echo '<a href="' . get_comment_link($comment) . '" class="widget-title">' . get_comment_author($comment) . 'さんのコメント</a>';
                echo '<div class="comment-excerpt">' . wp_trim_words( $comment->comment_content, 10, '...' ) . '</div>';
                echo '</li>';
            }
            echo '</ul>';
        } else {
            echo 'コメントは見つかりませんでした。';
        }
        echo $args['after_widget'];
    }
    public function form($instance) {
        $title = !empty($instance['title']) ? $instance['title'] : '新着コメント';
        $posts_per_page = !empty($instance['posts_per_page']) ? $instance['posts_per_page'] : 5;
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>">タイトル:</label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('posts_per_page')); ?>">表示件数:</label>
            <input class="tiny-text" id="<?php echo esc_attr($this->get_field_id('posts_per_page')); ?>" name="<?php echo esc_attr($this->get_field_name('posts_per_page')); ?>" type="number" step="1" min="1" value="<?php echo esc_attr($posts_per_page); ?>">
        </p>
        <?php
    }
    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? sanitize_text_field($new_instance['title']) : '';
        $instance['posts_per_page'] = (!empty($new_instance['posts_per_page'])) ? intval($new_instance['posts_per_page']) : 5;
        return $instance;
    }
}
function register_recent_comments_widget() {
    register_widget('Recent_Comments_Widget');
}
add_action('widgets_init', 'register_recent_comments_widget');

function rss_add_thumbnail($content) {
    global $post;
    if(has_post_thumbnail($post->ID)) {
        return '<p>' . get_the_post_thumbnail($post->ID) .'</p>' . $content;
    }
    return $content;
}
add_filter('the_excerpt_rss', 'rss_add_thumbnail');
add_filter('the_content_feed', 'rss_add_thumbnail');