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

            <!-- バナー4枚のグリッド -->
            <div class="pickup-grid">
                <a href="pickup-1.html" class="pickup-card">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/pickup-1.jpg" alt="夏物SALE開催中！">
                </a>
                <a href="pickup-2.html" class="pickup-card">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/pickup-2.jpg" alt="大人のJEANS特集">
                </a>
                <a href="pickup-3.html" class="pickup-card">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/pickup-3.jpg" alt="Autumn Outer Collection">
                </a>
                <a href="pickup-4.html" class="pickup-card">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/pickup-4.jpg" alt="はじめてのVintage T-shirt">
                </a>
            </div>

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

                <!-- 商品1 -->
                <div class="product-card">
                    <div class="product-image-wrap">
                        <img src="<?php echo get_template_directory_uri(); ?>/images/item-1.jpg" alt="Harley-Davidson">
                    </div>
                    <div class="product-info">
                        <div class="product-price">4,700<span class="currency">円</span></div>
                        <div class="product-tax">(税込5,170円)</div>
                        <div class="product-brand">Harley-Davidson</div>
                        <div class="product-size">メンズS</div>
                        <div class="product-condition">コンディションA</div>
                    </div>
                </div>

                <!-- 商品2 -->
                <div class="product-card">
                    <div class="product-image-wrap">
                        <img src="<?php echo get_template_directory_uri(); ?>/images/item-2.jpg" alt="Ralph Lauren">
                    </div>
                    <div class="product-info">
                        <div class="product-price">6,200<span class="currency">円</span></div>
                        <div class="product-tax">(税込6,820円)</div>
                        <div class="product-brand">Ralph Lauren</div>
                        <div class="product-size">メンズXL</div>
                        <div class="product-condition">コンディションB</div>
                    </div>
                </div>

                <!-- 商品3 -->
                <div class="product-card">
                    <div class="product-image-wrap">
                        <img src="<?php echo get_template_directory_uri(); ?>/images/item-3.jpg" alt="Carhartt">
                    </div>
                    <div class="product-info">
                        <div class="product-price">3,800<span class="currency">円</span></div>
                        <div class="product-tax">(税込4,180円)</div>
                        <div class="product-brand">Carhartt</div>
                        <div class="product-size">レディースL</div>
                        <div class="product-condition">コンディションA</div>
                    </div>
                </div>

                <!-- 商品4 -->
                <div class="product-card">
                    <div class="product-image-wrap">
                        <img src="<?php echo get_template_directory_uri(); ?>/images/item-4.jpg" alt="Columbia">
                    </div>
                    <div class="product-info">
                        <div class="product-price">5,900<span class="currency">円</span></div>
                        <div class="product-tax">(税込6,490円)</div>
                        <div class="product-brand">Columbia</div>
                        <div class="product-size">メンズXL</div>
                        <div class="product-condition">コンディションC</div>
                    </div>
                </div>

                <!-- 商品5 -->
                <div class="product-card">
                    <div class="product-image-wrap">
                        <img src="<?php echo get_template_directory_uri(); ?>/images/item-5.jpg" alt="LACOSTE">
                    </div>
                    <div class="product-info">
                        <div class="product-price">4,300<span class="currency">円</span></div>
                        <div class="product-tax">(税込4,730円)</div>
                        <div class="product-brand">LACOSTE</div>
                        <div class="product-size">レディースM</div>
                        <div class="product-condition">コンディションB</div>
                    </div>
                </div>

            </div>

            <!-- もっと見るリンク -->
            <div class="products-more">
                <a href="new-arrivals.html">&rarr;もっと見る</a>
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