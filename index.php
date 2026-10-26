<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>マイサイト</title>
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style.css">
    <!-- ★スマホ用の別CSS（768px以下でのみ読み込まれる） -->
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/sp.css" media="screen and (max-width: 768px)">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- Google Fonts (MonteCarlo) の読み込み -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=MonteCarlo&display=swap" rel="stylesheet">

    <!-- Google Fonts に Ledger を追加 -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ledger&family=MonteCarlo&display=swap" rel="stylesheet">
</head>

<body>

    <!-- 共通ヘッダー読み込みエリア -->
    <?php get_header(); ?>

    <!-- メインビジュアル -->
    <main class="hero">
        <div class="hero-overlay">
            <div class="hero-content">
                <h2 class="hero-title">THRIFT</h2>
                <p class="hero-subtitle">丁寧に選んだ服と暮らす、洗練された日常。</p>
            </div>
        </div>
    </main>

    <!-- お知らせセクション -->
    <section id="news" class="news-section">
        <div class="news-container">
            <div class="news-box">
                <div class="news-header">
                    <i class="fa-solid fa-circle-info news-icon"></i>
                    <span class="news-title">お知らせ</span>
                </div>
                <ul class="news-list">
                    <?php
                    // お知らせ用のデータを最新順で取得する設定（全件表示）
                    $args = array(
                        'post_type' => 'news',
                        'posts_per_page' => -1, // ★「-1」にすると件数制限なし（全件表示）になります！
                    );
                    $news_query = new WP_Query($args);
                    ?>

                    <?php if ($news_query->have_posts()) : ?>
                        <?php while ($news_query->have_posts()) : $news_query->the_post(); ?>
                            <li>
                                ・ <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </li>
                        <?php endwhile; ?>
                        <?php wp_reset_postdata(); ?>
                    <?php else : ?>
                        <li>現在お知らせはありません。</li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </section>

    <!-- ブランドコンセプト・バナーセクション -->
    <section class="concept-banner">
        <div class="concept-banner-container">
            <a href="<?php echo esc_url(home_url('/about/')); ?>" class="concept-banner-link">
                <div class="concept-banner-overlay">
                    <h2 class="concept-banner-title">THRIFTについて</h2>
                </div>
            </a>
        </div>
    </section>

    <!-- ピックアップセクション -->
    <section class="pickup-section">
        <div class="pickup-container">
            <!-- セクションタイトル -->
            <div class="pickup-header">
                <h2 class="pickup-title">
                    ピックアップ <span class="pickup-subtitle">Featured</span>
                </h2>
            </div>

            <?php
            // 「pickup」投稿を新しい順に4件取得するクエリ
            $args = array(
                'post_type'      => 'pickup',
                'posts_per_page' => 4, // 表示したい件数（4件）
                'orderby'        => 'date',
                'order'          => 'DESC',
            );
            $top_pickup_query = new WP_Query($args);
            ?>

            <?php if ($top_pickup_query->have_posts()) : ?>
                <!-- バナー4枚のグリッド -->
                <div class="pickup-grid">
                    <?php while ($top_pickup_query->have_posts()) : $top_pickup_query->the_post(); ?>

                        <a href="<?php the_permalink(); ?>" class="pickup-card">
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('full', array('alt' => get_the_title())); ?>
                            <?php endif; ?>
                        </a>

                    <?php endwhile; ?>
                </div>
                <?php wp_reset_postdata(); ?>
            <?php else : ?>
                <p>現在ピックアップ記事はありません。</p>
            <?php endif; ?>

            <!-- もっと見るリンク -->
            <div class="pickup-more">
                <a href="<?php echo esc_url(home_url('/pickup/')); ?>">&rarr;もっと見る</a>
            </div>
        </div>
    </section>

    <!-- 新着商品セクション -->
    <section class="products-section">
        <div class="products-container">
            <!-- セクションタイトル -->
            <div class="products-header">
                <h2 class="products-title">
                    新着入荷商品 <span class="products-subtitle">New Arrivals</span>
                </h2>
            </div>

            <!-- 商品カード5列グリッド -->
            <div class="products-grid">
                <?php
                // 1. 取得する条件の設定
                $args = array(
                    'post_type'      => 'new_arrival', // カスタム投稿タイプ名
                    'posts_per_page' => 5,             // 表示する件数（5件）
                    'orderby'        => 'date',        // 日付順
                    'order'          => 'DESC',        // 新しい順
                );
                $query = new WP_Query($args);
                ?>

                <?php if ($query->have_posts()) : ?>
                    <?php while ($query->have_posts()) : $query->the_post(); 
                        // カスタムフィールドの値を取得
                        $price        = get_post_meta(get_the_ID(), 'item_price', true);
                        $brand        = get_post_meta(get_the_ID(), 'item_brand', true);
                        $size         = get_post_meta(get_the_ID(), 'item_size', true);
                        $arrival_date = get_post_meta(get_the_ID(), 'item_arrival_date', true);

                        // 税込価格の自動計算＆カンマフォーマット
                        $raw_price     = str_replace([',', '円'], '', $price);
                        $tax_included  = is_numeric($raw_price) ? number_format(round($raw_price * 1.1)) : '';
                        $formatted_price = is_numeric($price) ? number_format($price) : $price;
                    ?>

                        <!-- 商品カード -->
                        <div class="product-card">
                            <div class="product-image-wrap">
                                <?php if (has_post_thumbnail()) : ?>
                                    <?php the_post_thumbnail('full'); ?>
                                <?php else : ?>
                                    <img src="<?php echo get_template_directory_uri(); ?>/images/no-image.jpg" alt="No Image">
                                <?php endif; ?>
                            </div>
                            <div class="product-info">
                                <?php if ($price) : ?>
                                    <div class="product-price"><?php echo esc_html($formatted_price); ?><span class="currency">円</span></div>
                                <?php endif; ?>

                                <?php if ($tax_included) : ?>
                                    <div class="product-tax">(税込<?php echo $tax_included; ?>円)</div>
                                <?php endif; ?>

                                <?php if ($brand) : ?>
                                    <div class="product-brand"><?php echo esc_html($brand); ?></div>
                                <?php endif; ?>

                                <?php if ($size) : ?>
                                    <div class="product-size"><?php echo esc_html($size); ?></div>
                                <?php endif; ?>

                                <?php if ($arrival_date) : ?>
                                    <div class="product-condition">入荷日：<?php echo esc_html($arrival_date); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                    <?php endwhile; ?>
                    <?php wp_reset_postdata(); ?>
                <?php else : ?>
                    <p>現在、新着商品はありません。</p>
                <?php endif; ?>

            </div>

            <!-- もっと見るリンク -->
            <div class="products-more">
                <a href="<?php echo esc_url(home_url('/new_arrival/')); ?>">&rarr;もっと見る</a>
            </div>
        </div>
    </section>



    <!-- 3つ並びのリンクバナーセクション -->
    <section class="info-banners-section">
        <div class="info-banners-container">

            <!-- 1つ目：商品のご購入・ご案内 -->
            <a href="<?php echo esc_url(home_url('/shopping-guide/')); ?>" class="info-banner-link"
                style="background-image: url('<?php echo get_template_directory_uri(); ?>/images/banner-stock.jpg');">
                <div class="info-banner-overlay">
                    <span class="info-banner-text">商品のご購入・<br class="sp-br">ご案内</span>
                </div>
            </a>

            <!-- 2つ目：返品・交換 -->
            <a href="<?php echo esc_url(home_url('/return/')); ?>" class="info-banner-link" style="background-image: url('<?php echo get_template_directory_uri(); ?>/images/banner-return.jpg');">
                <div class="info-banner-overlay">
                    <span class="info-banner-text">返品・交換<br class="sp-br">について</span>
                </div>
            </a>

            <!-- 3つ目：よくある質問（改行なし） -->
            <a href="<?php echo esc_url(home_url('/faq/')); ?>" class="info-banner-link" style="background-image: url('<?php echo get_template_directory_uri(); ?>/images/banner-faq.jpg');">
                <div class="info-banner-overlay">
                    <span class="info-banner-text">よくある質問</span>
                </div>
            </a>

        </div>
    </section>



    <!-- スタッフ募集セクション -->
    <section class="recruit-section">
        <div class="recruit-container">
            <h2 class="recruit-title">NEW STAFF募集中</h2>

            <div class="recruit-arrows">
                <span class="arrow">▼</span>
                <span class="arrow">▼</span>
            </div>

            <a href="<?php echo esc_url(home_url('/recruit/')); ?>" class="recruit-btn">募集要項を見る</a>
        </div>
    </section>

    <!-- SNSバナーセクション -->
    <section class="sns-section">
        <div class="sns-container">

            <!-- Instagramバナー -->
            <a href="<?php echo esc_url(home_url('/instagram/')); ?>" target="_blank" rel="noopener noreferrer" class="sns-card"
                style="background-image: url('<?php echo get_template_directory_uri(); ?>/images/sns-insta-bg.jpg');">
                <div class="sns-overlay">
                    <div class="sns-box">
                        <div class="sns-box-left">
                            <img src="<?php echo get_template_directory_uri(); ?>/images/icon-instagram.png" alt="Instagram" class="sns-icon">
                            <span class="sns-account">@thrift</span>
                        </div>
                        <div class="sns-box-right">
                            <h3 class="sns-title">Instagramで最新情報を配信中！</h3>
                            <p class="sns-desc">商品情報やコーディネートを随時掲載</p>
                        </div>
                    </div>
                </div>
            </a>

            <!-- LINEバナー -->
            <a href="<?php echo esc_url(home_url('/line/')); ?>" target="_blank" rel="noopener noreferrer" class="sns-card"
                style="background-image: url('<?php echo get_template_directory_uri(); ?>/images/sns-line-bg.jpg');">
                <div class="sns-overlay">
                    <div class="sns-box">
                        <div class="sns-box-left">
                            <img src="<?php echo get_template_directory_uri(); ?>/images/icon-line.png" alt="LINE" class="sns-icon line-icon">
                            <span class="sns-account">@thrift</span>
                        </div>
                        <div class="sns-box-right">
                            <h3 class="sns-title">LINEでお得な情報を配信中！</h3>
                            <p class="sns-desc">入荷情報やキャンペーン情報を随時掲載</p>
                        </div>
                    </div>
                </div>
            </a>

        </div>
    </section>
    <!-- ページトップへ戻るボタン -->
    <a href="#" class="page-top-btn">↑ ページ上部に戻る</a>

    <!-- フッターを読み込むための場所 -->
    <?php get_footer(); ?>

    <!-- 共通スクリプト -->
    <script src="<?php echo get_template_directory_uri(); ?>/script.js"></script>
</body>

</html>