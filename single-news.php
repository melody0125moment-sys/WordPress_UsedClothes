<?php get_header(); ?>

<!-- お知らせ詳細メインセクション -->
<main class="news-detail-section">
    <div class="news-detail-container">
        
        <div class="back-link">
            <a href="<?php echo esc_url( home_url('/') ); ?>">← トップページに戻る</a>
        </div>

        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            
            <!-- タイトルと日付エリア -->
            <div class="news-detail-header">
                <h1><?php the_title(); ?></h1>
                <span><?php echo get_the_date('Y年n月j日'); ?>更新</span>
            </div>

            <!-- 本文エリア（管理画面で入力した内容がここに反映されます） -->
            <div class="news-detail-body">
                <?php the_content(); ?>
            </div>

        <?php endwhile; endif; ?>

    </div>
</main>

<!-- ページトップへ戻るボタン -->
<a href="#" class="page-top-btn">↑ ページ上部に戻る</a>

<?php get_footer(); ?>