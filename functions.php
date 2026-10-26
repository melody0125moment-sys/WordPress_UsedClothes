<?php

// テーマ全体でアイキャッチ画像（post-thumbnails）を確実に有効化する
function setup_theme_thumbnails() {
    add_theme_support('post-thumbnails');
}
add_action('after_setup_theme', 'setup_theme_thumbnails');

// 「お知らせ」カスタム投稿タイプの追加
function create_news_post_type()
{
    register_post_type('news', array(
        'labels' => array(
            'name' => 'お知らせ',
            'singular_name' => 'お知らせ',
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail'),
        'show_in_rest' => true,
    ));
}
add_action('init', 'create_news_post_type');

// ピックアップ（pickup）のカスタム投稿タイプを追加
function create_pickup_post_type()
{
    $labels = array(
        'name'              => 'ピックアップ',
        'singular_name'     => 'ピックアップ',
        'menu_name'         => 'ピックアップ',
        'add_new'           => '新規追加',
        'add_new_item'      => '新しいピックアップを追加',
        'edit_item'         => 'ピックアップを編集',
        'new_item'          => '新しいピックアップ',
        'view_item'         => 'ピックアップを表示',
        'search_items'      => 'ピックアップを検索',
        'not_found'         => 'ピックアップが見つかりませんでした',
        'not_found_in_trash' => 'ゴミ箱にピックアップはありません',
    );
    $args = array(
        'labels'            => $labels,
        'public'            => true,
        'has_archive'       => true,
        'supports'          => array('title', 'editor', 'thumbnail', 'excerpt'),
        'show_in_rest'      => true,
        'menu_icon'         => 'dashicons-star-filled',
    );
    register_post_type('pickup', $args);
}
add_action('init', 'create_pickup_post_type');

// カスタム投稿タイプ「pickup」のアーカイブページの表示件数を4件にする
function change_pickup_posts_per_page($query) {
    if (!is_admin() && $query->is_main_query() && is_post_type_archive('pickup')) {
        $query->set('posts_per_page', 4);
    }
}
add_action('pre_get_posts', 'change_pickup_posts_per_page');

// 新着入荷商品（new_arrival）のカスタム投稿タイプを追加
function create_new_arrival_post_type() {
    $labels = array(
        'name'               => '新着入荷商品',
        'singular_name'      => '新着入荷商品',
        'menu_name'          => '新着入荷商品',
        'add_new'            => '新規追加',
        'add_new_item'       => '新しい商品を追加',
        'edit_item'          => '商品を編集',
        'new_item'           => '新しい商品',
        'view_item'          => '商品を表示',
        'search_items'       => '商品を検索',
        'not_found'          => '商品が見つかりませんでした',
        'not_found_in_trash' => 'ゴミ箱に商品はありません',
    );
    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'has_archive'        => true,
        'supports'           => array('title', 'thumbnail'),
        'show_in_rest'       => true,
        'menu_icon'          => 'dashicons-cart',
    );
    register_post_type('new_arrival', $args);
}
add_action('init', 'create_new_arrival_post_type');

// 「新着入荷商品」のタイトル入力欄のプレースホルダーを変更する
function change_new_arrival_title_placeholder($title, $post) {
    if ('new_arrival' === $post->post_type) {
        $title = '商品管理番号を入力（例：A-001）';
    }
    return $title;
}
add_filter('enter_title_here', 'change_new_arrival_title_placeholder', 10, 2);

// 【新着入荷用】詳細情報のメタボックス登録
function add_new_arrival_meta_boxes() {
    add_meta_box(
        'new_arrival_detail_box',
        '📦 商品の詳細情報',
        'render_new_arrival_meta_box',
        'new_arrival',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'add_new_arrival_meta_boxes');

// メタボックスの中身（管理画面の入力欄：税込欄を削除）
function render_new_arrival_meta_box($post) {
    wp_nonce_field('new_arrival_meta_nonce_action', 'new_arrival_meta_nonce');

    $price        = get_post_meta($post->ID, 'item_price', true);
    $brand        = get_post_meta($post->ID, 'item_brand', true);
    $size         = get_post_meta($post->ID, 'item_size', true);
    $arrival_date = get_post_meta($post->ID, 'item_arrival_date', true);
    ?>
    <p>
        <label><strong>価格（数字のみ 例：4700）:</strong></label><br>
        <input type="text" name="item_price" value="<?php echo esc_attr($price); ?>" style="width:100%;">
    </p>
    <p>
        <label><strong>ブランド名:</strong></label><br>
        <input type="text" name="item_brand" value="<?php echo esc_attr($brand); ?>" style="width:100%;">
    </p>
    <p>
        <label><strong>サイズ:</strong></label><br>
        <input type="text" name="item_size" value="<?php echo esc_attr($size); ?>" style="width:100%;">
    </p>
    <p>
        <label><strong>入荷日（例：2026.10.25）:</strong></label><br>
        <input type="text" name="item_arrival_date" value="<?php echo esc_attr($arrival_date); ?>" style="width:100%;">
    </p>
    <?php
}

// データの保存処理（税込データの保存を削除）
function save_new_arrival_meta_box($post_id) {
    if (!isset($_POST['new_arrival_meta_nonce']) || !wp_verify_nonce($_POST['new_arrival_meta_nonce'], 'new_arrival_meta_nonce_action')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    if (isset($_POST['item_price'])) {
        update_post_meta($post_id, 'item_price', sanitize_text_field($_POST['item_price']));
    }
    if (isset($_POST['item_brand'])) {
        update_post_meta($post_id, 'item_brand', sanitize_text_field($_POST['item_brand']));
    }
    if (isset($_POST['item_size'])) {
        update_post_meta($post_id, 'item_size', sanitize_text_field($_POST['item_size']));
    }
    if (isset($_POST['item_arrival_date'])) {
        update_post_meta($post_id, 'item_arrival_date', sanitize_text_field($_POST['item_arrival_date']));
    }
}
add_action('save_post', 'save_new_arrival_meta_box');

// 新着入荷商品（new_arrival）のアーカイブページの表示件数を5件にする
function change_new_arrival_posts_per_page($query) {
    if (!is_admin() && $query->is_main_query() && is_post_type_archive('new_arrival')) {
        $query->set('posts_per_page', 5);

        // 念のため投稿数制限を確実に適用する
        $query->set('nopaging', false);
    }
}
add_action('pre_get_posts', 'change_new_arrival_posts_per_page');

// manual.php の読み込み
require_once get_template_directory() . '/manual.php';
