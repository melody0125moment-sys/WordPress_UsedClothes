<?php

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
        'name'             => 'ピックアップ',
        'singular_name'    => 'ピックアップ',
        'menu_name'        => 'ピックアップ',
        'add_new'          => '新規追加',
        'add_new_item'     => '新しいピックアップを追加',
        'edit_item'        => 'ピックアップを編集',
        'new_item'         => '新しいピックアップ',
        'view_item'        => 'ピックアップを表示',
        'search_items'     => 'ピックアップを検索',
        'not_found'        => 'ピックアップが見つかりませんでした',
        'not_found_in_trash' => 'ゴミ箱にピックアップはありません',
    );
    $args = array(
        'labels'           => $labels,
        'public'           => true,
        'has_archive'      => true,
        'supports'         => array('title', 'editor', 'thumbnail', 'excerpt'),
        'show_in_rest'     => true,
        'menu_icon'        => 'dashicons-star-filled',
    );
    register_post_type('pickup', $args);
}
add_action('init', 'create_pickup_post_type');

// カスタム投稿タイプ「pickup」のアーカイブページの表示件数を4件にする
function change_pickup_posts_per_page($query) {
    // 管理画面ではなく、かつメインクエリで、かつカスタム投稿タイプが「pickup」の場合
    if (!is_admin() && $query->is_main_query() && is_post_type_archive('pickup')) {
        $query->set('posts_per_page', 4);
    }
}
add_action('pre_get_posts', 'change_pickup_posts_per_page');