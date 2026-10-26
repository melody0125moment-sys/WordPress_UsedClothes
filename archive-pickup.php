<?php get_header(); ?>

    <section class="all-pickup-section">
        <div class="all-pickup-container">
            <div class="pickup-inner">

                <?php
                // 1. データの取得とページネーションの準備
                $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                $args = array(
                    'post_type'      => 'pickup',
                    'posts_per_page' => 4, // 1ページあたりの表示件数
                    'paged'          => $paged,
                );
                $pickup_query = new WP_Query($args);

                // ページネーションリンクの生成
                $big_pagination_links = paginate_links(array(
                    'total'     => $pickup_query->max_num_pages,
                    'current'   => $paged,
                    'prev_text' => __('前へ'),
                    'next_text' => __('次へ'),
                ));
                ?>

                <!-- タイトルとページネーションのエリア -->
                <div class="all-pickup-header">
                    <h2 class="all-pickup-title">
                        ピックアップ一覧
                    </h2>
                    <div class="pagination">
                        <?php echo $big_pagination_links; ?>
                    </div>
                </div>

                <!-- 4列のカード一覧 -->
                <div class="all-pickup-grid">

                    <?php if ($pickup_query->have_posts()) : ?>
                        <?php while ($pickup_query->have_posts()) : $pickup_query->the_post(); ?>

                           <article class="all-pickup-card">
    <a href="<?php the_permalink(); ?>">
        <div class="card-img">
            <?php if (has_post_thumbnail()) : ?>
                <?php the_post_thumbnail('full'); ?>
            <?php endif; ?>
        </div>
        <div class="card-content">
            <h3 class="card-title"><?php the_title(); ?></h3>
            <div class="card-text">
                <?php 
                // 本文から画像タグを完全に除外し、テキストと改行（<br>など）だけを安全に出力する
                $content = get_post(get_the_ID())->post_content;
                // 自動で挿入される余計なHTMLや画像タグを取り除く
                $content = strip_tags($content, '<br><br class="pc-br"><br class="sp-br"><strong><span>');
                echo nl2br($content);
                ?>
            </div>
        </div>
    </a>
</article>

                        <?php endwhile; ?>
                        <?php wp_reset_postdata(); ?>
                    <?php else : ?>
                        <p>現在ピックアップ記事はありません。</p>
                    <?php endif; ?>

                </div>

                <!-- 下部のフッターエリア（戻るリンク＆ページネーション） -->
                <div class="pickup-footer-area">
                    <div class="back-link">
                        <a href="<?php echo esc_url(home_url('/')); ?>">← トップページに戻る</a>
                    </div>
                    <div class="pagination">
                        <?php echo $big_pagination_links; ?>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ページトップへ戻るボタン -->
    <a href="#" class="page-top-btn">↑ ページ上部に戻る</a>

<?php get_footer(); ?>