<?php get_header(); ?>

<main class="pickup-detail-section">
    <div class="pickup-detail-container">

        <!-- 戻るリンクまとめ -->
        <div class="back-link">
            <a href="<?php echo esc_url(home_url('/')); ?>">← トップページに戻る</a>
        </div>
        <div class="back-link">
            <a href="<?php echo esc_url(get_post_type_archive_link('pickup')); ?>">← ピックアップ一覧へ戻る</a>
        </div>

        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <!-- メインコンテンツ（2カラム） -->
            <div class="pickup-detail-content">

                <!-- 左側：画像（アイキャッチ画像のみ） -->
                <div class="pickup-detail-image">
                    <?php if (has_post_thumbnail()) : ?>
                        <?php the_post_thumbnail('full', array('alt' => get_the_title())); ?>
                    <?php endif; ?>
                </div>

                <!-- 右側：詳細テキスト -->
                <div class="pickup-detail-body">
                    <h1 class="pickup-detail-title"><?php the_title(); ?></h1>

                    <?php 
                    // ★ここを ensure: 本文（the_content）だけを出力する
                    // the_excerpt() は一切呼ばないので、抜粋の文章はここには表示されなくなります！
                    the_content(); 
                    ?>

                </div>
            </div>
        <?php endwhile; endif; ?>

    </div>
</main>

<!-- ページトップへ戻るボタン -->
<a href="#" class="page-top-btn">↑ ページ上部に戻る</a>

<!-- 共通スクリプト -->
    <script src="<?php echo get_template_directory_uri(); ?>/script.js"></script>

<?php get_footer(); ?>