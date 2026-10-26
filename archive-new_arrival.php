<?php get_header(); ?>

<section class="all-arrivals-section">
    <div class="all-arrivals-container">
        <div class="arrivals-inner">

            <!-- ヘッダーとページネーション -->
            <div class="all-arrivals-header">
                <h2 class="all-arrivals-title">
                    新着入荷商品一覧
                </h2>
                <div class="pagination">
                    <?php
                    // 上部のページネーション
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

            <section class="products-section">
                <div class="products-container">

                    <!-- 商品5列グリッド -->
                    <div class="products-grid">
                        <?php if (have_posts()) : ?>
                            <?php while (have_posts()) : the_post();
                                // カスタムフィールドの値を取得
                                $price        = get_post_meta(get_the_ID(), 'item_price', true);
                                $brand        = get_post_meta(get_the_ID(), 'item_brand', true);
                                $size         = get_post_meta(get_the_ID(), 'item_size', true);
                                $arrival_date = get_post_meta(get_the_ID(), 'item_arrival_date', true);

                                // 税込価格の自動計算＆カンマフォーマット
                                $raw_price       = str_replace([',', '円'], '', $price);
                                $tax_included    = is_numeric($raw_price) ? number_format(round($raw_price * 1.1)) : '';
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
                        <?php else : ?>
                            <p>現在、新着商品はありません。</p>
                        <?php endif; ?>
                    </div>
                </div>
            </section>

        </div>

        <div class="all-arrivals-footer-area">
            <div class="back-link">
                <a href="<?php echo esc_url(home_url('/')); ?>">← トップページに戻る</a>
            </div>
            <div class="pagination">
                <?php
                global $wp_query;
                $big = 999999999;
                echo paginate_links(array(
                    'base'      => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                    'format'    => '?paged=%#%',
                    'total'     => $wp_query->max_num_pages, // ←ここが `$custom_query` になっていたのが原因です
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