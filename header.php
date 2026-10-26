<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title('|', true, 'right'); ?></title>
    
    <!-- CSSの読み込み -->
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/sp.css" media="screen and (max-width: 768px)">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<header class="site-header">
    <div class="header-container">
        <!-- ブランドロゴ -->
        <div class="logo">
            <a href="<?php echo esc_url( home_url('/') ); ?>">THRIFT</a>
        </div>

        <!-- ハンバーガーメニューボタン -->
        <button class="menu-toggle" id="menuToggle" aria-label="メニューを開く">
            <i class="fa-solid fa-bars" id="menuIcon"></i>
        </button>
    </div>

    <!-- メニュー背景の暗幕（オーバーレイ） -->
    <div class="menu-overlay" id="menuOverlay"></div>

    <!-- スライド・全画面メニュー -->
    <nav class="global-menu" id="globalMenu">
        <!-- スマホ用閉じるボタンやロゴ（必要に応じて） -->
        <ul class="menu-list">
            <li><a href="index.html#news">お知らせ</a></li>
            <li><a href="<?php echo esc_url( home_url('/about/') ); ?>">THRIFTについて</a></li>
            <li><a href="pickup.html">ピックアップ</a></li>
            <li><a href="new-arrivals.html">新着入荷商品</a></li>
            <li><a href="<?php echo esc_url( home_url('/shopping-guide/') ); ?>">商品のご購入・ご案内</a></li>
            <li><a href="<?php echo esc_url( home_url('/return/') ); ?>">返品・交換について</a></li>
            <li><a href="<?php echo esc_url( home_url('/faq/') ); ?>">よくある質問</a></li>
            <li><a href="<?php echo esc_url( home_url('/recruit/') ); ?>">スタッフ募集</a></li>
            <li><a href="<?php echo esc_url( home_url('/instagram/') ); ?>" target="_blank" rel="noopener">Instagram</a></li>
            <li><a href="<?php echo esc_url( home_url('/line/') ); ?>" target="_blank" rel="noopener">LINE</a></li>
            <li><a href="<?php echo esc_url( home_url('/contact/') ); ?>">お問い合わせ</a></li>
            <li><a href="<?php echo esc_url( home_url('/privacypolicy/') ); ?>">プライバシーポリシー</a></li>
        </ul>
    </nav>
    <?php wp_head(); ?>
</header>