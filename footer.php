<footer class="site-footer">
    <div class="footer-container">
        <!-- 左側：ブランド名 -->
        <div class="footer-brand">
            <a href="<?php echo esc_url( home_url('/') ); ?>">THRIFT</a>
        </div>

        <!-- 右側：各種リンク -->
        <div class="footer-links">
            <ul class="footer-menu">
                <li><a href="<?php echo esc_url( home_url('/about/') ); ?>">THRIFTについて</a></li>
                <li><a href="<?php echo esc_url( home_url('/shopping-guide/') ); ?>">商品のご購入・ご案内</a></li>
                <li><a href="<?php echo esc_url( home_url('/return/') ); ?>">返品・交換について</a></li>
                <li><a href="<?php echo esc_url( home_url('/faq/') ); ?>">よくある質問</a></li>
                <li><a href="<?php echo esc_url( home_url('/contact/') ); ?>">お問い合わせ</a></li>
                <li><a href="<?php echo esc_url( home_url('/privacypolicy/') ); ?>">プライバシーポリシー</a></li>
            </ul>
        </div>
    </div>
    <p class="footer-copyright">&copy; 2026 THRIFT All Rights Reserved.</p>
    <?php wp_footer(); ?>
</footer>