<?php get_header(); ?>

<section class="all-pickup-section">
    <div class="all-pickup-container">
        
        <!-- ヘッダーとページネーション -->
        <div class="all-pickup-header">
            <h2 class="all-pickup-title">ピックアップ一覧</h2>
            <div class="pagination">
                <?php
                // メインクエリ用の安全なページネーション
                global $wp_query;
                $big = 999999999;
                echo paginate_links(array(
                    'base'      => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                    'format'    => '?paged=%#%',
                    'total'     => $wp_query->max_num_pages,
                    'current'   => max(1, get_query_var('paged')),
                    'prev_text' => __('前へ'),
                    'next_text' => __('次へ'),
                ));
                ?>
            </div>
        </div>

        <!-- カード一覧グリッド -->
        <div class="all-pickup-grid">
            <?php if (have_posts()) : ?>
                <?php while (have_posts()) : the_post(); ?>

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
    // 一覧用の一言（抜粋）を自動で表示する
    the_excerpt(); 
    ?>
</div>
                            </div>
                        </a>
                    </article>

                <?php endwhile; ?>
            <?php else : ?>
                <p>現在ピックアップ記事はありません。</p>
            <?php endif; ?>
        </div>

        <!-- フッターのページネーション -->
        <div class="pickup-footer-area">
            <div class="back-link">
                <a href="<?php echo esc_url(home_url('/')); ?>">← トップページに戻る</a>
            </div>
            <div class="pagination">
                <?php
                echo paginate_links(array(
                    'base'      => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                    'format'    => '?paged=%#%',
                    'total'     => $wp_query->max_num_pages,
                    'current'   => max(1, get_query_var('paged')),
                    'prev_text' => __('前へ'),
                    'next_text' => __('次へ'),
                ));
                ?>
            </div>
        </div>

    </div>
</section>

<!-- ページトップへ戻るボタン -->
<a href="#" class="page-top-btn">↑ ページ上部に戻る</a>

<!-- 共通スクリプト -->
    <script src="<?php echo get_template_directory_uri(); ?>/script.js"></script>

<?php get_footer(); ?>